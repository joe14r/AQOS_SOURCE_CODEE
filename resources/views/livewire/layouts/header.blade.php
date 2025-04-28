    <header>
        <h1>Welcome to Al Madinah Restaurant</h1>
        <nav>
    <ul class="nav-menu">
        <li><a wire:navigate href="{{ route('menu') }}">Menu</a></li>
        <li><a wire:navigate href="{{ route('cart') }}">Cart @livewire('cart-count')</a></li>
        <li><a wire:navigate href="{{ route('checkout') }}">Checkout</a></li>
        <li><a wire:navigate href="{{ route('order.tracking') }}">Order Tracking</a></li>
        <li><a wire:navigate href="{{ route('feedback') }}">Feedback</a></li>
        
    </ul>
</nav>

    </header>