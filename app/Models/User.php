<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
        'shop_name',
        'shop_city',
        'shop_phone',
        'shop_logo',
        'shop_description',
        'shop_address',
        'google_id',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isShopOwner(): bool
    {
        return $this->role === 'shop_owner';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'user' || $this->role === 'customer';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getShopProducts()
    {
        return Product::where(function($query) {
            $query->where('shop_name', $this->shop_name)
                  ->orWhere('user_id', $this->id);
        })->where('is_approved', true);
    }
}
