<?php

namespace App\Models;

use App\Helpers\ProductHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category', 
        'sub_category', 
        'brand', 
        'price', 
        'city', 
        'address_details', 
        'shop_name', 
        'contact_phone',
        'added_by', 
        'edit_token', 
        'image_path',
        'reference_code',
        'is_approved',
        'user_id',
        'condition',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'formatted_price',
        'image_url',
        'icon',
        'source_text',
        'source_color',
        'whatsapp_link'
    ];

    /**
     * علاقة التعليقات
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * علاقة المستخدم
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * تنسيق السعر مع العملة
     */
    public function getFormattedPriceAttribute(): string
    {
        return ProductHelper::formatPrice($this->price);
    }

    /**
     * الحصول على رابط الصورة أو الأيقونة الافتراضية
     */
   /**
 * الحصول على رابط الصورة أو الأيقونة الافتراضية
 */
public function getImageUrlAttribute(): string
{
    if ($this->image_path) {
        // تحقق من وجود الملف في التخزين العام
        $path = storage_path('app/public/' . $this->image_path);
        if (file_exists($path)) {
            return asset('storage/' . $this->image_path);
        }
    }
    
    // أيقونة افتراضية بناءً على الفئة
    return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=4f46e5&color=fff';
}

    /**
     * الحصول على أيقونة المنتج
     */
    public function getIconAttribute(): string
    {
        return ProductHelper::getProductIcon($this->category);
    }

    /**
     * الحصول على نص نوع المصدر
     */
    public function getSourceTextAttribute(): string
    {
        return ProductHelper::getSourceText($this->added_by);
    }

    /**
     * الحصول على لون خلفية نوع المصدر
     */
    public function getSourceColorAttribute(): string
    {
        return ProductHelper::getSourceColor($this->added_by);
    }

    /**
     * الحصول على رابط واتساب
     */
    public function getWhatsappLinkAttribute(): string
    {
        $message = "مرحبا، شفت منتج {$this->name} على موقع أحسن سعر وأرغب في الاستفسار عنه";
        return ProductHelper::whatsappLink($this->contact_phone, $message);
    }

    /**
     * نطاق للمنتجات المُعتمدة
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * نطاق للمنتجات الأرخص
     */
    public function scopeCheapest($query)
    {
        return $query->orderBy('price', 'asc');
    }

    /**
     * نطاق لأحدث المنتجات
     */
    public function scopeLatestProducts($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * نطاق للبحث في اسم المنتج
     */
    public function scopeSearch($query, string $searchTerm)
    {
        return $query->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('brand', 'like', "%{$searchTerm}%")
                    ->orWhere('category', 'like', "%{$searchTerm}%");
    }

    /**
     * إنشاء رمز التعديل تلقائياً
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->edit_token)) {
                $product->edit_token = \Illuminate\Support\Str::random(40);
            }
        });

        static::created(function ($product) {
            if (empty($product->reference_code)) {
                $product->reference_code = ProductHelper::generateReferenceCode($product->id);
                $product->save(); // Save the model again to persist the reference_code
            }
        });
    }
}
