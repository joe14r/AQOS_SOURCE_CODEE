<main>
    <section class="modern-checkout-section">
        <h2 class="modern-checkout-title">Checkout</h2>
        @php
        $cart = session()->get('cart', []);
            if (empty($cart)) {
        @endphp
        <p class="modern-cart-empty">You have no item in the cart, please select some items.</p>
        <a href="{{ route('menu') }}" class="modern-btn">Go to menu</a>
        @php
            } else {
        @endphp
        <div class="modern-checkout-form-card">
            <form wire:submit.prevent="placeOrder" id="checkout-form" class="modern-checkout-form-organized">
                <div class="modern-checkout-form-section">
                    <h3 class="modern-checkout-form-title"><i class="fas fa-user"></i> Customer Information</h3>
                    <div class="modern-checkout-form-fields">
                        <div class="modern-checkout-field">
                            <label for="name">Name</label>
                            <input type="text" wire:model="name" id="name" required class="modern-checkout-input">
                            @error('name') <span class="modern-checkout-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="modern-checkout-field">
                            <label for="phone">Phone</label>
                            <input type="text" wire:model="phone" id="phone" required class="modern-checkout-input">
                            @error('phone') <span class="modern-checkout-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modern-checkout-form-section">
                    <h3 class="modern-checkout-form-title"><i class="fas fa-credit-card"></i> Payment Method</h3>
                    <div class="modern-checkout-form-fields modern-checkout-radio-row">
                        <label class="modern-checkout-radio">
                            <input type="radio" wire:model="paymentMethod" value="credit" required>
                            <span><i class="fas fa-credit-card"></i> Credit Card</span>
                        </label>
                        <label class="modern-checkout-radio">
                            <input type="radio" wire:model="paymentMethod" value="cash" required>
                            <span><i class="fas fa-money-bill-wave"></i> Pay Cash (at the counter)</span>
                        </label>
                        @error('paymentMethod') <span class="modern-checkout-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="modern-btn modern-checkout-btn">Place Order</button>
            </form>
        </div>
        @php
            }
        @endphp
    </section>
</main>