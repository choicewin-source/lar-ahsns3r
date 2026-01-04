<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-[100] font-sans shadow-sm" dir="rtl">
    
    <!-- 1. الشريط العلوي (Top Bar) - شريط فخم ومميز -->
    <div class="bg-white border-b border-gray-200 py-3 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm font-medium">
            
            <!-- يمين: روابط التواصل والإبلاغ -->
            <div class="flex items-center gap-5">
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-gray-900 transition-all duration-200 flex items-center gap-2 hover:scale-105 font-semibold">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>تواصل معنا</span>
                </a>
                
                <div class="h-5 w-px bg-gray-300"></div>

                <a href="{{ route('report') }}" class="text-red-600 hover:text-red-700 transition-all duration-200 flex items-center gap-2 hover:scale-105 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>إبلاغ عن مخالفة</span>
                </a>
            </div>

            <!-- يسار: الموقع والتاريخ والسوشيال -->
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-2 text-gray-900 font-bold">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <span>غزة - فلسطين</span>
                    🇵🇸
                </span>
                
                <div class="h-5 w-px bg-gray-300"></div>
                
                <span class="text-gray-700 flex items-center gap-2 font-semibold">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ date('Y-m-d') }}</span>
                </span>
                
                <div class="h-5 w-px bg-gray-300"></div>
                
                <div class="flex gap-3">
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition-all duration-200 transform hover:scale-125" title="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-pink-600 transition-all duration-200 transform hover:scale-125" title="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. الشريط الرئيسي (اللوجو والقوائم) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- يمين: اللوجو والقائمة -->
            <div class="flex items-center">
                <!-- Logo - تحسين التصميم -->
                <div class="shrink-0 flex items-center ml-10">
                    <a href="{{ route('home') }}" class="group flex items-center gap-3">
                        <!-- أيقونة السعر/التاج الفخمة -->
                        <div class="relative w-12 h-12 bg-gradient-to-br from-red-600 via-red-700 to-red-800 text-white rounded-2xl flex items-center justify-center shadow-xl shadow-red-300/50 group-hover:shadow-2xl group-hover:shadow-red-400/60 group-hover:scale-110 transition-all duration-300 overflow-hidden">
                            <!-- خلفية متوهجة -->
                            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- أيقونة السعر -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            
                            <!-- نقطة خضراء متحركة -->
                            <div class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-gradient-to-br from-green-400 to-green-500 rounded-full animate-pulse shadow-lg shadow-green-400/50"></div>
                        </div>
                        
                        <div class="flex items-baseline gap-2">
                            <!-- أيقونة نجمة ذهبية بجانب أحسن -->
                            <svg class="w-6 h-6 flex-shrink-0 group-hover:rotate-180 transition-transform duration-700" viewBox="0 0 24 24" fill="none">
                                <defs>
                                    <linearGradient id="navStarGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#d4af37;stop-opacity:1" />
                                        <stop offset="50%" style="stop-color:#f4d03f;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#d4af37;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" 
                                      fill="url(#navStarGrad)" 
                                      stroke="#c9a74a" 
                                      stroke-width="0.5"
                                      style="filter: drop-shadow(0 2px 6px rgba(212,175,55,0.5));"/>
                            </svg>
                            
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-gray-900 leading-none group-hover:text-red-600 transition-colors duration-200" style="font-family: 'Cairo', sans-serif;">أحسن</span>
                                <span class="text-lg font-black leading-none tracking-wide" style="font-family: 'Cairo', sans-serif; background: linear-gradient(135deg, #B31B1B 0%, #D32F2F 50%, #B31B1B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; filter: drop-shadow(0 2px 4px rgba(179, 27, 27, 0.2));">سعر</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Links - تحسين التصميم -->
                <div class="hidden space-x-8 space-x-reverse md:-my-px md:flex h-full items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 pt-1 border-b-3 {{ request()->routeIs('home') ? 'border-red-600 text-gray-900 font-extrabold' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }} text-base font-bold leading-5 transition-all duration-200 h-full relative group/link">
                        @if(request()->routeIs('home'))
                            <span class="absolute inset-x-0 -bottom-px h-0.5 bg-gradient-to-r from-red-600 via-red-500 to-red-600"></span>
                        @endif
                        <svg class="w-5 h-5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span style="font-family: 'Cairo', sans-serif;">الرئيسية</span>
                    </a>
                    
                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 pt-1 border-b-3 {{ request()->routeIs('products.create') ? 'border-red-600 text-gray-900 font-extrabold' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }} text-base font-bold leading-5 transition-all duration-200 h-full relative group/link">
                        @if(request()->routeIs('products.create'))
                            <span class="absolute inset-x-0 -bottom-px h-0.5 bg-gradient-to-r from-red-600 via-red-500 to-red-600"></span>
                        @endif
                        <svg class="w-5 h-5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span style="font-family: 'Cairo', sans-serif;">إضافة سعر</span>
                    </a>

                    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-4 pt-1 border-b-3 {{ request()->routeIs('shop.index') || request()->routeIs('shop.show') ? 'border-red-600 text-gray-900 font-extrabold' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }} text-base font-bold leading-5 transition-all duration-200 h-full relative group/link">
                        @if(request()->routeIs('shop.index') || request()->routeIs('shop.show'))
                            <span class="absolute inset-x-0 -bottom-px h-0.5 bg-gradient-to-r from-red-600 via-red-500 to-red-600"></span>
                        @endif
                        <svg class="w-5 h-5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span style="font-family: 'Cairo', sans-serif;">المتاجر</span>
                    </a>

                    @guest
                        <a href="{{ route('shop.register') }}" class="inline-flex items-center px-4 pt-1 border-b-3 border-transparent text-gray-700 hover:text-red-600 hover:border-red-400 text-base font-bold leading-5 transition-all duration-200 h-full relative group/link">
                            <svg class="w-5 h-5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span style="font-family: 'Cairo', sans-serif;">سجل متجرك</span>
                        </a>
                    @endguest
                    
                    <a href="{{ route('about') }}" class="inline-flex items-center px-4 pt-1 border-b-3 {{ request()->routeIs('about') ? 'border-red-600 text-gray-900 font-extrabold' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }} text-base font-bold leading-5 transition-all duration-200 h-full relative group/link">
                        @if(request()->routeIs('about'))
                            <span class="absolute inset-x-0 -bottom-px h-0.5 bg-gradient-to-r from-red-600 via-red-500 to-red-600"></span>
                        @endif
                        <svg class="w-5 h-5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span style="font-family: 'Cairo', sans-serif;">من نحن</span>
                    </a>
                </div>
            </div>

            <!-- يسار: الأزرار وحساب المستخدم -->
            <div class="hidden md:flex md:items-center md:ms-6 gap-4">
                
                @auth
                    <!-- Dropdown للمستخدمين -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-5 py-2.5 border border-gray-300 text-sm font-bold rounded-full text-gray-700 bg-white hover:bg-gray-50 hover:shadow-md focus:outline-none transition-all duration-200">
                                <div class="w-2.5 h-2.5 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                <div>{{ Auth::user()->name ?? 'الملف الشخصي' }}</div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- معلومات الحساب -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                @if(Auth::user()->isShopOwner())
                                    <div class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <span class="font-bold">صاحب متجر</span>
                                    </div>
                                @endif
                            </div>

                            <!-- الخيارات -->
                            @if(Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        <span>لوحة التحكم</span>
                                    </div>
                                </x-dropdown-link>
                            @endif

                            @if(Auth::user()->isShopOwner())
                                <x-dropdown-link :href="route('shop.dashboard')">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        <span>لوحة تحكم المتجر</span>
                                    </div>
                                </x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.show')">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>الملف الشخصي</span>
                                </div>
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>الإعدادات</span>
                                </div>
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <div class="flex items-center gap-2 text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span class="font-bold">تسجيل خروج</span>
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- زر إضافة سعر جديد فقط - تم حذف زر دخول المالك -->
                    <a href="{{ route('products.create') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-lg shadow-red-200 hover:shadow-xl hover:shadow-red-300 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
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
            <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index') || request()->routeIs('shop.show')">
                المتاجر
            </x-responsive-nav-link>
            
            <div class="border-t border-gray-100 my-2"></div>
            
            <a href="{{ route('contact') }}" class="block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                تواصل معنا
            </a>
            <a href="{{ route('report') }}" class="block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                إبلاغ عن مخالفة
            </a>
        </div>

        <!-- إعدادات المستخدم في الموبايل -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4 pb-3 border-b border-gray-100">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    @if(Auth::user()->isShopOwner())
                        <div class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="font-bold">صاحب متجر</span>
                        </div>
                    @endif
                </div>
                <div class="mt-3 space-y-1">
                    @if(Auth::user()->isAdmin())
                        <x-responsive-nav-link :href="route('admin.dashboard')">
                            لوحة التحكم
                        </x-responsive-nav-link>
                    @endif

                    @if(Auth::user()->isShopOwner())
                        <x-responsive-nav-link :href="route('shop.dashboard')">
                            لوحة تحكم المتجر
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('profile.show')">
                        الملف الشخصي
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')">
                        الإعدادات
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            تسجيل خروج
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>