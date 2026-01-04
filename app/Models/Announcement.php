<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * الحصول على الإعلانات المفعلة فقط
     */
    public static function active()
    {
        return self::where('is_active', true)->orderBy('created_at', 'desc')->get();
    }
}
