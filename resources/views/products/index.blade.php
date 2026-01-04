<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">جرد المنتجات</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- البحث والفلترة -->
            <div class="bg-white p-6 rounded-xl shadow-md mb-6">
                <form method="GET" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">البحث عن منتج</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="ابحث عن منتج..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div class="min-w-[150px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">القسم</label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <option value="">جميع الأقسام</option>
                            @foreach(App\Models\Category::orderBy('name')->get() as $category)
                                <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="min-w-[150px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                        <select name="city" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <option value="">جميع المدن</option>
                            <option value="شمال غزة" {{ request('city') == 'شمال غزة' ? 'selected' : '' }}>شمال غزة</option>
                            <option value="مدينة غزة" {{ request('city') == 'مدينة غزة' ? 'selected' : '' }}>مدينة غزة</option>
                            <option value="المنطقة الوسطى" {{ request('city') == 'المنطقة الوسطى' ? 'selected' : '' }}>المنطقة الوسطى</option>
                            <option value="خانيونس" {{ request('city') == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                            <option value="رفح" {{ request('city') == 'رفح' ? 'selected' : '' }}>رفح</option>
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition">
                            بحث
                        </button>
                    </div>
                </form>
            </div>

            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-md border-r-4 border-blue-500">
                    <div class="text-2xl font-bold text-blue-600">{{ $products->total() }}</div>
                    <div class="text-sm text-gray-600">إجمالي المنتجات</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md border-r-4 border-green-500">
                    <div class="text-2xl font-bold text-green-600">{{ $products->where('added_by', 'customer')->count() }}</div>
                    <div class="text-sm text-gray-600">تجارب المواطنين</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md border-r-4 border-purple-500">
                    <div class="text-2xl font-bold text-purple-600">{{ $products->where('added_by', 'shop_owner')->count() }}</div>
                    <div class="text-sm text-gray-600">منتجات المتاجر</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md border-r-4 border-orange-500">
                    <div class="text-2xl font-bold text-orange-600">{{ App\Models\Product::distinct('shop_name')->count() }}</div>
                    <div class="text-sm text-gray-600">عدد المتاجر</div>
                </div>
            </div>

            <!-- جدول المنتجات -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-red-600 text-white px-6 py-4">
                    <h3 class="text-lg font-bold">جميع المنتجات (مرتبة من الأحدث للأقدم)</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">كود العرض</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اسم المنتج</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">القسم</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الشركة</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">السعر</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المدينة</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المحل</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المصدر</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                            {{ $product->reference_code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->category }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->brand ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="font-bold text-red-600">{{ $product->formatted_price }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->city }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->shop_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($product->added_by == 'shop_owner' && $product->user && $product->user->is_approved)
                                            {{-- متجر معتمد --}}
                                            <a href="{{ route('shop.show', ['id' => $product->user_id]) }}" 
                                               class="inline-flex items-center gap-1 bg-purple-600 hover:bg-purple-700 text-white text-xs px-2 py-1 rounded transition">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                </svg>
                                                متجر معتمد
                                            </a>
                                        @else
                                            {{-- زبون --}}
                                            <span class="bg-green-600 text-white text-xs px-2 py-1 rounded">زبون</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->created_at->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                        <div class="text-center">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">📦</div>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد منتجات</h3>
                                            <p class="text-gray-500">لم يتم العثور على أي منتجات تطابق معايير البحث.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- ترقيم الصفحات -->
                <div class="bg-gray-50 px-6 py-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>