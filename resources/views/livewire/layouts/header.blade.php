<header class="modern-user-header">
    <div class="modern-user-header-inner">
        <div class="modern-user-header-logo">
            <i class="fas fa-utensils"></i>
            <span class="modern-user-header-title">Al Madinah Restaurant</span>
        </div>
        <nav class="modern-user-header-nav">
            <ul class="modern-user-header-menu">
                <li><a wire:navigate href="{{ route('menu') }}" class="modern-user-header-btn"><i class="fas fa-list"></i> Menu</a></li>
                <li><a wire:navigate href="{{ route('cart') }}" class="modern-user-header-btn"><i class="fas fa-shopping-cart"></i> Cart <span class="modern-user-header-cart-count">@livewire('cart-count')</span></a></li>
                <li><a wire:navigate href="{{ route('checkout') }}" class="modern-user-header-btn"><i class="fas fa-credit-card"></i> Checkout</a></li>
                <li><a wire:navigate href="{{ route('order.tracking') }}" class="modern-user-header-btn"><i class="fas fa-map-marker-alt"></i> Tracking</a></li>
                <li><a wire:navigate href="{{ route('feedback') }}" class="modern-user-header-btn"><i class="fas fa-comment-dots"></i> Feedback</a></li>
            </ul>
        </nav>
    </div>
</header>