<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('shop_logo')->nullable()->after('shop_phone');
            $table->text('shop_description')->nullable()->after('shop_logo');
            $table->string('shop_address')->nullable()->after('shop_description');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['shop_logo', 'shop_description', 'shop_address']);
        });
    }
};