    <main>
        @php
        $cart = session()->get('cart', []);
            if (empty($cart)) {
                @endphp
<h3>You have no item in the cart, please select some items.</h3>
<div class="cart-summary">
            
            <a href="{{ route('menu') }}" class="btn">Go to menu</a>
        </div>

                @php
                
            }
            else {
        @endphp
        <h2>Your Cart</h2>
        <h3>Total Price: RM <span id="total-price"> {{ number_format($total, 2) }}</span></h3>
        <div id="cart-items">
            <div class="cart-summary">
            
            <div class="cart">

    @if(count($cartItems) > 0)
        <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="10" cellspacing="0">
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
                        <td><img src="{{ asset('storage/' . $item['image']) }}" width="60" /></td>
                        <td>{{ $item['name'] }}</td>
                        <td>RM {{ number_format($item['price'], 2) }}</td>
                        <td>
                            <input type="number" min="1" wire:model.lazy="cartItems.{{ $id }}.quantity" style="width: 60px;" />
                        </td>
                        <td>RM {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td>
                            <button wire:click="removeItem('{{ $id }}')" style="color: red;">Remove</button>
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
        <p>Your cart is empty.</p>
    @endif
</div>
</div>
        </div>
        


<div class="cart-summary">
            <h3>Total Price: RM<span id="total-price"> {{ number_format($total, 2) }}</span></h3>
            <a href="{{ route('checkout') }}" class="btn" onclick="location.href='checkout.html'">Proceed to Checkout</a>
        </div>
@php
}
@endphp
    </main>