// JavaScript functions for QR Code-based Ordering System

document.addEventListener('DOMContentLoaded', function () {
    const menuItemsContainer = document.getElementById('menu-items');

    // Function to fetch and display menu items
    function fetchMenuItems() {
        fetch('http://127.0.0.1:8000/api/menu', {
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                menuItemsContainer.innerHTML = '';
                data.forEach(item => {
                    const menuItem = document.createElement('div');
                    menuItem.classList.add('menu-item');
                    menuItem.innerHTML = `
                    <h3>${item.name}</h3>
                    <p>${item.description}</p>
                    <p>Price: $${item.price}</p>
                    <img src="${item.image}" alt="${item.name}" width="100">
                    <button class="btn" onclick="addToCart('${item.name}', ${item.price})">Add to Cart</button>
                `;
                    menuItemsContainer.appendChild(menuItem);
                });
            })
            .catch(error => console.error('Error fetching menu items:', error));
    }

    // Fetch and display menu items on page load
    if (menuItemsContainer) {
        fetchMenuItems();
    }
});

// Function to add items to the cart
function addToCart(dishName, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let item = cart.find(item => item.dishName === dishName);
    if (item) {
        item.quantity += 1;
    } else {
        cart.push({ dishName, price, quantity: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert('Item added to cart');
}

// Function to load cart items
function loadCartItems() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartItemsContainer = document.getElementById('cart-items');
    let totalPrice = 0;
    cartItemsContainer.innerHTML = '';
    cart.forEach(item => {
        totalPrice += item.price * item.quantity;
        cartItemsContainer.innerHTML += `
            <div class="cart-item">
                <p>${item.dishName}</p>
                <p>Quantity: <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity('${item.dishName}', this.value)"></p>
                <p>Price: $${item.price.toFixed(2)}</p>
                <button class="btn" onclick="removeFromCart('${item.dishName}')">Remove</button>
            </div>
        `;
    });
    document.getElementById('total-price').innerText = totalPrice.toFixed(2);
}

// Function to update item quantity
function updateQuantity(dishName, quantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let item = cart.find(item => item.dishName === dishName);
    if (item) {
        item.quantity = parseInt(quantity);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCartItems();
    }
}

// Function to remove items from the cart
function removeFromCart(dishName) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.dishName !== dishName);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCartItems();
    updateCartCount();
}

// Function to update cart count in the header
function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartCount = cart.reduce((count, item) => count + item.quantity, 0);
    document.getElementById('cart-count').innerText = cartCount;
}

// Load cart items and update cart count when the cart page is loaded
if (document.getElementById('cart-items')) {
    loadCartItems();
    updateCartCount();
}

// Update cart count on other pages
if (document.getElementById('cart-count')) {
    updateCartCount();
}

// Function to update the quantity of an item in the cart
function updateCartItemQuantity(itemId, quantity) {
    // Logic to update the item quantity in the cart
    console.log(`Item ${itemId} quantity updated to ${quantity}.`);
}

// Function to proceed to checkout
function proceedToCheckout() {
    // Logic to redirect to the checkout page
    window.location.href = 'pages/checkout.html';
}

// Function to submit feedback
function submitFeedback(feedback) {
    // Logic to handle feedback submission
    console.log(`Feedback submitted: ${feedback}`);
}

// Function to track order status
function trackOrder(orderId) {
    // Logic to fetch and display order status
    console.log(`Tracking order ${orderId}.`);
}

// Placeholder for future QR code scanning feature
console.log("QR Ordering System JavaScript Loaded!");

function placeOrder() {
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

    const orderData = {
        user_id: 1, // Replace with actual user ID
        items: [
            // Replace with actual cart items
            { menu_item_id: 1, quantity: 2 },
            { menu_item_id: 2, quantity: 1 }
        ],
        payment_method: paymentMethod
    };

    fetch('http://127.0.0.1:8000/api/order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
        .then(response => response.json())
        .then(data => {
            if (paymentMethod === 'credit') {
                processPayment(data.order_id, data.total_amount);
            } else {
                alert('Order placed successfully. Please pay cash at the counter.');
                window.location.href = 'order-tracking.html';
            }
        })
        .catch(error => console.error('Error:', error));
}

function processPayment(orderId, amount) {
    // Implement credit card payment processing
    alert(`Processing payment for order ${orderId} with amount $${amount}`);
    // Redirect to order tracking page after successful payment
    window.location.href = 'order-tracking.html';
}

//window.location.href = 'pages/manage-menu.html'; // Redirect to manage menu page