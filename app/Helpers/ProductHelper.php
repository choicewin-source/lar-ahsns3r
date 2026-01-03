<?php

namespace App\Helpers;

class ProductHelper
{
    private const ICONS = [
        'أجهزة كهربائية وطاقة' => '🔌☀️',
        'أثاث ومفروشات وخيام' => '🛋️⛺',
        'سيارات ودراجات' => '🚗🚲',
        'جوالات وإلكترونيات' => '📱',
        'مطاعم' => '🍽️',
        'عقار' => '🏠',
        'ملابس' => '👕',
        'خدمات إلكترونية' => '🧾💻',
        'مواد غذائية وسوبر ماركت' => '🛒',
        'مواد بناء ولوازم منزلية' => '🧰',
        'صيدليات ومستلزمات طبية' => '🩺',
        'خدمات عامة' => '🛠️',
        'ترفيه وألعاب ورياضة' => '🎮⚽',
        'زراعة وحيوانات' => '🐔🐄',
        'أخرى' => '📦',
    ];

    private const SOURCE_TEXTS = [
        'shop_owner' => 'محل تجاري',
        'customer' => 'تجربة مواطن',
    ];

    private const SOURCE_COLORS = [
        'shop_owner' => 'bg-gray-900',
        'customer' => 'bg-green-600',
    ];

    /**
     * الحصول على أيقونة المنتج بناءً على الفئة
     */
    public static function getProductIcon(string $category): string
    {
        // Sort keys by length in descending order to prioritize more specific categories
        $sortedIcons = self::ICONS;
        uksort($sortedIcons, function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        foreach ($sortedIcons as $key => $icon) {
            if (str_contains($category, $key)) {
                return $icon;
            }
        }

        return '📦'; // أيقونة افتراضية
    }

    /**
     * تنسيق السعر مع العملة
     */
    public static function formatPrice(float|int|string|null $price): string
    {
        $value = is_numeric($price) ? (float) $price : 0.0;
        return number_format($value, 2, '.', ',') . ' ₪';
    }

    /**
     * توليد كود العرض التسلسلي
     */
    public static function generateReferenceCode(int $id): string
    {
        return 'AS-' . str_pad($id, 6, '0', STR_PAD_LEFT);
    }

    /**
     * الحصول على نص نوع المصدر
     */
    public static function getSourceText(string $addedBy): string
    {
        return self::SOURCE_TEXTS[$addedBy] ?? 'غير معروف';
    }

    /**
     * الحصول على لون خلفية نوع المصدر
     */
    public static function getSourceColor(string $addedBy): string
    {
        return self::SOURCE_COLORS[$addedBy] ?? 'bg-gray-500';
    }

    /**
     * تنظيف وتحويل رقم الهاتف
     */
    public static function cleanPhoneNumber(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        // إزالة المسافات والأحرف الخاصة
        $cleaned = preg_replace('/[^0-9+]/', '', $phone);
        
        // توحيد البادئة ورقم الجوال (فلسطين +970)
        // شائع: 059xxxxxxx أو 056xxxxxxx
        if (preg_match('/^0(59|56)\d{7}$/', $cleaned)) {
            $cleaned = '+970' . substr($cleaned, 1);
        }

        // إذا كان 9 أرقام بدون 0 (مثال: 59xxxxxxx) اعتبره فلسطين
        if (preg_match('/^(59|56)\d{7}$/', $cleaned)) {
            $cleaned = '+970' . $cleaned;
        }

        // إذا كان يبدأ بـ 970 بدون +
        if (preg_match('/^970\d{9}$/', $cleaned)) {
            $cleaned = '+'.$cleaned;
        }

        return $cleaned;
    }

    /**
     * إنشاء رابط واتساب
     */
    public static function whatsappLink(string $phone, string $message = ''): string
    {
        $cleanPhone = self::cleanPhoneNumber($phone);
        if (!$cleanPhone) {
            return '#';
        }

        $encodedMessage = urlencode($message ?: 'مرحبا، أرغب في الاستفسار عن المنتج');
        return "https://wa.me/{$cleanPhone}?text={$encodedMessage}";
    }
}