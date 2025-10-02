<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.982 8.982 0 016 18c2.32 0 4.433.86 6 2.25" />
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 dark:text-gray-400 leading-7 font-semibold">
                                    <a href="https://laravel.com/docs">Documentation</a>
                                </div>
                            </div>
                            <div class="ml-12">
                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Laravel has wonderful documentation covering every aspect of the framework. Whether you're new to the framework or have previous experience, we recommend reading all of the documentation from beginning to end.
                                </div>
                            </div>
                        </div>
                        <!-- Các khối khác có thể bỏ qua nếu bạn chỉ cần file tồn tại -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>