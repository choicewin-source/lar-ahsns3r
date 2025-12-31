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
   // database/seeders/DatabaseSeeder.php



public function run(): void
{
    // حساب المالك الوحيد
    User::create([
        'name' => 'Owner', // اسم المالك
        'email' => 'admin@bestprice.com', // الايميل اللي هتدخل فيه
        'password' => Hash::make('password123'), // كلمة السر (غيرها براحتك)
        'email_verified_at' => now(),
    ]);
}
}
