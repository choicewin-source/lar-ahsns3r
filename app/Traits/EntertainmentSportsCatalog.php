<?php

namespace App\Traits;

trait EntertainmentSportsCatalog
{
    private function normalizeEntertainmentText(?string $text): string
    {
        if (!$text) {
            return '';
        }
        
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
        
        return $text;
    }

    protected function getEntertainmentSportsSpecifications(): array
    {
        return [
            'ألعاب فيديو' => [
                'PlayStation',
                'Xbox',
                'Nintendo',
                'PC',
            ],
            'ألعاب أطفال' => [
                '1-3 سنوات',
                '3-5 سنوات',
                '5-8 سنوات',
                '8+ سنوات',
            ],
            'معدات رياضية' => [
                'كرة قدم',
                'كرة سلة',
                'تنس',
                'سباحة',
                'لياقة بدنية',
            ],
            'أنشطة ترفيهية' => [
                'أطفال',
                'شباب',
                'عائلات',
            ],
        ];
    }

    public function getEntertainmentSportsSpecsForSubCategory(?string $subCategory): array
    {
        if (empty($subCategory)) {
            return [];
        }

        $subCategory = $this->normalizeEntertainmentText($subCategory);
        $catalog = $this->getEntertainmentSportsSpecifications();

        if (isset($catalog[$subCategory])) {
            return $catalog[$subCategory];
        }

        foreach ($catalog as $key => $specs) {
            if ($this->normalizeEntertainmentText($key) === $subCategory) {
                return $specs;
            }
        }

        return [];
    }
}