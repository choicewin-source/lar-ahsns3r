<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-6 bg-gray-50">
        <div class="max-w-md w-full text-center">
            <!-- أيقونة -->
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <!-- العنوان الرئيسي -->
            <h2 class="text-2xl font-bold text-gray-800 mb-3">تم استلام طلبك بنجاح! ✅</h2>
            
            <!-- الرسالة -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
                <p class="text-gray-600 mb-4 leading-relaxed">
                    شكراً لتسجيلك في منصة <span class="font-bold text-blue-600">أحسن سعر</span> كتاجر.
                    تم استلام طلب تسجيل متجرك بنجاح وهو الآن قيد المراجعة من قبل إدارة المنصة.
                </p>
                
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-blue-800 mb-2 text-sm">ماذا يحدث الآن؟</h3>
                    <ul class="text-sm text-blue-700 space-y-1 text-right">
                        <li class="flex items-center justify-end gap-2">
                            <span>سيتم مراجعة بيانات متجرك خلال 24-48 ساعة</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </li>
                        <li class="flex items-center justify-end gap-2">
                            <span>ستصلك رسالة تأكيد على بريدك الإلكتروني عند الموافقة</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </li>
                        <li class="flex items-center justify-end gap-2">
                            <span>يمكنك بعدها إضافة منتجاتك وعرضها للزبائن</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </li>
                    </ul>
                </div>
                
                <p class="text-sm text-gray-500 mb-4">
                    للمساعدة أو الاستفسار، يمكنك التواصل معنا عبر:
                </p>
                
                <div class="flex flex-col gap-3">
                    <a href="https://t.me/shady2013" target="_blank" 
                       class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.193c-.202 1.638-1.068 5.628-1.507 7.459-.166.693-.492.923-.807.946-.675.049-1.189-.447-1.843-.876-1.025-.684-1.604-1.109-2.598-1.776-1.149-.773-.405-1.197.25-1.891.172-.179 3.145-2.878 3.203-3.124.006-.029.012-.138-.052-.195-.064-.057-.158-.037-.226-.022-.096.02-1.616 1.025-4.562 3.011-.432.304-.823.452-1.173.445-.387-.009-1.131-.218-1.684-.398-.679-.221-1.221-.338-1.174-.716.023-.189.287-.382.789-.579 3.115-1.355 5.193-2.257 6.237-2.704 2.829-1.192 3.413-1.399 3.797-1.404.085-.001.275.02.398.12.098.079.125.185.137.242.012.057.027.187.015.289z"/>
                        </svg>
                        تليجرام: @shady2013
                    </a>
                </div>
            </div>

            <!-- زر العودة -->
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</x-guest-layout>