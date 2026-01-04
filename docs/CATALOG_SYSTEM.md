# Product Catalog System Documentation

## Overview

The Product Catalog System provides a clean, data-driven approach to managing product brands and models in the price comparison platform.

## Category Types

The system supports three distinct category types:

### 1. Product Categories
Categories that require both **brand** and **model** selection:
- جوالات وإلكترونيات (Phones & Electronics)
- أثاث ومفروشات وخيام (Furniture & Furnishings)
- سيارات ودراجات (Vehicles & Bikes)
- ملابس (Clothing)
- ترفيه وألعاب ورياضة (Entertainment & Sports)

**User Flow:**
1. Select category → 2. Select subcategory → 3. Select brand → 4. Select/enter model → 5. Enter price

### 2. Electric Appliances
Special category that requires **model only** (no brand):
- أجهزة كهربائية وطاقة (Electric Appliances & Energy)

**User Flow:**
1. Select category → 2. Select subcategory → 3. Select/enter model → 4. Enter price

**Why no brand?**
Electric appliances often have generic specifications (e.g., "ثلاجة 400L Side By Side") that are more important than brand names in the local market.

### 3. Service Categories
Categories that only require **free text name** (no brand or model selection):
- مطاعم (Restaurants)
- عقارات (Real Estate)
- خدمات إلكترونية (Digital Services)
- مواد غذائية وسوبر ماركت (Groceries & Supermarket)
- مواد بناء ولوازم منزلية (Building Materials)
- صيدليات ومستلزمات طبية (Pharmacies & Medical)
- خدمات عامة (General Services)
- زراعة وحيوانات (Agriculture & Animals)
- أخرى (Other)

**User Flow:**
1. Select category → 2. Select subcategory → 3. Enter name (free text) → 4. Enter price

**Examples:**
- Restaurant: "وجبة شاورما كبيرة"
- Real Estate: "شقة 3 غرف طابق ثالث"

## Architecture

### ProductCatalogTrait Methods

#### Category Type Checkers

```php
// Check if category is a product type (requires brand + model)
public function isProductCategory(string $category): bool

// Check if category is electric appliances (model only)
public function isElectricCategory(string $category): bool

// Check if category is a service (free text only)
public function isServiceCategory(string $category): bool

// Determine if brand field should be shown
public function shouldShowBrandField(?string $category): bool
```

#### Data Access Methods

```php
// Get brands for a specific category/subcategory
public function getBrandsForSubcategory(?string $category, ?string $subCategory): array

// Get models for a product (handles both electric and regular)
public function getModelsForProduct(?string $category, ?string $subCategory, ?string $brand = null): array
```

#### Internal Catalog Methods

```php
// Returns the full electric models catalog
protected function getElectricModelsCatalog(): array

// Returns the full brands catalog
protected function getBrandsCatalog(): array

// Returns the full models catalog
protected function getModelsCatalog(): array
```

## Data Structure

### Electric Models Catalog
```php
[
    'ثلاجة' => [
        'ثلاجة 300L Top Freezer',
        'ثلاجة 400L Side By Side',
        ...
    ],
    'غسالة' => [
        'غسالة 7KG Front Load',
        ...
    ],
    ...
]
```

### Brands Catalog
```php
[
    'جوالات وإلكترونيات' => [
        'جوال' => ['Apple', 'Samsung', 'Xiaomi', ...],
        'لابتوب' => ['Apple', 'HP', 'Dell', ...],
        ...
    ],
]
```

### Models Catalog
```php
[
    'جوالات وإلكترونيات' => [
        'جوال' => [
            'Apple' => ['iPhone 16 Pro Max', 'iPhone 16 Pro', ...],
            'Samsung' => ['Galaxy S24 Ultra', 'Galaxy S24+', ...],
            ...
        ],
        ...
    ],
]
```

## Adding New Data

### Adding a New Electric Model
Edit `getElectricModelsCatalog()` in ProductCatalogTrait:

```php
'شاشة تلفزيون' => [
    'شاشة 32 بوصة HD',
    'شاشة 43 بوصة Full HD',
    'شاشة 65 بوصة 8K', // ← New model
],
```

### Adding a New Brand
Edit `getBrandsCatalog()`:

```php
'جوالات وإلكترونيات' => [
    'جوال' => [
        'Apple', 'Samsung', 'Xiaomi',
        'Nothing', // ← New brand
    ],
],
```

### Adding Models for a Brand
Edit `getModelsCatalog()`:

```php
'جوال' => [
    'Apple' => [...existing models...],
    'Nothing' => [ // ← New brand with models
        'Nothing Phone 2',
        'Nothing Phone 2a',
    ],
],
```

### Adding a New Product Category
1. Add category to `getCategoryTypes()` under 'product':
```php
'product' => [
    'جوالات وإلكترونيات',
    'كتب ومجلات', // ← New category
],
```

2. Add brand catalog:
```php
'كتب ومجلات' => [
    'كتاب' => ['دار المعرفة', 'دار الشروق', ...],
],
```

3. Add model catalog (if needed):
```php
'كتب ومجلات' => [
    'كتاب' => [
        'دار المعرفة' => ['كتاب البرمجة', 'كتاب التصميم', ...],
    ],
],
```

## Database Integration

The system merges static catalog data with user-contributed data from the database:

1. **Static Catalog** (from trait) - curated, high-quality entries
2. **Database Entries** (from approved products) - user contributions

This hybrid approach prevents database pollution while allowing flexibility.

## Validation Rules

### Product Categories
```php
'category' => 'required',
'sub_category' => 'required',
'brand' => 'required|string|max:255',
'name' => 'required|min:2', // Model
'price' => 'required|numeric|min:0.01',
```

### Electric Appliances
```php
'category' => 'required',
'sub_category' => 'required',
'brand' => 'nullable', // No brand required
'name' => 'required|min:2', // Model
'price' => 'required|numeric|min:0.01',
```

### Service Categories
```php
'category' => 'required',
'sub_category' => 'required',
'brand' => 'nullable', // No brand
'name' => 'required|min:2', // Free text description
'price' => 'required|numeric|min:0.01',
```

## Benefits of This Architecture

### ✅ Simplicity
- Clear separation of concerns
- Easy to understand data structures
- No database migrations needed for catalog updates

### ✅ Maintainability
- Single source of truth for catalog data
- Easy to add new brands/models
- Consistent validation logic

### ✅ Scalability
- Can easily add new category types
- Supports custom user entries (pending approval)
- Merges static + dynamic data seamlessly

### ✅ Data Quality
- Prevents typos and duplicates
- Provides suggestions to users
- Maintains consistency across platform

## Future Enhancements

### Phase 2 (Later)
- Move catalogs to database tables
- Add admin panel for catalog management
- Implement approval workflow for custom entries
- Add image associations for brands/models

### Phase 3 (Advanced)
- API integration for auto-updating catalogs
- Machine learning for duplicate detection
- Advanced search and filtering
- Multi-language support

## Notes

- Keep catalog data focused and relevant to the local market
- Prioritize commonly searched items
- Review and update catalogs quarterly
- Monitor user-submitted entries for patterns

---

**Last Updated:** 2026-01-03
**Version:** 1.0.0