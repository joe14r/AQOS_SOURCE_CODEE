    <main>
        <h2>Checkout</h2>
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
        <form wire:submit.prevent="placeOrder" id="checkout-form">
    <h3>Customer Information</h3>
    <div>
        <label for="name">Name</label>
        <input type="text" wire:model="name" id="name" required>
        @error('name') <span style="color:red">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" wire:model="phone" id="phone" required>
        @error('phone') <span style="color:red">{{ $message }}</span> @enderror
    </div>

    <h3>Payment Method</h3>
    <label>
        <input type="radio" wire:model="paymentMethod" value="credit" required>
        Credit Card
    </label>
    <label>
        <input type="radio" wire:model="paymentMethod" value="cash" required>
        Pay Cash (at the counter)
    </label>

    @error('paymentMethod') <span style="color:red">{{ $message }}</span> @enderror

    <button type="submit">Place Order</button>
</form>
@php
}
@endphp
    </main>