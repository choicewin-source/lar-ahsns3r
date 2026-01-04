<?php

namespace App\Traits;

trait AgricultureAnimalsCatalog
{
    private function normalizeAgricultureText(?string $text): string
    {
        if (!$text) {
            return '';
        }
        
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
        
        return $text;
    }

    protected function getAgricultureAnimalsSpecifications(): array
    {
        return [
            'حيوانات أليفة' => [
                'قطة',
                'كلب',
                'أرنب',
                'سلحفاة',
                'سمك',
            ],
            'طيور' => [
                'دجاج',
                'حمام',
                'ببغاء',
                'كناري',
            ],
            'أعلاف' => [
                'كيس صغير',
                'كيس متوسط',
                'كيس كبير',
                'طن',
            ],
            'أدوات زراعة' => [
                'أداة صغيرة',
                'أداة متوسطة',
                'أداة كبيرة',
            ],
            'بذور' => [
                'كيس صغير',
                'كيس متوسط',
                'كيس كبير',
            ],
            'معدات ري' => [
                'جهاز صغير',
                'جهاز متوسط',
                'جهاز كبير',
            ],
        ];
    }

    public function getAgricultureAnimalsSpecsForSubCategory(?string $subCategory): array
    {
        if (empty($subCategory)) {
            return [];
        }

        $subCategory = $this->normalizeAgricultureText($subCategory);
        $catalog = $this->getAgricultureAnimalsSpecifications();

        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        foreach ($catalog as $key => $specs) {
            if ($this->normalizeAgricultureText($key) === $subCategory) {
                return $specs;
            }
        }

        return [];
    }
}