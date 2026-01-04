<?php

namespace App\Traits;

/**
 * Furniture and Tents Catalog Trait
 * 
 * Manages specification-based products for "أثاث ومفروشات وخيام" category.
 * NO brands, NO models - only predefined specifications.
 */
trait FurnitureTentsCatalog
{
    /**
     * Normalize Arabic text for comparison
     * Removes extra spaces and normalizes Arabic characters
     */
    private function normalizeFurnitureText(?string $text): string
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
     * Get all furniture and tents specifications
     * 
     * @return array<string, array<string>>
     */
    protected function getFurnitureTentsSpecifications(): array
    {
        return [
            'خيمة' => [
                'خيمة قبة',
                'خيمة قطرية',
                'خيمة إماراتية',
                'خيمة صينية',
                'خيمة مصرية',
                'خيمة WFP',
                'خيمة باكستانية',
                'خيمة يونيسيف',
            ],
            'شادر' => [
                'شادر 4 × 4',
                'شادر 4 × 5',
                'شادر 4 × 6',
            ],
            'كنب' => [
                '3 قطع',
                '5 قطع',
                'زاوية',
            ],
            'غرفة نوم' => [
                'مفرد',
                'مزدوج',
                'كينغ',
            ],
            'فرشات' => [
                'مفرد',
                'مزدوج',
                'كينغ',
            ],
            'سجاد' => [
                'صغير',
                'متوسط',
                'كبير',
            ],
            'مستلزمات خيام' => [
                'أوتاد',
                'حبال',
                'فرش',
                'إضاءة',
            ],
        ];
    }

    /**
     * Get furniture/tents specifications for a specific sub-category
     * 
     * @param string|null $subCategory
     * @return array<string>
     */
    public function getFurnitureTentsSpecsForSubCategory(?string $subCategory): array
    {
        // Return empty array if sub-category is null or empty
        if (empty($subCategory)) {
            return [];
        }

        // Normalize the input
        $subCategory = $this->normalizeFurnitureText($subCategory);

        // Get all specifications
        $catalog = $this->getFurnitureTentsSpecifications();

        // Try direct match first
        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        // Try normalized match
        foreach ($catalog as $key => $specs) {
            if ($this->normalizeFurnitureText($key) === $subCategory) {
                return $specs;
            }
        }

        // Return empty array if not found
        return [];
    }

    /**
     * Get all available sub-categories for furniture and tents
     * 
     * @return array<string>
     */
    public function getFurnitureTentsSubCategories(): array
    {
        return array_keys($this->getFurnitureTentsSpecifications());
    }

    /**
     * Check if a sub-category exists in furniture and tents
     * 
     * @param string|null $subCategory
     * @return bool
     */
    public function isValidFurnitureTentsSubCategory(?string $subCategory): bool
    {
        if (empty($subCategory)) {
            return false;
        }

        return array_key_exists($subCategory, $this->getFurnitureTentsSpecifications());
    }

    /**
     * Get total count of specifications for a sub-category
     * 
     * @param string|null $subCategory
     * @return int
     */
    public function getFurnitureTentsSpecificationsCount(?string $subCategory): int
    {
        return count($this->getFurnitureTentsSpecsForSubCategory($subCategory));
    }
}