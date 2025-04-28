<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>QR Code Ordering System - Al Madinah Restaurant</title> -->
    <title>@yield('title', 'QR Code Ordering System - Al Madinah Restaurant')</title>

    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    @livewireStyles
</head>

<body>


@livewire('layouts.header')
{{ $slot }}
@livewire('layouts.footer')
    
@livewireScripts
    <!-- <script src="{{ asset('dist/js/script.js') }}"></script> -->
</body>

</html>