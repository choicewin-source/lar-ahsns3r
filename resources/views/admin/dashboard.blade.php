<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-gray-900 flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span>لوحة التحكم - مدير النظام</span>
                        </h1>
                        <p class="mt-2 text-gray-600 font-medium">مرحباً <span class="text-red-600 font-bold">{{ Auth::user()->name }}</span>، إدارة كاملة لمنصة أحسن سعر</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg font-bold text-sm transition-colors flex items-center gap-2 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            الصفحة الرئيسية
                        </a>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-bold text-sm flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            مدير النظام
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Panel -->
            <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl shadow-sm border border-purple-100 p-6 mb-8">
                <h2 class="text-lg font-black text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    إجراءات سريعة
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.announcements.index') }}" class="group bg-white hover:bg-blue-600 border-2 border-blue-200 hover:border-blue-600 rounded-xl p-4 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 group-hover:bg-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 group-hover:text-white transition-colors">إدارة الإعلانات</p>
                                <p class="text-xs text-gray-600 group-hover:text-blue-100 transition-colors">الشريط المتحرك</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.reports.index') }}" class="group bg-white hover:bg-green-600 border-2 border-green-200 hover:border-green-600 rounded-xl p-4 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 group-hover:bg-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 group-hover:text-white transition-colors">البلاغات</p>
                                <p class="text-xs text-gray-600 group-hover:text-green-100 transition-colors">إدارة البلاغات</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('home') }}" class="group bg-white hover:bg-red-600 border-2 border-red-200 hover:border-red-600 rounded-xl p-4 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 group-hover:bg-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 group-hover:text-white transition-colors">معاينة الموقع</p>
                                <p class="text-xs text-gray-600 group-hover:text-red-100 transition-colors">واجهة المستخدم</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('products.index') }}" class="group bg-white hover:bg-purple-600 border-2 border-purple-200 hover:border-purple-600 rounded-xl p-4 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 group-hover:bg-white rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 group-hover:text-white transition-colors">جميع المنتجات</p>
                                <p class="text-xs text-gray-600 group-hover:text-purple-100 transition-colors">قائمة المنتجات</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Products -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">إجمالي المنتجات</p>
                            <p class="text-3xl font-black text-gray-900">{{ $stats['total_products'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Today's Products -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">منتجات اليوم</p>
                            <p class="text-3xl font-black text-green-600">{{ $stats['today_products'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Shops Count -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">عدد المتاجر</p>
                            <p class="text-3xl font-black text-purple-600">{{ $stats['shops_count'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Products -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">منتجات معلقة</p>
                            <p class="text-3xl font-black text-orange-600">{{ $stats['pending_products'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Shops -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">متاجر معلقة</p>
                            <p class="text-3xl font-black text-red-600">{{ $stats['pending_shops'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Pending Shop Owners Section -->
            @if($pendingUsers->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            طلبات تسجيل المتاجر المعلقة
                        </h2>
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-bold">
                            {{ $pendingUsers->count() }} طلب
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach($pendingUsers as $user)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-red-300 transition-colors">
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 text-lg mb-1">{{ $user->shop_name }}</p>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ $user->name }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $user->email }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $user->shop_city }}
                                        </span>
                                        @if($user->shop_phone)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $user->shop_phone }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.user.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-colors flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            موافقة
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.user.reject', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من رفض هذا الطلب؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-colors flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            رفض
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination for Pending Users -->
                    <div class="mt-6">
                        {{ $pendingUsers->links() }}
                    </div>
                </div>
            @endif

            <!-- Products Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        جميع المنتجات
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">اسم المنتج</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">السعر</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">المتجر</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">المستخدم</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">الحالة</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">التاريخ</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        #{{ $product->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        <div class="flex items-center gap-3">
                                            @if($product->image_path)
                                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover">
                                            @else
                                                <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <span>{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-lg font-black text-red-600">₪{{ number_format($product->price, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $product->shop_name ?? 'غير محدد' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $product->user->name ?? 'مستخدم محذوف' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->is_approved)
                                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-100 text-green-800">
                                                مفعل
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-orange-100 text-orange-800">
                                                معلق
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $product->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <!-- Toggle Approval -->
                                            <form action="{{ route('admin.product.toggleApprove', $product->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2 {{ $product->is_approved ? 'bg-orange-100 hover:bg-orange-200 text-orange-700' : 'bg-green-100 hover:bg-green-200 text-green-700' }} rounded-lg transition-colors" title="{{ $product->is_approved ? 'إيقاف' : 'تفعيل' }}">
                                                    @if($product->is_approved)
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>

                                            <!-- Edit Button -->
                                            <button 
                                                @click="$dispatch('open-edit-modal', { id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price }}, shop_name: '{{ $product->shop_name }}' })"
                                                class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors"
                                                title="تعديل">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors" title="حذف">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Product Modal -->
    <div 
        x-data="{ 
            open: false, 
            productId: null, 
            productName: '', 
            productPrice: '', 
            shopName: '' 
        }"
        @open-edit-modal.window="
            open = true; 
            productId = $event.detail.id; 
            productName = $event.detail.name; 
            productPrice = $event.detail.price; 
            shopName = $event.detail.shop_name;
        "
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;">
        
        <!-- Backdrop -->
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
            @click="open = false">
        </div>

        <!-- Modal -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <div 
                class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6"
                @click.stop>
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-gray-900">تعديل المنتج</h3>
                    <button 
                        @click="open = false"
                        class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form :action="'/admin/products/' + productId" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">اسم المنتج</label>
                            <input 
                                type="text" 
                                name="name" 
                                x-model="productName"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 font-medium"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">السعر</label>
                            <input 
                                type="number" 
                                name="price" 
                                x-model="productPrice"
                                step="0.01"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 font-medium"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">اسم المتجر</label>
                            <input 
                                type="text" 
                                name="shop_name" 
                                x-model="shopName"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 font-medium">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <button 
                            type="submit"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition-colors">
                            حفظ التعديلات
                        </button>
                        <button 
                            type="button"
                            @click="open = false"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 rounded-lg transition-colors">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>