<div class="py-12 bg-gray-50 min-h-screen font-sans" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- العمود الأيمن (التفاصيل والتعليقات) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- كرت المنتج الرئيسي -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 relative">
                    
                    @if($isCheapest)
                    <div class="absolute top-0 left-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-br-lg shadow-sm animate-pulse">
                        🔥 هذا هو أرخص سعر حالياً
                    </div>
                    @endif

                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-3xl font-black text-gray-800 mb-2">{{ $product->name }}</h1>
                            <div class="flex gap-2">
                                <span class="text-gray-500 text-xs bg-gray-100 px-2 py-1 rounded">
                                    {{ $product->category }}
                                </span>
                                <span class="text-gray-400 text-xs flex items-center gap-1">
                                    🕒 {{ $product->created_at->diffForHumans() }}
                                </span>
                                <span class="text-blue-600 text-xs bg-blue-50 px-2 py-1 rounded font-bold">
                                    {{ $product->reference_code }}
                                </span>
                            </div>
                        </div>
                        <div class="text-left">
                            <p class="text-4xl font-black text-red-600">{{ $product->formatted_price }}</p>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-100">

                    <!-- معلومات المكان والتواصل -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <h3 class="font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="bg-white p-1 rounded-full shadow-sm">📍</span> العنوان
                            </h3>
                            <p class="text-gray-600 font-bold">{{ $product->city }}</p>
                            <p class="text-sm text-gray-500">{{ $product->shop_name }}</p>
                            @if($product->address_details)
                                <p class="text-xs text-gray-400 mt-1">{{ $product->address_details }}</p>
                            @endif
                        </div>

                        <div class="bg-green-50 p-4 rounded-xl border border-green-100">
                            <h3 class="font-bold text-green-800 mb-2 flex items-center gap-2">
                                <span class="bg-white p-1 rounded-full shadow-sm">📞</span> التواصل
                            </h3>
                            @if($product->contact_phone)
                                <a href="{{ $product->whatsapp_link }}" target="_blank" 
                                   class="flex items-center justify-center gap-2 bg-green-600 text-white w-full py-2 rounded-lg font-bold hover:bg-green-700 transition shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.481 0 1.461 1.063 2.875 1.211 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    تواصل واتساب
                                </a>
                            @else
                                <div class="text-center py-2 text-sm text-gray-500">
                                    لم يضف المعلن رقم تواصل
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- (داخل كرت المنتج الرئيسي، تحت السعر وقبل الـ hr) -->

@if($product->image_path)
    <div class="mt-4 mb-6">
        <div class="relative w-full h-64 md:h-80 bg-gray-100 rounded-xl overflow-hidden shadow-inner border border-gray-100 group">
            <img src="{{ asset('storage/' . $product->image_path) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
            
            <a href="{{ asset('storage/' . $product->image_path) }}" target="_blank" class="absolute bottom-2 left-2 bg-black/50 text-white text-xs px-2 py-1 rounded backdrop-blur-sm hover:bg-black/70">
                🔍 تكبير الصورة
            </a>
        </div>
    </div>
@endif

                <!-- قسم التعليقات -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                    <h3 class="text-xl font-bold mb-6 text-gray-800 flex items-center gap-2">
                        الاستفسارات
                        <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 rounded-full">{{ $product->comments->count() }}</span>
                    </h3>

                    <form wire:submit.prevent="saveComment" class="mb-8 relative">
                        <input wire:model="user_name" type="text" placeholder="اسمك (اختياري)" class="w-full mb-2 text-sm border-gray-200 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <textarea wire:model="comment_body" rows="3" placeholder="اكتب استفسارك هنا..." class="w-full text-sm border-gray-200 rounded-lg focus:ring-red-500 focus:border-red-500"></textarea>
                        <button type="submit" class="absolute bottom-3 left-3 bg-red-600 text-white px-4 py-1.5 rounded-md text-xs font-bold hover:bg-red-700 transition">
                            إرسال
                        </button>
                    </form>

                    <div class="space-y-6">
                        @forelse($product->comments as $comment)
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-500">
                                    {{ mb_substr($comment->user_name, 0, 1) }}
                                </div>
                                <div class="bg-gray-50 p-3 rounded-2xl rounded-tr-none w-full">
                                    <div class="flex justify-between items-center mb-1">
                                        <h4 class="font-bold text-sm">{{ $comment->user_name }}</h4>
                                        <span class="text-[10px] text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-400 py-4 text-sm">
                                لا توجد تعليقات بعد.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- العمود الأيسر (Sidebar) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
                    <h3 class="font-bold text-gray-800 mb-4 border-r-4 border-red-600 pr-2">
                         أسعار أخرى مشابهة
                    </h3>

                    <div class="space-y-3">
                        @forelse($similarProducts as $sim)
                            <a href="{{ route('products.show', $sim->id) }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-50 hover:bg-gray-50 hover:border-gray-200 transition group">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-xl group-hover:bg-white group-hover:shadow-sm transition">
                                     @if(Str::contains($sim->category, 'جوال')) 📱 @else 📦 @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm truncate group-hover:text-red-600">{{ $sim->name }}</h4>
                                    <div class="flex justify-between items-center mt-1">
                                        <span class="text-xs text-gray-500">{{ $sim->shop_name }}</span>
                                        <span class="text-sm font-black text-red-600">{{ $sim->formatted_price }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm">
                                لا توجد منتجات مشابهة بالاسم.
                            </div>
                        @endforelse
                    </div>

                    @if($similarProducts->isNotEmpty())
                    <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                        <p class="text-xs text-gray-400">مرتبة من الأرخص للأغلى</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>