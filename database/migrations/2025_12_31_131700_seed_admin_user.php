<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        // استخدام متغير بيئة لكلمة المرور إذا أمكن
        $password = env('ADMIN_DEFAULT_PASSWORD', 'Admin@123456');
        
        $now = now();
        DB::table('users')->insertOrIgnore([
            'name' => 'Administrator',
            'email' => 'admin@local.test',
            'password' => Hash::make($password),
            'role' => 'admin',
            'is_approved' => true,
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down(): void
    {
        DB::table('users')->where('email', 'admin@local.test')->delete();
    }
};