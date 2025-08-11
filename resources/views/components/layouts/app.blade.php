<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Jui Power Digital Ips' }}</title>
    {{-- <meta name="description" content="{{ $description ?? 'eGadget - Your one-stop shop for all gadgets' }}">
        <meta name="keywords" content="{{ $keywords ?? 'gadgets, electronics, online shop' }}"> --}}

    <!-- ✅ Add this line below your <title> tag -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

<!-- Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>





    @vite('resources/css/app.css')
    @vite('resources/js/app.js')


    @livewireStyles()
</head>
<script src="https://unpkg.com/preline@latest/dist/preline.js"></script>



<body class="bg-white ">
    <header class="z-50 sticky top-0">
        @livewire('partials.navbar')
    </header>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts()
    {{-- 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       
       
        <x-livewire-alert::scripts/> --}}




        



</body>
<footer>
    @livewire('partials.footer')
</footer>

</html>
