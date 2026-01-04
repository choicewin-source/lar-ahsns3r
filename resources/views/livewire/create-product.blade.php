<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-10" dir="rtl" x-cloak>
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100">
      <div class="p-6 sm:p-8 bg-gradient-to-r from-red-600 to-orange-500 text-white">
        <div class="flex items-center justify-between gap-4">
          <div>
            <h1 class="text-2xl sm:text-3xl font-black">إضافة سعر جديد</h1>
            <p class="text-white/90 text-sm mt-1">اختر القسم ثم النوع ثم (الشركة) ثم الموديل، وبعدها أكمل السعر وباقي البيانات</p>
          </div>
          <div class="text-4xl">🏷️</div>
        </div>
      </div>

      <div class="p-6 sm:p-8">
        @if (session('success'))
          <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
            <div class="font-bold mb-2">يرجى تصحيح الأخطاء التالية:</div>
            <ul class="list-disc list-inside text-sm space-y-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form wire:submit.prevent="store" class="space-y-6">

          {{-- رسالة توجيهية --}}
          <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
            <p class="text-sm font-bold text-blue-800">
              @if(!$category)
                👉 ابدأ باختيار القسم أولاً
              @elseif(!$sub_category)
                👉 اختر نوع المنتج من القسم <span class="text-red-600">{{ $category }}</span>
              @elseif($categoryType === 'service_text' && !$name)
                👉 أدخل وصف الخدمة أو المنتج
              @elseif($categoryType === 'brand_model' && $showBrandField && !$brand)
                👉 اختر الشركة المصنعة أو أدخلها يدوياً
              @elseif($categoryType !== 'service_text' && !$name)
                👉 اختر {{ $categoryType === 'brand_model' ? 'الموديل' : 'المواصفات' }} من القائمة أو أدخله يدوياً
              @else
                ✨ رائع! الآن أكمل السعر وبيانات المحل
              @endif
            </p>
          </div>

          @if($categoryType !== 'service_text')
          <div class="grid grid-cols-4 gap-2 text-center text-xs font-bold mb-6">
            <div class="p-3 rounded-xl transition-all {{ $category ? 'bg-green-100 text-green-800 shadow-sm border-2 border-green-300' : 'bg-gray-100 text-gray-500' }}">
              <div class="text-lg mb-1">{{ $category ? '✅' : '1️⃣' }}</div>
              <div>القسم</div>
            </div>
            <div class="p-3 rounded-xl transition-all {{ $sub_category ? 'bg-green-100 text-green-800 shadow-sm border-2 border-green-300' : 'bg-gray-100 text-gray-500' }}">
              <div class="text-lg mb-1">{{ $sub_category ? '✅' : '2️⃣' }}</div>
              <div>النوع</div>
            </div>
            <div class="p-3 rounded-xl transition-all {{ (!$showBrandField || $brand) ? 'bg-green-100 text-green-800 shadow-sm border-2 border-green-300' : 'bg-gray-100 text-gray-500' }}">
              <div class="text-lg mb-1">{{ (!$showBrandField || $brand) ? '✅' : '3️⃣' }}</div>
              <div>{{ $showBrandField ? 'الشركة' : 'تلقائي' }}</div>
            </div>
            <div class="p-3 rounded-xl transition-all {{ $name ? 'bg-green-100 text-green-800 shadow-sm border-2 border-green-300' : 'bg-gray-100 text-gray-500' }}">
              <div class="text-lg mb-1">{{ $name ? '✅' : '4️⃣' }}</div>
              <div>{{ $categoryType === 'brand_model' ? 'الموديل' : 'المواصفات' }}</div>
            </div>
          </div>
          @endif

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">القسم</label>
              <select wire:model.live="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                <option value="">-- اختر القسم --</option>
                @foreach($categoriesList as $cat)
                  <option value="{{ $cat['name'] }}">{{ $cat['icon'] ?? '📦' }} {{ $cat['name'] }}</option>
                @endforeach
              </select>
              @error('category') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">نوع المنتج</label>
              <select wire:model.live="sub_category" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" {{ $category ? '' : 'disabled' }}>
                <option value="">-- اختر النوع --</option>
                @foreach($this->getSubCategoriesProperty() as $sub)
                  <option value="{{ $sub }}">{{ $sub }}</option>
                @endforeach
              </select>
              @error('sub_category') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          {{-- Form fields based on category type --}}
          @if($categoryType === 'service_text')
            {{-- SERVICE TEXT TYPE - Single text input only --}}
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">وصف الخدمة أو المنتج</label>
              <input type="text" 
                     wire:model.live="name"
                     placeholder="{{ $serviceTextPlaceholder }}" 
                     class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500"
                     {{ ($category && $sub_category) ? '' : 'disabled' }}>
              @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
          @elseif($categoryType === 'variant_specs' && !empty($variantSpecs))
            {{-- VARIANT SPECS WITH MIXED INPUTS (GROCERIES, PHARMACY, BUILDING) --}}
            <div class="space-y-4">
              <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-center">
                <p class="text-sm font-bold text-amber-800">
                  📋 املأ جميع المواصفات المطلوبة
                </p>
              </div>
              
              <div class="grid grid-cols-1 sm:grid-cols-{{ min(count($variantSpecs), 3) }} gap-4">
                @foreach($variantSpecs as $index => $spec)
                  <div class="{{ count($variantSpecs) > 3 && $index >= 3 ? 'sm:col-span-' . min(count($variantSpecs), 3) : '' }}">
                    <label class="block text-gray-800 text-sm font-bold mb-2">
                      {{ $spec['name'] }} 
                      @if(isset($spec['required']) && $spec['required'])
                        <span class="text-red-600">*</span>
                      @endif
                    </label>
                    
                    @if($spec['type'] === 'select')
                      {{-- Dropdown --}}
                      <select wire:model.live="spec{{ $index + 1 }}"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" 
                              {{ ($category && $sub_category) ? '' : 'disabled' }}>
                        <option value="">-- اختر {{ $spec['name'] }} --</option>
                        @foreach($spec['options'] as $option)
                          <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                      </select>
                    @elseif($spec['type'] === 'number')
                      {{-- Number input --}}
                      <input type="number" 
                             wire:model.live="spec{{ $index + 1 }}"
                             placeholder="{{ $spec['placeholder'] ?? '' }}"
                             class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500"
                             {{ ($category && $sub_category) ? '' : 'disabled' }}>
                    @else
                      {{-- Text input --}}
                      <input type="text" 
                             wire:model.live="spec{{ $index + 1 }}"
                             placeholder="{{ $spec['placeholder'] ?? '' }}"
                             class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500"
                             {{ ($category && $sub_category) ? '' : 'disabled' }}>
                    @endif
                    
                    @error('spec' . ($index + 1)) <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>
                @endforeach
              </div>
              
              @if($name)
                <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
                  <p class="text-xs text-green-700 font-bold">المواصفات المختارة:</p>
                  <p class="text-sm font-black text-green-800 mt-1">{{ $name }}</p>
                </div>
              @endif
            </div>
          @else
            {{-- BRAND_MODEL or VARIANT_SPECS TYPE --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              {{-- حقل الشركة - يظهر فقط إذا كان مطلوباً --}}
              @if($showBrandField)
                <div>
                  <div class="flex items-center justify-between">
                    <label class="block text-gray-800 text-sm font-bold mb-2">الشركة</label>
                  </div>

                  <select wire:model.live="brand"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" 
                          {{ ($category && $sub_category) ? '' : 'disabled' }}>
                    <option value="">-- اختر الشركة ({{ count($brands) }} خيار) --</option>
                    @if(!empty($brands))
                      @foreach($brands as $b)
                        <option value="{{ $b }}">{{ $b }}</option>
                      @endforeach
                      <option value="__custom__">✍️ أخرى (إدخال يدوي)</option>
                    @else
                      <option value="" disabled>لا توجد شركات متاحة</option>
                    @endif
                  </select>
                  
                  @if($brand === '__custom__')
                    <div class="mt-2">
                      <input type="text" 
                             wire:model.live="brand"
                             placeholder="اكتب اسم الشركة ثم اضغط Enter" 
                             class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500"
                             autofocus>
                    </div>
                  @endif

                  @error('brand') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
              @endif

              {{-- حقل المواصفات / الموديل (for non-groceries variant specs and brand_model types) --}}
              <div class="{{ $showBrandField ? '' : 'col-span-2' }}">
                <label class="block text-gray-800 text-sm font-bold mb-2">
                  {{ $categoryType === 'brand_model' ? 'الموديل / اسم المنتج' : 'المواصفات' }}
                </label>
                
                @if(!empty($models))
                  <select wire:model.live="name"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" 
                          {{ ($category && $sub_category && (!$showBrandField || ($brand && $brand !== '__custom__'))) ? '' : 'disabled' }}>
                    <option value="">-- {{ $categoryType === 'brand_model' ? 'اختر الموديل' : 'اختر المواصفات' }} ({{ count($models) }} خيار) --</option>
                    @foreach($models as $m)
                      <option value="{{ $m }}">{{ $m }}</option>
                    @endforeach
                    <option value="__custom__">✍️ إدخال يدوي</option>
                  </select>
                  
                  @if($name === '__custom__')
                    <div class="mt-2">
                      <input type="text" 
                             wire:model.live="name"
                             placeholder="{{ $categoryType === 'brand_model' ? 'اكتب اسم الموديل (مثل: iPhone 15 Pro Max)' : 'اكتب المواصفات' }}" 
                             class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500"
                             autofocus>
                    </div>
                  @endif
                @else
                  <input type="text" 
                         wire:model.live="name"
                         placeholder="{{ $categoryType === 'brand_model' ? 'اكتب اسم الموديل (مثل: iPhone 15 Pro Max)' : 'اكتب المواصفات' }}" 
                         class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500"
                         {{ ($category && $sub_category && (!$showBrandField || ($brand && $brand !== '__custom__'))) ? '' : 'disabled' }}>
                @endif
                
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
              </div>
            </div>
          @endif

          <div class="grid grid-cols-1 sm:grid-cols-{{ $showConditionField ? '2' : '1' }} gap-4">
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">السعر (شيكل)</label>
              <div class="relative">
                <input type="number" step="0.01" wire:model="price" placeholder="0.00"
                       class="w-full px-4 py-3 border border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 bg-green-50 font-black text-lg text-green-800" />
                <span class="absolute left-4 top-3.5 text-green-700 font-bold">₪</span>
              </div>
              @error('price') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            @if($showConditionField)
              <div>
                <label class="block text-gray-800 text-sm font-bold mb-2">حالة المنتج</label>
                <div class="grid grid-cols-2 gap-2">
                  <button type="button" 
                          wire:click="$set('condition', 'new')"
                          class="flex items-center justify-center gap-2 border rounded-xl py-3 cursor-pointer transition {{ $condition === 'new' ? 'border-red-500 bg-red-50 shadow-sm' : 'border-gray-200 bg-white hover:border-red-200' }}">
                    <span>🆕</span><span class="font-bold">جديد</span>
                  </button>
                  <button type="button" 
                          wire:click="$set('condition', 'used')"
                          class="flex items-center justify-center gap-2 border rounded-xl py-3 cursor-pointer transition {{ $condition === 'used' ? 'border-red-500 bg-red-50 shadow-sm' : 'border-gray-200 bg-white hover:border-red-200' }}">
                    <span>♻️</span><span class="font-bold">مستعمل</span>
                  </button>
                </div>
                @error('condition') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
              </div>
            @endif
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">المنطقة</label>
              <select wire:model="city" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 bg-white">
                <option value="">اختر..</option>
                <option value="شمال غزة">شمال غزة</option>
                <option value="مدينة غزة">مدينة غزة</option>
                <option value="المنطقة الوسطى">المنطقة الوسطى</option>
                <option value="خانيونس">خانيونس</option>
                <option value="رفح">رفح</option>
              </select>
              @error('city') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            @if(!auth()->check() || !auth()->user()->isShopOwner() || !auth()->user()->is_approved)
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">اسم المحل</label>
              <input type="text" wire:model="shop_name" placeholder="مثلاً: معرض القدس"
                     class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500" />
              @error('shop_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            @else
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">اسم المحل</label>
              <input type="text" value="{{ auth()->user()->shop_name }}" disabled
                     class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-100 text-gray-700 font-bold cursor-not-allowed" />
              <p class="text-xs text-gray-500 mt-1">يتم استخدام اسم متجرك تلقائياً</p>
            </div>
            @endif
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">رقم التواصل / واتساب (اختياري)</label>
              <input type="text" wire:model="contact_phone" placeholder="059xxxxxxx"
                     class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500" />
              @error('contact_phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">تفاصيل العنوان (اختياري)</label>
              <input type="text" wire:model="address_details" placeholder="الشارع، المعلم القريب..."
                     class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500" />
            </div>
          </div>

          <div>
            <label class="block text-gray-800 text-sm font-bold mb-2">صورة المنتج (اختياري)</label>
            <div class="flex items-center justify-center w-full">
              <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden border-gray-200">
                @if ($image)
                  <img src="{{ $image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover opacity-90" alt="preview" />
                  <div class="z-10 bg-white/90 px-3 py-1 rounded-xl text-xs font-bold text-green-700">تم اختيار الصورة ✅</div>
                @else
                  <div class="flex flex-col items-center justify-center">
                    <div class="text-3xl mb-2">🖼️</div>
                    <p class="text-sm font-bold text-gray-700">اضغط لرفع صورة</p>
                    <p class="text-xs text-gray-500">jpeg/png/webp حتى 5MB</p>
                  </div>
                @endif

                <input type="file" wire:model="image" class="hidden" accept="image/*" />
              </label>
            </div>
            <div wire:loading wire:target="image" class="text-xs text-blue-600 mt-2 font-bold">جاري رفع الصورة...</div>
          </div>

          <input type="hidden" wire:model="added_by" />

          <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white font-black py-4 px-4 rounded-2xl shadow-lg transition transform hover:scale-[1.01] flex justify-center items-center gap-3">
              <span>نشر السعر الآن</span>
              <span wire:loading class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></span>
            </button>
            <a href="{{ route('home') }}" class="block text-center mt-4 text-gray-500 text-sm hover:text-red-600 transition">إلغاء وعودة للرئيسية</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>