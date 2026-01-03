<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">معرض {{ $shop->shop_name ?? $shop->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- معلومات المتجر -->
            <div class="bg-gradient-to-r from-red-50 to-blue-50 p-6 rounded-2xl shadow-lg border border-red-100">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-center md:text-right">
                        <div class="flex items-center gap-3 justify-center md:justify-start mb-2">
                            <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                {{ mb_substr($shop->shop_name ?? $shop->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 font-bold">🏪 معرض تجاري معتمد</div>
                                <div class="text-2xl font-black text-gray-800">{{ $shop->shop_name ?? $shop->name }}</div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-1 justify-center md:justify-start">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $shop->shop_city ?? '' }}
                            </div>
                            @if($shop->shop_phone)
                            <div class="flex items-center gap-1 justify-center md:justify-start">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $shop->shop_phone }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-black text-red-600">{{ $products->total() }}</div>
                        <div class="text-sm text-gray-500">منتج</div>
                    </div>
                </div>
            </div>

            <!-- المنتجات -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
                    <h3 class="text-xl font-black text-gray-800 flex items-center gap-3">
                        <span class="w-3 h-8 bg-red-600 rounded-full"></span>
                        جميع المنتجات (مرتبة حسب السعر)
                    </h3>
                    <div class="text-sm text-gray-500">
                        أقل سعر → أعلى سعر
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <a href="{{ route('products.show', $product->id) }}" class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-red-100 transition-all duration-300 flex flex-col h-full group">
                            
                            <!-- الصورة -->
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
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    {{ $product->sub_category ?? $product->category }}
                                </div>
                            </div>

                            <!-- السعر وكود العرض -->
                            <div class="mt-4 flex justify-between items-end border-t border-gray-50 pt-3">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold">السعر</p>
                                    <span class="text-2xl font-black text-red-600 leading-none">
                                        {{ $product->formatted_price }}
                                    </span>
                                </div>
                                
                                <!-- كود العرض التسلسلي -->
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400 font-bold">كود العرض</p>
                                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                        {{ $product->reference_code }}
                                    </span>
                                </div>
                            </div>

                            <!-- التاريخ -->
                            <div class="mt-2 text-center">
                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">
                                    {{ $product->created_at->format('Y-m-d') }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 grayscale opacity-50">📦</div>
                            <h3 class="text-lg font-bold text-gray-600">لا توجد منتجات حالياً</h3>
                            <p class="text-gray-400 text-sm mt-1">هذا المتجر لم يضف أي منتجات بعد</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>