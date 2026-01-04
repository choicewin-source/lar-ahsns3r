<section class="space-y-6">
    <p class="text-sm text-gray-600 leading-relaxed">
        عند حذف حسابك، سيتم حذف جميع البيانات والمعلومات المرتبطة به بشكل دائم. قبل الحذف، يُرجى حفظ أي بيانات تود الاحتفاظ بها.
    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        <span>حذف الحساب نهائياً</span>
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-gray-900 mb-3">
                هل أنت متأكد من حذف حسابك؟
            </h2>

            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                عند حذف حسابك، سيتم حذف جميع البيانات والمعلومات بشكل دائم. الرجاء إدخال كلمة المرور لتأكيد الحذف.
            </p>

            <div class="mb-6">
                <x-input-label for="password" value="كلمة المرور" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500"
                    placeholder="أدخل كلمة المرور للتأكيد"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition">
                    إلغاء
                </button>

                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    حذف الحساب
                </button>
            </div>
        </form>
    </x-modal>
</section>