<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مقارنة الأسعار - {{ $subCategory }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- العودة للأقسام -->
            <div class="mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    العودة للأقسام
                </a>
            </div>

            <!-- العنوان -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-black text-gray-800 mb-2">
                    🏆 أفضل أسعار {{ $subCategory }}
                </h1>
                <p class="text-gray-600">
                    أرخص سعر لكل موديل من {{ $category }}
                </p>
            </div>

            @if(empty($bestPrices))
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 grayscale opacity-50">📦</div>
                    <h3 class="text-lg font-bold text-gray-600 mb-2">لا توجد منتجات</h3>
                    <p class="text-gray-400">لم يتم العثور على أي منتجات في هذا القسم</p>
                </div>
            @else
                <!-- جدول المقارنة -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-4">
                        <h3 class="text-lg font-bold flex items-center gap-2">
                            <span>🏷️</span>
                            أفضل الأسعار المتاحة
                        </h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الموديل</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">أفضل سعر</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المحل</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المدينة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المصدر</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">كود العرض</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bestPrices as $index => $product)
                                    <tr class="hover:bg-gray-50 transition {{ $index === 0 ? 'bg-green-50' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                @if($index === 0)
                                                    <span class="bg-yellow-400 text-white text-xs px-2 py-1 rounded-full font-bold">🥇 الأفضل</span>
                                                @endif
                                                <span class="font-medium text-gray-900">{{ $product['model'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-xl font-black text-red-600">
                                                {{ number_format($product['best_price'], 2) }} ₪
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $product['shop_name'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $product['city'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($product['added_by'] == 'shop_owner')
                                                <span class="bg-gray-900 text-white text-xs px-2 py-1 rounded">محل تجاري</span>
                                            @else
                                                <span class="bg-green-600 text-white text-xs px-2 py-1 rounded">تجربة مواطن</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded text-xs">
                                                {{ $product['reference_code'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product['created_at']->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ملخص إحصائي -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200">
                        <div class="text-3xl font-bold text-green-700 mb-2">
                            {{ number_format($bestPrices[0]['best_price'], 2) }} ₪
                        </div>
                        <div class="text-sm text-green-600 font-medium">أرخص سعر</div>
                        <div class="text-xs text-green-500 mt-1">{{ $bestPrices[0]['model'] }}</div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                        <div class="text-3xl font-bold text-blue-700 mb-2">{{ count($bestPrices) }}</div>
                        <div class="text-sm text-blue-600 font-medium">إجمالي الموديلات</div>
                        <div class="text-xs text-blue-500 mt-1">{{ $subCategory }}</div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200">
                        <div class="text-3xl font-bold text-purple-700 mb-2">
                            {{ number_format(array_sum(array_column($bestPrices, 'best_price')) / count($bestPrices), 2) }} ₪
                        </div>
                        <div class="text-sm text-purple-600 font-medium">متوسط السعر</div>
                        <div class="text-xs text-purple-500 mt-1">للموديل</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
