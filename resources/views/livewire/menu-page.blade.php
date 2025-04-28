    <main>
        <h2>Our Menu</h2>
        @php
            $booked_table = session()->get('table_booked', []);

            if($booked_table){
                @endphp
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
            @php
            }
            else{
                @endphp
                <h3>Please scan a QR Code to show mwnu</h3>

                @php
            }

            
        @endphp

    </main>