<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'reference_code', // جديد
        'is_approved',    // جديد
        'user_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_approved' => 'boolean',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}