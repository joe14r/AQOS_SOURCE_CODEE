<main>
    <section class="modern-menu-hero">
        <h1 class="modern-menu-title">Our Menu</h1>
        <h2 class="modern-menu-table">You set on : {{ $booked_table->title }}</h2>
    </section>
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
</main>