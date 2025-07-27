<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Gadgety' }}</title>
        {{-- <meta name="description" content="{{ $description ?? 'eGadget - Your one-stop shop for all gadgets' }}">
        <meta name="keywords" content="{{ $keywords ?? 'gadgets, electronics, online shop' }}"> --}}

        <!-- ✅ Add this line below your <title> tag -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
      
        
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
