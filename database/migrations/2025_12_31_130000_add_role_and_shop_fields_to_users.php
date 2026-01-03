<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'shop_owner', 'admin'])->default('user')->after('email');
                        $table->boolean('is_approved')->default(false)->after('role');
            $table->string('shop_name')->nullable()->after('is_approved');
            $table->string('shop_city')->nullable()->after('shop_name');
            $table->string('shop_phone')->nullable()->after('shop_city');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_approved', 'shop_name', 'shop_city', 'shop_phone']);
        });
    }
};
