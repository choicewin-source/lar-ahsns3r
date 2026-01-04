<?php

namespace App\Traits;

trait BuildingMaterialsCatalog
{
    private function normalizeBuildingText(?string $text): string
    {
        if (!$text) {
            return '';
        }
        
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
        
        return $text;
    }

    /**
     * Get specifications structure for building materials subcategories
     * Returns array of specs with their types and options
     */
    protected function getBuildingMaterialsSpecifications(): array
    {
        return [
            'مواد بناء أساسية' => [
                [
                    'name' => 'النوع',
                    'type' => 'select',
                    'options' => ['اسمنت', 'رمل', 'باطون', 'حصمة']
                ],
                [
                    'name' => 'الكمية',
                    'type' => 'select',
                    'options' => ['كيس', 'طن', 'متر مكعب']
                ],
                [
                    'name' => 'الاستخدام',
                    'type' => 'select',
                    'options' => ['بناء', 'تشطيب']
                ],
            ],
            'أدوات كهربائية وسباكة' => [
                [
                    'name' => 'الاسم',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: مثقاب كهربائي'
                ],
                [
                    'name' => 'الاستخدام',
                    'type' => 'select',
                    'options' => ['كهرباء', 'سباكة', 'يدوي']
                ],
            ],
            'دهانات وأخشاب' => [
                [
                    'name' => 'النوع',
                    'type' => 'select',
                    'options' => ['بلاستيك', 'زيتي', 'خشب']
                ],
                [
                    'name' => 'اللون',
                    'type' => 'text',
                    'placeholder' => 'مثال: أبيض'
                ],
                [
                    'name' => 'الحجم',
                    'type' => 'select',
                    'options' => ['1 لتر', '4 لتر', '18 لتر']
                ],
            ],
            'أثاث منزلي وديكور' => [
                [
                    'name' => 'اسم المنتج',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: طاولة خشبية'
                ],
                [
                    'name' => 'المادة',
                    'type' => 'select',
                    'options' => ['خشب', 'معدن', 'بلاستيك', 'زجاج']
                ],
            ],
            'أدوات يدوية ومعدات صغيرة' => [
                [
                    'name' => 'الاسم',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: مطرقة'
                ],
                [
                    'name' => 'الاستخدام',
                    'type' => 'select',
                    'options' => ['كهرباء', 'سباكة', 'يدوي', 'نجارة']
                ],
            ],
        ];
    }

    /**
     * Get specifications for a specific building materials subcategory
     * Returns array of spec definitions with names, types and options
     */
    public function getBuildingMaterialsSpecsForSubCategory(?string $subCategory): array
    {
        if (empty($subCategory)) {
            return [];
        }

        $subCategory = $this->normalizeBuildingText($subCategory);
        $catalog = $this->getBuildingMaterialsSpecifications();

        // Direct match
        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        // Normalized match
        foreach ($catalog as $key => $specs) {
            if ($this->normalizeBuildingText($key) === $subCategory) {
                return $specs;
            }
        }

        return [];
    }
}