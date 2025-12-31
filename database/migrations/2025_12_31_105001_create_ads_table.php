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
    Schema::create('ads', function (Blueprint $table) {
        $table->id();
        
        $table->string('title')->nullable(); // عنوان للإعلان (عشان المالك يميزهم)
        $table->string('image_path')->nullable(); // مسار الصورة (لو الإعلان صورة)
        $table->text('text_content')->nullable(); // نص الإعلان (لو الإعلان كتابة فقط)
        
        $table->string('link')->nullable(); // رابط خارجي لو ضغط عليه الزبون (مثلاً رابط واتساب المحل المعلن)
        
        $table->enum('position', ['top', 'middle', 'bottom'])->default('top'); // وين نعرض الإعلان؟
        $table->boolean('is_active')->default(true); // تفعيل/تعطيل الإعلان بضغطة زر
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
