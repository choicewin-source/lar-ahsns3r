@extends('layouts.app')

@section('content')
<div class="py-12" dir="rtl">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">إدارة متجري</h2>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            @if($products->count())
                <div class="space-y-4">
                    @foreach($products as $p)
                        <div class="flex items-center justify-between border rounded p-3">
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                                    @if($p->image_path)
                                        <img src="{{ asset('storage/' . $p->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs text-gray-400">لا صورة</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-bold">{{ $p->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $p->shop_name }} — {{ $p->city }}</div>
                                    <div class="text-sm text-green-700 font-bold">₪ {{ number_format($p->price,2) }}</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('products.edit', $p->edit_token) }}" class="px-3 py-2 bg-yellow-100 text-yellow-800 rounded">تعديل</a>

                                <form method="POST" action="{{ route('shop.product.destroy', $p->id) }}" onsubmit="return confirm('هل أنت متأكد؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-2 bg-red-100 text-red-700 rounded">حذف</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">{{ $products->links() }}</div>
            @else
                <div class="text-center text-gray-500 py-12">لم تضف أي منتجات بعد. <a href="{{ route('products.create') }}" class="text-red-600 font-bold">أضف الآن</a></div>
            @endif
        </div>
    </div>
</div>
@endsection
