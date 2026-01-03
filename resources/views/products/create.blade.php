<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-red-600">
                
                <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">إضافة سعر جديد 🏷️</h2>

                <!-- عرض أخطاء التعبئة إن وجدت -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded relative text-sm">
                        <strong class="font-bold">يرجى تصحيح الأخطاء التالية:</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <!-- يتم إرسال نوع المُضيف تلقائياً كـ (زبون).
                         إذا كان المستخدم صاحب متجر مُعتمد ومسجل دخول، سيتم تحويله تلقائياً في ProductController -->
                    <input type="hidden" name="added_by" value="customer">

                    <!-- 1. اسم المنتج -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">اسم المنتج / الخدمة</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="مثلاً: ثلاجة LG 18 قدم، ايفون 15..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                    </div>

                    <!-- 2. القسم -> ثم نوع المنتج (sub_category) بناءً على الأقسام الفرعية المتوفرة -->
                    @php
                        $categoryMap = [
                            'أجهزة كهربائية وطاقة' => ['icon' => '🔌☀️', 'subs' => []],
                            'أثاث ومفروشات وخيام' => ['icon' => '🛋️⛺', 'subs' => []],
                            'سيارات ودراجات' => ['icon' => '🚗🚲', 'subs' => []],
                            'جوالات وإلكترونيات' => ['icon' => '📱', 'subs' => []],
                            'مطاعم' => ['icon' => '🍽️', 'subs' => []],
                            'عقارات' => ['icon' => '🏠', 'subs' => []],
                            'ملابس' => ['icon' => '👕', 'subs' => ['ملابس رجالية', 'ملابس نسائية', 'ملابس أطفال', 'أحذية وإكسسوارات']],
                            'خدمات إلكترونية' => ['icon' => '🧾💻', 'subs' => ['استضافة ومواقع', 'تصميم وبرمجة', 'تسويق إلكتروني', 'خدمات دفع', 'صيانة إلكترونية']],
                            'مواد غذائية وسوبر ماركت' => ['icon' => '🛒', 'subs' => ['خضار وفواكه', 'ألبان', 'لحوم ودواجن', 'مواد معلبة', 'مشروبات وحلويات']],
                            'مواد بناء ولوازم منزلية' => ['icon' => '🧰', 'subs' => ['مواد بناء أساسية', 'أدوات كهربائية وسباكة', 'دهانات', 'أثاث منزلي', 'أدوات يدوية']],
                            'صيدليات ومستلزمات طبية' => ['icon' => '🩺', 'subs' => ['أدوية', 'مستلزمات طبية', 'مكملات غذائية', 'مستلزمات أطفال']],
                            'خدمات عامة' => ['icon' => '🛠️', 'subs' => ['صيانة كهرباء وسباكة', 'توصيل ونقل', 'تنظيف', 'تصليح أجهزة']],
                            'ترفيه وألعاب ورياضة' => ['icon' => '🎮⚽️', 'subs' => ['ألعاب فيديو', 'ألعاب أطفال', 'معدات رياضية', 'أنشطة ترفيهية']],
                            'زراعة وحيوانات' => ['icon' => '🐔🐄', 'subs' => ['حيوانات أليفة', 'أعلاف', 'أدوات زراعة', 'معدات ري']],
                            'أخرى' => ['icon' => '📦', 'subs' => []],
                        ];

                        // دمج بيانات DB مع خريطة ثابتة (إن كانت subs في DB فارغة)
                        $categoriesForForm = ($categories ?? collect())->map(function($c) use ($categoryMap) {
                            $custom = $categoryMap[$c->name] ?? null;

                            return [
                                'name' => $c->name,
                                'icon' => $custom['icon'] ?? ($c->icon ?? '📦'),
                                'subs' => array_values(array_unique(array_merge($c->subs ?? [], $custom['subs'] ?? []))),
                            ];
                        })->values();

                        $subCategoriesJson = $categoriesForForm->mapWithKeys(fn($c) => [$c['name'] => $c['subs']])->toJson(JSON_UNESCAPED_UNICODE);
                    @endphp

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">القسم</label>
                        <select id="categorySelect" name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-white">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>-- اختر القسم المناسب --</option>
                            @foreach($categoriesForForm as $cat)
                                <option value="{{ $cat['name'] }}" {{ old('category') === $cat['name'] ? 'selected' : '' }}>
                                    {{ $cat['icon'] }} {{ $cat['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4" id="subCategoryWrapper" style="display:none;">
                        <label class="block text-gray-700 text-sm font-bold mb-2">نوع المنتج</label>
                        <select id="subCategorySelect" name="sub_category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-white">
                            <option value="">-- اختر النوع --</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">إذا لم تجد النوع المناسب، يمكنك تركه فارغًا.</p>
                    </div>

                    <!-- 3. السعر -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">السعر (شيكل)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00"
                                class="w-full px-4 py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-green-50 font-bold text-lg text-green-800">
                            <span class="absolute left-4 top-3.5 text-green-700 font-bold">₪</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- 4. المحل -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">اسم المحل</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" placeholder="مثلاً: معرض القدس"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>

                        <!-- 5. المدينة -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">المنطقة</label>
                            <select name="city" class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-white">
                                <option value="شمال غزة">شمال غزة</option>
                                <option value="مدينة غزة">مدينة غزة</option>
                                <option value="المنطقة الوسطى">المنطقة الوسطى</option>
                                <option value="خانيونس">خانيونس</option>
                                <option value="رفح">رفح</option>
                            </select>
                        </div>
                    </div>

                    <!-- 6. تفاصيل العنوان -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">تفاصيل العنوان (اختياري)</label>
                        <textarea name="address_details" rows="2" placeholder="الشارع، المعلم القريب..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('address_details') }}</textarea>
                    </div>


                    <script>
                        (function () {
                            const subCategoriesByCategory = {!! $subCategoriesJson !!};
                            const categorySelect = document.getElementById('categorySelect');
                            const subWrapper = document.getElementById('subCategoryWrapper');
                            const subSelect = document.getElementById('subCategorySelect');

                            function renderSubCategories() {
                                const cat = categorySelect.value;
                                const subs = (subCategoriesByCategory && subCategoriesByCategory[cat]) ? subCategoriesByCategory[cat] : [];

                                // تنظيف الخيارات
                                subSelect.innerHTML = '<option value="">-- اختر النوع --</option>';

                                if (!cat || !subs || subs.length === 0) {
                                    subWrapper.style.display = 'none';
                                    return;
                                }

                                subs.forEach((s) => {
                                    const opt = document.createElement('option');
                                    opt.value = s;
                                    opt.textContent = s;
                                    subSelect.appendChild(opt);
                                });

                                // إعادة تعيين القيمة القديمة إن وجدت
                                const oldSub = @json(old('sub_category'));
                                if (oldSub) {
                                    subSelect.value = oldSub;
                                }

                                subWrapper.style.display = 'block';
                            }

                            categorySelect.addEventListener('change', renderSubCategories);
                            document.addEventListener('DOMContentLoaded', renderSubCategories);
                            // في حال كانت الصفحة محملة مسبقاً
                            renderSubCategories();
                        })();
                    </script>

                    <!-- زر النشر -->
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition transform hover:scale-[1.02] flex justify-center items-center gap-2">
                        <span>نشر السعر الآن</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </button>
                    
                    <a href="{{ route('home') }}" class="block text-center mt-4 text-gray-500 text-sm hover:text-red-600 transition">إلغاء وعودة للرئيسية</a>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>