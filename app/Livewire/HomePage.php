<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Ad;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class HomePage extends Component
{
    use WithPagination;

    public $search = ''; 
    public $selectedCategory = ''; 
    public $city = '';
    public $selectedShop = ''; // جديد: لفلترة منتجات محل معين

    // سيتم جلب القائمة من جدول الفئات
    public $categoriesList = [];

    public $cities = ['شمال غزة', 'مدينة غزة', 'المنطقة الوسطى', 'خانيونس', 'رفح'];
    public $ads = [];

    public function selectCategory($category)
    {
        $this->selectedCategory = $category === $this->selectedCategory ? '' : $category;
        $this->selectedShop = ''; // تصفير المحل عند اختيار قسم
        $this->resetPage(); 
    }

    public function mount()
    {
        // استقبال اسم المحل من الرابط إذا وجد (shop_profile)
        if(request()->has('shop')) {
            $this->selectedShop = request('shop');
        }

        // جلب الفئات من DB إذا وُجدت، وإلا fallback للقائمة الداخلية
        $this->categoriesList = Category::orderBy('id')->get()->map(function($c){
            return [
                'name' => $c->name,
                'icon' => $c->icon ?? '📦',
                'slug' => $c->slug,
                'subs' => $c->subs ?? [],
            ];
        })->toArray();

        // جلب الإعلانات المفعلّة
        $this->ads = Ad::where('is_active', true)->orderBy('position')->get()->groupBy('position')->toArray();
    }

    public function render()
    {
        $products = Product::query()
            ->where('is_approved', true) // يعرض فقط الموافق عليه
            ->when($this->search, function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('shop_name', 'like', '%'.$this->search.'%');
            })
            ->when($this->selectedCategory, function($q) {
                $q->where('category', $this->selectedCategory);
            })
            ->when($this->selectedShop, function($q) {
                $q->where('shop_name', $this->selectedShop);
            })
            ->when($this->city, function($q) {
                $q->where('city', $this->city);
            })
            // إظهار أفضل عرض لكل منتج (السعر الأدنى لكل اسم منتج)
            ->whereRaw('price = (select min(p2.price) from products p2 where p2.name = products.name and p2.is_approved = 1)')
            ->orderBy('price', 'asc')
            ->paginate(12);

        return view('livewire.home-page', [
            'products' => $products,
            'ads' => $this->ads,
        ]);
    }
}