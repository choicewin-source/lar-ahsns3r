<?php

namespace App\Traits;

trait ProductCatalogTrait
{
    protected function getElectricModels(?string $subCategory): array
    {
        switch ($subCategory) {
            case 'ثلاجة':
                return [
                    'ثلاجة 300L Top Freezer',
                    'ثلاجة 500L French Door',
                    'ثلاجة 400L Side By Side',
                    'ثلاجة 600L InstaView',
                ];
            case 'غسالة':
                return [
                    'غسالة 7KG Front Load',
                    'غسالة 10KG Top Load',
                    'غسالة 8KG Front Load',
                ];
            case 'شاشة تلفزيون':
                return [
                    'شاشة 32 بوصة HD',
                    'شاشة 43 بوصة Full HD',
                    'شاشة 50 بوصة 4K',
                    'شاشة 55 بوصة OLED',
                ];
            case 'مولد كهرباء':
                return [
                    'مولد 1 كيلو',
                    'مولد 2 كيلو',
                    'مولد 3 كيلو',
                    'مولد 5 كيلو',
                ];
            case 'نظام طاقة شمسية':
                return [
                    'لوح طاقة 360 واط',
                    'لوح طاقة 450 واط',
                    'لوح طاقة 660 واط',
                ];
            case 'بطاريات':
                return [
                    'بطارية 9 أمبير',
                    'بطارية 18 أمبير',
                    'بطارية 45 أمبير',
                    'بطارية 100 أمبير',
                    'بطارية 200 أمبير',
                ];
            case 'انفيرتر':
                return [
                    'انفيرتر 0.5 كيلو',
                    'انفيرتر 1 كيلو',
                    'انفيرتر 1.5 كيلو',
                    'انفيرتر 2 كيلو',
                    'انفيرتر 2.5 كيلو',
                    'انفيرتر 3 كيلو',
                ];
            case 'مراوح':
                return [
                    'مروحة سقف 120 سم',
                    'مروحة طاولة 40 سم',
                    'مروحة أرضية 50 سم',
                ];
            default:
                return [];
        }
    }

    protected function staticBrandsCatalog(?string $category, ?string $subCategory): array
    {
        if ($category !== 'جوالات وإلكترونيات' || !$subCategory) {
            return [];
        }

        if ($subCategory === 'جوال') {
            return [
                'Samsung', 'Apple', 'Xiaomi', 'Huawei', 'Google Pixel', 'OnePlus',
                'Oppo', 'Vivo', 'Realme', 'Tecno', 'Infinix', 'Nokia',
            ];
        }

        if ($subCategory === 'لابتوب') {
            return ['HP', 'Dell', 'Lenovo', 'Asus', 'Acer', 'MSI', 'Apple', 'Huawei'];
        }

        if ($subCategory === 'تابلت') {
            return ['Apple', 'Samsung', 'Huawei', 'Lenovo'];
        }

        if ($subCategory === 'سماعات') {
            return ['Apple', 'Sony', 'Bose', 'JBL', 'Samsung', 'Xiaomi'];
        }

        if ($subCategory === 'شواحن') {
            return ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'OnePlus', 'Anker', 'Baseus'];
        }

        if ($subCategory === 'اكسسوارات') {
            return ['Apple', 'Samsung', 'Xiaomi', 'Anker', 'Baseus', 'UGREEN', 'Belkin', 'JSAUX'];
        }

        if ($subCategory === 'صيانة') {
            return ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Dell', 'HP', 'Lenovo', 'Asus', 'صيانة عامة'];
        }

