<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dashboard - Al Madinah Restaurant') }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('build/assets/app-wO4EqYCH.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
    @livewireStyles

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

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
    @stack('scripts')

    <script>
        // console.log("Blade loaded!");
    </script>

    <!-- Move the Echo script here, so it runs after app.js is loaded -->
    <script>
//      window.onload = function () {
//         console.log("Echo connection state:", Echo.connector.pusher.connection.state);
//     Echo.channel('order-channel')
//         .listen('order.event', (event) => {
//             console.log("Event received:", event);
//             alert("Order ID: " + event.order_id);
//         })
//         .error((err) => {
//             console.error("Error subscribing to Echo channel:", err);
//         });

//     // Log Pusher connection status for debugging
//     Echo.connector.pusher.connection.bind('state_change', function (states) {
//         console.log('Pusher connection state:', states.current);
//     });
// };
</script>
</body>

</html>