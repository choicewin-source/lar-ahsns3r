<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-10" dir="rtl">
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

          <div class="grid grid-cols-4 gap-2 text-center text-xs font-bold">
            <div class="p-2 rounded-xl {{ $category ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">1) القسم</div>
            <div class="p-2 rounded-xl {{ $sub_category ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">2) النوع</div>
            <div class="p-2 rounded-xl {{ ($category === 'أجهزة كهربائية وطاقة' || $brand) ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">3) الشركة</div>
            <div class="p-2 rounded-xl {{ $name ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">4) الموديل</div>
          </div>

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

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <div class="flex items-center justify-between">
                <label class="block text-gray-800 text-sm font-bold mb-2">الشركة</label>
                @if(!$showBrandField)
                  <span class="text-xs text-gray-500">(اختياري)</span>
                @endif
              </div>

              <select wire:model.live="brand" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" {{ ($category && $sub_category) ? '' : 'disabled' }}>
                <option value="">-- اختر الشركة --</option>
                @foreach($brands as $b)
                  <option value="{{ $b }}">{{ $b }}</option>
                @endforeach
                @if($showBrandField)
                  <option value="أخرى">أخرى</option>
                @endif
              </select>
              @if($showBrandField)
                @error('brand') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
              @endif
            </div>

            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">الموديل / اسم المنتج</label>
              <select wire:model.live="name" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" {{ ($category && $sub_category && (!$showBrandField || $brand)) ? '' : 'disabled' }}>
                <option value="">-- اختر الموديل --</option>
                @foreach($models as $m)
                  <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
              </select>
              @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">السعر (شيكل)</label>
              <div class="relative">
                <input type="number" step="0.01" wire:model="price" placeholder="0.00"
                       class="w-full px-4 py-3 border border-green-200 rounded-xl focus:ring-2 focus:ring-green-500 bg-green-50 font-black text-lg text-green-800" />
                <span class="absolute left-4 top-3.5 text-green-700 font-bold">₪</span>
              </div>
              @error('price') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">حالة المنتج</label>
              <div class="grid grid-cols-2 gap-2">
                <label class="flex items-center justify-center gap-2 border rounded-xl py-3 cursor-pointer {{ $condition === 'new' ? 'border-red-500 bg-red-50' : 'border-gray-200 bg-white' }}">
                  <input type="radio" class="hidden" wire:model="condition" value="new" />
                  <span>🆕</span><span class="font-bold">جديد</span>
                </label>
                <label class="flex items-center justify-center gap-2 border rounded-xl py-3 cursor-pointer {{ $condition === 'used' ? 'border-red-500 bg-red-50' : 'border-gray-200 bg-white' }}">
                  <input type="radio" class="hidden" wire:model="condition" value="used" />
                  <span>♻️</span><span class="font-bold">مستعمل</span>
                </label>
              </div>
              @error('condition') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
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

            <div>
              <label class="block text-gray-800 text-sm font-bold mb-2">اسم المحل</label>
              <input type="text" wire:model="shop_name" placeholder="مثلاً: معرض القدس"
                     class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500" />
              @error('shop_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
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