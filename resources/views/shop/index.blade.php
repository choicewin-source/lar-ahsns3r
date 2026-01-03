<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-black text-gray-900 mb-4">دليل المتاجر المعتمدة</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    تصفح أفضل المتاجر في غزة، قارن الأسعار، وتواصل مباشرة مع أصحاب المحلات.
                </p>
            </div>

            <!-- Search (Optional - can be added later) -->
            
            <!-- Shops Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($shops as $shop)
                    <a href="{{ route('shop.show', $shop->id) }}" class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-red-100 block">
                        <!-- Cover / Header -->
                        <div class="h-24 bg-gradient-to-r from-gray-800 to-gray-900 relative">
                            <div class="absolute -bottom-8 right-4">
                                <div class="w-16 h-16 bg-white rounded-xl shadow-md flex items-center justify-center text-3xl border-2 border-white">
                                    🏪
                                </div>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="pt-10 pb-6 px-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-red-600 transition-colors">
                                {{ $shop->shop_name }}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $shop->shop_city ?? 'غزة' }}
                            </div>

                            <div class="border-t border-gray-50 pt-4 flex justify-between items-center">
                                <span class="text-xs font-bold bg-green-50 text-green-700 px-2 py-1 rounded-full">
                                    ✅ متجر معتمد
                                </span>
                                <span class="text-xs text-gray-400">
                                    {{ $shop->products_count }} منتج
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="text-6xl mb-4">🏪</div>
                        <h3 class="text-xl font-bold text-gray-600">لا توجد متاجر مسجلة حالياً</h3>
                        <p class="text-gray-400 mt-2">كن أول من يسجل متجره معنا!</p>
                        <a href="{{ route('shop.register') }}" class="inline-block mt-6 bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">
                            سجل متجرك الآن
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $shops->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
