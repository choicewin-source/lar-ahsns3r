<?php

namespace App\Traits;

/**
 * ProductCatalogTrait
 * 
 * Provides static brand and model catalogs for products.
 * Supports three category types:
 * - Product categories: phones, electronics (have brand + model)
 * - Service categories: restaurants, real estate (free text name only)
 * - Electric appliances: special case (model only, no brand required)
 * - Variant specs: furniture, tents (specifications only, no brand or model)
 */
trait ProductCatalogTrait
{
    use ElectricAppliancesCatalog;
    use FurnitureTentsCatalog;
    use ClothesCatalog;
    use GroceriesCatalog;
    use BuildingMaterialsCatalog;
    use PharmacyCatalog;
    use EntertainmentSportsCatalog;
    use AgricultureAnimalsCatalog;

    /**
     * Category type definitions
     * Determines whether a category requires brand/model selection
     */
    protected function getCategoryTypes(): array
    {
        return [
            'product' => [
                'جوالات وإلكترونيات',
                'سيارات ودراجات',
            ],
            'electric' => [
                'أجهزة كهربائية وطاقة',
            ],
            'variant_specs' => [
                'أثاث ومفروشات وخيام',
                'ملابس',
                'مواد غذائية وسوبر ماركت',
                'مواد بناء ولوازم منزلية',
                'صيدليات ومستلزمات طبية',
                'ترفيه وألعاب ورياضة',
                'زراعة وحيوانات',
            ],
            'service' => [
                'مطاعم',
                'عقارات',
                'خدمات إلكترونية',
                'خدمات عامة',
                'أخرى',
            ],
        ];
    }

    /**
     * Normalize Arabic text for comparison
     * Removes extra spaces and normalizes Arabic characters
     */
    private function normalizeText(?string $text): string
    {
        if (!$text) {
            return '';
        }
        
        // Trim and normalize spaces
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        
        // Normalize Arabic characters
        // Convert all forms of alef to simple alef
        $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
        
        // Convert Arabic-Indic digits to regular digits
        $text = str_replace(['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'], 
                           ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], $text);
        