        return [];
    }

    protected function staticModelsCatalog(?string $category, ?string $subCategory, ?string $brand): array
    {
        $category = trim($category ?? '');
        $subCategory = trim($subCategory ?? '');
        $brand = trim($brand ?? '');

        if ($category !== 'جوالات وإلكترونيات' || empty($subCategory) || empty($brand)) {
            return [];
        }

        if ($subCategory === 'جوال') {
            if ($brand === 'Apple') {
                return [
                    'iPhone 11', 'iPhone 11 Pro', 'iPhone 11 Pro Max',
                    'iPhone 12', 'iPhone 12 Mini', 'iPhone 12 Pro', 'iPhone 12 Pro Max',
                    'iPhone 13', 'iPhone 13 Mini', 'iPhone 13 Pro', 'iPhone 13 Pro Max',
                    'iPhone 14', 'iPhone 14 Plus', 'iPhone 14 Pro', 'iPhone 14 Pro Max',
                    'iPhone 15', 'iPhone 15 Plus', 'iPhone 15 Pro', 'iPhone 15 Pro Max',
                    'iPhone 16', 'iPhone 16 Plus', 'iPhone 16 Pro', 'iPhone 16 Pro Max',
                    'iPhone X', 'iPhone XR', 'iPhone XS', 'iPhone XS Max',
                    'iPhone SE (2020)', 'iPhone SE (2022)',
                ];
            }
            if ($brand === 'Samsung') {
                return [
                    'Galaxy S24 Ultra', 'Galaxy S24+', 'Galaxy S24',
                    'Galaxy S23 Ultra', 'Galaxy S23+', 'Galaxy S23', 'Galaxy S23 FE',
                    'Galaxy S22 Ultra', 'Galaxy S22+', 'Galaxy S22',
                    'Galaxy S21 Ultra', 'Galaxy S21+', 'Galaxy S21', 'Galaxy S21 FE',
                    'Galaxy A55', 'Galaxy A54', 'Galaxy A35', 'Galaxy A34', 'Galaxy A25', 'Galaxy A15',
                    'Galaxy Z Fold 6', 'Galaxy Z Flip 6', 'Galaxy Z Fold 5', 'Galaxy Z Flip 5',
                ];
            }
            if ($brand === 'Xiaomi') {
                return [
                    'Xiaomi 14 Ultra', 'Xiaomi 14',
                    'Xiaomi 13T Pro', 'Xiaomi 13T',
                    'Redmi Note 13 Pro+', 'Redmi Note 13 Pro', 'Redmi Note 13',
                    'Poco F6 Pro', 'Poco F6', 'Poco X6 Pro', 'Poco X6', 'Poco M6 Pro',
                ];
            }
        }

        if ($subCategory === 'لابتوب') {
            if ($brand === 'HP') {
                return [
                    'HP Pavilion 15', 'HP 15s', 'HP Victus 15', 'HP Victus 16',
                    'HP Omen 16', 'HP Spectre x360', 'HP Envy x360', 'HP EliteBook 840 G8',
                ];
            }
            if ($brand === 'Dell') {
                return [
                    'Dell XPS 13', 'Dell XPS 15', 'Dell Inspiron 15', 'Dell G15',
                    'Dell Latitude 5420', 'Dell Vostro 3510',
                ];
            }
            if ($brand === 'Lenovo') {
                return [
                    'Lenovo Legion 5', 'Lenovo Legion 7', 'Lenovo LOQ 15',
                    'Lenovo IdeaPad 3', 'Lenovo IdeaPad 5', 'Lenovo ThinkPad E14', 'Lenovo ThinkPad T14',
                ];
            }
            if ($brand === 'Asus') {
                return [
                    'Asus TUF Gaming F15', 'Asus TUF Gaming A15', 'Asus ROG Strix G16',
                    'Asus Vivobook 15', 'Asus Vivobook 16', 'Asus Zenbook 14',
                ];
            }
            if ($brand === 'Apple') {
                return [
                    'MacBook Air M1', 'MacBook Air M2', 'MacBook Air M3',
                    'MacBook Pro 14 M3', 'MacBook Pro 16 M3',
                    'MacBook Pro 13 M2', 'MacBook Pro 14 M2', 'MacBook Pro 16 M2',
                ];
            }
        }

        if ($subCategory === 'تابلت') {
            if ($brand === 'Apple') {
                return [
                    'iPad 9th Gen', 'iPad 10th Gen',
                    'iPad Air 5', 'iPad Air 6 (M2)',
                    'iPad Pro 11 (M4)', 'iPad Pro 13 (M4)',
                    'iPad Mini 6',
                ];
            }
            if ($brand === 'Samsung') {
                return [
                    'Galaxy Tab S9 Ultra', 'Galaxy Tab S9+', 'Galaxy Tab S9', 'Galaxy Tab S9 FE',
                    'Galaxy Tab A9+', 'Galaxy Tab A9',
                ];
            }
        }

        if ($subCategory === 'سماعات') {
            if ($brand === 'Apple') {
                return ['AirPods 2', 'AirPods 3', 'AirPods Pro 2 (USB-C)', 'AirPods Max'];
            }
            if ($brand === 'Samsung') {
                return ['Galaxy Buds 2', 'Galaxy Buds 2 Pro', 'Galaxy Buds FE'];
            }
        }

        if ($subCategory === 'اكسسوارات') {
            return [
                'كفر حماية', 'واقي شاشة (Screen Protector)',
                'شاحن جداري', 'كيبل شحن', 'Power Bank',
                'حامل جوال للسيارة', 'سماعة سلكية',
            ];
        }

        return [];
    }
}