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
        // حساب المدير الوحيد - التحقق من عدم وجوده أولاً
        if (!User::where('email', 'manager@bestprice.ps')->exists()) {
            User::create([
                'name' => 'مدير النظام',
                'email' => 'manager@bestprice.ps',
                'password' => Hash::make('BestPrice@2026!'),
                'email_verified_at' => now(),
                'role' => 'admin',
                'is_approved' => true,
            ]);
        }

        // استدعاء سيدر الفئات
        $this->call(CategorySeeder::class);
    }
}