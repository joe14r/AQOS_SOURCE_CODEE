<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dashboard - Al Madinah Restaurant') }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        @include('admin.layouts.aside')

        <!-- Main Content -->
        <main class="main-content">
            @include('admin.layouts.header')

            @yield('content')
        </main>
    </div>

    <!-- <script src="{{ asset('/assets/js/script.js')}}"></script> -->
</body>

</html>