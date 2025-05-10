<?php
// Start the session to store cart data
session_start();

// Include the database connection script
include_once 'PHP_scripts/connect_script.php';
// Include the cart functions
include_once 'PHP_scripts/cart_script.php';

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart actions
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add_to_cart':
            // Add item to cart
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $product_table = isset($_POST['product_table']) ? $_POST['product_table'] : '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($product_id > 0 && $product_table != '') {
                add_to_cart($connection, $_SESSION['cart'], $product_id, $product_table, $quantity);
            }
            break;
            
        case 'update_quantity':
            // Update item quantity
            $cart_key = isset($_POST['cart_key']) ? $_POST['cart_key'] : '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($cart_key != '') {
                update_cart_quantity($_SESSION['cart'], $cart_key, $quantity);
            }
            break;
            
        case 'remove_item':
            // Remove item from cart
            $cart_key = isset($_POST['cart_key']) ? $_POST['cart_key'] : '';
            
            if ($cart_key != '') {
                remove_from_cart($_SESSION['cart'], $cart_key);
            }
            break;
            
        case 'clear_cart':
            // Clear the entire cart
            clear_cart($_SESSION['cart']);
            break;
    }
    
    // Redirect to avoid form resubmission
    header('Location: cart.php');
    exit;
}

// Process payment
$payment_message = '';
if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $valid_payment = false;
    
    switch ($payment_method) {
        case 'card':
            // Simple validation for card details
            if (!empty($_POST['card_number']) && !empty($_POST['card_expiry']) && !empty($_POST['card_cvv'])) {
                $valid_payment = true;
            }
            break;
            
        case 'blik':
            // Simple validation for BLIK code (6 digits)
            if (!empty($_POST['blik_code']) && strlen($_POST['blik_code']) == 6 && is_numeric($_POST['blik_code'])) {
                $valid_payment = true;
            }
            break;
            
        case 'gift_card':
            // Simple validation for gift card code (8 characters)
            if (!empty($_POST['gift_card_code']) && strlen($_POST['gift_card_code']) == 8) {
                $valid_payment = true;
            }
            break;
    }
    
    if ($valid_payment) {
        // In a real system, you would process the payment here
        $payment_message = 'Płatność zakończona sukcesem! Dziękujemy za zamówienie.';
        // Clear the cart after successful payment
        $_SESSION['cart'] = [];
    } else {
        $payment_message = 'Błąd płatności. Proszę sprawdzić wprowadzone dane.';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabryka Modeli - Koszyk</title>
    <link rel="icon" type="image/png" href="Assets/main_page/Logo_v2.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="main">
        <div class="container" id="navigation_main">
            <div class="container" id="navigation_logo"> <!-- logo of the store-->
                <a href="index.php">
                    <img src="Assets/main_page/Logo_v2.png" alt="logo" id="logo">
                </a>
            </div>
            <div class="container" id="navigation_bar">
                <ul>
                    <li><a href="category_military.php">Militaria</a></li>
                    <li><a href="category_civ_vehicles.php">Pojazdy Cywilne</a></li>
                    <li><a href="category_buildings.php">Budynki</a></li>
                    <li><a href="category_materials.php">Materiały</a></li>
                </ul>
            </div>
            <div class="container" id="navigation_misc">
                <a href="cart.php"><button>Koszyk</button></a>
                <button>Moje Konto</button>
            </div>
        </div>
        
        <div class="container" id="content_main">
            <div class="container" id="content_cart">
                <h1>Twój Koszyk</h1>
                
                <?php if (!empty($payment_message)): ?>
                    <div class="payment-message">
                        <?php echo htmlspecialchars($payment_message); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (empty($_SESSION['cart'])): ?>
                    <p>Twój koszyk jest pusty.</p>
                    <a href="index.php">Kontynuuj zakupy</a>
                <?php else: ?>
                    <!-- Cart items table -->
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Produkt</th>
                                <th>Cena</th>
                                <th>Ilość</th>
                                <th>Wartość</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_price = 0;
                            foreach ($_SESSION['cart'] as $cart_key => $item): 
                                $item_total = $item['price'] * $item['quantity'];
                                $total_price += $item_total;
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo number_format($item['price'], 2); ?> zł</td>
                                    <td>
                                        <form method="post" action="cart.php">
                                            <input type="hidden" name="action" value="update_quantity">
                                            <input type="hidden" name="cart_key" value="<?php echo $cart_key; ?>">
                                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px;">
                                            <button type="submit">Zmień</button>
                                        </form>
                                    </td>
                                    <td><?php echo number_format($item_total, 2); ?> zł</td>
                                    <td>
                                        <form method="post" action="cart.php">
                                            <input type="hidden" name="action" value="remove_item">
                                            <input type="hidden" name="cart_key" value="<?php echo $cart_key; ?>">
                                            <button type="submit">Usuń</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>Suma:</strong></td>
                                <td><strong><?php echo number_format($total_price, 2); ?> zł</strong></td>
                                <td>
                                    <form method="post" action="cart.php">
                                        <input type="hidden" name="action" value="clear_cart">
                                        <button type="submit">Wyczyść koszyk</button>
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="address-section">
                        
                    </div>
                    <!-- Payment options -->
                    <div class="payment-section">
                        <h2>Opcje Płatności</h2>
                        
                        <div class="payment-methods">
                            <button id="show-card-payment" class="payment-method-btn">Karta Płatnicza</button>
                            <button id="show-blik-payment" class="payment-method-btn">BLIK</button>
                            <button id="show-gift-card-payment" class="payment-method-btn">Karta Podarunkowa</button>
                        </div>
                        
                        <!-- Card payment form -->
                        <div id="card-payment-form" class="payment-form" style="display: none;">
                            <h3>Płatność Kartą</h3>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="payment_method" value="card">
                                <div>
                                    <label for="card_number">Numer karty:</label>
                                    <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                                </div>
                                <div>
                                    <label for="card_expiry">Data ważności:</label>
                                    <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/RR" required>
                                </div>
                                <div>
                                    <label for="card_cvv">CVV:</label>
                                    <input type="text" id="card_cvv" name="card_cvv" placeholder="123" required>
                                </div>
                                <button type="submit">Zapłać Kartą</button>
                            </form>
                        </div>
                        
                        <!-- BLIK payment form -->
                        <div id="blik-payment-form" class="payment-form" style="display: none;">
                            <h3>Płatność BLIK</h3>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="payment_method" value="blik">
                                <div>
                                    <label for="blik_code">Kod BLIK:</label>
                                    <input type="text" id="blik_code" name="blik_code" placeholder="123456" maxlength="6" required>
                                </div>
                                <button type="submit">Zapłać przez BLIK</button>
                            </form>
                        </div>
                        
                        <!-- Gift card payment form -->
                        <div id="gift-card-payment-form" class="payment-form" style="display: none;">
                            <h3>Karta Podarunkowa</h3>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="payment_method" value="gift_card">
                                <div>
                                    <label for="gift_card_code">Kod karty podarunkowej:</label>
                                    <input type="text" id="gift_card_code" name="gift_card_code" placeholder="12345678" maxlength="8" required>
                                </div>
                                <button type="submit">Użyj Karty Podarunkowej</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="container" id="footer">
            <div class="container" id="footer_left">
                
            </div>
            <div class="container" id="footer_right">
                
            </div>
        </div>
    </div>
    
    <script>
        // Simple JavaScript to toggle payment forms
        document.addEventListener('DOMContentLoaded', function() {
            // Get all payment buttons and forms
            const cardBtn = document.getElementById('show-card-payment');
            const blikBtn = document.getElementById('show-blik-payment');
            const giftCardBtn = document.getElementById('show-gift-card-payment');
            
            const cardForm = document.getElementById('card-payment-form');
            const blikForm = document.getElementById('blik-payment-form');
            const giftCardForm = document.getElementById('gift-card-payment-form');
            
            // Hide all forms initially
            function hideAllForms() {
                cardForm.style.display = 'none';
                blikForm.style.display = 'none';
                giftCardForm.style.display = 'none';
            }
            
            // Add click handlers
            if (cardBtn) {
                cardBtn.addEventListener('click', function() {
                    hideAllForms();
                    cardForm.style.display = 'block';
                });
            }
            
            if (blikBtn) {
                blikBtn.addEventListener('click', function() {
                    hideAllForms();
                    blikForm.style.display = 'block';
                });
            }
            
            if (giftCardBtn) {
                giftCardBtn.addEventListener('click', function() {
                    hideAllForms();
                    giftCardForm.style.display = 'block';
                });
            }
        });
    </script>
</body>
</html>