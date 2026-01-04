<?php

namespace App\Traits;

trait PharmacyCatalog
{
    private function normalizePharmacyText(?string $text): string
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
     * Get specifications structure for pharmacy subcategories
     * Returns array of specs with their types and options
     */
    protected function getPharmacySpecifications(): array
    {
        return [
            'أدوية ووصفات طبية' => [
                [
                    'name' => 'اسم الدواء',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: بنادول'
                ],
                [
                    'name' => 'الشكل الدوائي',
                    'type' => 'select',
                    'options' => ['أقراص', 'شراب', 'حقن', 'كريم', 'مرهم']
                ],
                [
                    'name' => 'التركيز / الجرعة',
                    'type' => 'text',
                    'placeholder' => 'مثال: 500 ملغ'
                ],
                [
                    'name' => 'العبوة',
                    'type' => 'select',
                    'options' => ['علبة', 'شريط']
                ],
                [
                    'name' => 'الكمية',
                    'type' => 'number',
                    'placeholder' => 'عدد الحبات أو القطع'
                ],
            ],
            'مستلزمات طبية منزلية' => [
                [
                    'name' => 'اسم المنتج',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: قياس سكر'
                ],
                [
                    'name' => 'النوع',
                    'type' => 'select',
                    'options' => ['جهاز طبي', 'مستلزمات', 'معدات']
                ],
            ],
            'مكملات غذائية وفيتامينات' => [
                [
                    'name' => 'اسم المكمل',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: فيتامين د'
                ],
                [
                    'name' => 'العبوة',
                    'type' => 'select',
                    'options' => ['علبة 30 حبة', 'علبة 60 حبة', 'علبة 90 حبة', 'كيس']
                ],
            ],
            'مستلزمات أطفال ورضّع' => [
                [
                    'name' => 'اسم المنتج',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'مثال: حفاضات'
                ],
                [
                    'name' => 'العبوة',
                    'type' => 'select',
                    'options' => ['علبة صغيرة', 'علبة متوسطة', 'علبة كبيرة', 'كيس']
                ],
            ],
        ];
    }

    /**
     * Get specifications for a specific pharmacy subcategory
     * Returns array of spec definitions with names, types and options
     */
    public function getPharmacySpecsForSubCategory(?string $subCategory): array
    {
        if (empty($subCategory)) {
            return [];
        }

        $subCategory = $this->normalizePharmacyText($subCategory);
        $catalog = $this->getPharmacySpecifications();

        // Direct match
        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        // Normalized match
        foreach ($catalog as $key => $specs) {
            if ($this->normalizePharmacyText($key) === $subCategory) {
                return $specs;
            }
        }

        return [];
    }
}