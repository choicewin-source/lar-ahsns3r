<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        $now = now();
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@local.test',
            'password' => Hash::make('secret123'),
            'role' => 'admin',
            'is_approved' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down(): void
    {
        DB::table('users')->where('email','admin@local.test')->delete();
    }
};
