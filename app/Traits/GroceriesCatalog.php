<?php

namespace App\Traits;

trait GroceriesCatalog
{
    private function normalizeGroceriesText(?string $text): string
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
     * Get specifications structure for groceries subcategories
     * Returns array of specs with their options for each subcategory
     */
    protected function getGroceriesSpecifications(): array
    {
        return [
            'خضار وفواكه' => [
                [
                    'name' => 'الصنف',
                    'options' => ['بندورة', 'بطاطا', 'خيار', 'بصل', 'تفاح', 'موز', 'برتقال']
                ],
                [
                    'name' => 'الوحدة',
                    'options' => ['كيلو', 'صندوق', 'ربطة']
                ],
                [
                    'name' => 'الجودة',
                    'options' => ['عادي', 'ممتاز']
                ],
            ],
            'لحوم ودواجن' => [
                [
                    'name' => 'النوع',
                    'options' => ['دجاج', 'لحم بلدي', 'لحم مستورد', 'سمك']
                ],
                [
                    'name' => 'التقطيع',
                    'options' => ['كامل', 'صدور', 'أفخاذ', 'مفروم']
                ],
                [
                    'name' => 'الوحدة',
                    'options' => ['كيلو']
                ],
            ],
            'ألبان' => [
                [
                    'name' => 'الصنف',
                    'options' => ['حليب', 'لبنة', 'لبن', 'جبنة']
                ],
                [
                    'name' => 'العبوة',
                    'options' => ['علبة', 'كرتونة']
                ],
                [
                    'name' => 'الحجم',
                    'options' => ['250 مل', '500 مل', '1 لتر', '1 كغ']
                ],
            ],
            'مواد معلبة وتجفيفات' => [
                [
                    'name' => 'الصنف',
                    'options' => ['حمص', 'فاصوليا', 'عدس', 'رز', 'تونة']
                ],
                [
                    'name' => 'العبوة',
                    'options' => ['علبة', 'كيس']
                ],
                [
                    'name' => 'الوزن',
                    'options' => ['400 غ', '800 غ', '1 كغ', '5 كغ']
                ],
            ],
            'مشروبات' => [
                [
                    'name' => 'الصنف',
                    'options' => ['مياه', 'عصير', 'مشروب غازي']
                ],
                [
                    'name' => 'العبوة',
                    'options' => ['علبة', 'زجاجة', 'كرتونة']
                ],
                [
                    'name' => 'الحجم',
                    'options' => ['250 مل', '330 مل', '1 لتر', '1.5 لتر']
                ],
            ],
        ];
    }

    /**
     * Get specifications for a specific groceries subcategory
     * Returns array of spec definitions with names and options
     */
    public function getGroceriesSpecsForSubCategory(?string $subCategory): array
    {
        if (empty($subCategory)) {
            return [];
        }

        $subCategory = $this->normalizeGroceriesText($subCategory);
        $catalog = $this->getGroceriesSpecifications();

        // Direct match
        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        // Normalized match
        foreach ($catalog as $key => $specs) {
            if ($this->normalizeGroceriesText($key) === $subCategory) {
                return $specs;
            }
        }

        return [];
    }
}