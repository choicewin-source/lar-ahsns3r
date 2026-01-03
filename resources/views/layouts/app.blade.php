<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'أحسن سعر') }}</title>

        <!-- 1. استدعاء خط Cairo من جوجل -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- 2. تطبيق الخط على كل شيء -->
        <style>
            body, html, .font-sans, h1, h2, h3, h4, h5, h6, p, span, a, button, input, select {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-800">
        <div class="min-h-screen flex flex-col justify-between">
            
            <!-- استدعاء الناف بار (الهيدر) -->
            @include('layouts.navigation')

            <!-- المحتوى المتغير -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- فوتر بسيط وثابت -->
            <footer class="bg-white border-t border-gray-200 mt-auto py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="flex justify-center items-center gap-2 mb-2">
                        <span class="text-2xl font-black text-gray-800">أحسن</span>
                        <span class="text-2xl font-black text-red-600">سعر</span>
                    </div>
                    <p class="text-sm text-gray-500 font-bold mb-4">
                        دليلك الأول لمعرفة الأسعار في غزة 🇵🇸
                    </p>
                    <p class="text-xs text-gray-400">
                        جميع الحقوق محفوظة © {{ date('Y') }}
                    </p>
                </div>
            </footer>

        </div>

        <!-- Livewire Scripts -->
        @livewireScripts
        <!-- Alpine.js for modal and interactivity -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>