<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreateProduct extends Component
{
    use WithFileUploads;

    public $name, $category, $sub_category, $brand, $price, $shop_name, $city, $address_details, $contact_phone;
    public $image;
    public $added_by = 'customer';

    // الفئات ستُحمّل من جدول الفئات إن وُجدت
    public $categories = [];

    public function render()
    {
        return view('livewire.create-product');
    }

    public function mount()
    {
        // جلب فئات وقوائم فرعية من قاعدة البيانات إذا وُجدت
        $this->categories = Category::orderBy('id')->get()->mapWithKeys(function($c){
            return [$c->name => $c->subs ?? []];
        })->toArray();

        // إذا المستخدم مسجل كمالك محل ومفعل، عيّن الحقول مسبقاً
        if (auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved) {
            $this->added_by = 'shop_owner';
            if (auth()->user()->shop_name) {
                $this->shop_name = auth()->user()->shop_name;
            }
            if (auth()->user()->shop_city) {
                $this->city = auth()->user()->shop_city;
            }
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
            'category' => 'required',
            'sub_category' => 'required',
            'price' => 'required|numeric|min:0',
            'city' => 'required',
            'shop_name' => 'required',
            'added_by' => 'required',
            'image' => 'nullable|image|max:5120',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        // توليد كود العرض (مثلاً: AS-9284)
        $refCode = 'AS-' . mt_rand(1000, 9999);

        $data = [
            'name' => $this->name,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'brand' => $this->brand,
            'price' => $this->price,
            'city' => $this->city,
            'shop_name' => $this->shop_name,
            'address_details' => $this->address_details,
            'contact_phone' => $this->contact_phone,
            'added_by' => $this->added_by,
            'edit_token' => Str::random(40),
            'image_path' => $imagePath,
            'reference_code' => $refCode,
            'is_approved' => true, // مفعل تلقائياً حسب الطلب المبدئي
        ];

        // إذا المستخدم مسجل ومالك متجر ومفعل، اربط المنتج بحسابه
        if (auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved) {
            $data['user_id'] = auth()->id();
            $data['added_by'] = 'shop_owner';
            // إذا لم يُعطِ اسم محل في الفورم، خذ الاسم من حسابه
            if (empty($data['shop_name']) && auth()->user()->shop_name) {
                $data['shop_name'] = auth()->user()->shop_name;
            }
        }

        Product::create($data);

        return redirect()->route('home')->with('success', 'تمت الإضافة! كود العرض الخاص بك هو: ' . $refCode);
    }
}