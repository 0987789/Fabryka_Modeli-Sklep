document.addEventListener('DOMContentLoaded', function() {
    // Sample cart data (in a real application, this would come from a backend)
    let cartItems = [
        {
            id: 1,
            name: "Model Czołgu T-34",
            price: 89.99,
            quantity: 2,
            image: "Assets/main_page/example_product.jpg"
        },
        {
            id: 2,
            name: "Model Samolotu Spitfire",
            price: 129.99,
            quantity: 1,
            image: "Assets/main_page/example_product.jpg"
        }
    ];

    // DOM Elements
    const cartItemsContainer = document.querySelector('.cart_items');
    const subtotalElement = document.querySelector('.subtotal');
    const shippingElement = document.querySelector('.shipping');
    const totalElement = document.querySelector('.total_amount');
    const checkoutButton = document.querySelector('.checkout_button');

    // Render cart items
    function renderCart() {
        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="empty_cart">
                    <p>Twój koszyk jest pusty</p>
                    <a href="index.html" class="continue_shopping">Kontynuuj zakupy</a>
                </div>
            `;
            return;
        }

        cartItemsContainer.innerHTML = cartItems.map(item => `
            <div class="cart_item" data-id="${item.id}">
                <img src="${item.image}" alt="${item.name}" class="cart_item_image">
                <div class="cart_item_details">
                    <div class="cart_item_name">${item.name}</div>
                    <div class="cart_item_price">${item.price.toFixed(2)} zł</div>
                    <div class="cart_item_quantity">
                        <button class="quantity_button minus">-</button>
                        <input type="number" class="quantity_input" value="${item.quantity}" min="1">
                        <button class="quantity_button plus">+</button>
                    </div>
                    <button class="remove_item">Usuń</button>
                </div>
            </div>
        `).join('');

        // Add event listeners to quantity buttons and remove buttons
        addCartEventListeners();
        
        // Update totals
        updateTotals();
    }

    // Add event listeners to cart items
    function addCartEventListeners() {
        // Quantity buttons
        document.querySelectorAll('.quantity_button').forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart_item');
                const itemId = parseInt(cartItem.dataset.id);
                const input = cartItem.querySelector('.quantity_input');
                const currentValue = parseInt(input.value);

                if (this.classList.contains('minus')) {
                    if (currentValue > 1) {
                        input.value = currentValue - 1;
                        updateItemQuantity(itemId, currentValue - 1);
                    }
                } else {
                    input.value = currentValue + 1;
                    updateItemQuantity(itemId, currentValue + 1);
                }
            });
        });

        // Quantity input changes
        document.querySelectorAll('.quantity_input').forEach(input => {
            input.addEventListener('change', function() {
                const cartItem = this.closest('.cart_item');
                const itemId = parseInt(cartItem.dataset.id);
                const newValue = parseInt(this.value);
                
                if (newValue >= 1) {
                    updateItemQuantity(itemId, newValue);
                } else {
                    this.value = 1;
                    updateItemQuantity(itemId, 1);
                }
            });
        });

        // Remove buttons
        document.querySelectorAll('.remove_item').forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart_item');
                const itemId = parseInt(cartItem.dataset.id);
                removeItem(itemId);
            });
        });
    }

    // Update item quantity
    function updateItemQuantity(itemId, newQuantity) {
        const item = cartItems.find(item => item.id === itemId);
        if (item) {
            item.quantity = newQuantity;
            updateTotals();
        }
    }

    // Remove item from cart
    function removeItem(itemId) {
        cartItems = cartItems.filter(item => item.id !== itemId);
        renderCart();
    }

    // Update cart totals
    function updateTotals() {
        const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const shipping = subtotal > 0 ? 15.00 : 0;
        const total = subtotal + shipping;

        subtotalElement.textContent = `${subtotal.toFixed(2)} zł`;
        shippingElement.textContent = `${shipping.toFixed(2)} zł`;
        totalElement.textContent = `${total.toFixed(2)} zł`;

        // Disable checkout button if cart is empty
        checkoutButton.disabled = cartItems.length === 0;
        checkoutButton.style.opacity = cartItems.length === 0 ? '0.5' : '1';
    }

    // Checkout button handler
    checkoutButton.addEventListener('click', function() {
        if (cartItems.length > 0) {
            // Here you would typically redirect to a checkout page
            alert('Przekierowanie do kasy...');
        }
    });

    // Initial render
    renderCart();
}); 