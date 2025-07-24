<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>QR Code Ordering System - Al Madinah Restaurant</title> -->
    <title>@yield('title', 'QR Code Ordering System - Al Madinah Restaurant')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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