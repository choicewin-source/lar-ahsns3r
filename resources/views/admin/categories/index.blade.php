<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">إدارة الفئات</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded shadow mb-6">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="grid grid-cols-3 gap-3">
                        <input name="name" placeholder="اسم الفئة" class="col-span-1 border p-2 rounded" />
                        <input name="slug" placeholder="slug" class="col-span-1 border p-2 rounded" />
                        <input name="icon" placeholder="أيقونة (رمز)" class="col-span-1 border p-2 rounded" />
                    </div>
                    <div class="mt-3">
                        <label class="block text-sm">القوائم الفرعية (كل واحدة في سطر)</label>
                        <textarea name="subs" class="w-full border p-2 rounded" rows="3"></textarea>
                    </div>
                    <div class="mt-3 text-left">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">إضافة فئة</button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-3">الفئات الحالية</h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                        <div class="flex justify-between items-center border p-3 rounded">
                            <div>
                                <div class="font-bold">{{ $cat->name }} <span class="text-xs">{{ $cat->icon }}</span></div>
                                <div class="text-xs text-gray-500">{{ implode(', ', $cat->subs ?? []) }}</div>
                            </div>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('حذف الفئة؟');">
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
