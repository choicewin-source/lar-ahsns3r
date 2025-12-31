<div class="min-h-screen bg-white font-sans" dir="rtl" lang="ar">
    
    <!-- استدعاء خط عربي فخم (Tajawal) -->
    <!-- إعلانات أسفل الصفحة -->
    @if(!empty($ads['bottom'] ?? null))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
            @foreach($ads['bottom'] as $ad)
                <a href="{{ $ad['link'] ?? '#' }}" class="block mb-3">
                    @if(!empty($ad['image_path']))
                        <img src="{{ asset('storage/'.$ad['image_path']) }}" alt="{{ $ad['title'] ?? '' }}" class="w-full rounded-lg" loading="lazy">
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded">{{ $ad['text_content'] ?? $ad['title'] }}</div>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>

    <!-- 1. الهيدر -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <!-- شريط الأخبار المتحرك (طلب شادي) -->
<div class="bg-gray-900 text-white overflow-hidden py-2 relative z-50" role="region" aria-label="أخبار الموقع" aria-live="polite">
    <div class="whitespace-nowrap animate-marquee flex gap-10">
        <span class="mx-4 font-bold">📢 مرحبًا بكم في منصة "أحسن سعر" - دليلك الأول للأسعار في غزة</span>
        <span class="mx-4 text-red-400">🔥 الأسعار الأرخص تظهر أولاً دائماً!</span>
        <span class="mx-4 text-green-400">✅ يمكن لأصحاب المحلات إضافة بضائعهم وإنشاء متجر خاص مجاناً</span>
        <span class="mx-4">⚠️ الإبلاغ عن الأسعار الوهمية يساعدنا في الحفاظ على المصداقية</span>
    </div>
</div>

<!-- إعلانات أعلى الصفحة -->
@if(!empty($ads['top'] ?? null))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">
        @foreach($ads['top'] as $ad)
            <a href="{{ $ad['link'] ?? '#' }}" class="block mb-3">
                @if(!empty($ad['image_path']))
                    <img src="{{ asset('storage/'.$ad['image_path']) }}" alt="{{ $ad['title'] ?? '' }}" class="w-full rounded-lg" loading="lazy">
                @else
                    <div class="bg-yellow-100 border border-yellow-300 p-4 rounded">{{ $ad['text_content'] ?? $ad['title'] }}</div>
                @endif
            </a>
        @endforeach
    </div>
@endif

