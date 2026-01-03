<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // حساب المالك الوحيد - التحقق من عدم وجوده أولاً
        if (!User::where('email', 'admin@bestprice.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@bestprice.com',
                'password' => Hash::make('Admin@123456'),
                'email_verified_at' => now(),
                'role' => 'admin',
                'is_approved' => true,
            ]);
        }

        // حساب مساعد (اختياري)
        if (!User::where('email', 'moderator@bestprice.com')->exists()) {
            User::create([
                'name' => 'المشرف',
                'email' => 'moderator@bestprice.com',
                'password' => Hash::make('Moderator@123'),
                'email_verified_at' => now(),
                'role' => 'admin',
                'is_approved' => true,
            ]);
        }

        // استدعاء سيدر الفئات
        $this->call(CategorySeeder::class);
    }
}