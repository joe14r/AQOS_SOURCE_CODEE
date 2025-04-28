<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dashboard - Al Madinah Restaurant') }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

      <!-- <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script> -->
<!-- <script>
    // Enable Pusher logging (useful for debugging)
    Pusher.logToConsole = true;

    // Initialize Pusher with your app key and cluster
    var pusher = new Pusher('d5e2ae068b90ed02ac54', {
        cluster: 'ap2'
    });

    // Initialize Echo
    var echo = new Echo({
        broadcaster: 'pusher',
        key: 'd5e2ae068b90ed02ac54',
        cluster: 'ap2',
        encrypted: true
    });

    // Subscribe to the 'order-channel'
    echo.channel('order-channel')
        .listen('order-event', function(data) {
            // Display the data from the event
            console.log(data);
            alert("New Order: " + JSON.stringify(data));
        });
</script> -->

    @livewireStyles

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

      <script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    // var pusher = new Pusher('d5e2ae068b90ed02ac54', {
    //   cluster: 'ap2'
    // });

    // var channel = pusher.subscribe('orders');
    // channel.bind('order.placed', function(data) {
    //   alert(JSON.stringify(data));
    // });
  </script>



</head>

<body>
    <div class="dashboard-container">
        @livewire('admin.aside')

        <!-- Main Content -->
        <main class="main-content">
            @livewire('admin.header')

            {{ $slot }}
        </main>
    </div>
@livewireScripts
@yield('script')
<script>
    console.log("Blade loaded!");
</script>

    <!-- <script src="{{ asset('/assets/js/script.js')}}"></script> -->
</body>

</html>