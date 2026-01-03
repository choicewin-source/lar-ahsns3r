<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">إدارة الفئات</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">إضافة فئة جديدة</h3>
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">اسم الفئة</label>
                            <input name="name" value="{{ old('name') }}" placeholder="مثال: جوالات وإلكترونيات" 
                                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" />
                            @error('name') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug (رابط)</label>
                            <input name="slug" value="{{ old('slug') }}" placeholder="جوالات-والكترونيات" 
                                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-500 @enderror" />
                            @error('slug') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">الأيقونة</label>
                            <input name="icon" value="{{ old('icon') }}" placeholder="📱" 
                                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('icon') border-red-500 @enderror" />
                            @error('icon') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">الأقسام الفرعية (كل قسم في سطر جديد)</label>
                        <textarea name="subs" rows="3" 
                                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('subs') border-red-500 @enderror">{{ old('subs') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">مثال: جوال, لابتوب, تابلت, سماعات</p>
                        @error('subs') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="text-left">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition duration-200">
                            إضافة فئة جديدة
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">الفئات الحالية ({{ $categories->count() }})</h3>
                
                @if($categories->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="mt-2">لا توجد فئات مضافة حالياً</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($categories as $cat)
                            <div class="flex justify-between items-center border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-150">
                                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <span class="text-2xl">{{ $cat->icon ?? '📦' }}</span>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $cat->name }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ implode(' • ', array_slice($cat->subs ?? [], 0, 3)) }}
                                            @if(count($cat->subs ?? []) > 3) ... @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $cat->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 px-3 py-1.5 rounded-lg hover:bg-blue-50 transition">
                                        تعديل
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" 
                                          onsubmit="return confirm('هل أنت متأكد من حذف الفئة {{ $cat->name }}؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 transition">
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>