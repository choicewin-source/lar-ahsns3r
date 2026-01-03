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

            // 1. تفاصيل المنتج الأساسية
            $table->string('name');                     // اسم المنتج (مثلاً: ايفون 17)
            $table->string('category');                 // التصنيف الرئيسي
            $table->string('sub_category')->nullable(); // التصنيف الفرعي
            $table->string('brand')->nullable();        // الماركة
            $table->decimal('price', 10, 2);            // السعر
            $table->enum('condition', ['new', 'used'])->default('new'); // جديد أو مستعمل

            // 2. الموقع والعنوان
            $table->string('city');                     // المدينة
            $table->text('address_details')->nullable(); // تفاصيل العنوان
            $table->string('shop_name');                // اسم المحل

            // 3. معلومات التواصل
            $table->string('contact_phone')->nullable(); // رقم الهاتف

            // 4. هوية المُضيف
            $table->enum('added_by', ['customer', 'shop_owner'])->default('customer');

            // 5. نظام التعديل والمراجع
            $table->string('edit_token')->unique();
            $table->string('reference_code')->nullable()->unique(); // كود العرض مثل: AS-000001

            // 6. الصور والمرفقات
            $table->string('image_path')->nullable();   // مسار الصورة

            // 7. العلاقات والأذونات
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_approved')->default(true); // حالة الموافقة

            // 8. التواريخ
            $table->timestamps();
            
            // 9. فهارس لتحسين الأداء
            $table->index(['category', 'sub_category']);
            $table->index('price');
            $table->index('city');
            $table->index('is_approved');
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