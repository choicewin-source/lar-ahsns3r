<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // التأكد من وجود حقول أصحاب المتاجر
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'shop_owner', 'customer'])->default('customer')->after('email');
            }
            if (!Schema::hasColumn('users', 'is_approved')) {
                $table->boolean('is_approved')->default(false)->after('role');
            }
            if (!Schema::hasColumn('users', 'shop_name')) {
                $table->string('shop_name')->nullable()->after('is_approved');
            }
            if (!Schema::hasColumn('users', 'shop_city')) {
                $table->string('shop_city')->nullable()->after('shop_name');
            }
            if (!Schema::hasColumn('users', 'shop_phone')) {
                $table->string('shop_phone')->nullable()->after('shop_city');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_approved', 'shop_name', 'shop_city', 'shop_phone']);
        });
    }
};
