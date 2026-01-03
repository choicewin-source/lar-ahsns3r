<a href="{{ route('products.show', $product->id) }}" 
   class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-red-100 transition-all duration-300 flex flex-col h-full group">
    
    <!-- الصورة أو الأيقونة -->
    <div class="h-44 bg-gray-50 rounded-xl flex items-center justify-center text-6xl mb-4 group-hover:scale-105 transition-transform duration-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-tr from-white/0 to-white/40 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        {{ $product->icon }}
    </div>

    <!-- التفاصيل -->
    <div class="flex-1">
        <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 group-hover:text-red-600 transition-colors">
            {{ $product->name }}
        </h3>
        
        @if($showDetails)
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3 bg-gray-50 w-fit px-2 py-1 rounded">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ $product->city }} | {{ $product->shop_name }}
            </div>
        @endif
    </div>

    <!-- السعر والزر -->
    <div class="mt-4 flex justify-between items-end border-t border-gray-50 pt-3">
        <div>
            <p class="text-[10px] text-gray-400 font-bold">السعر</p>
            <span class="text-2xl font-black text-red-600 leading-none">
                {{ $product->formatted_price }}
            </span>
        </div>
        
        @if($showDetails)
            <!-- كود العرض التسلسلي -->
            <div class="text-left">
                <p class="text-[10px] text-gray-400 font-bold">كود العرض</p>
                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                    {{ $product->reference_code }}
                </span>
            </div>
        @endif
    </div>

    <!-- نوع المصدر -->
    <div class="mt-3">
        <span class="{{ $product->source_color }} text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">
            {{ $product->source_text }}
        </span>
    </div>
</a>