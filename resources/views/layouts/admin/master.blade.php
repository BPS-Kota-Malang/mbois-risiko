<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('layouts.admin.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.admin.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    {{-- //modal dari identifikasi penyebab --}}
    <script>
        var openmodal = document.querySelectorAll('#openModal');
        var closemodal = document.querySelectorAll('#closeModal, #closeModal2');
        var modal = document.querySelector('#penyebabModal');
        var body = document.querySelector('body');

        openmodal.forEach(function(el) {
            el.addEventListener('click', function(event) {
                event.preventDefault();
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                modal.classList.remove('pointer-events-none');
                body.classList.add('modal-active');
            });
        });

        closemodal.forEach(function(el) {
            el.addEventListener('click', function(event) {
                event.preventDefault();
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
                body.classList.remove('modal-active');
            });
        });
    </script>

</body>
</body>

</html>
