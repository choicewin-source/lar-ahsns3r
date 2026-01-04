<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-black text-gray-900 flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <span>إدارة البلاغات</span>
                        </h1>
                        <p class="mt-2 text-gray-600 font-medium">مراجعة ومتابعة بلاغات المستخدمين</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        العودة للوحة التحكم
                    </a>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">إجمالي البلاغات</p>
                            <p class="text-3xl font-black text-gray-900">{{ $stats['total'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">قيد المراجعة</p>
                            <p class="text-3xl font-black text-orange-600">{{ $stats['pending'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">تمت المراجعة</p>
                            <p class="text-3xl font-black text-blue-600">{{ $stats['reviewed'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">تم الحل</p>
                            <p class="text-3xl font-black text-green-600">{{ $stats['resolved'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Reports Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        جميع البلاغات
                    </h2>
                </div>

                @if($reports->isEmpty())
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">لا توجد بلاغات</h3>
                        <p class="text-gray-600">لم يتم تسجيل أي بلاغات حتى الآن</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-200">
                        @foreach($reports as $report)
                            <div class="p-6 hover:bg-gray-50 transition-colors" x-data="{ expanded: false }">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-3 mb-3">
                                            <div class="flex-shrink-0 mt-1">
                                                @if($report->status === 'pending')
                                                    <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                                @elseif($report->status === 'reviewed')
                                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                                @else
                                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $report->status === 'pending' ? 'bg-orange-100 text-orange-700' : ($report->status === 'reviewed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                                        {{ $report->status === 'pending' ? '⏳ قيد المراجعة' : ($report->status === 'reviewed' ? '👁️ تمت المراجعة' : '✅ تم الحل') }}
                                                    </span>
                                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">
                                                        {{ $report->reason }}
                                                    </span>
                                                </div>
                                                
                                                @if($report->product_link)
                                                    <p class="text-sm text-gray-900 font-bold mb-1">
                                                        <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                        </svg>
                                                        <a href="{{ $report->product_link }}" target="_blank" class="text-blue-600 hover:underline">
                                                            {{ Str::limit($report->product_link, 50) }}
                                                        </a>
                                                    </p>
                                                @endif

                                                @if($report->shop_name)
                                                    <p class="text-sm text-gray-700 mb-1">
                                                        <strong>المحل:</strong> {{ $report->shop_name }}
                                                    </p>
                                                @endif

                                                @if($report->details)
                                                    <button @click="expanded = !expanded" class="text-sm text-blue-600 hover:text-blue-700 font-bold">
                                                        <span x-show="!expanded">عرض التفاصيل ↓</span>
                                                        <span x-show="expanded" style="display: none;">إخفاء التفاصيل ↑</span>
                                                    </button>
                                                    <div x-show="expanded" style="display: none;" class="mt-2 p-4 bg-gray-100 rounded-lg">
                                                        <p class="text-sm text-gray-700">{{ $report->details }}</p>
                                                    </div>
                                                @endif

                                                <div class="flex flex-wrap items-center gap-3 text-xs text-gray-600 mt-2">
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ $report->created_at->diffForHumans() }}
                                                    </span>
                                                    @if($report->reporter_name)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                            </svg>
                                                            {{ $report->reporter_name }}
                                                        </span>
                                                    @endif
                                                    @if($report->reporter_phone)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                            </svg>
                                                            {{ $report->reporter_phone }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <!-- Status Update -->
                                        <form action="{{ route('admin.reports.update-status', $report->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $report->status === 'pending' ? 'reviewed' : ($report->status === 'reviewed' ? 'resolved' : 'pending') }}">
                                            <button type="submit" class="p-2 {{ $report->status === 'resolved' ? 'bg-orange-100 hover:bg-orange-200 text-orange-700' : 'bg-green-100 hover:bg-green-200 text-green-700' }} rounded-lg transition-colors" title="{{ $report->status === 'resolved' ? 'إعادة فتح' : 'تحديث الحالة' }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا البلاغ؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors" title="حذف">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>