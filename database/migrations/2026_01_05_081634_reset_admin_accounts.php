<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // حذف جميع حسابات الأدمن الحالية
        User::where('role', 'admin')->delete();

        // إنشاء حساب المدير الجديد
        User::create([
            'name' => 'مدير النظام',
            'email' => 'manager@bestprice.ps',
            'password' => Hash::make('BestPrice@2026!'),
            'email_verified_at' => now(),
            'role' => 'admin',
            'is_approved' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لا نحتاج إلى عكس هذا التغيير
        // يمكن استخدام السيدر لإعادة إنشاء حسابات الأدمن الأصلية
    }
};