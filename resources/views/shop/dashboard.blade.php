<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-gray-900 flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <span>لوحة تحكم المتجر</span>
                        </h1>
                        <p class="mt-2 text-gray-600 font-medium">مرحباً <span class="text-purple-600 font-bold">{{ Auth::user()->name }}</span>، إدارة متجر <span class="text-purple-600 font-bold">{{ Auth::user()->shop_name }}</span></p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-bold text-sm flex items-center gap-2 shadow-sm">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            متجر مفعل ونشط
                        </span>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
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

                <!-- Approved Products -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">منتجات مفعلة</p>
                            <p class="text-3xl font-black text-green-600">{{ $stats['approved_products'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Products -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">قيد المراجعة</p>
                            <p class="text-3xl font-black text-orange-600">{{ $stats['pending_products'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Today's Products -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">إضافات اليوم</p>
                            <p class="text-3xl font-black text-purple-600">{{ $stats['today_products'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Shop Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-8">
                        <h2 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            ملف المتجر
                        </h2>

                        <!-- Shop Logo -->
                        <div class="mb-6 text-center">
                            <div class="inline-block relative">
                                @if(Auth::user()->shop_logo)
                                    <img src="{{ Storage::url(Auth::user()->shop_logo) }}" alt="{{ Auth::user()->shop_name }}" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-lg">
                                @else
                                    <div class="w-32 h-32 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center border-4 border-gray-200 shadow-lg">
                                        <svg class="w-16 h-16 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                @endif
                                <button 
                                    @click="$dispatch('open-logo-modal')"
                                    class="absolute bottom-0 right-0 w-10 h-10 bg-purple-600 hover:bg-purple-700 rounded-full flex items-center justify-center shadow-lg transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="mt-4 text-xl font-black text-gray-900">{{ Auth::user()->shop_name }}</h3>
                            <p class="text-gray-600 font-medium">{{ Auth::user()->shop_city }}</p>
                        </div>

                        <!-- Shop Info -->
                        <div class="space-y-3 mb-6">
                            <div class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <p class="text-gray-500 text-xs">المالك</p>
                                    <p class="font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-gray-500 text-xs">البريد الإلكتروني</p>
                                    <p class="font-bold text-gray-900 break-all">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            @if(Auth::user()->shop_phone)
                                <div class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <div>
                                        <p class="text-gray-500 text-xs">رقم الهاتف</p>
                                        <p class="font-bold text-gray-900">{{ Auth::user()->shop_phone }}</p>
                                    </div>
                                </div>
                            @endif
                            @if(Auth::user()->shop_address)
                                <div class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-gray-500 text-xs">العنوان</p>
                                        <p class="font-bold text-gray-900">{{ Auth::user()->shop_address }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Edit Profile Button -->
                        <button 
                            @click="$dispatch('open-edit-modal')"
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            تعديل البيانات
                        </button>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="lg:col-span-2">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                        <h2 class="text-lg font-black text-gray-900 mb-4">إجراءات سريعة</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('products.create') }}" class="flex items-center gap-3 p-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-xl text-white transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-black">إضافة منتج جديد</p>
                                    <p class="text-xs text-red-100">أضف سعر منتج الآن</p>
                                </div>
                            </a>
                            <a href="{{ route('home') }}" class="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl text-white transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-black">تصفح المنتجات</p>
                                    <p class="text-xs text-blue-100">شاهد جميع الأسعار</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                منتجاتي
                            </h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase">المنتج</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase">السعر</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase">الحالة</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase">المدينة</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase">التاريخ</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase">إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($products as $product)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    @if($product->image_path)
                                                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                                    @else
                                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div class="min-w-0">
                                                        <p class="font-bold text-gray-900 truncate">{{ $product->name }}</p>
                                                        <div class="flex items-center gap-2 mt-0.5">
                                                            <span class="text-xs text-gray-500">{{ $product->category ?? 'غير مصنف' }}</span>
                                                            @if($product->sub_category)
                                                                <span class="text-xs text-gray-400">• {{ $product->sub_category }}</span>
                                                            @endif
                                                        </div>
                                                        <span class="text-[10px] text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded mt-1 inline-block">
                                                            {{ $product->reference_code }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="text-lg font-black text-red-600">₪{{ number_format($product->price, 2) }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($product->is_approved)
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-100 text-green-800">
                                                        ✓ مفعل
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-orange-100 text-orange-800">
                                                        ⏳ مراجعة
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="text-sm text-gray-600 flex items-center gap-1">
                                                    📍 {{ $product->city }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                {{ $product->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('products.show', $product->id) }}" 
                                                   class="inline-flex items-center gap-1 text-purple-600 hover:text-purple-700 font-bold text-xs transition-colors"
                                                   target="_blank">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    عرض
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                    <p class="text-gray-500 font-medium mb-4">لم تضف أي منتجات بعد</p>
                                                    <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                        إضافة أول منتج
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($products->hasPages())
                            <div class="px-6 py-4 border-t border-gray-200">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div 
        x-data="{ open: false }"
        @open-edit-modal.window="open = true"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;">
        
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="open = false"></div>

        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6" @click.stop>
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-black text-gray-900">تعديل معلومات المتجر</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('shop.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">الاسم الشخصي</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-medium" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">اسم المتجر</label>
                            <input type="text" name="shop_name" value="{{ Auth::user()->shop_name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-medium" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">المدينة</label>
                            <select name="shop_city" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-medium" required>
                                <option value="شمال غزة" {{ Auth::user()->shop_city == 'شمال غزة' ? 'selected' : '' }}>شمال غزة</option>
                                <option value="مدينة غزة" {{ Auth::user()->shop_city == 'مدينة غزة' ? 'selected' : '' }}>مدينة غزة</option>
                                <option value="المنطقة الوسطى" {{ Auth::user()->shop_city == 'المنطقة الوسطى' ? 'selected' : '' }}>المنطقة الوسطى</option>
                                <option value="خانيونس" {{ Auth::user()->shop_city == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                                <option value="رفح" {{ Auth::user()->shop_city == 'رفح' ? 'selected' : '' }}>رفح</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">رقم الهاتف</label>
                            <input type="tel" name="shop_phone" value="{{ Auth::user()->shop_phone }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-medium">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">العنوان</label>
                            <input type="text" name="shop_address" value="{{ Auth::user()->shop_address }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-medium" placeholder="مثال: شارع الجلاء - بجانب مسجد السلام">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">وصف المتجر (اختياري)</label>
                            <textarea name="shop_description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-medium" placeholder="نبذة قصيرة عن متجرك والمنتجات التي تبيعها">{{ Auth::user()->shop_description }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg transition-colors">
                            حفظ التعديلات
                        </button>
                        <button type="button" @click="open = false" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 rounded-lg transition-colors">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Upload Logo Modal -->
    <div 
        x-data="{ open: false }"
        @open-logo-modal.window="open = true"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;">
        
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="open = false"></div>

        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6" @click.stop>
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-gray-900">تحديث شعار المتجر</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('shop.logo.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">اختر صورة الشعار</label>
                        <input type="file" name="shop_logo" accept="image/*" class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg focus:border-purple-500 font-medium" required>
                        <p class="mt-2 text-xs text-gray-500">الحد الأقصى: 2 ميجابايت | الصيغ المدعومة: JPG, PNG, WEBP</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg transition-colors">
                            رفع الشعار
                        </button>
                        @if(Auth::user()->shop_logo)
                            <button type="button" @click="if(confirm('هل أنت متأكد؟')) { $refs.deleteForm.submit() }" class="px-4 py-3 bg-red-100 hover:bg-red-200 text-red-700 font-bold rounded-lg transition-colors">
                                حذف
                            </button>
                        @endif
                    </div>
                </form>

                @if(Auth::user()->shop_logo)
                    <form x-ref="deleteForm" action="{{ route('shop.logo.delete') }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>