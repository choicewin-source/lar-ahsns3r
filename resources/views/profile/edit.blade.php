<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('profile.show') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-black text-gray-900">إعدادات الحساب</h1>
                </div>
                <p class="text-gray-600">قم بتحديث معلومات حسابك وإعدادات الأمان</p>
            </div>

            <!-- رسالة النجاح -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-800 font-bold">{{ session('status') }}</p>
                </div>
            @endif

            <!-- رفع صورة المتجر (لأصحاب المتاجر فقط) -->
            @if($user->isShopOwner())
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-gray-900">صورة المتجر</h2>
                            <p class="text-sm text-gray-600">قم برفع شعار أو صورة متجرك</p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <!-- معاينة الصورة الحالية -->
                        <div>
                            @if($user->shop_logo)
                                <img src="{{ asset('storage/' . $user->shop_logo) }}" 
                                     alt="{{ $user->shop_name }}" 
                                     class="w-32 h-32 rounded-2xl object-cover shadow-lg">
                            @else
                                <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-lg">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- نموذج رفع الصورة -->
                        <div class="flex-1">
                            <form action="{{ route('profile.logo.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">اختر صورة جديدة</label>
                                    <input type="file" 
                                           name="shop_logo" 
                                           accept="image/*" 
                                           class="block w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                                    @error('shop_logo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, WEBP حتى 2MB</p>
                                </div>

                                <div class="flex gap-3">
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition shadow-md hover:shadow-lg text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <span>رفع الصورة</span>
                                    </button>

                                    @if($user->shop_logo)
                                        <form action="{{ route('profile.logo.delete') }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('هل أنت متأكد من حذف الصورة؟')" class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-700 font-bold rounded-lg transition text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span>حذف الصورة</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- معلومات الحساب -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-900">المعلومات الشخصية</h2>
                        <p class="text-sm text-gray-600">قم بتحديث معلومات حسابك وبريدك الإلكتروني</p>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- تغيير كلمة المرور -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-900">تغيير كلمة المرور</h2>
                        <p class="text-sm text-gray-600">تأكد من استخدام كلمة مرور طويلة وآمنة</p>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <!-- حذف الحساب -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-red-100">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-900">حذف الحساب</h2>
                        <p class="text-sm text-gray-600">احذف حسابك بشكل نهائي - هذا الإجراء لا يمكن التراجع عنه</p>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>