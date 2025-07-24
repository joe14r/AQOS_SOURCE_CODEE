<main>
    @php
    $cart = session()->get('cart', []);
        if (empty($cart)) {
    @endphp
    <section class="modern-cart-section">
        <h2 class="modern-cart-title">Your Cart</h2>
        <p class="modern-cart-empty">You have no item in the cart, please select some items.</p>
        <a href="{{ route('menu') }}" class="modern-btn">Go to menu</a>
    </section>
    @php
        } else {
    @endphp
    <section class="modern-cart-section">
        <h2 class="modern-cart-title">Your Cart</h2>
        <div class="modern-cart-table-wrapper">
            @if(count($cartItems) > 0)
            <table class="modern-cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $id => $item)
                    <tr>
                        <td><img src="{{ asset('storage/' . $item['image']) }}" class="modern-cart-img" /></td>
                        <td>{{ $item['name'] }}</td>
                        <td>RM {{ number_format($item['price'], 2) }}</td>
                        <td>
                            <input type="number" min="1" wire:model.lazy="cartItems.{{ $id }}.quantity" class="modern-cart-qty" />
                        </td>
                        <td>RM {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td>
                            <button wire:click="removeItem('{{ $id }}')" class="modern-cart-remove">Remove</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: right;">Total:</th>
                        <th colspan="2">RM {{ number_format($total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
            @else
            <p class="modern-cart-empty">Your cart is empty.</p>
            @endif
        </div>
        <div class="modern-cart-summary">
            <h3>Total Price: RM <span id="total-price">{{ number_format($total, 2) }}</span></h3>
            <a href="{{ route('checkout') }}" class="modern-btn">Proceed to Checkout</a>
        </div>
    </section>
    @php
        }
    @endphp
</main>