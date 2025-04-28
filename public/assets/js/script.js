document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('http://127.0.0.1:8000/api/admin/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, password })
        })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    localStorage.setItem('jwt_token', data.token);
                    window.location.href = 'pages/manage-menu.html'; // Redirect to manage menu page
                } else {
                    alert('Login failed. Please check your credentials.');
                }
            })
            .catch(error => console.error('Error logging in:', error));
    });

    const addMenuItemForm = document.getElementById('add-menu-item');
    if (addMenuItemForm) {
        addMenuItemForm.addEventListener('submit', function (event) {
            event.preventDefault();
            addMenuItem();
        });
    }

    if (document.getElementById('menu-items')) {
        loadMenuItems();
    }

    if (document.getElementById('orders')) {
        loadOrders();
    }

    if (document.getElementById('payments')) {
        loadPayments();
    }

    if (document.getElementById('feedback')) {
        loadFeedback();
    }
});

function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('http://127.0.0.1:8000/api/admin/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                localStorage.setItem('jwt_token', data.token);
                window.location.href = 'pages/manage-menu.html'; // Redirect to manage menu page
            } else {
                alert('Login failed. Please check your credentials.');
            }
        })
        .catch(error => console.error('Error logging in:', error));
}

function logout() {
    localStorage.removeItem('token');
}

function loadMenuItems() {
    fetch('http://127.0.0.1:8000/api/menu', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.json())
        .then(data => {
            const menuItemsContainer = document.getElementById('menu-items');
            menuItemsContainer.innerHTML = '';
            data.forEach(item => {
                menuItemsContainer.innerHTML += `
                <div class="menu-item">
                    <p>Name: ${item.name}</p>
                    <p>Description: ${item.description}</p>
                    <p>Price: $${item.price}</p>
                    <p><img src="${item.image}" alt="${item.name}" width="100"></p>
                    <button onclick="editMenuItem(${item.id})">Edit</button>
                    <button onclick="deleteMenuItem(${item.id})">Delete</button>
                </div>
            `;
            });
        })
        .catch(error => console.error('Error:', error));
}

function addMenuItem() {
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const price = document.getElementById('price').value;
    const image = document.getElementById('image').value;

    fetch('http://127.0.0.1:8000/api/menu', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        body: JSON.stringify({ name, description, price, image })
    })
        .then(response => response.json())
        .then(data => {
            alert('Menu item added');
            loadMenuItems(); // Reload menu items after adding a new item
        })
        .catch(error => console.error('Error:', error));
}

function editMenuItem(id) {
    const name = prompt('Enter new name:');
    const description = prompt('Enter new description:');
    const price = prompt('Enter new price:');
    const image = prompt('Enter new image URL:');

    fetch(`http://127.0.0.1:8000/api/menu/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        body: JSON.stringify({ name, description, price, image })
    })
        .then(response => response.json())
        .then(data => {
            alert('Menu item updated');
            loadMenuItems(); // Reload menu items after updating an item
        })
        .catch(error => console.error('Error:', error));
}

function deleteMenuItem(id) {
    fetch(`http://127.0.0.1:8000/api/menu/${id}`, {
        method: 'DELETE',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.json())
        .then(data => {
            alert('Menu item deleted');
            loadMenuItems(); // Reload menu items after deleting an item
        })
        .catch(error => console.error('Error:', error));
}

function loadOrders() {
    console.log('loadOrders function called'); // Debugging log

    fetch('http://127.0.0.1:8000/api/orders', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Accept': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Orders fetched:', data); // Debugging log
            const ordersContainer = document.getElementById('orders');
            ordersContainer.innerHTML = ''; // Clear existing rows
            data.forEach(order => {
                ordersContainer.innerHTML += `
                    <tr>
                        <td>${order.id}</td>
                        <td>${order.customer_name || 'N/A'}</td>
                        <td>${order.payment_method || 'N/A'}</td>
                        <td>${new Date(order.created_at).toLocaleDateString()}</td>
                        <td>${order.receipt_number || 'N/A'}</td>
                        <td>${order.status}</td>
                        <td>
                            <button onclick="updateOrderStatus(${order.id}, 'Preparing')">Mark as Preparing</button>
                            <button onclick="updateOrderStatus(${order.id}, 'Completed')">Mark as Completed</button>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(error => console.error('Error loading orders:', error));
}

function updateOrderStatus(id, status) {
    fetch(`http://127.0.0.1:8000/api/order/${id}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        body: JSON.stringify({ status })
    })
        .then(response => response.json())
        .then(data => {
            alert('Order status updated');
            loadOrders(); // Reload orders after updating the status
        })
        .catch(error => console.error('Error:', error));
}

function loadPayments() {
    fetch('http://127.0.0.1:8000/api/payments', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.json())
        .then(data => {
            const paymentsContainer = document.getElementById('payments');
            paymentsContainer.innerHTML = '';
            data.forEach(payment => {
                paymentsContainer.innerHTML += `
                <div class="payment">
                    <p>Payment ID: ${payment.id}</p>
                    <p>Order ID: ${payment.order_id}</p>
                    <p>Amount: $${payment.amount}</p>
                    <p>Payment Method: ${payment.payment_method}</p>
                </div>
            `;
            });
        })
        .catch(error => console.error('Error:', error));
}