        return $text;
    }

    /**
     * Check if category is a product type (requires brand + model)
     */
    public function isProductCategory(string $category): bool
    {
        $category = $this->normalizeText($category);
        $types = $this->getCategoryTypes();
        
        foreach ($types['product'] as $cat) {
            if ($this->normalizeText($cat) === $category) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if category is electric appliances (model only, no brand)
     */
    public function isElectricCategory(string $category): bool
    {
        $category = $this->normalizeText($category);
        $types = $this->getCategoryTypes();
        
        foreach ($types['electric'] as $cat) {
            if ($this->normalizeText($cat) === $category) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if category is variant specs type (specifications only, no brand)
     */
    public function isVariantSpecsCategory(string $category): bool
    {
        $category = $this->normalizeText($category);
        $types = $this->getCategoryTypes();
        
        foreach ($types['variant_specs'] as $cat) {
            if ($this->normalizeText($cat) === $category) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if category is a service type (free text name only)
     */
    public function isServiceCategory(string $category): bool
    {
        $category = $this->normalizeText($category);
        $types = $this->getCategoryTypes();
        
        foreach ($types['service'] as $cat) {
            if ($this->normalizeText($cat) === $category) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Electric device models catalog
     * Organized by subcategory with predefined model templates
     */
    protected function getElectricModelsCatalog(): array
    {
        return [
            'ثلاجة' => [
                'ثلاجة 200 لتر',
                'ثلاجة 300 لتر',
                'ثلاجة 400 لتر',
                'ثلاجة 500 لتر',
                'ثلاجة Side By Side',
                'ثلاجة French Door',
                'ثلاجة Mini Bar',
            ],
            'غسالة' => [
                'غسالة 5 كيلو',
                'غسالة 6 كيلو',
                'غسالة 7 كيلو',
                'غسالة 8 كيلو',
                'غسالة 9 كيلو',
                'غسالة 10 كيلو',
                'غسالة 12 كيلو',
                'غسالة Front Load',
                'غسالة Top Load',
                'غسالة Twin Tub',
            ],
            'شاشة تلفزيون' => [
                'شاشة 24 إنش HD',
                'شاشة 32 إنش HD',
                'شاشة 40 إنش Full HD',
                'شاشة 43 إنش Full HD',
                'شاشة 50 إنش 4K',
                'شاشة 55 إنش 4K',
                'شاشة 55 إنش OLED',
                'شاشة 65 إنش 4K',
                'شاشة 75 إنش 4K',
            ],
            'مولد كهرباء' => [
                'مولد 1 كيلو',
                'مولد 2 كيلو',
                'مولد 3 كيلو',
                'مولد 5 كيلو',
                'مولد 7 كيلو',
                'مولد 10 كيلو',
            ],
            'نظام طاقة شمسية' => [
                'لوح طاقة 360 واط',
                'لوح طاقة 450 واط',
                'لوح طاقة 550 واط',
                'لوح طاقة 660 واط',
                'نظام كامل 3 كيلو',
                'نظام كامل 5 كيلو',
                'نظام كامل 10 كيلو',
            ],
            'بطاريات' => [
                'بطارية 7 أمبير',
                'بطارية 9 أمبير',
                'بطارية 18 أمبير',
                'بطارية 26 أمبير',
                'بطارية 45 أمبير',
                'بطارية 65 أمبير',
                'بطارية 100 أمبير',
                'بطارية 150 أمبير',
                'بطارية 200 أمبير',
            ],
            'انفيرتر' => [
                'انفيرتر 0.5 كيلو',
                'انفيرتر 1 كيلو',
                'انفيرتر 1.5 كيلو',
                'انفيرتر 2 كيلو',
                'انفيرتر 2.5 كيلو',
                'انفيرتر 3 كيلو',
                'انفيرتر 4 كيلو',
                'انفيرتر 5 كيلو',
            ],
            'مراوح' => [
                'مروحة سقف 100 سم',
                'مروحة سقف 120 سم',
                'مروحة سقف 140 سم',
                'مروحة طاولة 30 سم',
                'مروحة طاولة 40 سم',
                'مروحة أرضية 40 سم',
                'مروحة أرضية 50 سم',
                'مروحة صندوقية',
            ],
        ];
    }


    /**
     * Brand catalog organized by category > subcategory
     */
    protected function getBrandsCatalog(): array
    {
        return [
            'جوالات وإلكترونيات' => [ // Must match database exactly
                'جوال' => [
                    'Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Google Pixel', 'OnePlus',
                    'Oppo', 'Vivo', 'Realme', 'Tecno', 'Infinix', 'Nokia',
                ],
                'لابتوب' => [
                    'Apple', 'HP', 'Dell', 'Lenovo', 'Asus', 'Acer', 'MSI', 'Huawei',
                ],
                'تابلت' => [
                    'Apple', 'Samsung', 'Huawei', 'Lenovo',
                ],
                'سماعات' => [
                    'Apple', 'Sony', 'Bose', 'JBL', 'Samsung', 'Xiaomi',
                ],
                'شواحن' => [
                    'Apple', 'Samsung', 'Xiaomi', 'Huawei', 'OnePlus', 'Anker', 'Baseus',
                ],
                'اكسسوارات' => [
                    'Apple', 'Samsung', 'Xiaomi', 'Anker', 'Baseus', 'UGREEN', 'Belkin', 'JSAUX',
                ],
                'صيانة' => [
                    'Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Dell', 'HP', 'Lenovo', 'Asus', 'صيانة عامة',
                ],
            ],
            'سيارات ودراجات' => [
                'سيارة' => [
                    'Toyota', 'Hyundai', 'Kia', 'Nissan', 'Honda', 'Mazda',
                    'Chevrolet', 'Ford', 'Volkswagen', 'BMW', 'Mercedes-Benz', 'Audi',
                ],
                'دراجة نارية' => [
                    'Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'KTM', 'Bajaj', 'Benelli', 'SYM',
                ],
                'دراجة هوائية' => [
                    'Giant', 'Trek', 'Trinx', 'Merida', 'Specialized', 'Scott',
                ],
            ],
        ];
    }

    /**
     * Get static brands for a category/subcategory combination
     */
    protected function staticBrandsCatalog(?string $category, ?string $subCategory): array
    {
        if (!$category || !$subCategory) {
            return [];
        }

        // Normalize inputs
        $category = $this->normalizeText($category);
        $subCategory = $this->normalizeText($subCategory);

        $catalog = $this->getBrandsCatalog();
        
        // Try direct match first
        if (isset($catalog[$category][$subCategory])) {
            return $catalog[$category][$subCategory];
        }
        
        // Try normalized match
        foreach ($catalog as $catKey => $subCats) {
            if ($this->normalizeText($catKey) === $category) {
                foreach ($subCats as $subKey => $brands) {
                    if ($this->normalizeText($subKey) === $subCategory) {
                        return $brands;
                    }
                }
            }
        }
        
        return [];
    }

    /**
     * Model catalog organized by category > subcategory > brand
     */
    protected function getModelsCatalog(): array
    {
        return [
            'جوالات وإلكترونيات' => [ // Must match database exactly
                'جوال' => [
                    'Apple' => [
                        'iPhone 16 Pro Max', 'iPhone 16 Pro', 'iPhone 16 Plus', 'iPhone 16',
                        'iPhone 15 Pro Max', 'iPhone 15 Pro', 'iPhone 15 Plus', 'iPhone 15',
                        'iPhone 14 Pro Max', 'iPhone 14 Pro', 'iPhone 14 Plus', 'iPhone 14',
                        'iPhone 13 Pro Max', 'iPhone 13 Pro', 'iPhone 13 Mini', 'iPhone 13',
                        'iPhone 12 Pro Max', 'iPhone 12 Pro', 'iPhone 12 Mini', 'iPhone 12',
                        'iPhone 11 Pro Max', 'iPhone 11 Pro', 'iPhone 11',
                        'iPhone XS Max', 'iPhone XS', 'iPhone XR', 'iPhone X',
                        'iPhone SE (2022)', 'iPhone SE (2020)',
                    ],
                    'Samsung' => [
                        'Galaxy S24 Ultra', 'Galaxy S24+', 'Galaxy S24',
                        'Galaxy S23 Ultra', 'Galaxy S23+', 'Galaxy S23', 'Galaxy S23 FE',
                        'Galaxy S22 Ultra', 'Galaxy S22+', 'Galaxy S22',
                        'Galaxy S21 Ultra', 'Galaxy S21+', 'Galaxy S21', 'Galaxy S21 FE',
                        'Galaxy Z Fold 6', 'Galaxy Z Flip 6', 'Galaxy Z Fold 5', 'Galaxy Z Flip 5',
                        'Galaxy A55', 'Galaxy A54', 'Galaxy A35', 'Galaxy A34', 'Galaxy A25', 'Galaxy A15',
                    ],
                    'Xiaomi' => [
                        'Xiaomi 14 Ultra', 'Xiaomi 14',
                        'Xiaomi 13T Pro', 'Xiaomi 13T',
                        'Redmi Note 13 Pro+', 'Redmi Note 13 Pro', 'Redmi Note 13',
                        'Poco F6 Pro', 'Poco F6', 'Poco X6 Pro', 'Poco X6', 'Poco M6 Pro',
                    ],
                    'Huawei' => [
                        'Huawei Pura 70 Ultra', 'Huawei Pura 70 Pro', 'Huawei Pura 70',
                        'Huawei Mate 60 Pro', 'Huawei Mate 60',
                        'Huawei P60 Pro', 'Huawei P60',
                        'Huawei Nova 12 Pro', 'Huawei Nova 12', 'Huawei Nova 11',
                    ],
                    'Google Pixel' => [
                        'Google Pixel 9 Pro XL', 'Google Pixel 9 Pro', 'Google Pixel 9',
                        'Google Pixel 8 Pro', 'Google Pixel 8', 'Google Pixel 8a',
                        'Google Pixel 7 Pro', 'Google Pixel 7', 'Google Pixel 7a',
                    ],
                    'OnePlus' => [
                        'OnePlus 12', 'OnePlus 12R',
                        'OnePlus 11', 'OnePlus 11R',
                        'OnePlus Nord 4', 'OnePlus Nord CE 4', 'OnePlus Nord 3',
                        'OnePlus Open',
                    ],
                    'Oppo' => [
                        'Oppo Find X7 Ultra', 'Oppo Find X7',
                        'Oppo Reno 12 Pro', 'Oppo Reno 12', 'Oppo Reno 11',
                        'Oppo A79', 'Oppo A59', 'Oppo A38',
                    ],
                    'Vivo' => [
                        'Vivo X100 Pro', 'Vivo X100',
                        'Vivo V40 Pro', 'Vivo V40', 'Vivo V30',
                        'Vivo Y200', 'Vivo Y100', 'Vivo Y36',
                    ],
                    'Realme' => [
                        'Realme GT 6', 'Realme GT 5 Pro',
                        'Realme 12 Pro+', 'Realme 12 Pro', 'Realme 12',
                        'Realme C67', 'Realme C65', 'Realme C55',
                    ],
                    'Tecno' => [
                        'Tecno Phantom X2 Pro', 'Tecno Phantom X2',
                        'Tecno Camon 30 Pro', 'Tecno Camon 30',
                        'Tecno Spark 20 Pro', 'Tecno Spark 20', 'Tecno Spark 10',
                    ],
                    'Infinix' => [
                        'Infinix Note 40 Pro', 'Infinix Note 40',
                        'Infinix Hot 40 Pro', 'Infinix Hot 40', 'Infinix Hot 30',
                        'Infinix Zero 30', 'Infinix Smart 8',
                    ],
                    'Nokia' => [
                        'Nokia G60', 'Nokia G42', 'Nokia G22',
                        'Nokia X30', 'Nokia X20',
                        'Nokia C32', 'Nokia C31', 'Nokia C21',
                    ],
                ],
                'لابتوب' => [
                    'Apple' => [
                        'MacBook Air M3', 'MacBook Air M2', 'MacBook Air M1',
                        'MacBook Pro 16 M3', 'MacBook Pro 14 M3',
                        'MacBook Pro 16 M2', 'MacBook Pro 14 M2', 'MacBook Pro 13 M2',
                    ],
                    'HP' => [
                        'HP Spectre x360', 'HP Envy x360', 'HP EliteBook 840 G8',
                        'HP Omen 16', 'HP Victus 16', 'HP Victus 15',
                        'HP Pavilion 15', 'HP 15s',
                    ],
                    'Dell' => [
                        'Dell XPS 15', 'Dell XPS 13',
                        'Dell Inspiron 15', 'Dell G15',
                        'Dell Latitude 5420', 'Dell Vostro 3510',
                    ],
                    'Lenovo' => [
                        'Lenovo Legion 7', 'Lenovo Legion 5', 'Lenovo LOQ 15',
                        'Lenovo ThinkPad T14', 'Lenovo ThinkPad E14',
                        'Lenovo IdeaPad 5', 'Lenovo IdeaPad 3',
                    ],
                    'Asus' => [
                        'Asus ROG Strix G16',
                        'Asus TUF Gaming F15', 'Asus TUF Gaming A15',
                        'Asus Zenbook 14',
                        'Asus Vivobook 16', 'Asus Vivobook 15',
                    ],
                ],
                'تابلت' => [
                    'Apple' => [
                        'iPad Pro 13 (M4)', 'iPad Pro 11 (M4)',
                        'iPad Air 6 (M2)', 'iPad Air 5',
                        'iPad 10th Gen', 'iPad 9th Gen',
                        'iPad Mini 6',
                    ],
                    'Samsung' => [
                        'Galaxy Tab S9 Ultra', 'Galaxy Tab S9+', 'Galaxy Tab S9', 'Galaxy Tab S9 FE',
                        'Galaxy Tab A9+', 'Galaxy Tab A9',
                    ],
                ],
                'سماعات' => [
                    'Apple' => [
                        'AirPods Pro 2 (USB-C)', 'AirPods Max', 'AirPods 3', 'AirPods 2',
                    ],
                    'Samsung' => [
                        'Galaxy Buds 2 Pro', 'Galaxy Buds 2', 'Galaxy Buds FE',
                    ],
                    'Sony' => [
                        'Sony WF-1000XM5', 'Sony WF-1000XM4',
                        'Sony WH-1000XM5', 'Sony WH-1000XM4',
                        'Sony LinkBuds S', 'Sony LinkBuds',
                    ],
                    'Bose' => [
                        'Bose QuietComfort Ultra', 'Bose QuietComfort 45',
                        'Bose QuietComfort Earbuds II', 'Bose Sport Earbuds',
                    ],
                    'JBL' => [
                        'JBL Live Pro 2', 'JBL Live Free 2',
                        'JBL Tune 760NC', 'JBL Tune 230NC',
                        'JBL Flip 6', 'JBL Charge 5',
                    ],
                    'Xiaomi' => [
                        'Xiaomi Buds 5', 'Xiaomi Buds 4 Pro',
                        'Redmi Buds 5 Pro', 'Redmi Buds 4',
                    ],
                ],
                'شواحن' => [
                    'Apple' => [
                        'شاحن 20W USB-C', 'شاحن 30W USB-C', 'شاحن 35W USB-C',
                        'MagSafe Charger', 'MagSafe Duo Charger',
                    ],
                    'Samsung' => [
                        'شاحن سريع 25W', 'شاحن سريع 45W', 'شاحن سريع 65W',
                        'شاحن لاسلكي 15W', 'Wireless Charger Duo',
                    ],
                    'Xiaomi' => [
                        'شاحن سريع 33W', 'شاحن سريع 67W', 'شاحن سريع 120W',
                        'شاحن لاسلكي 50W', 'شاحن لاسلكي 80W',
                    ],
                    'Huawei' => [
                        'شاحن سريع 40W', 'شاحن سريع 66W', 'شاحن سريع 100W',
                        'شاحن لاسلكي 40W',
                    ],
                    'OnePlus' => [
                        'SUPERVOOC 80W', 'SUPERVOOC 100W', 'SUPERVOOC 150W',
                        'شاحن لاسلكي 50W',
                    ],
                    'Anker' => [
                        'Anker 511 (20W)', 'Anker 735 (65W)', 'Anker 747 (150W)',
                        'PowerPort III 3-Port', 'PowerCore 10000',
                    ],
                    'Baseus' => [
                        'Baseus 20W PD', 'Baseus 65W GaN', 'Baseus 100W GaN',
                        'Baseus 20000mAh Power Bank',
                    ],
                ],
                'اكسسوارات' => [
                    // Generic accessories - same for all brands
                    'Apple' => $this->getGenericAccessories(),
                    'Samsung' => $this->getGenericAccessories(),
                    'Xiaomi' => $this->getGenericAccessories(),
                    'Huawei' => $this->getGenericAccessories(),
                    'Google Pixel' => $this->getGenericAccessories(),
                    'OnePlus' => $this->getGenericAccessories(),
                    'Oppo' => $this->getGenericAccessories(),
                    'Vivo' => $this->getGenericAccessories(),
                    'Realme' => $this->getGenericAccessories(),
                    'Anker' => $this->getGenericAccessories(),
                    'Baseus' => $this->getGenericAccessories(),
                    'UGREEN' => $this->getGenericAccessories(),
                    'Belkin' => $this->getGenericAccessories(),
                    'JSAUX' => $this->getGenericAccessories(),
                ],
                'صيانة' => [
                    'Apple' => [
                        'تبديل شاشة iPhone', 'تبديل بطارية iPhone',
                        'تبديل شاشة iPad', 'تبديل شاشة MacBook',
                        'إصلاح لوحة مفاتيح MacBook',
                    ],
                    'Samsung' => [
                        'تبديل شاشة Galaxy', 'تبديل بطارية Galaxy',
                        'إصلاح منفذ شحن', 'تبديل كاميرا خلفية',
                    ],
                    'Xiaomi' => [
                        'تبديل شاشة', 'تبديل بطارية',
                        'إصلاح منفذ شحن', 'فك تشفير (FRP)',
                    ],
                    'Huawei' => [
                        'تبديل شاشة', 'تبديل بطارية',
                        'إصلاح منفذ شحن',
                    ],
                    'Dell' => [
                        'تبديل شاشة لابتوب', 'تبديل بطارية لابتوب',
                        'إصلاح لوحة مفاتيح', 'تنظيف وصيانة',
                    ],
                    'HP' => [
                        'تبديل شاشة لابتوب', 'تبديل بطارية لابتوب',
                        'إصلاح لوحة مفاتيح', 'تنظيف وصيانة',
                    ],
                    'Lenovo' => [
                        'تبديل شاشة لابتوب', 'تبديل بطارية لابتوب',
                        'إصلاح لوحة مفاتيح', 'تنظيف وصيانة',
                    ],
                    'Asus' => [
                        'تبديل شاشة لابتوب', 'تبديل بطارية لابتوب',
                        'إصلاح لوحة مفاتيح', 'تنظيف وصيانة',
                    ],
                    'صيانة عامة' => [
                        'إصلاح برمجي (Software)', 'فورمات وتثبيت نظام',
                        'فك تشفير (FRP)', 'إزالة iCloud Lock',
                        'صيانة عامة',
                    ],
                ],
            ],
            'سيارات ودراجات' => [
                'سيارة' => [
                    'Toyota' => [
                        'Corolla', 'Camry', 'Yaris', 'Hilux', 'Land Cruiser', 'Prado', 'RAV4',
                    ],
                    'Hyundai' => [
                        'Elantra', 'Accent', 'Sonata', 'Tucson', 'Santa Fe', 'Creta',
                    ],
                    'Kia' => [
                        'Picanto', 'Rio', 'Cerato', 'K5', 'Sportage', 'Sorento',
                    ],
                    'Nissan' => [
                        'Sunny', 'Sentra', 'Altima', 'X-Trail', 'Pathfinder', 'Patrol',
                    ],
                    'Honda' => [
                        'Civic', 'Accord', 'CR-V', 'HR-V',
                    ],
                    'Mazda' => [
                        'Mazda 2', 'Mazda 3', 'Mazda 6', 'CX-5', 'CX-9',
                    ],
                    'Chevrolet' => [
                        'Aveo', 'Cruze', 'Malibu', 'Captiva', 'Tahoe',
                    ],
                    'Ford' => [
                        'Fiesta', 'Focus', 'Fusion', 'Escape', 'Explorer', 'Ranger',
                    ],
                    'Volkswagen' => [
                        'Golf', 'Passat', 'Jetta', 'Tiguan', 'Touareg',
                    ],
                    'BMW' => [
                        '318i', '320i', '330i', 'X1', 'X3', 'X5',
                    ],
                    'Mercedes-Benz' => [
                        'A200', 'C200', 'E200', 'E300', 'GLC', 'GLE',
                    ],
                    'Audi' => [
                        'A3', 'A4', 'A6', 'Q3', 'Q5', 'Q7',
                    ],
                ],
                'دراجة نارية' => [
                    'Honda' => [
                        'CBR 1000RR', 'CBR 600RR', 'CBR 500R', 'CB 650R', 'CB 125F', 'Africa Twin', 'PCX 160',
                    ],
                    'Yamaha' => [
                        'R1', 'R6', 'R3', 'MT-09', 'MT-07', 'MT-03', 'YZF R15', 'Aerox 155',
                    ],
                    'Suzuki' => [
                        'GSX-R1000', 'GSX-R750', 'GSX-R600', 'SV650', 'V-Strom 650', 'GN 125',
                    ],
                    'Kawasaki' => [
                        'Ninja 1000', 'Ninja 650', 'Ninja 400', 'Z900', 'Z650', 'Versys 650',
                    ],
                    'KTM' => [
                        'Duke 390', 'Duke 250', 'Duke 200', 'RC 390', 'Adventure 390',
                    ],
                    'Bajaj' => [
                        'Pulsar 150', 'Pulsar 200 NS', 'Pulsar 220F', 'Dominar 250', 'Dominar 400',
                    ],
                    'Benelli' => [
                        'TNT 150', 'TNT 250', 'TNT 600', 'TRK 502',
                    ],
                    'SYM' => [
                        'Wolf 150', 'Jet X 150', 'Cruisym 300',
                    ],
                ],
                'دراجة هوائية' => [
                    'Giant' => [
                        'ATX 830', 'ATX 860', 'Talon 2', 'Talon 3', 'Escape 3',
                    ],
                    'Trek' => [
                        'Marlin 5', 'Marlin 6', 'Marlin 7', 'FX 2', 'FX 3',
                    ],
                    'Trinx' => [
                        'M100', 'M116', 'M136', 'X1 Elite',
                    ],
                    'Merida' => [
                        'Big Seven 20', 'Big Nine 40', 'Crossway 100',
                    ],
                    'Specialized' => [
                        'Rockhopper', 'Sirrus X', 'Allez',
                    ],
                    'Scott' => [
                        'Aspect 950', 'Scale 970', 'Speedster 30',
                    ],
                ],
            ],
        ];
    }

    /**
     * Generic accessory models (reusable across brands)
     */
    private function getGenericAccessories(): array
    {
        return [
            'كفر حماية',
            'واقي شاشة (Screen Protector)',
            'شاحن جداري',
            'كيبل شحن',
            'Power Bank',
            'حامل جوال للسيارة',
            'سماعة سلكية',
        ];
    }

    /**
     * Get static models for a category/subcategory/brand combination
     */
    protected function staticModelsCatalog(?string $category, ?string $subCategory, ?string $brand): array
    {
        // Normalize inputs
        $category = $this->normalizeText($category);
        $subCategory = $this->normalizeText($subCategory);
        $brand = $this->normalizeText($brand);

        if (empty($category) || empty($subCategory) || empty($brand)) {
            return [];
        }

        $catalog = $this->getModelsCatalog();
        
        // Try direct match first
        if (isset($catalog[$category][$subCategory][$brand])) {
            return $catalog[$category][$subCategory][$brand];
        }
        
        // Try normalized match
        foreach ($catalog as $catKey => $subCats) {
            if ($this->normalizeText($catKey) === $category) {
                foreach ($subCats as $subKey => $brands) {
                    if ($this->normalizeText($subKey) === $subCategory) {
                        foreach ($brands as $brandKey => $models) {
                            if ($this->normalizeText($brandKey) === $brand) {
                                return $models;
                            }
                        }
                    }
                }
            }
        }
        
        return [];
    }

    /**
     * Determine if a category/subcategory should show brand field
     * Returns true if brand is required for this category
     */
    public function shouldShowBrandField(?string $category): bool
    {
        if (!$category) {
            return false;
        }

        // Electric appliances don't need brand
        if ($this->isElectricCategory($category)) {
            return false;
        }

        // Variant specs don't need brand
        if ($this->isVariantSpecsCategory($category)) {
            return false;
        }

        // Services don't need brand
        if ($this->isServiceCategory($category)) {
            return false;
        }

        // Product categories need brand
        return $this->isProductCategory($category);
    }

    /**
     * Get all available brands for a category/subcategory
     * Merges static catalog with database entries
     */
    public function getBrandsForSubcategory(?string $category, ?string $subCategory): array
    {
        if (!$category || !$subCategory) {
            return [];
        }

        // Only return brands for product categories
        if (!$this->isProductCategory($category)) {
            return [];
        }

        return $this->staticBrandsCatalog($category, $subCategory);
    }

    /**
     * Get all available models for a category/subcategory/brand
     * Handles electric appliances, variant specs, and regular products
     */
    public function getModelsForProduct(?string $category, ?string $subCategory, ?string $brand = null): array
    {
        if (!$category || !$subCategory) {
            return [];
        }

        // Electric appliances: return specifications without brand requirement
        if ($this->isElectricCategory($category)) {
            return $this->getElectricSpecsForSubCategory($subCategory);
        }

        // Variant specs: return specifications without brand requirement
        if ($this->isVariantSpecsCategory($category)) {
            $normalizedCategory = $this->normalizeText($category);
            
            if ($normalizedCategory === $this->normalizeText('أثاث ومفروشات وخيام')) {
                return $this->getFurnitureTentsSpecsForSubCategory($subCategory);
            }
            if ($normalizedCategory === $this->normalizeText('ملابس')) {
                return $this->getClothesSpecsForSubCategory($subCategory);
            }
            if ($normalizedCategory === $this->normalizeText('مواد غذائية وسوبر ماركت')) {
                // For groceries, return empty array - specs are handled separately via variantSpecs
                return [];
            }
            if ($normalizedCategory === $this->normalizeText('مواد بناء ولوازم منزلية')) {
                // For building materials, return empty array - specs are handled separately via variantSpecs
                return [];
            }
            if ($normalizedCategory === $this->normalizeText('صيدليات ومستلزمات طبية')) {
                // For pharmacy, return empty array - specs are handled separately via variantSpecs
                return [];
            }
            if ($normalizedCategory === $this->normalizeText('ترفيه وألعاب ورياضة')) {
                return $this->getEntertainmentSportsSpecsForSubCategory($subCategory);
            }
            if ($normalizedCategory === $this->normalizeText('زراعة وحيوانات')) {
                return $this->getAgricultureAnimalsSpecsForSubCategory($subCategory);
            }
            
            return [];
        }

        // Regular products: require brand
        if (!$brand) {
            return [];
        }

        return $this->staticModelsCatalog($category, $subCategory, $brand);
    }
}