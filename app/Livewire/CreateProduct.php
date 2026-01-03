<?php

namespace App\Livewire;

use App\Helpers\ProductHelper;
use App\Models\Product;
use App\Traits\ProductCatalogTrait;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreateProduct extends Component
{
    use WithFileUploads;
    use ProductCatalogTrait;

    public $name;
    public $price;
    public $city;
    public $address_details;
    public $contact_phone;
    public $shop_name;
    public $image;
    public $added_by;
    public $category;
    public $sub_category;
    public $brand;
    public $condition = 'new';
    public $categories = [];
    public $categoriesList = [];
    public $subCategories = [];
    public $brands = [];
    public $models = [];

    public function render()
    {
        $showBrandField = $this->category !== 'أجهزة كهربائية وطاقة';

        return view('livewire.create-product', [
            'brands' => $this->getBrandsProperty(),
            'models' => $this->getModelsProperty(),
            'showBrandField' => $showBrandField,
        ]);
    }

    public function getSubCategoriesProperty()
    {
        $subCategories = [];
        if ($this->category) {
            // البحث عن القسم في القائمة
            $cat = collect($this->categoriesList)->firstWhere('name', $this->category);

            // إذا تم العثور عليه وكان لديه subs
            if ($cat && isset($cat['subs'])) {
                $subs = $cat['subs'];
                // التأكد من أن subs هو array
                if (is_array($subs) && !empty($subs)) {
                    $subCategories = $subs;
                } elseif (is_string($subs)) {
                    // إذا كان string، حاول تحويله إلى array
                    $decoded = json_decode($subs, true);
                    if (is_array($decoded) && !empty($decoded)) {
                        $subCategories = $decoded;
                    }
                }
            }

            // إذا لم يتم العثور عليه أو كان فارغاً، حاول البحث مباشرة من قاعدة البيانات
            if (empty($subCategories)) {
                $categoryModel = Category::where('name', $this->category)->first();
                if ($categoryModel) {
                    $subs = $categoryModel->subs;
                    if (is_array($subs) && !empty($subs)) {
                        $subCategories = $subs;
                    } elseif (is_string($subs)) {
                        $decoded = json_decode($subs, true);
                        if (is_array($decoded) && !empty($decoded)) {
                            $subCategories = $decoded;
                        }
                    }
                }
            }
        }
        return $subCategories;
    }

    public function getBrandsProperty()
    {
        $brands = [];
        if ($this->category && $this->sub_category) {
            $brands = Product::query()
                ->where('is_approved', true)
                ->where('category', $this->category)
                ->where('sub_category', $this->sub_category)
                ->whereNotNull('brand')
                ->where('brand', '!=', '')
                ->select('brand')
                ->distinct()
                ->orderBy('brand')
                ->pluck('brand')
                ->toArray();

            $staticBrands = $this->staticBrandsCatalog($this->category, $this->sub_category);
            if (!empty($staticBrands)) {
                $brands = array_values(array_unique(array_merge($staticBrands, $brands)));
            }
        }
        return $brands;
    }

   
    public function getModelsProperty()
    {
        $models = [];
        
        // حالة خاصة: إذا كان القسم "أجهزة كهربائية وطاقة"
        if ($this->category === 'أجهزة كهربائية وطاقة' && $this->sub_category) {
            // جلب الموديلات الثابتة من الكتالوج
            $staticModels = $this->getElectricModels($this->sub_category);
            
            // جلب الموديلات من قاعدة البيانات (بدون brand)
            $dbModels = Product::query()
                ->where('is_approved', true)
                ->where('category', $this->category)
                ->where('sub_category', $this->sub_category)
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->selectRaw('name, MIN(created_at) as first_created_at')
                ->groupBy('name')
                ->orderBy('first_created_at', 'asc')
                ->pluck('name')
                ->toArray();
            
            // دمج الموديلات الثابتة مع الموديلات من قاعدة البيانات
            if (!empty($staticModels)) {
                $models = array_values(array_unique(array_merge($staticModels, $dbModels)));
            } else {
                $models = $dbModels;
            }
            
            return $models;
        }
        
        // الحالة العادية: للأقسام الأخرى (جوالات وإلكترونيات)
        if ($this->category && $this->sub_category && $this->brand) {
            // تنظيف القيم
            $category = trim($this->category);
            $subCategory = trim($this->sub_category);
            $brand = trim($this->brand);

            // جلب الموديلات الثابتة أولاً (من الكتالوج)
            $staticModels = $this->staticModelsCatalog($category, $subCategory, $brand);

            // جلب الموديلات من قاعدة البيانات
            $dbModels = Product::query()
                ->where('is_approved', true)
                ->where('category', $category)
                ->where('sub_category', $subCategory)
                ->where('brand', $brand)
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->selectRaw('name, MIN(created_at) as first_created_at')
                ->groupBy('name')
                ->orderBy('first_created_at', 'asc')
                ->pluck('name')
                ->toArray();

            // دمج الموديلات الثابتة مع الموديلات من قاعدة البيانات
            if (!empty($staticModels)) {
                $models = array_values(array_unique(array_merge($staticModels, $dbModels)));
            } else {
                $models = $dbModels;
            }
        }
        
        return $models;
    }

    public function mount()
    {
        // جلب فئات وقوائم فرعية من قاعدة البيانات مع الأيقونات
        $this->categoriesList = Category::orderBy('id')->get()->map(function($c){
            // التأكد من أن subs هو array
            $subs = $c->subs ?? [];
            if (!is_array($subs)) {
                $subs = json_decode($subs, true) ?? [];
            }

            return [
                'name' => $c->name,
                'icon' => $c->icon ?? '📦',
                'slug' => $c->slug,
                'subs' => $subs,
            ];
        })->toArray();

        // توافق مع الواجهة الحالية (تستخدم $categories)
        $this->categories = $this->categoriesList;

        // إذا المستخدم مسجل كمالك محل ومفعل، عيّن الحقول مسبقاً
        if (auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved) {
            $this->added_by = 'shop_owner';
            if (auth()->user()->shop_name) {
                $this->shop_name = auth()->user()->shop_name;
            }
            if (auth()->user()->shop_city) {
                $this->city = auth()->user()->shop_city;
            }
            if (auth()->user()->shop_phone) {
                $this->contact_phone = auth()->user()->shop_phone;
            }
        } else {
            // تلقائياً الزبون إذا لم يكن صاحب محل معتمد
            $this->added_by = 'customer';
        }
    }

    public function updatedCategory()
    {
        $this->sub_category = null;
        $this->brand = null;
        $this->name = null;
    }

    public function updatedSubCategory()
    {
        $this->brand = null;
        $this->name = null;
    }

    public function updatedBrand()
    {
        $this->name = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
            'category' => 'required',
            'sub_category' => 'required',
            'price' => 'required|numeric|min:0.01',
            'city' => 'required',
            'shop_name' => 'required',
            'added_by' => 'required|in:customer,shop_owner',
            'condition' => 'required|in:new,used',
            'image' => 'nullable|image|max:5120',
            'brand' => $this->category === 'أجهزة كهربائية وطاقة' ? 'nullable|string|max:255' : 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        // لا تولّد reference_code مسبقاً لتفادي مشاكل التزامن.
        // سيتم توليده تلقائياً في Model بعد الحصول على id.

        $data = [
            'name' => $this->name,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'brand' => $this->category === 'أجهزة كهربائية وطاقة' ? null : $this->brand,
            'price' => $this->price,
            'city' => $this->city,
            'shop_name' => $this->shop_name,
            'address_details' => $this->address_details,
            'contact_phone' => $this->contact_phone,
            'added_by' => $this->added_by,
            'condition' => $this->condition,
            'edit_token' => Str::random(40),
            'image_path' => $imagePath,
            'is_approved' => false,
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

        $product = Product::create($data);

        $ref = $product->reference_code ?: ProductHelper::generateReferenceCode($product->id);
        session()->flash('success', "تمت الإضافة بنجاح! كود العرض: {$ref}");

        return redirect()->route('home');
    }
}