function filterPayments() {
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    const paymentMethod = document.getElementById('payment-method').value;

    fetch(`http://127.0.0.1:8000/api/payments?start_date=${startDate}&end_date=${endDate}&method=${paymentMethod}`, {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.json())
        .then(data => {
            const paymentsContainer = document.getElementById('payments');
            paymentsContainer.innerHTML = '';
            data.forEach(payment => {
                paymentsContainer.innerHTML += `
                    <tr>
                        <td>${payment.id}</td>
                        <td>${payment.order_id}</td>
                        <td>$${payment.amount}</td>
                        <td>${payment.payment_method}</td>
                        <td>${new Date(payment.created_at).toLocaleString()}</td>
                    </tr>
                `;
            });
        })
        .catch(error => console.error('Error filtering payments:', error));
}

function exportToCSV() {
    fetch('http://127.0.0.1:8000/api/payments/export/csv', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'payments.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => console.error('Error exporting to CSV:', error));
}

function exportToPDF() {
    fetch('http://127.0.0.1:8000/api/payments/export/pdf', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'payments.pdf';
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => console.error('Error exporting to PDF:', error));
}

function loadFeedback() {
    fetch('http://127.0.0.1:8000/api/feedback', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.json())
        .then(data => {
            const feedbackContainer = document.getElementById('feedback');
            feedbackContainer.innerHTML = '';
            data.forEach(feedback => {
                feedbackContainer.innerHTML += `
                <div class="feedback">
                    <p>User ID: ${feedback.user_id}</p>
                    <p>Comment: ${feedback.comment}</p>
                    <p>Rating: ${feedback.rating}</p>
                    <button onclick="respondToFeedback(${feedback.id})">Respond</button>
                </div>
            `;
            });
        })
        .catch(error => console.error('Error:', error));
}

function respondToFeedback(id) {
    const response = prompt('Enter your response:');
    // Implement the logic to save the response to the feedback
    alert('Response saved');
}

function trackSalesTrends() {
    // Implement the logic to track sales trends
    alert('Sales trends tracked');
}

function generateReports() {
    // Implement the logic to generate reports
    alert('Reports generated');
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('add-menu-item');
    const menuItemsContainer = document.getElementById('menu-items');

    // Function to fetch and display menu items
    function fetchMenuItems() {
        fetch('http://127.0.0.1:8000/api/menu', {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('jwt_token')}`
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
                    <img src="${item.image}" alt="${item.name}">
                `;
                    menuItemsContainer.appendChild(menuItem);
                });
            })
            .catch(error => console.error('Error fetching menu items:', error));
    }

    // Fetch and display menu items on page load
    fetchMenuItems();

    // Handle form submission
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const data = {
            name: formData.get('name'),
            description: formData.get('description'),
            price: formData.get('price'),
            image: formData.get('image')
        };

        fetch('http://127.0.0.1:8000/api/menu', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('jwt_token')}`,
                'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                console.log('Menu item added:', data);
                fetchMenuItems(); // Refresh the menu items list
                form.reset(); // Clear the form
            })
            .catch(error => console.error('Error adding menu item:', error));
    });

    // Function to get a cookie value by name
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Simulate search bar interaction
    const searchBar = document.getElementById('search-bar');
    if (searchBar) {
        searchBar.addEventListener('input', function () {
            console.log('Searching for:', searchBar.value);
        });
    }

    // Simulate "Add User" button interaction
    const addUserButton = document.getElementById('add-user-btn');
    if (addUserButton) {
        addUserButton.addEventListener('click', function () {
            alert('Add User functionality coming soon!');
        });
    }
});

function loadUsers() {
    fetch('http://127.0.0.1:8000/api/users', {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => response.json())
        .then(data => {
            const userList = document.getElementById('user-list');
            userList.innerHTML = '';
            data.forEach(user => {
                userList.innerHTML += `
                    <tr>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>
                            <button onclick="deactivateUser(${user.id})">Deactivate</button>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(error => console.error('Error loading users:', error));
}

function filterUsers() {
    const searchValue = document.getElementById('search-users').value.toLowerCase();
    const rows = document.querySelectorAll('#user-list tr');
    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const email = row.cells[1].textContent.toLowerCase();
        row.style.display = name.includes(searchValue) || email.includes(searchValue) ? '' : 'none';
    });
}

function deactivateUser(userId) {
    if (confirm('Are you sure you want to deactivate this user?')) {
        fetch(`http://127.0.0.1:8000/api/users/${userId}/deactivate`, {
            method: 'PUT',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
            .then(response => response.json())
            .then(data => {
                alert('User deactivated successfully');
                loadUsers(); // Reload the user list
            })
            .catch(error => console.error('Error deactivating user:', error));
    }
}

// Load users on page load
document.addEventListener('DOMContentLoaded', loadUsers);