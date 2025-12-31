<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $shop->shop_name ?? $shop->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">محل</div>
                        <div class="text-xl font-bold">{{ $shop->shop_name ?? $shop->name }}</div>
                        <div class="text-sm text-gray-400">{{ $shop->shop_city ?? '' }}</div>
                        <div class="text-sm text-gray-400">{{ $shop->shop_phone ?? '' }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                @forelse($products as $product)
                    <a href="{{ route('products.show', $product->id) }}" class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition">
                        <div class="h-40 flex items-center justify-center text-6xl">📦</div>
                        <div class="mt-3 font-bold">{{ $product->name }}</div>
                        <div class="text-sm text-gray-500">{{ $product->category }} - {{ $product->sub_category }}</div>
                        <div class="mt-2 text-red-600 font-black">{{ floatval($product->price) }} ₪</div>
                        <div class="text-xs text-gray-400 mt-1">{{ $product->created_at->format('Y-m-d') }}</div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">لا توجد منتجات حالياً لدى هذا المتجر.</div>
                @endforelse
            </div>

            <div class="mt-6">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>
