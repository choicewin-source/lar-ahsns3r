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
    public $brandsList = []; // Renamed to avoid conflict
    public $modelsList = []; // Renamed to avoid conflict
    
    // For variant_specs with multiple dropdowns/inputs (groceries, pharmacy, building)
    public $variantSpecs = [];
    public $spec1;
    public $spec2;
    public $spec3;
    public $spec4;
    public $spec5;

    public function render()
    {
        // Use trait helper to determine if brand field should be shown
        $showBrandField = $this->shouldShowBrandField($this->category);
        
        // Determine category type
        $categoryType = $this->getCategoryType($this->category);
        
        // Get placeholder for service_text type
        $serviceTextPlaceholder = $this->getServiceTextPlaceholder($this->category, $this->sub_category);
        
        // Determine if condition field should be shown
        $showConditionField = $this->shouldShowConditionField($this->category, $this->sub_category, $categoryType);
        
        // Get variant specs configuration for groceries
        $this->updateVariantSpecs();

        return view('livewire.create-product', [
            'brands' => $this->brandsList,
            'models' => $this->modelsList,
            'showBrandField' => $showBrandField,
            'categoryType' => $categoryType,
            'serviceTextPlaceholder' => $serviceTextPlaceholder,
            'showConditionField' => $showConditionField,
        ]);
    }
    
    /**
     * Get the type of the current category
     */
    private function getCategoryType(?string $category): string
    {
        if (!$category) {
            return 'unknown';
        }
        
        if ($this->isServiceCategory($category)) {
            return 'service_text';
        }
        
        if ($this->isElectricCategory($category)) {
            return 'variant_specs';
        }
        
        if ($this->isVariantSpecsCategory($category)) {
            return 'variant_specs';
        }
        
        if ($this->isProductCategory($category)) {
            return 'brand_model';
        }
        
        return 'unknown';
    }
    
    /**
     * Determine if condition field should be shown
     * Only show for non-consumable products
     */
    private function shouldShowConditionField(?string $category, ?string $subCategory, string $categoryType): bool
    {
        if (!$category) {
            return false;
        }
        
        // Never show for service_text types
        if ($categoryType === 'service_text') {
            return false;
        }
        
        // Always show for brand_model types (phones, cars, etc.)
        if ($categoryType === 'brand_model') {
            return true;
        }
        
        $normalizedCategory = $this->normalizeText($category);
        $normalizedSubCategory = $this->normalizeText($subCategory);
        
        // Categories where condition is always relevant
        $allowedCategories = [
            'جوالات وإلكترونيات',
            'أثاث ومفروشات وخيام',
            'سيارات ودراجات',
            'ترفيه وألعاب ورياضة',
        ];
        
        foreach ($allowedCategories as $allowedCat) {
            if ($normalizedCategory === $this->normalizeText($allowedCat)) {
                return true;
            }
        }
        
        // Forbidden categories (consumables and services)
        $forbiddenCategories = [
            'مواد غذائية وسوبر ماركت',
            'صيدليات ومستلزمات طبية',
            'مطاعم',
            'عقارات',
            'خدمات إلكترونية',
            'خدمات عامة',
            'أخرى',
        ];
        
        foreach ($forbiddenCategories as $forbiddenCat) {
            if ($normalizedCategory === $this->normalizeText($forbiddenCat)) {
                return false;
            }
        }
        
        // For building materials, only show for non-consumable items
        if ($normalizedCategory === $this->normalizeText('مواد بناء ولوازم منزلية')) {
            // Show for tools/equipment subcategories
            $allowedSubs = ['أدوات كهربائية وسباكة', 'أدوات يدوية ومعدات صغيرة', 'أثاث منزلي وديكور'];
            foreach ($allowedSubs as $allowedSub) {
                if ($normalizedSubCategory === $this->normalizeText($allowedSub)) {
                    return true;
                }
            }
            return false;
        }
        
        // For variant_specs in agriculture/animals
        if ($normalizedCategory === $this->normalizeText('زراعة وحيوانات')) {
            // Show for equipment, not for consumables
            $allowedSubs = ['أدوات زراعة وبذور', 'معدات الري والأسمدة'];
            foreach ($allowedSubs as $allowedSub) {
                if ($normalizedSubCategory === $this->normalizeText($allowedSub)) {
                    return true;
                }
            }
            return false;
        }
        
        // Default to false for safety
        return false;
    }
    
    /**
     * Get placeholder text for service_text input
     */
    private function getServiceTextPlaceholder(?string $category, ?string $subCategory): string
    {
        if (!$category) {
            return 'وصف المنتج أو الخدمة';
        }
        
        $category = $this->normalizeText($category);
        
        // مطاعم
        if ($category === $this->normalizeText('مطاعم')) {
            return 'مثال: مطعم النخيل - وجبة شاورما - 15 شيكل';
        }
        
        // عقارات
        if ($category === $this->normalizeText('عقارات')) {
            if ($subCategory) {
                $sub = $this->normalizeText($subCategory);
                if (str_contains($sub, 'شقة')) {
                    return 'مثال: شقة للإيجار - 100 متر - الرمال - 500 شيكل/شهر';
                }
                if (str_contains($sub, 'ارض')) {
                    return 'مثال: أرض للبيع - 200 متر - البلد - 50000 شيكل';
                }
                if (str_contains($sub, 'محل')) {
                    return 'مثال: محل للإيجار - 30 متر - الشارع الرئيسي - 1000 شيكل/شهر';
                }
            }
            return 'مثال: إيجار/بيع - المساحة - الموقع - السعر';
        }
        
        // خدمات إلكترونية
        if ($category === $this->normalizeText('خدمات إلكترونية')) {
            return 'مثال: تصميم موقع - 7 أيام - 300 شيكل';
        }
        
        // خدمات عامة
        if ($category === $this->normalizeText('خدمات عامة')) {
            return 'مثال: صيانة كهرباء - الرمال - 50 شيكل';
        }
        
        // أخرى
        if ($category === $this->normalizeText('اخرى')) {
            return 'مثال: وصف مختصر للمنتج أو الخدمة - السعر';
        }
        
        return 'وصف المنتج أو الخدمة + السعر';
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

        // تحديد نوع الناشر تلقائياً
        // إذا المستخدم مسجل كمالك محل ومعتمد، يتم تعيينه كصاحب متجر
        if (auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved) {
            $this->added_by = 'shop_owner'; // سيظهر كـ "متجر معتمد" في الصفحة الرئيسية
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
            // تلقائياً زبون/مواطن إذا لم يكن صاحب محل معتمد
            $this->added_by = 'customer'; // سيظهر كـ "زبون" في الصفحة الرئيسية
        }
    }

    public function updatedCategory($value)
    {
        $this->sub_category = null;
        $this->brand = null;
        $this->name = null;
        $this->brandsList = [];
        $this->modelsList = [];
        $this->resetVariantSpecs();
    }

    public function updatedSubCategory($value)
    {
        $this->brand = null;
        $this->name = null;
        $this->modelsList = [];
        $this->resetVariantSpecs();
        
        // Don't update lists for service categories
        if ($this->isServiceCategory($this->category)) {
            return;
        }
        
        // Update brands list when subcategory changes
        $this->updateBrandsList();
        
        // If electric category or variant specs (no brands required), update models list directly
        if ($this->isElectricCategory($this->category) || $this->isVariantSpecsCategory($this->category)) {
            $this->updateModelsList();
            $this->updateVariantSpecs();
        }
    }

    public function updatedBrand($value)
    {
        $this->name = null;
        
        // Update models list when brand changes
        $this->updateModelsList();
    }
    
    /**
     * Update variant specs configuration when subcategory changes
     */
    private function updateVariantSpecs()
    {
        if (!$this->category || !$this->sub_category) {
            $this->variantSpecs = [];
            return;
        }
        
        $categoryType = $this->getCategoryType($this->category);
        if ($categoryType !== 'variant_specs') {
            $this->variantSpecs = [];
            return;
        }
        
        $normalizedCategory = $this->normalizeText($this->category);
        
        // Get specs based on category
        if ($normalizedCategory === $this->normalizeText('مواد غذائية وسوبر ماركت')) {
            $this->variantSpecs = $this->getGroceriesSpecsForSubCategory($this->sub_category);
        } elseif ($normalizedCategory === $this->normalizeText('صيدليات ومستلزمات طبية')) {
            $this->variantSpecs = $this->getPharmacySpecsForSubCategory($this->sub_category);
        } elseif ($normalizedCategory === $this->normalizeText('مواد بناء ولوازم منزلية')) {
            $this->variantSpecs = $this->getBuildingMaterialsSpecsForSubCategory($this->sub_category);
        } else {
            $this->variantSpecs = [];
        }
    }
    
    /**
     * Reset variant spec values
     */
    private function resetVariantSpecs()
    {
        $this->spec1 = null;
        $this->spec2 = null;
        $this->spec3 = null;
        $this->spec4 = null;
        $this->spec5 = null;
        $this->variantSpecs = [];
    }
    
    /**
     * Update spec values when any spec dropdown/input changes
     */
    public function updatedSpec1($value)
    {
        $this->updateNameFromSpecs();
    }
    
    public function updatedSpec2($value)
    {
        $this->updateNameFromSpecs();
    }
    
    public function updatedSpec3($value)
    {
        $this->updateNameFromSpecs();
    }
    
    public function updatedSpec4($value)
    {
        $this->updateNameFromSpecs();
    }
    
    public function updatedSpec5($value)
    {
        $this->updateNameFromSpecs();
    }
    
    /**
     * Combine all specs into the name field
     */
    private function updateNameFromSpecs()
    {
        $specs = array_filter([$this->spec1, $this->spec2, $this->spec3, $this->spec4, $this->spec5]);
        
        // Check if all required specs are filled
        $requiredCount = 0;
        foreach ($this->variantSpecs as $spec) {
            if (isset($spec['required']) && $spec['required']) {
                $requiredCount++;
            }
        }
        
        // Build name from filled specs
        if (!empty($specs) && count($specs) >= $requiredCount) {
            $this->name = implode(' - ', $specs);
        } else {
            $this->name = null;
        }
    }
    
    private function updateBrandsList()
    {
        if (!$this->category || !$this->sub_category) {
            $this->brandsList = [];
            return;
        }

        // Direct catalog for جوالات وإلكترونيات
        $directCatalog = [
            'جوال' => ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Google Pixel', 'OnePlus', 'Oppo', 'Vivo', 'Realme', 'Tecno', 'Infinix', 'Nokia'],
            'لابتوب' => ['Apple', 'HP', 'Dell', 'Lenovo', 'Asus', 'Acer', 'MSI', 'Huawei'],
            'تابلت' => ['Apple', 'Samsung', 'Huawei', 'Lenovo'],
            'سماعات' => ['Apple', 'Samsung', 'Sony', 'Bose', 'JBL', 'Xiaomi'],
            'شواحن' => ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'OnePlus', 'Anker', 'Baseus'],
            'اكسسوارات' => ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Google Pixel', 'OnePlus', 'Oppo', 'Vivo', 'Realme', 'Anker', 'Baseus', 'UGREEN', 'Belkin', 'JSAUX'],
            'صيانة' => ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Dell', 'HP', 'Lenovo', 'Asus', 'صيانة عامة'],
        ];

        $staticBrands = [];
        
        // Check if this is جوالات وإلكترونيات category
        if (strpos($this->category, 'جوالات') !== false && strpos($this->category, 'لكترونيات') !== false) {
            $staticBrands = $directCatalog[$this->sub_category] ?? [];
        } else {
            // Use trait method for other categories
            $staticBrands = $this->getBrandsForSubcategory($this->category, $this->sub_category);
        }
        
        // Get user-added brands from database
        $dbBrands = Product::query()
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

        // Merge and deduplicate
        if (!empty($staticBrands)) {
            $this->brandsList = array_values(array_unique(array_merge($staticBrands, $dbBrands)));
        } else {
            $this->brandsList = $dbBrands;
        }
    }
    
    private function updateModelsList()
    {
        if (!$this->category || !$this->sub_category) {
            $this->modelsList = [];
            return;
        }
        
        // For groceries with multiple specs, don't populate models list
        if ($this->normalizeText($this->category) === $this->normalizeText('مواد غذائية وسوبر ماركت')) {
            $this->modelsList = [];
            return;
        }

        // Get static models from catalog
        $staticModels = $this->getModelsForProduct(
            $this->category,
            $this->sub_category,
            $this->brand
        );

        // Build database query
        $query = Product::query()
            ->where('is_approved', true)
            ->where('category', $this->category)
            ->where('sub_category', $this->sub_category)
            ->whereNotNull('name')
            ->where('name', '!=', '');

        // Add brand filter if not electric category
        if (!$this->isElectricCategory($this->category) && $this->brand) {
            $query->where('brand', $this->brand);
        }

        $dbModels = $query
            ->selectRaw('name, MIN(created_at) as first_created_at')
            ->groupBy('name')
            ->orderBy('first_created_at', 'asc')
            ->pluck('name')
            ->toArray();

        // Merge and deduplicate
        if (!empty($staticModels)) {
            $this->modelsList = array_values(array_unique(array_merge($staticModels, $dbModels)));
        } else {
            $this->modelsList = $dbModels;
        }
    }

    public function store()
    {
        $categoryType = $this->getCategoryType($this->category);
        $showConditionField = $this->shouldShowConditionField($this->category, $this->sub_category, $categoryType);
        
        $this->validate([
            'name' => 'required|min:2',
            'category' => 'required',
            'sub_category' => 'required',
            'price' => 'required|numeric|min:0.01',
            'city' => 'required',
            'shop_name' => 'required',
            'added_by' => 'required|in:customer,shop_owner',
            'condition' => $showConditionField ? 'required|in:new,used' : 'nullable|in:new,used',
            'image' => 'nullable|image|max:5120',
            'brand' => $this->shouldShowBrandField($this->category) ? 'required|string|max:255' : 'nullable|string|max:255',
        ]);
        
        // Set default condition if not shown
        if (!$showConditionField && !$this->condition) {
            $this->condition = 'new';
        }

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
            'brand' => $this->shouldShowBrandField($this->category) ? $this->brand : null,
            'price' => $this->price,
            'city' => $this->city,
            'shop_name' => $this->shop_name,
            'address_details' => $this->address_details,
            'contact_phone' => $this->contact_phone,
            'added_by' => $this->added_by,
            'condition' => $this->condition,
            'edit_token' => Str::random(40),
            'image_path' => $imagePath,
            // تلقائياً معتمد، كما في ProductController
            'is_approved' => true,
        ];

        // إذا المستخدم مسجل ومالك متجر معتمد، اربط المنتج بحسابه
        if (auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved) {
            $data['user_id'] = auth()->id();
            $data['added_by'] = 'shop_owner'; // ضمان أن المنتج يُعرض كمنتج من متجر معتمد
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