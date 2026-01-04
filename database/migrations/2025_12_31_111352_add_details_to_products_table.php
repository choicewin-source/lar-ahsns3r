<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // هذه الأعمدة موجودة بالفعل في migration السابق (create_products_table)
        // لذلك لا نحتاج لإضافتها مرة أخرى
        // Schema::table('products', function (Blueprint $table) {
        //     $table->string('sub_category')->nullable();
        //     $table->string('brand')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};