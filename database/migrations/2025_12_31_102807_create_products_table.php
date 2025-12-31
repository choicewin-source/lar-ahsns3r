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
    Schema::create('products', function (Blueprint $table) {
        $table->id();

        // 1. تفاصيل المنتج
        $table->string('name');          // اسم المنتج (مثلاً: ايفون 17)
        $table->string('category');      // التصنيف (جوالات، صيدليات، أجهزة كهربائية...)
        $table->decimal('price', 10, 2); // السعر بالشيكل (يقبل فواصل مثل 10.50)

        // 2. الموقع والعنوان (التعديل الجديد)
        // هون بنخزن (شمال غزة، غزة، الوسطى، الجنوب..)
        $table->string('city');          
        $table->text('address_details')->nullable(); // تفاصيل العنوان (مثلاً: شارع النصر، مقابل مخبز..)
        $table->string('shop_name');     // اسم المحل

        // 3. هوية المُضيف (طلب شادي المهم)
        // عشان نميز باللون في الفرونت إن هل هو زبون ولا صاحب محل
        $table->enum('added_by', ['customer', 'shop_owner'])->default('customer');

        // 4. نظام التعديل بدون تسجيل دخول
        // كود سري طويل بنولده تلقائي وبنعطيه للي ضاف عشان يقدر يعدل لاحقاً
        $table->string('edit_token')->unique();

        // 5. التاريخ
        // created_at هو تاريخ الإضافة (بيظهر للناس)
        // updated_at هو تاريخ آخر تحديث للسعر
        $table->timestamps(); 
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
