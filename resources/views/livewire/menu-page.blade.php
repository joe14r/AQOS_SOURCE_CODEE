<main>
    <section class="modern-menu-hero">
        <h1 class="modern-menu-title">Our Menu</h1>
        <p class="modern-menu-subtitle">Discover our delicious dishes and add your favorites to the cart!</p>
    </section>
    @php
        $booked_table = session()->get('table_booked', []);

        if($booked_table){
    @endphp
        <section class="modern-menu-section">
            <div class="modern-menu-container">
                @foreach ($menus as $menu)
                <div class="modern-menu-card">
                    <img src="{{ url('public/uploads/user', $menu->image) }}" alt="Food Image" class="modern-menu-image">
                    <div class="modern-menu-content">
                        <h3 class="modern-menu-item-title">{{ $menu->name }}</h3>
                        <p class="modern-menu-price">RM {{ $menu->price }}</p>
                        <button class="modern-btn" wire:click="addToCart({{ $menu->id }})">Add to Cart</button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    @php
        } else {
    @endphp
        <section class="modern-menu-section">
            <h3 class="modern-menu-warning">Please scan a QR Code to show menu</h3>
        </section>
    @php
        }
    @endphp
</main>