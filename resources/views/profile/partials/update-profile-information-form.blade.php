<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- الاسم -->
        <div>
            <x-input-label for="name" value="الاسم الشخصي" class="font-bold text-gray-700" />
            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- البريد الإلكتروني -->
        <div>
            <x-input-label for="email" value="البريد الإلكتروني" class="font-bold text-gray-700" />
            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800 mb-2">
                        بريدك الإلكتروني غير مفعّل.
                    </p>
                    <button form="send-verification" class="text-sm text-blue-600 hover:text-blue-800 font-bold underline">
                        انقر هنا لإعادة إرسال رابط التفعيل
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600 font-bold">
                            تم إرسال رابط تفعيل جديد إلى بريدك الإلكتروني.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if($user->isShopOwner())
            <!-- اسم المتجر -->
            <div>
                <x-input-label for="shop_name" value="اسم المعرض / المتجر" class="font-bold text-gray-700" />
                <x-text-input id="shop_name" name="shop_name" type="text" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" :value="old('shop_name', $user->shop_name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('shop_name')" />
            </div>

            <!-- المدينة -->
            <div>
                <x-input-label for="shop_city" value="المدينة" class="font-bold text-gray-700" />
                <select id="shop_city" name="shop_city" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">اختر المدينة</option>
                    <option value="شمال غزة" {{ old('shop_city', $user->shop_city) == 'شمال غزة' ? 'selected' : '' }}>شمال غزة</option>
                    <option value="مدينة غزة" {{ old('shop_city', $user->shop_city) == 'مدينة غزة' ? 'selected' : '' }}>مدينة غزة</option>
                    <option value="المنطقة الوسطى" {{ old('shop_city', $user->shop_city) == 'المنطقة الوسطى' ? 'selected' : '' }}>المنطقة الوسطى</option>
                    <option value="خانيونس" {{ old('shop_city', $user->shop_city) == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                    <option value="رفح" {{ old('shop_city', $user->shop_city) == 'رفح' ? 'selected' : '' }}>رفح</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('shop_city')" />
            </div>

            <!-- رقم الهاتف -->
            <div>
                <x-input-label for="shop_phone" value="رقم الهاتف" class="font-bold text-gray-700" />
                <x-text-input id="shop_phone" name="shop_phone" type="tel" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" :value="old('shop_phone', $user->shop_phone)" placeholder="مثال: 0591234567" />
                <x-input-error class="mt-2" :messages="$errors->get('shop_phone')" />
            </div>

            <!-- العنوان -->
            <div>
                <x-input-label for="shop_address" value="العنوان التفصيلي (اختياري)" class="font-bold text-gray-700" />
                <x-text-input id="shop_address" name="shop_address" type="text" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" :value="old('shop_address', $user->shop_address)" placeholder="مثال: شارع الوحدة، بجانب مسجد النور" />
                <x-input-error class="mt-2" :messages="$errors->get('shop_address')" />
            </div>

            <!-- وصف المتجر -->
            <div>
                <x-input-label for="shop_description" value="وصف المتجر (اختياري)" class="font-bold text-gray-700" />
                <textarea id="shop_description" name="shop_description" rows="4" class="mt-2 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="أخبر عملاءك عن متجرك...">{{ old('shop_description', $user->shop_description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('shop_description')" />
                <p class="mt-1 text-xs text-gray-500">وصف مختصر عن متجرك ومنتجاتك</p>
            </div>
        @endif

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>حفظ التغييرات</span>
            </button>
        </div>
    </form>
</section>
