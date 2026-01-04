<div class="min-h-screen bg-white font-sans" dir="rtl" lang="ar" x-data="{ showModal: {{ request('open') == 'add' ? 'true' : 'false' }} }">
    
    {{-- نضع الستايل هنا داخل الـ Root لتجنب مشاكل Livewire --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&family=Cairo:wght@400;600;700;800;900&display=swap');
        body { font-family: 'Tajawal', sans-serif; }

        /* ألوان علم فلسطين المحسّنة */
        :root {
            --palestine-black: #1a1a1a;
            --palestine-white: #FFFFFF;
            --palestine-green: #007A3D;
            --palestine-red: #B31B1B;
            --burgundy: #800020;
            --mahogany: #B31B1B;
            --forest-green: #138808;
            --regal-navy: #00356B;
            --gold-accent: #d4af37;
            --bg-premium: #fafafa;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-subtle: #e5e7eb;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 20s linear infinite;
        }
        .bg-gray-900:hover .animate-marquee,
        .animate-marquee:hover { animation-play-state: paused; }

        /* أنيميشن العناصر العائمة */
        @keyframes float-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        @keyframes float-medium { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        @keyframes float-fast { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        @keyframes bounce-slow { 0%, 100% { transform: translate(-50%, 0); } 50% { transform: translate(-50%, -5px); } }

        .animate-float-slow { animation: float-slow 4s ease-in-out infinite; }
        .animate-float-medium { animation: float-medium 3s ease-in-out infinite; }
        .animate-float-fast { animation: float-fast 5s ease-in-out infinite; }
        .animate-bounce-slow { animation: bounce-slow 3s ease-in-out infinite; }

        /* أنيميشن علم فلسطين */
        @keyframes flag-wave {
            0%, 100% { transform: scale(1) rotate(0deg); }
            25% { transform: scale(1.05) rotate(1deg); }
            75% { transform: scale(1.05) rotate(-1deg); }
        }
        .palestine-flag:hover {
            animation: flag-wave 2s ease-in-out infinite;
        }

        /* تأثيرات إضافية للتصنيفات */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
    </style>

    {{-- نافذة إضافة السعر المنبثقة --}}
    <div x-show="showModal" x-cloak style="display: none;" class="fixed inset-0 z-[100] bg-gray-900/60 backdrop-blur-sm overflow-y-auto">
        <div class="min-h-screen flex items-center justify-center p-4" @click.self="showModal = false">
            <livewire:create-product />
        </div>
    </div>

    {{-- إعلانات أسفل الصفحة (اختياري حسب الترتيب) --}}
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

    {{-- 1. الهيدر --}}
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- شريط الأخبار المتحرك المحسّن --}}
            <div class="relative overflow-hidden py-2.5 z-50 rounded-b-xl shadow-lg" 
                 style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);" 
                 role="region" aria-label="أخبار الموقع">
                <div class="absolute inset-0 opacity-10" 
                     style="background: linear-gradient(90deg, transparent 0%, #d4af37 50%, transparent 100%);"></div>
                <div class="whitespace-nowrap animate-marquee flex gap-10 relative z-10">
                    @if(isset($tickerText) && count($tickerText) > 0)
                        @foreach($tickerText as $message)
                            <span class="mx-4 text-sm font-semibold text-white/95 tracking-wide">
                                <span class="inline-block w-1.5 h-1.5 bg-red-500 rounded-full ml-2 animate-pulse"></span>
                                {{ $message }}
                            </span>
                        @endforeach
                    @else
                         <span class="mx-4 text-sm font-semibold text-white/95 tracking-wide">
                            <span class="inline-block w-1.5 h-1.5 bg-red-500 rounded-full ml-2 animate-pulse"></span>
                            أهلاً بكم في أحسن سعر - منصتكم الأولى لمقارنة الأسعار في غزة
                         </span>
                    @endif
                </div>
            </div>

            {{-- إعلانات أعلى الصفحة --}}
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

            {{-- الجزء العلوي - هيدر فخم بألوان علم فلسطين --}}
            <div class="relative overflow-hidden py-8 bg-white">
                
                <div class="relative flex flex-col md:flex-row justify-center items-center gap-8">
                    {{-- اللوجو مع علم فلسطين الفخم --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-5 group cursor-pointer transform transition-all duration-300 hover:scale-[1.02]">
                        {{-- علم فلسطين SVG فخم مع تأثيرات احترافية --}}
                        <div class="relative palestine-flag">
                            {{-- ظل متوهج خلف العلم --}}
                            <div class="absolute -inset-2 bg-gradient-to-br from-red-500/20 via-green-500/20 to-black/10 rounded-xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <svg width="80" height="60" viewBox="0 0 80 60" class="relative drop-shadow-2xl">
                                <defs>
                                    {{-- تدرجات لونية راقية --}}
                                    <linearGradient id="blackGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" style="stop-color:#1a1a1a;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#2d2d2d;stop-opacity:1" />
                                    </linearGradient>
                                    <linearGradient id="greenGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" style="stop-color:#007A3D;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#00914A;stop-opacity:1" />
                                    </linearGradient>
                                    <linearGradient id="redGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#B31B1B;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#C92A2A;stop-opacity:1" />
                                    </linearGradient>
                                    <linearGradient id="whiteShine" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.3" />
                                        <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0" />
                                    </linearGradient>
                                </defs>
                                
                                {{-- الشريط الأسود العلوي --}}
                                <rect x="0" y="0" width="80" height="20" fill="url(#blackGrad)" rx="1"/>
                                {{-- الشريط الأبيض الأوسط --}}
                                <rect x="0" y="20" width="80" height="20" fill="#FFFFFF" stroke="#e5e7eb" stroke-width="0.5"/>
                                {{-- الشريط الأخضر السفلي --}}
                                <rect x="0" y="40" width="80" height="20" fill="url(#greenGrad)" rx="1"/>
                                {{-- المثلث الأحمر --}}
                                <path d="M 0,0 L 30,30 L 0,60 Z" fill="url(#redGrad)"/>
                                {{-- إطار ذهبي فاخر --}}
                                <rect x="0.5" y="0.5" width="79" height="59" fill="none" stroke="#d4af37" stroke-width="1" opacity="0.4" rx="2"/>
                                {{-- لمعة خفيفة --}}
                                <rect x="0" y="0" width="80" height="20" fill="url(#whiteShine)" opacity="0.1"/>
                            </svg>
                        </div>

                        {{-- اللوجو النصي الفخم المحسّن --}}
                        <div class="relative">
                            <div class="flex items-center gap-3">
                                <div class="flex items-baseline gap-2">
                                    {{-- أيقونة قبل أحسن --}}
                                    <svg class="w-8 h-8 md:w-10 md:h-10 flex-shrink-0 group-hover:rotate-12 transition-transform duration-500 self-center" viewBox="0 0 24 24" fill="none">
                                        <defs>
                                            <linearGradient id="iconGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#d4af37;stop-opacity:1" />
                                                <stop offset="50%" style="stop-color:#f4d03f;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#d4af37;stop-opacity:1" />
                                            </linearGradient>
                                        </defs>
                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" 
                                              fill="url(#iconGrad1)" 
                                              stroke="#c9a74a" 
                                              stroke-width="0.5"
                                              style="filter: drop-shadow(0 2px 8px rgba(212,175,55,0.5));"/>
                                    </svg>
                                    
                                    <span class="text-5xl md:text-7xl font-black tracking-tight transition-all duration-300 group-hover:tracking-normal" 
                                          style="font-family: 'Cairo', sans-serif; 
                                                 color: #1a1a1a;
                                                 text-shadow: 2px 4px 8px rgba(0,0,0,0.06), 0 0 25px rgba(212,175,55,0.08);">أحسن</span>
                                    <span class="text-5xl md:text-7xl font-black tracking-tight group-hover:scale-105 transition-all duration-300" 
                                          style="font-family: 'Cairo', sans-serif;
                                                 background: linear-gradient(135deg, #B31B1B 0%, #D32F2F 30%, #C92A2A 70%, #B31B1B 100%); 
                                                 -webkit-background-clip: text; 
                                                 -webkit-text-fill-color: transparent; 
                                                 background-clip: text;
                                                 filter: drop-shadow(0 3px 6px rgba(179, 27, 27, 0.25)) drop-shadow(0 0 20px rgba(179, 27, 27, 0.12));">سعر</span>
                                </div>
                            </div>
                            {{-- خط زخرفي فاخر بألوان علم فلسطين --}}
                            <div class="relative h-2.5 w-full mt-5 rounded-full overflow-hidden shadow-md">
                                <div class="absolute inset-0" 
                                     style="background: linear-gradient(90deg, #1a1a1a 0%, #007A3D 33%, #FFFFFF 50%, #007A3D 66%, #B31B1B 100%);"></div>
                                <div class="absolute inset-0 opacity-40" 
                                     style="background: linear-gradient(90deg, transparent 0%, rgba(212,175,55,0.6) 50%, transparent 100%);"></div>
                            </div>
                            {{-- نقاط ذهبية زخرفية محسّنة --}}
                            <div class="absolute -top-3 -right-3 w-4 h-4 bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 rounded-full opacity-70 group-hover:opacity-100 transition-opacity duration-300 shadow-lg"></div>
                            <div class="absolute -bottom-2 -left-3 w-3 h-3 bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 rounded-full opacity-60 group-hover:opacity-100 transition-opacity duration-300 shadow-lg"></div>
                        </div>

                        <div class="h-16 w-px bg-gradient-to-b from-transparent via-gray-300/60 to-transparent mx-6 hidden lg:block relative">
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-1.5 h-1.5 bg-yellow-500/50 rounded-full"></div>
                        </div>
                        
                        {{-- النص الوصفي الفخم المحسّن --}}
                        <div class="text-center md:text-right hidden lg:block">
                            <span class="block text-lg font-bold tracking-wide mb-1" 
                                  style="color: #1f2937; font-family: 'Cairo', sans-serif; 
                                         text-shadow: 1px 2px 4px rgba(0,0,0,0.05);">دليلك الذكي</span>
                            <span class="block text-sm font-bold tracking-wider" 
                                  style="background: linear-gradient(90deg, #007A3D 0%, #00914A 50%, #B31B1B 100%); 
                                         -webkit-background-clip: text; 
                                         -webkit-text-fill-color: transparent; 
                                         background-clip: text;
                                         filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">في قلب غزة 🇵🇸</span>
                        </div>
                    </a>
                </div>
            </div>


            {{-- شريط التصنيفات السريع المحسّن --}}
            <div class="hidden md:flex justify-center gap-3 py-4 text-sm font-bold border-t relative z-40" 
                 style="background: linear-gradient(to bottom, #ffffff 0%, #fafafa 50%, #ffffff 100%); border-color: #e5e7eb;">
                @foreach(array_slice($categoriesList, 0, 8) as $cat)
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative group">
                        <button type="button" wire:click="selectCategory('{{ $cat['name'] }}')" 
                                class="flex items-center gap-2 px-5 py-3 rounded-xl transition-all duration-300 whitespace-nowrap font-semibold tracking-wide relative overflow-hidden
                                       {{ $selectedCategory == $cat['name'] ? 'text-white shadow-xl shadow-red-500/40 scale-105' : 'text-gray-700 hover:text-white hover:shadow-lg hover:shadow-red-500/25' }}"
                                style="{{ $selectedCategory == $cat['name'] 
                                         ? 'background: linear-gradient(135deg, #B31B1B 0%, #C92A2A 50%, #B31B1B 100%);' 
                                         : 'background: white; border: 2px solid #e5e7eb;' }}">
                            @if($selectedCategory != $cat['name'])
                                <span class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            @else
                                <span class="absolute inset-0 opacity-20" 
                                      style="background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);"></span>
                            @endif
                            <span class="relative z-10">{{ $cat['name'] }}</span>
                            <svg class="w-4 h-4 opacity-70 group-hover:rotate-180 transition-transform duration-300 relative z-10" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute top-full right-0 w-56 bg-white border-2 border-gray-200/80 shadow-2xl rounded-2xl overflow-hidden z-50 mt-2"
                             style="backdrop-filter: blur(12px); background: rgba(255, 255, 255, 0.98);">
                            
                            <div class="py-2">
                                @foreach($cat['subs'] ?? [] as $sub)
                                    <a href="{{ route('products.compare', ['category' => $cat['name'], 'sub_category' => $sub]) }}" 
                                       class="block w-full text-right px-5 py-3 text-sm font-semibold text-gray-700 hover:text-white transition-all duration-200 relative group/sub overflow-hidden">
                                        <span class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-600 opacity-0 group-hover/sub:opacity-100 transition-all duration-200 rounded-lg mx-2"></span>
                                        <span class="relative z-10">{{ $sub }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </header>

    {{-- 2. Hero Section --}}
    <div class="relative bg-[#FFF9F3] overflow-hidden min-h-[550px] flex items-center justify-center py-20 border-b border-[#F5EBE0]">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-[#F5EBE0] rounded-full opacity-60 blur-[80px] -z-0"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-6xl font-black text-gray-800 mb-4 leading-tight">
                منصة <span class="text-red-600 inline-block transform hover:scale-105 transition duration-300">أحسن سعر</span>
            </h1>
            <h2 class="text-2xl md:text-4xl font-extrabold text-gray-700 mb-6">
                الأسعار الأفضل في <span class="underline decoration-green-600 decoration-4">غزة</span>
            </h2>
            <p class="text-gray-500 text-lg font-medium max-w-lg mx-auto bg-white/50 backdrop-blur-sm py-2 px-6 rounded-full border border-white/60 mb-8">
                اختار، قارن، واشتري صح .. وفر فلوسك وجهدك
            </p>

            {{-- أزرار تسجيل الدخول وإنشاء متجر للزوار فقط --}}
            @guest
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-gray-50 text-gray-800 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-200 hover:border-red-600 group">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-lg">تسجيل الدخول</span>
                    </a>

                    <a href="{{ route('shop.register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="text-lg">إنشاء متجر</span>
                    </a>
                </div>
            @endguest
        </div>

        {{-- العناصر العائمة (ديكور) --}}
        <div class="hidden md:block absolute top-[20%] right-[5%] animate-float-slow hover:z-20">
            <div class="w-24 h-24 bg-white rounded-2xl border-2 border-gray-100 shadow-xl flex flex-col items-center justify-center transform rotate-6 hover:rotate-0 transition duration-300">
                <span class="text-4xl">🏠</span>
                <span class="text-[10px] font-bold text-gray-500 mt-1">عقارات</span>
            </div>
        </div>
        <div class="absolute top-[15%] right-[15%] md:right-[20%] animate-float-medium hover:z-20">
            <div class="w-20 h-32 bg-gray-800 rounded-2xl border-4 border-gray-700 shadow-2xl flex items-center justify-center relative transform -rotate-6 hover:rotate-0 transition duration-300">
                <span class="text-4xl">📱</span>
                <div class="absolute bottom-2 w-1 h-1 bg-white rounded-full"></div>
            </div>
        </div>
        <div class="absolute bottom-[20%] right-[10%] md:right-[25%] animate-float-fast hover:z-20">
            <div class="w-28 h-20 bg-blue-600 rounded-lg border-2 border-blue-400 shadow-xl flex items-center justify-center transform rotate-12 hover:rotate-0 transition duration-300">
                <span class="text-4xl">☀️</span>
            </div>
        </div>
        <div class="absolute bottom-[10%] left-1/2 transform -translate-x-1/2 animate-bounce-slow hover:z-20">
            <div class="w-36 h-20 bg-red-50 rounded-2xl border border-red-100 flex flex-col items-center justify-center shadow-lg">
                <span class="text-5xl drop-shadow-md">🚗</span>
            </div>
        </div>
        <div class="absolute bottom-[20%] left-[10%] md:left-[25%] animate-float-slow hover:z-20">
            <div class="w-20 h-32 bg-gray-100 rounded-lg border border-gray-300 shadow-xl flex flex-col items-center justify-center relative transform -rotate-6 hover:rotate-0 transition duration-300">
                <div class="w-full h-[40%] border-b border-gray-300"></div>
                <div class="absolute top-10 right-2 w-1 h-6 bg-gray-300 rounded"></div>
                <div class="absolute bottom-10 right-2 w-1 h-6 bg-gray-300 rounded"></div>
                <span class="text-3xl absolute z-10">❄️</span>
            </div>
        </div>
        <div class="absolute top-[15%] left-[15%] md:left-[20%] animate-float-medium hover:z-20">
            <div class="w-28 h-24 bg-orange-50 rounded-xl border-b-4 border-orange-200 shadow-xl flex items-center justify-center transform rotate-6 hover:rotate-0 transition duration-300">
                <span class="text-5xl">⛺</span>
            </div>
        </div>
        <div class="hidden md:block absolute top-[20%] left-[5%] animate-float-fast hover:z-20">
            <div class="w-24 h-24 bg-white rounded-2xl border-2 border-gray-100 shadow-xl flex flex-col items-center justify-center transform -rotate-12 hover:rotate-0 transition duration-300">
                <span class="text-4xl">🛋️</span>
                <span class="text-[10px] font-bold text-gray-500 mt-1">أثاث</span>
            </div>
        </div>
    </div>

    {{-- إعلانات الوسط --}}
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

    {{-- 3. قسم التصنيفات (Grid 16) --}}
    <div class="bg-white py-12">
        <div class="text-center mb-10">
            <h3 class="text-2xl font-black text-gray-800 inline-block relative z-10">
                البوابات الرئيسية
                <div class="absolute w-full h-3 bg-red-100 bottom-1 -z-10 rounded-full"></div>
            </h3>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($categoriesList as $cat)
                    <a href="{{ route('products.index', ['category' => $cat['name']]) }}" class="flex flex-col items-center group cursor-pointer p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-red-50 hover:border-red-200 hover:scale-105 transition-all duration-300 {{ $selectedCategory == $cat['name'] ? '!bg-red-600 !text-white !border-red-600 shadow-lg scale-105' : '' }}">
                        <span class="text-5xl mb-3">{{ $cat['icon'] }}</span>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-red-600 text-center transition-colors {{ $selectedCategory == $cat['name'] ? 'text-white' : '' }}">
                            {{ $cat['name'] }}
                        </span>
                        @if(count($cat['subs'] ?? []) > 0)
                            <span class="text-[10px] text-gray-400 mt-1 group-hover:text-red-400 {{ $selectedCategory == $cat['name'] ? 'text-white/70' : '' }}">
                                {{ count($cat['subs']) }} نوع
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 4. أحدث الأسعار المضافة - قائمة عمودية فخمة --}}
    <div class="bg-gradient-to-b from-gray-50 to-white py-16 border-t border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- العنوان الرئيسي الفخم --}}
            <div class="text-center mb-12">
                <div class="inline-block relative">
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-3 tracking-tight">
                        @if($selectedCategory)
                            عروض قسم: <span class="bg-gradient-to-r from-red-600 to-red-700 bg-clip-text text-transparent">{{ $selectedCategory }}</span>
                        @else
                            أحدث الأسعار المضافة
                        @endif
                    </h2>
                    <div class="absolute -bottom-3 right-0 w-full h-5 bg-gradient-to-r from-red-200/40 via-red-300/60 to-red-200/40 rounded-full blur-sm -z-10"></div>
                    <div class="absolute -bottom-2 right-0 w-full h-3 bg-gradient-to-r from-red-300/60 via-red-400/80 to-red-300/60 rounded-full -z-10"></div>
                </div>
                <p class="text-gray-600 font-semibold mt-4 text-lg">تصفح أحدث العروض والأسعار في غزة 🇵🇸</p>
                <div wire:loading class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-red-500 bg-red-50 px-4 py-2 rounded-full">
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    جاري التحميل...
                </div>
            </div>

            {{-- قائمة المنتجات العمودية الفخمة --}}
            <div class="space-y-4">
                @forelse($products as $index => $product)
                    <div class="group relative bg-white border-2 border-gray-200 rounded-3xl overflow-hidden hover:border-red-400 hover:shadow-2xl transition-all duration-300">
                        
                        {{-- رقم الترتيب --}}
                        <div class="absolute top-5 left-5 bg-gradient-to-br from-gray-900 to-gray-800 text-white w-11 h-11 rounded-xl flex items-center justify-center shadow-lg z-10">
                            <span class="text-base font-black">#{{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}</span>
                        </div>
                        
                        <div class="flex flex-col md:flex-row items-stretch gap-4 p-5 md:p-6">
                            {{-- الأيقونة --}}
                            <a href="{{ route('products.show', $product->id) }}" class="flex-shrink-0">
                                <div class="relative w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl shadow-md flex items-center justify-center text-5xl md:text-6xl transform group-hover:scale-105 transition-all duration-300 border-2 border-gray-200 group-hover:border-red-300">
                                    @if(Str::contains($product->category, 'جوال'))
                                        📱
                                    @elseif(Str::contains($product->category, 'كهرباء') || Str::contains($product->category, 'طاقة'))
                                        🔌
                                    @elseif(Str::contains($product->category, 'أثاث') || Str::contains($product->category, 'خيام'))
                                        🛋️
                                    @elseif(Str::contains($product->category, 'سيارات'))
                                        🚗
                                    @elseif(Str::contains($product->category, 'مطاعم'))
                                        🍽️
                                    @elseif(Str::contains($product->category, 'عقارات'))
                                        🏠
                                    @elseif(Str::contains($product->category, 'ملابس'))
                                        👕
                                    @elseif(Str::contains($product->category, 'إلكترونية'))
                                        💻
                                    @elseif(Str::contains($product->category, 'غذائية'))
                                        🛒
                                    @elseif(Str::contains($product->category, 'بناء'))
                                        🧰
                                    @elseif(Str::contains($product->category, 'صيدليات'))
                                        🩺
                                    @elseif(Str::contains($product->category, 'خدمات'))
                                        🛠️
                                    @elseif(Str::contains($product->category, 'ترفيه'))
                                        🎮
                                    @elseif(Str::contains($product->category, 'زراعة'))
                                        🐔
                                    @else
                                        🛍️
                                    @endif
                                    
                                    {{-- علامة جديد --}}
                                    @if($product->created_at->diffInHours() < 24)
                                        <div class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-md animate-pulse z-20">
                                            جديد
                                        </div>
                                    @endif
                                </div>
                            </a>

                            {{-- المحتوى الرئيسي --}}
                            <div class="flex-1 flex flex-col justify-between min-w-0 md:pr-4">
                                <a href="{{ route('products.show', $product->id) }}" class="block mb-3">
                                    {{-- اسم المنتج --}}
                                    <h3 class="font-black text-gray-900 text-lg md:text-xl mb-2 group-hover:text-red-600 transition-colors leading-tight line-clamp-2">
                                        {{ $product->name }}
                                    </h3>

                                    {{-- التصنيفات والموقع --}}
                                    <div class="flex flex-wrap items-center gap-2">
                                        <div class="flex items-center gap-1 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 px-2.5 py-1 rounded-lg font-bold text-xs border border-blue-200">
                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            <span class="truncate max-w-[150px]">{{ $product->category }}</span>
                                        </div>
                                        
                                        @if($product->sub_category)
                                            <div class="flex items-center gap-1 bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 px-2.5 py-1 rounded-lg text-xs font-bold border border-purple-200">
                                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                <span class="truncate max-w-[120px]">{{ $product->sub_category }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($product->city)
                                            <div class="flex items-center gap-1 bg-gradient-to-r from-green-50 to-green-100 text-green-700 px-2.5 py-1 rounded-lg text-xs font-bold border border-green-200">
                                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="truncate max-w-[100px]">{{ $product->city }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </a>

                                {{-- معلومات إضافية --}}
                                <div class="flex flex-wrap items-center gap-2 text-xs">
                                    {{-- الوقت --}}
                                    <div class="flex items-center gap-1 text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-semibold">{{ $product->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    <span class="text-gray-300">•</span>
                                    
                                    {{-- الكود --}}
                                    <span class="font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded">
                                        {{ $product->reference_code }}
                                    </span>
                                    
                                    @if(isset($product->added_by) && $product->added_by == 'shop_owner' && $product->user && $product->user->is_approved)
                                        <span class="text-gray-300 hidden sm:inline">•</span>
                                        {{-- متجر معتمد --}}
                                        <a href="{{ route('shop.show', ['id' => $product->user_id]) }}" 
                                           onclick="event.stopPropagation();"
                                           class="inline-flex items-center gap-1 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-2.5 py-1 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg font-bold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            <span class="truncate max-w-[120px]">{{ $product->user->shop_name ?? $product->shop_name }}</span>
                                        </a>
                                    @else
                                        <span class="text-gray-300 hidden sm:inline">•</span>
                                        {{-- زبون / مواطن --}}
                                        <div class="inline-flex items-center gap-1 bg-gradient-to-r from-green-500 to-green-600 text-white px-2.5 py-1 rounded-lg shadow-sm font-bold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>زبون</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- السعر والزر --}}
                            <div class="flex-shrink-0 flex flex-col items-center justify-center gap-2.5 md:min-w-[140px] mt-3 md:mt-0">
                                {{-- السعر --}}
                                <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-300 rounded-2xl p-3 shadow-md w-full">
                                    <div class="text-[10px] font-bold text-green-700 mb-0.5 text-center">السعر</div>
                                    <div class="text-2xl font-black text-green-600 text-center leading-none">
                                        {{ number_format($product->price, 2) }}
                                    </div>
                                    <div class="text-xs font-bold text-green-700 mt-0.5 text-center">شيكل</div>
                                </div>
                                
                                {{-- زر التفاصيل --}}
                                <a href="{{ route('products.show', $product->id) }}" 
                                   class="flex items-center justify-center gap-1.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold px-5 py-2.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg w-full text-sm">
                                    <span>التفاصيل</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="py-20 text-center bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl border-2 border-dashed border-gray-300">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-5xl mx-auto mb-6 shadow-lg grayscale opacity-50">
                                🔍
                            </div>
                            <h3 class="text-2xl font-black text-gray-700 mb-2">عفواً، لا توجد نتائج</h3>
                            <p class="text-gray-500 text-base mb-6">حاول البحث عن شيء آخر أو كن أول من يضيف سعراً!</p>
                            <a href="#" @click.prevent="showModal = true" 
                               class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                إضافة سعر جديد
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            
            {{-- Pagination --}}
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>

</div>