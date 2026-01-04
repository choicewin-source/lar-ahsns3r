<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['product_id', 'user_id', 'user_name', 'body'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * علاقة المستخدم (اختيارية - قد يكون التعليق من زائر)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute($value)
    {
        return $value ?: 'زائر';
    }
}
