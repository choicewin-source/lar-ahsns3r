<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">إدارة الإعلانات</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded shadow mb-6">
                <form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <input name="title" placeholder="عنوان الإعلان" class="col-span-1 border p-2 rounded" />
                        <select name="position" class="col-span-1 border p-2 rounded">
                            <option value="top">أعلى</option>
                            <option value="middle">وسط</option>
                            <option value="bottom">أسفل</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <input type="file" name="image" accept="image/*" />
                    </div>
                    <div class="mt-3">
                        <textarea name="text_content" placeholder="نص الإعلان" class="w-full border p-2 rounded" rows="3"></textarea>
                    </div>
                    <div class="mt-3 text-left">
                        <label><input type="checkbox" name="is_active" checked /> مفعل</label>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded ml-2">حفظ الإعلان</button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-3">الإعلانات الحالية</h3>
                <div class="space-y-2">
                    @foreach($ads as $ad)
                        <div class="flex justify-between items-center border p-3 rounded">
                            <div class="text-right">
                                <div class="font-bold">{{ $ad->title }}</div>
                                <div class="text-xs text-gray-500">{{ $ad->position }} • {{ $ad->is_active ? 'مفعل' : 'متوقف' }}</div>
                            </div>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('admin.ads.destroy', $ad->id) }}" onsubmit="return confirm('حذف الإعلان؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">حذف</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
