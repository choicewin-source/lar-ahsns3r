<div class="py-12" dir="rtl">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg sm:rounded-2xl p-8 border-t-4 border-red-600">
            
            <h2 class="text-2xl font-black mb-8 text-gray-800 text-center flex items-center justify-center gap-2">
                <span>إضافة سعر جديد</span>
                <span class="text-3xl">🏷️</span>
            </h2>

            <form wire:submit.prevent="store">
                
                <!-- 1. التصنيف الرئيسي -->
                <div class="mb-5">
                    <label class="block text-gray-800 text-sm font-bold mb-2">القسم الرئيسي</label>
                    <select wire:model.live="category" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 transition">
                        <option value="">-- اختر القسم --</option>
                        @foreach($categories as $main => $subs)
                            <option value="{{ $main }}">{{ $main }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. التصنيف الفرعي (يظهر بناءً على اختيار الرئيسي) -->
                @if($category)
                <div class="mb-5 animate-fade-in-down">
                    <label class="block text-gray-800 text-sm font-bold mb-2">
                        @if($category == 'عقارات') نوع العرض @else نوع المنتج @endif
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($categories[$category] as $sub)
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="sub_category" value="{{ $sub }}" class="peer sr-only">
                                <div class="text-center py-2 px-3 border border-gray-200 rounded-lg text-sm font-medium peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600 hover:bg-gray-50 transition">
                                    {{ $sub }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- 3. اسم المنتج (ذكي للجوالات) -->
                <div class="mb-5">
                    <label class="block text-gray-800 text-sm font-bold mb-2">
                        @if($sub_category == 'جوال') موديل الجوال (اكتب الاسم) @else اسم المنتج الكامل @endif
                    </label>
                    
                    <input type="text" wire:model="name" list="suggestions" placeholder="مثلاً: {{ $sub_category == 'جوال' ? 'iPhone 15 Pro' : 'ثلاجة LG 18 قدم' }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 transition">
                    
                    <!-- اقتراحات للجوالات -->
                    @if($sub_category == 'جوال')
                        <datalist id="suggestions">
                            @foreach($phoneModels as $phone)
                                <option value="{{ $phone }}">
                            @endforeach
                        </datalist>
                        <p class="text-xs text-gray-500 mt-1">💡 اختر من القائمة أو اكتب الموديل بدقة للمقارنة الصحيحة.</p>
                    @endif
                </div>

                <!-- 4. السعر -->
                <div class="mb-5">
                    <label class="block text-gray-800 text-sm font-bold mb-2">السعر (شيكل)</label>
                    <div class="relative">
                        <input type="number" step="0.01" wire:model="price" placeholder="0.00"
                            class="w-full px-4 py-3 border border-green-300 rounded-xl focus:ring-2 focus:ring-green-500 bg-green-50 font-bold text-lg text-green-800">
                        <span class="absolute left-4 top-3.5 text-green-700 font-bold">₪</span>
                    </div>
                </div>

                <!-- 5. المحل والمدينة -->
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-gray-800 text-sm font-bold mb-2">المنطقة</label>
                        <select wire:model="city" class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500">
                            <option value="">اختر..</option>
                            <option value="شمال غزة">شمال غزة</option>
                            <option value="مدينة غزة">مدينة غزة</option>
                            <option value="المنطقة الوسطى">المنطقة الوسطى</option>
                            <option value="خانيونس">خانيونس</option>
                            <option value="رفح">رفح</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-800 text-sm font-bold mb-2">اسم المحل</label>
                        <input type="text" wire:model="shop_name" placeholder="معرض.."
                            class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500">
                    </div>
                </div>

                <!-- 6. رقم التواصل -->
                <div class="mb-6">
                    <label class="block text-gray-800 text-sm font-bold mb-2">رقم التواصل / واتساب (اختياري)</label>
                    <input type="text" wire:model="contact_phone" placeholder="059xxxxxxx"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                </div>
                <!-- 6.5 صورة المنتج (اختياري) -->
<div class="mb-6">
    <label class="block text-gray-800 text-sm font-bold mb-2">صورة المنتج (اختياري)</label>
    
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden">
            
            @if ($image)
                <!-- عرض الصورة المصغرة بعد الرفع -->
                <img src="{{ $image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover opacity-80">
                <div class="z-10 bg-white/80 px-2 py-1 rounded text-xs font-bold text-green-600">تم اختيار الصورة ✅</div>
            @else
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="text-xs text-gray-500">اضغط لرفع صورة أو اسحبها هنا</p>
                </div>
            @endif

            <input id="dropzone-file" type="file" wire:model="image" class="hidden" accept="image/*" />
        </label>
    </div>
    
    <!-- مؤشر التحميل -->
    <div wire:loading wire:target="image" class="text-xs text-blue-500 mt-1 font-bold">
        جاري رفع الصورة... انتظر لحظة ⏳
    </div>
</div>
                <!-- 6. بصفتك من تنشر السعر؟ (اخفِ الخيار لأصحاب المحلات المسجلين والمفعلين) -->
                @unless(auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved)
                <div class="mb-8 bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <label class="block text-gray-800 text-sm font-bold mb-3">أنت بتضيف السعر بصفتك مين؟</label>
                    <div class="flex gap-4">
                        <!-- خيار الزبون -->
                        <label class="flex items-center gap-2 cursor-pointer bg-white px-4 py-3 rounded-lg border hover:border-green-500 hover:bg-green-50 transition flex-1 justify-center">
                            <input type="radio" wire:model="added_by" value="customer" class="text-green-600 focus:ring-green-500 w-5 h-5">
                            <span class="text-sm font-bold text-gray-700">👤 أنا زبون (مجرب)</span>
                        </label>
                        
                        <!-- خيار صاحب المحل -->
                        <label class="flex items-center gap-2 cursor-pointer bg-white px-4 py-3 rounded-lg border hover:border-black hover:bg-gray-100 transition flex-1 justify-center">
                            <input type="radio" wire:model="added_by" value="shop_owner" class="text-black focus:ring-black w-5 h-5">
                            <span class="text-sm font-bold text-gray-700">🏪 أنا صاحب المحل</span>
                        </label>
                    </div>
                </div>
                @else
                    <input type="hidden" wire:model="added_by" value="shop_owner">
                @endunless
                <!-- 7. زر النشر -->
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg transition transform hover:scale-[1.02] flex justify-center items-center gap-2">
                    <span>نشر السعر الآن</span>
                    <span wire:loading class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></span>
                </button>

            </form>
        </div>
    </div>
</div>