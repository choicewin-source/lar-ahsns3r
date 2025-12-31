<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50 font-sans shadow-sm" dir="rtl">
    
    <!-- 1. الشريط العلوي (Top Bar) - لملء الفراغ وإعطاء احترافية -->
    <div class="bg-gray-50 border-b border-gray-100 py-2 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-xs font-medium text-gray-500">
            
            <!-- يمين: الموقع وروابط المساعدة -->
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1 text-gray-700 font-bold">
                    🇵🇸 غزة، فلسطين
                </span>
                
                <div class="h-3 w-px bg-gray-300"></div>

                <a href="{{ route('contact') }}" class="hover:text-red-600 transition flex items-center gap-1">
    ... تواصل معنا
</a>
                <a href="{{ route('report') }}" class="hover:text-red-600 transition flex items-center gap-1 text-red-500">
    ... إبلاغ عن مخالفة
</a>
            </div>

            <!-- يسار: التاريخ والسوشيال -->
            <div class="flex items-center gap-3">
                <span class="text-gray-400">{{ date('Y-m-d') }}</span>
                <div class="flex gap-2 opacity-60">
                    <a href="#" class="hover:text-blue-600 transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="hover:text-pink-600 transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. الشريط الرئيسي (اللوجو والقوائم) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <!-- يمين: اللوجو والقائمة -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center ml-10">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2">
                        <!-- أيقونة التاج/السعر -->
                        <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-800 text-white rounded-xl flex items-center justify-center shadow-md group-hover:rotate-12 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-gray-800 leading-none group-hover:text-red-600 transition">أحسن</span>
                            <span class="text-lg font-bold text-red-600 leading-none tracking-wider">سعر</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Links -->
                <div class="hidden space-x-8 space-x-reverse md:-my-px md:flex h-full items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-red-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-red-600 hover:border-red-200' }} text-base font-bold leading-5 transition duration-150 ease-in-out h-full">
                        الرئيسية
                    </a>
                    
                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.create') ? 'border-red-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-red-600 hover:border-red-200' }} text-base font-bold leading-5 transition duration-150 ease-in-out h-full">
                        إضافة سعر
                    </a>

                        <a href="{{ route('shop.register') }}" class="text-sm text-gray-700 underline mr-4">سجل متجرك</a>
                    <!-- رابط إضافي لملء البار -->
                   <a href="{{ route('about') }}" class="...">
    من نحن
</a>
                </div>
            </div>

            <!-- يسار: الأزرار وحساب المستخدم -->
            <div class="hidden md:flex md:items-center md:ms-6 gap-4">
                
                @auth
                    <!-- Dropdown للمستخدمين -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-medium rounded-full text-gray-700 bg-gray-50 hover:text-gray-900 hover:bg-white hover:shadow-sm focus:outline-none transition ease-in-out duration-150">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(Auth::user()->email == 'admin@bestprice.com')
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    لوحة التحكم
                                </x-dropdown-link>
                            @endif

                            @if(Auth::user()->isShopOwner() && Auth::user()->is_approved)
                                <x-dropdown-link :href="route('shop.dashboard')">
                                    إدارة متجري
                                </x-dropdown-link>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    تسجيل خروج
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- أزرار الزوار -->
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-red-600 px-3 py-2 transition">
                        دخول المالك
                    </a>
                    
                    <a href="{{ route('products.create') }}" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-md shadow-red-200 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        <span>إضافة سعر جديد</span>
                    </a>
                @endauth
            </div>

            <!-- Hamburger (زر القائمة للموبايل) -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                الرئيسية
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">
                إضافة سعر
            </x-responsive-nav-link>
            
            <div class="border-t border-gray-100 my-2"></div>
            
            <a href="#" class="block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50 transition">
                📱 تواصل معنا
            </a>
            <a href="#" class="block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition">
                ⚠️ إبلاغ عن مخالفة
            </a>
        </div>

            <!-- إعدادات المستخدم في الموبايل -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                        @if(Auth::user()->isShopOwner() && Auth::user()->is_approved)
                            <x-responsive-nav-link :href="route('shop.dashboard')">إدارة متجري</x-responsive-nav-link>
                        @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            تسجيل خروج
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="p-4">
                    <a href="{{ route('login') }}" class="block w-full text-center text-gray-700 bg-gray-100 py-3 rounded-lg font-bold mb-2">دخول المالك</a>
                        <a href="{{ route('shop.register') }}" class="block w-full text-center text-gray-700 bg-white py-3 rounded-lg font-bold">سجل متجرك</a>
                </div>
            @endauth
        </div>
    </div>
</nav>