<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">إدارة الإعلانات</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">إضافة إعلان جديد</h3>
                <form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">عنوان الإعلان</label>
                            <input name="title" placeholder="مثال: عرض خاص" 
                                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">الموقع</label>
                            <select name="position" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="top">أعلى الصفحة</option>
                                <option value="middle">وسط الصفحة</option>
                                <option value="bottom">أسفل الصفحة</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">الصورة (اختياري)</label>
                        <input type="file" name="image" accept="image/*" 
                               class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        <p class="text-xs text-gray-500 mt-1">يُفضل صورة بحجم 1200x300 للأفضل عرض</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">النص (اختياري)</label>
                        <textarea name="text_content" placeholder="نص الإعلان..." rows="3"
                                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">الرابط (اختياري)</label>
                        <input name="link" type="url" placeholder="https://..." 
                               class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="ms-2 text-sm text-gray-700">الإعلان مفعل</span>
                        </label>
                        
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition duration-200">
                            حفظ الإعلان
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">الإعلانات الحالية ({{ $ads->count() }})</h3>
                
                @if($ads->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <p class="mt-2">لا توجد إعلانات مضافة حالياً</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($ads as $ad)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-150">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $ad->title ?: 'بدون عنوان' }}</div>
                                        <div class="text-sm text-gray-600 mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if($ad->position === 'top') bg-blue-100 text-blue-800
                                                @elseif($ad->position === 'middle') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                @if($ad->position === 'top') أعلى الصفحة
                                                @elseif($ad->position === 'middle') وسط الصفحة
                                                @else أسفل الصفحة @endif
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ml-2
                                                @if($ad->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                                {{ $ad->is_active ? 'مفعل' : 'معطل' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.ads.edit', $ad->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 px-3 py-1.5 rounded-lg hover:bg-blue-50 transition">
                                            تعديل
                                        </a>
                                        <form method="POST" action="{{ route('admin.ads.destroy', $ad->id) }}" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الإعلان؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 transition">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                @if($ad->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $ad->image_path) }}" alt="{{ $ad->title }}" 
                                             class="max-w-full h-auto rounded-lg border border-gray-200 max-h-48">
                                    </div>
                                @endif
                                
                                @if($ad->text_content)
                                    <p class="text-gray-700 mb-2">{{ $ad->text_content }}</p>
                                @endif
                                
                                @if($ad->link)
                                    <div class="text-sm">
                                        <a href="{{ $ad->link }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $ad->link }}
                                        </a>
                                    </div>
                                @endif
                                
                                <div class="text-xs text-gray-500 mt-2">
                                    أضيف في: {{ $ad->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>