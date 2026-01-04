@php
    $announcements = \App\Models\Announcement::active();
@endphp

@if($announcements->count() > 0)
    <div class="bg-gradient-to-r from-red-600 via-red-700 to-red-600 text-white py-3 shadow-lg relative overflow-hidden z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
            </div>

            <!-- Ticker Container -->
            <div class="flex-1 overflow-hidden relative" style="height: 40px;">
                <div class="ticker-container flex items-center" style="animation: ticker-scroll {{ $announcements->count() * 10 }}s linear infinite;">
                    @foreach($announcements as $announcement)
                        <div class="ticker-item flex-shrink-0 px-8 flex items-center gap-3">
                            <span class="text-white font-bold text-lg">{{ $announcement->content }}</span>
                            <span class="text-white/60">•</span>
                        </div>
                    @endforeach
                    
                    <!-- Duplicate for seamless loop -->
                    @foreach($announcements as $announcement)
                        <div class="ticker-item flex-shrink-0 px-8 flex items-center gap-3">
                            <span class="text-white font-bold text-lg">{{ $announcement->content }}</span>
                            <span class="text-white/60">•</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Close Button (Optional) -->
            <div class="flex-shrink-0">
                <button 
                    onclick="this.closest('.bg-gradient-to-r').style.display='none'" 
                    class="w-8 h-8 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg flex items-center justify-center transition-colors"
                    title="إخفاء">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Shine Effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent" style="animation: shine 3s ease-in-out infinite;"></div>
    </div>

    <style>
        @keyframes ticker-scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes shine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }

        .ticker-container {
            display: flex;
            width: max-content;
        }

        .ticker-item {
            white-space: nowrap;
        }
    </style>
@endif