<style>
@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
.animate-marquee {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 20s linear infinite;
    animation-play-state: running;
}
/* إيقاف التحريك عند المرور بالماوس لتحسين إمكانية القراءة */
.bg-gray-900:hover .animate-marquee,
.animate-marquee:hover { animation-play-state: paused; }
</style>
        <!-- الجزء العلوي -->
            <div class="flex flex-col md:flex-row justify-between items-center py-3 gap-4">
                
                <!-- اللوجو -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group cursor-pointer">
                    <div class="relative">
                        <span class="text-3xl font-black text-gray-800 tracking-tighter group-hover:text-gray-600 transition">أحسن</span>
                        <span class="text-3xl font-black text-red-600 tracking-tighter">سعر</span>
                        <span class="absolute -top-3 -left-2 text-sm animate-pulse">🇵🇸</span>
                    </div>
                    <div class="h-8 w-px bg-gray-300 mx-2 hidden md:block"></div>
                    <span class="text-xs font-bold text-gray-500 hidden md:block">دليلك الذكي<br>في غزة</span>
                </a>

                <!-- مربع البحث -->
                <div class="flex-1 max-w-3xl w-full mx-4">
                    <div class="relative flex group shadow-sm rounded-lg overflow-hidden border border-gray-300 focus-within:ring-2 focus-within:ring-red-500 focus-within:border-red-500 transition-all">
                        
                        <!-- زر البحث -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        
                        <input wire:model.live.debounce.300ms="search" type="text" aria-label="بحث عن منتجات" 
                            class="block w-full p-3 pr-10 text-sm text-gray-900 border-none bg-gray-50 focus:ring-0" 
                            placeholder="ايش ناقصك اليوم؟ (اكتب: ايفون، خيمة، ثلاجة...)">
                        
                        <!-- فاصل -->
                        <div class="w-px bg-gray-300 my-2"></div>

                        <!-- قائمة المدن -->
                        <select wire:model.live="city" aria-label="اختيار المدينة" class="bg-gray-100 border-none text-gray-700 text-sm font-bold focus:ring-0 block p-2.5 min-w-[110px] cursor-pointer hover:bg-gray-200 transition">
                            <option value="">📍 كل غزة</option>
                            @foreach($cities as $c)
                                <option value="{{ $c }}">{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- الأزرار -->
                <div class="flex items-center gap-6 text-sm font-medium text-gray-600">
                    <a href="{{ route('products.create') }}" class="flex flex-col items-center group">
                        <div class="bg-red-50 p-2 rounded-full group-hover:bg-red-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-xs mt-1 font-bold group-hover:text-red-600">إضافة سعر</span>
                    </a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="flex flex-col items-center group">
                            <div class="p-2 rounded-full group-hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 group-hover:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <span class="text-xs mt-1 font-bold">دخول</span>
                        </a>
                    @endguest
                </div>
            </div>

            <!-- شريط التصنيفات السريع (زي مقارنة) -->
                      <!-- شريط التصنيفات السريع (مع قوائم منسدلة) -->
            <div class="hidden md:flex justify-center gap-2 py-2 text-[13px] font-bold text-gray-600 border-t border-gray-100 relative z-40">
                @foreach(array_slice($categoriesList, 0, 8) as $cat)
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative group">
                        <!-- الزر الرئيسي -->
                        <button type="button" wire:click="selectCategory('{{ $cat['slug'] }}')" 
                                class="flex items-center gap-1 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition whitespace-nowrap {{ $selectedCategory == $cat['slug'] ? 'text-red-600 bg-red-50' : '' }}">
                            <span>{{ $cat['name'] }}</span>
                            <svg class="w-3 h-3 opacity-50 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- القائمة المنسدلة -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute top-full right-0 w-48 bg-white border border-gray-100 shadow-xl rounded-xl overflow-hidden z-50">
                            
                            <div class="py-2">
                                @foreach($cat['subs'] ?? [] as $sub)
                                    <button type="button" wire:click="$set('search', '{{ $sub }}')" 
                                            class="block w-full text-right px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                        {{ $sub }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

    <!-- 2. Hero Section (معبأ وموزون) -->
    <div class="relative bg-[#FFF9F3] overflow-hidden min-h-[550px] flex items-center justify-center py-20 border-b border-[#F5EBE0]">
        
        <!-- الخلفية الجمالية (Blob) -->
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-[#F5EBE0] rounded-full opacity-60 blur-[80px] -z-0"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-6xl font-black text-gray-800 mb-4 leading-tight">
                منصة <span class="text-red-600 inline-block transform hover:scale-105 transition duration-300">أحسن سعر</span>
            </h1>
            <h2 class="text-2xl md:text-4xl font-extrabold text-gray-700 mb-6">
                الأسعار الأفضل في <span class="underline decoration-green-600 decoration-4">غزة</span>
            </h2>
            <p class="text-gray-500 text-lg font-medium max-w-lg mx-auto bg-white/50 backdrop-blur-sm py-2 px-6 rounded-full border border-white/60">
                اختار، قارن، واشتري صح .. وفر فلوسك وجهدك
            </p>
        </div>

        <!-- === العناصر العائمة (موزعة بشكل قوس) === -->

        <!-- 1. أقصى اليمين (عقارات) -->
        <div class="hidden md:block absolute top-[20%] right-[5%] animate-float-slow hover:z-20">
            <div class="w-24 h-24 bg-white rounded-2xl border-2 border-gray-100 shadow-xl flex flex-col items-center justify-center transform rotate-6 hover:rotate-0 transition duration-300">
                <span class="text-4xl">🏠</span>
                <span class="text-[10px] font-bold text-gray-500 mt-1">عقارات</span>
            </div>
        </div>

        <!-- 2. يمين وسط (جوالات) -->
        <div class="absolute top-[15%] right-[15%] md:right-[20%] animate-float-medium hover:z-20">
            <div class="w-20 h-32 bg-gray-800 rounded-2xl border-4 border-gray-700 shadow-2xl flex items-center justify-center relative transform -rotate-6 hover:rotate-0 transition duration-300">
                <span class="text-4xl">📱</span>
                <div class="absolute bottom-2 w-1 h-1 bg-white rounded-full"></div>
            </div>
        </div>

        <!-- 3. يمين تحت (طاقة شمسية) -->
        <div class="absolute bottom-[20%] right-[10%] md:right-[25%] animate-float-fast hover:z-20">
            <div class="w-28 h-20 bg-blue-600 rounded-lg border-2 border-blue-400 shadow-xl flex items-center justify-center transform rotate-12 hover:rotate-0 transition duration-300">
                <span class="text-4xl">☀️</span>
            </div>
        </div>

        <!-- 4. منتصف تحت (سيارة) -->
        <div class="absolute bottom-[10%] left-1/2 transform -translate-x-1/2 animate-bounce-slow hover:z-20">
            <div class="w-36 h-20 bg-red-50 rounded-2xl border border-red-100 flex flex-col items-center justify-center shadow-lg">
                <span class="text-5xl drop-shadow-md">🚗</span>
            </div>
        </div>

        <!-- 5. يسار تحت (كهربائية) -->
        <div class="absolute bottom-[20%] left-[10%] md:left-[25%] animate-float-slow hover:z-20">
            <div class="w-20 h-32 bg-gray-100 rounded-lg border border-gray-300 shadow-xl flex flex-col items-center justify-center relative transform -rotate-6 hover:rotate-0 transition duration-300">
                <div class="w-full h-[40%] border-b border-gray-300"></div>
                <div class="absolute top-10 right-2 w-1 h-6 bg-gray-300 rounded"></div>
                <div class="absolute bottom-10 right-2 w-1 h-6 bg-gray-300 rounded"></div>
                <span class="text-3xl absolute z-10">❄️</span>
            </div>
        </div>

        <!-- 6. يسار وسط (خيام) -->
        <div class="absolute top-[15%] left-[15%] md:left-[20%] animate-float-medium hover:z-20">
            <div class="w-28 h-24 bg-orange-50 rounded-xl border-b-4 border-orange-200 shadow-xl flex items-center justify-center transform rotate-6 hover:rotate-0 transition duration-300">
                <span class="text-5xl">⛺</span>
            </div>
        </div>

        <!-- 7. أقصى اليسار (أثاث) -->
        <div class="hidden md:block absolute top-[20%] left-[5%] animate-float-fast hover:z-20">
            <div class="w-24 h-24 bg-white rounded-2xl border-2 border-gray-100 shadow-xl flex flex-col items-center justify-center transform -rotate-12 hover:rotate-0 transition duration-300">
                <span class="text-4xl">🛋️</span>
                <span class="text-[10px] font-bold text-gray-500 mt-1">أثاث</span>
            </div>
        </div>

    </div>

    <!-- إعلان / إعلانات وسط الصفحة -->
    @if(!empty($ads['middle'] ?? null))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
            @foreach($ads['middle'] as $ad)
                <a href="{{ $ad['link'] ?? '#' }}" class="block mb-4">
                    @if(!empty($ad['image_path']))
                        <img src="{{ asset('storage/'.$ad['image_path']) }}" alt="{{ $ad['title'] ?? '' }}" class="w-full rounded-lg" loading="lazy">
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded">{{ $ad['text_content'] ?? $ad['title'] }}</div>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    <!-- 3. قسم التصنيفات (Grid) -->
    <div class="bg-white py-12">
        <div class="text-center mb-10">
            <h3 class="text-2xl font-black text-gray-800 inline-block relative z-10">
                تصفح الأقسام
                <div class="absolute w-full h-3 bg-red-100 bottom-1 -z-10 rounded-full"></div>
            </h3>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- دوائر التصنيفات -->
            <div class="flex flex-wrap justify-center gap-8 md:gap-14">
                @foreach($categoriesList as $cat)
                    <div wire:click="selectCategory('{{ $cat['slug'] }}')" class="flex flex-col items-center group cursor-pointer w-20 md:w-auto">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center mb-3 shadow-sm group-hover:bg-red-50 group-hover:border-red-200 group-hover:scale-110 transition-all duration-300 {{ $selectedCategory == $cat['slug'] ? '!bg-red-600 !text-white !border-red-600 shadow-lg scale-110' : '' }}">
                            <span class="text-3xl md:text-4xl filter drop-shadow-sm">{{ $cat['icon'] }}</span>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-red-600 transition-colors {{ $selectedCategory == $cat['slug'] ? 'text-red-600' : '' }}">
                            {{ $cat['name'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 4. أفضل العروض (المنتجات) -->
    <div class="bg-[#F9FAFB] py-16 border-t border-gray-200 rounded-t-[40px] shadow-inner -mt-8 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-black text-gray-800 flex items-center gap-3">
                    <span class="w-3 h-8 bg-red-600 rounded-full"></span>
                    @if($selectedCategory)
                        عروض قسم: <span class="text-red-600">{{ $selectedCategory }}</span>
                    @else
                        أحدث الأسعار المضافة
                    @endif
                </h2>
                <div wire:loading class="text-sm font-bold text-red-500 animate-pulse">جاري التحميل...</div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <a href="{{ route('products.show', $product->id) }}" class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-red-100 transition-all duration-300 flex flex-col h-full group">
                        
                        <!-- الصورة (Placeholder متفاعل) -->
                        <div class="h-44 bg-gray-50 rounded-xl flex items-center justify-center text-6xl mb-4 group-hover:scale-105 transition-transform duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/0 to-white/40 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                             @if(Str::contains($product->category, 'جوال')) 📱 
                            @elseif(Str::contains($product->category, 'كهرباء')) 🔌
                            @elseif(Str::contains($product->category, 'أثاث')) 🛋️
                            @elseif(Str::contains($product->category, 'شمس')) ☀️
                            @elseif(Str::contains($product->category, 'خيم')) ⛺
                            @elseif(Str::contains($product->category, 'سيار')) 🚗
                            @elseif(Str::contains($product->category, 'عقار')) 🏠
                            @else 📦 @endif
                        </div>

                        <!-- التفاصيل -->
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 group-hover:text-red-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3 bg-gray-50 w-fit px-2 py-1 rounded">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $product->city }} | {{ $product->shop_name }}
                            </div>
                        </div>

                        <!-- السعر والزر -->
                        <div class="mt-4 flex justify-between items-end border-t border-gray-50 pt-3">
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold">السعر</p>
                                <span class="text-2xl font-black text-red-600 leading-none">
                                    {{ floatval($product->price) }} <span class="text-sm font-bold text-gray-400">₪</span>
                                </span>
                            </div>
                            
                            @if($product->added_by == 'shop_owner')
                                <span class="bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">محل تجاري</span>
                            @else
                                <span class="bg-green-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">تجربة مواطن</span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 grayscale opacity-50">🔍</div>
                        <h3 class="text-lg font-bold text-gray-600">عفواً، لا توجد نتائج</h3>
                        <p class="text-gray-400 text-sm mt-1">حاول البحث عن شيء آخر أو كن أول من يضيف سعراً!</p>
                        <a href="{{ route('products.create') }}" class="inline-block mt-4 text-red-600 font-bold hover:underline">إضافة سعر جديد +</a>
                    </div>
                @endforelse
            </div>
            
             <div class="mt-10">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    
     <!-- Animation Styles -->
    <style>
        @keyframes float-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        @keyframes float-medium { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        @keyframes float-fast { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        @keyframes bounce-slow { 0%, 100% { transform: translate(-50%, 0); } 50% { transform: translate(-50%, -5px); } }
        
        .animate-float-slow { animation: float-slow 4s ease-in-out infinite; }
        .animate-float-medium { animation: float-medium 3s ease-in-out infinite; }
        .animate-float-fast { animation: float-fast 5s ease-in-out infinite; }
        .animate-bounce-slow { animation: bounce-slow 3s ease-in-out infinite; }
    </style>

</div>