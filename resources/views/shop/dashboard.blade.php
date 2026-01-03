<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لوحة تحكم المالك - أحسن سعر') }}
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- قسم الإحصائيات -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- كارد 1: عدد المنتجات -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-r-4 border-blue-500">
                    <div class="text-gray-500">عدد الأسعار الكلي</div>
                    <div class="text-3xl font-bold">{{ $stats['total_products'] ?? 0 }}</div>
                </div>
                <!-- كارد 2: المحلات -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-r-4 border-green-500">
                    <div class="text-gray-500">عدد المحلات المشاركة</div>
                    <div class="text-3xl font-bold">{{ $stats['shops_count'] ?? 0 }}</div>
                </div>
                <!-- كارد 3: إضافات اليوم -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-r-4 border-red-500">
                    <div class="text-gray-500">إضافات اليوم</div>
                    <div class="text-3xl font-bold">{{ $stats['today_products'] ?? 0 }}</div>
                </div>
            </div>

            <!-- قسم طلبات تسجيل المتاجر المعلقة -->
            @if(!empty($pendingUsers) && count($pendingUsers) > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">طلبات تسجيل المتاجر المعلقة</h3>
                        <div class="space-y-3">
                            @foreach($pendingUsers as $user)
                                <div class="p-4 border rounded flex justify-between items-center">
                                    <div class="text-right">
                                        <div class="font-bold">{{ $user->shop_name ?? $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }} • {{ $user->shop_city }}</div>
                                    </div>
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.user.approve', $user->id) }}">
                                            @csrf
                                            <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">موافقة</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.user.reject', $user->id) }}" onsubmit="return confirm('هل تريد رفض وحذف هذا الطلب؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">رفض</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- قسم جدول المنتجات -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">إدارة الأسعار والمنتجات</h3>
                    <div class="mb-4 flex gap-3">
                        <a href="{{ route('admin.categories.index') }}" class="bg-indigo-600 text-white px-3 py-2 rounded">إدارة الفئات</a>
                        <a href="{{ route('admin.ads.index') }}" class="bg-yellow-600 text-white px-3 py-2 rounded">إدارة الإعلانات</a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-right">المنتج</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">السعر</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">المحل / المدينة</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">المُضيف</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">
                                            <div class="font-bold">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $product->category }}</div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 font-bold text-green-600">
                                            {{ $product->formatted_price }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <div>{{ $product->shop_name }}</div>
                                            <div class="text-xs text-gray-400">{{ $product->city }}</div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            @if($product->added_by == 'shop_owner')
                                                <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">صاحب محل</span>
                                            @else
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">زبون</span>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <form action="{{ route('admin.product.toggleApprove', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-2 py-1 text-sm rounded {{ $product->is_approved ? 'bg-yellow-500 text-white' : 'bg-green-600 text-white' }}">
                                                        {{ $product->is_approved ? 'مفعّل' : 'تفعيل' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا السعر؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border border-gray-300 px-4 py-4 text-center text-gray-500">
                                            لا يوجد أسعار مضافة حتى الآن.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- التصفح بين الصفحات -->
                    <div class="mt-4">
                        {{ $products->links() }} 
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>