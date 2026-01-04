<?php

namespace App\Traits;

/**
 * Electric Appliances Catalog Trait
 * 
 * Manages specification-based products for "أجهزة كهربائية وطاقة" category.
 * NO brands, NO models - only specifications.
 */
trait ElectricAppliancesCatalog
{
    /**
     * Normalize Arabic text for comparison
     * Removes extra spaces and normalizes Arabic characters
     */
    private function normalizeElectricText(?string $text): string
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
        
        return $text;
    }

    /**
     * Get all electric appliances specifications
     * 
     * @return array<string, array<string>>
     */
    protected function getElectricAppliancesSpecifications(): array
    {
        return [
            'ثلاجة' => [
                'ثلاجة 300 لتر',
                'ثلاجة 400 لتر',
                'ثلاجة 500 لتر',
                'ثلاجة Side By Side',
                'ثلاجة French Door',
            ],
            'غسالة' => [
                'غسالة 7 كيلو',
                'غسالة 8 كيلو',
                'غسالة 10 كيلو',
                'غسالة 12 كيلو',
                'غسالة Front Load',
                'غسالة Top Load',
            ],
            'شاشة تلفزيون' => [
                'شاشة 32 إنش HD',
                'شاشة 43 إنش Full HD',
                'شاشة 50 إنش 4K',
                'شاشة 55 إنش 4K',
                'شاشة 55 إنش OLED',
                'شاشة 65 إنش 4K',
            ],
            'مولد كهرباء' => [
                'مولد 1 كيلو',
                'مولد 2 كيلو',
                'مولد 3 كيلو',
                'مولد 5 كيلو',
                'مولد 7 كيلو',
            ],
            'نظام طاقة شمسية' => [
                'لوح طاقة 360 واط',
                'لوح طاقة 450 واط',
                'لوح طاقة 660 واط',
                'نظام كامل 5 كيلو',
                'نظام كامل 10 كيلو',
            ],
            'بطاريات' => [
                'بطارية 9 أمبير',
                'بطارية 18 أمبير',
                'بطارية 45 أمبير',
                'بطارية 100 أمبير',
                'بطارية 200 أمبير',
            ],
            'انفيرتر' => [
                'انفيرتر 0.5 كيلو',
                'انفيرتر 1 كيلو',
                'انفيرتر 1.5 كيلو',
                'انفيرتر 2 كيلو',
                'انفيرتر 2.5 كيلو',
                'انفيرتر 3 كيلو',
            ],
            'مراوح' => [
                'مروحة سقف 120 سم',
                'مروحة طاولة 40 سم',
                'مروحة أرضية 50 سم',
                'مروحة صندوقية',
            ],
        ];
    }

    /**
     * Get electric appliances specifications for a specific sub-category
     * 
     * @param string|null $subCategory
     * @return array<string>
     */
    public function getElectricSpecsForSubCategory(?string $subCategory): array
    {
        // Return empty array if sub-category is null or empty
        if (empty($subCategory)) {
            return [];
        }

        // Normalize the input
        $subCategory = $this->normalizeElectricText($subCategory);

        // Get all specifications
        $catalog = $this->getElectricAppliancesSpecifications();

        // Try direct match first
        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        // Try normalized match
        foreach ($catalog as $key => $specs) {
            if ($this->normalizeElectricText($key) === $subCategory) {
                return $specs;
            }
        }

        // Return empty array if not found
        return [];
    }

    /**
     * Get all available sub-categories for electric appliances
     * 
     * @return array<string>
     */
    public function getElectricSubCategories(): array
    {
        return array_keys($this->getElectricAppliancesSpecifications());
    }

    /**
     * Check if a sub-category exists in electric appliances
     * 
     * @param string|null $subCategory
     * @return bool
     */
    public function isValidElectricSubCategory(?string $subCategory): bool
    {
        if (empty($subCategory)) {
            return false;
        }

        return array_key_exists($subCategory, $this->getElectricAppliancesSpecifications());
    }

    /**
     * Get total count of specifications for a sub-category
     * 
     * @param string|null $subCategory
     * @return int
     */
    public function getElectricSpecificationsCount(?string $subCategory): int
    {
        return count($this->getElectricSpecsForSubCategory($subCategory));
    }
}