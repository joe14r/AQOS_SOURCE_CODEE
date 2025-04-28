    <main>
        <h2>Our Menu</h2>
        <h2>You set on : {{ $booked_table->title }}</h2>
        <div id="menu-items">
            <div class="menu-container">
                @foreach ($menus as $menu)
            <div class="menu-card">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="Food Image" class="menu-image">
                <div class="menu-content">
                    <h3 class="menu-title">{{ $menu->name }}</h3>
                    <p class="menu-price">RM {{ $menu->price }}</p>
                    <button class="add-to-cart" wire:click="addToCart({{ $menu->id }})">Add to Cart</button>
                </div>
            </div>
            @endforeach
            
</div>
        </div>
    </main>