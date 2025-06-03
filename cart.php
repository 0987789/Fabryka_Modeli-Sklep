<?php
session_start();

include_once 'PHP_scripts/connect_script.php';
include_once 'PHP_scripts/cart_script.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add_to_cart':
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $product_table = isset($_POST['product_table']) ? $_POST['product_table'] : '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($product_id > 0 && $product_table != '') {
                add_to_cart($connection, $_SESSION['cart'], $product_id, $product_table, $quantity);
            }
            break;
            
        case 'update_quantity':
            $cart_key = isset($_POST['cart_key']) ? $_POST['cart_key'] : '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($cart_key != '') {
                update_cart_quantity($_SESSION['cart'], $cart_key, $quantity);
            }
            break;
            
        case 'remove_item':
            $cart_key = isset($_POST['cart_key']) ? $_POST['cart_key'] : '';
            
            if ($cart_key != '') {
                remove_from_cart($_SESSION['cart'], $cart_key);
            }
            break;
            
        case 'clear_cart':
            clear_cart($_SESSION['cart']);
            break;
            
        case 'checkout':
            if (!empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['postal_code'])) {
                $_SESSION['delivery_address'] = $_POST['address'] . ', ' . $_POST['postal_code'] . ' ' . $_POST['city'];
            }
            break;    
    }
    
    header('Location: cart.php');
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'checkout') {
    if (!empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['postal_code'])) {
        $_SESSION['delivery_address'] = $_POST['address'] . ', ' . $_POST['postal_code'] . ' ' . $_POST['city'];
    }
}

$payment_message = '';
if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $valid_payment = false;
    
    switch ($payment_method) {
        case 'card':
            if (!empty($_POST['card_number']) && !empty($_POST['card_expiry']) && !empty($_POST['card_cvv'])) {
                $valid_payment = true;
            }
            break;
            
        case 'blik':
            if (!empty($_POST['blik_code']) && strlen($_POST['blik_code']) == 6 && is_numeric($_POST['blik_code'])) {
                $valid_payment = true;
            }
            break;
            
        case 'gift_card':
            if (!empty($_POST['gift_card_code']) && strlen($_POST['gift_card_code']) == 8) {
                $valid_payment = true;
            }
            break;
    }
    
    if ($valid_payment) {
        $address_info = '';
        if (isset($_SESSION['delivery_address'])) {
            $address_info = '<br><strong>Dostawa na adres:</strong> ' . htmlspecialchars($_SESSION['delivery_address']);
            unset($_SESSION['delivery_address']);
        }
        
        $_SESSION['payment_message'] = 'Płatność została pomyślnie zrealizowana. Dziękujemy za zakupy!' . $address_info;
        $_SESSION['cart'] = [];
        header('Location: cart.php');
        exit;
    } else {
        $_SESSION['payment_message'] = 'Błąd płatności. Proszę sprawdzić wprowadzone dane.';
    }
}

if (isset($_SESSION['payment_message'])) {
    $payment_message = $_SESSION['payment_message'];
    unset($_SESSION['payment_message']);
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
        <div id="navigation_main">
            <div id="navigation_logo">
                <a href="index.php">
                    <img src="Assets/main_page/Logo_v2.png" alt="logo" id="logo">
                </a>
            </div>
            <div id="navigation_bar">
                <ul>
                    <li><a href="category_military.php">Militaria</a></li>
                    <li><a href="category_civ_vehicles.php">Pojazdy Cywilne</a></li>
                    <li><a href="category_buildings.php">Budynki</a></li>
                    <li><a href="category_materials.php">Materiały</a></li>
                </ul>
            </div>
            <div id="navigation_misc">
                <a href="cart.php"><button>Koszyk</button></a>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="account.php"><button>Moje Konto</button></a>';
                } else {
                    echo '<a href="login.php"><button>Moje Konto</button></a>';
                }
                ?>
            </div>
        </div>
        
        <div class="container" id="content_main">
            <div class="container" id="content_cart">
                <h1>Twój Koszyk</h1>
                
                <?php if (!empty($payment_message)): ?>
                    <div class="payment_message">
                        <?php echo $payment_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (empty($_SESSION['cart'])): ?>
                    <div class="empty_cart_message">
                    <p>Twój koszyk jest pusty.</p>
                    <a href="index.php">Kontynuuj zakupy</a>
                    </div>
                <?php else: ?>
                    <table class="cart_table">
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
                    <div class="checkout_address">
                        <h2>Adres Dostawy</h2>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="action" value="checkout">
                            <div>
                                <label for="address">Adres:</label>
                                <input type="text" id="address" name="address" placeholder="Wprowadź adres dostawy" required>
                            </div>
                            <div>
                                <label for="city">Miasto:</label>
                                <input type="text" id="city" name="city" placeholder="Wprowadź miasto" required>
                            </div>
                            <div>
                                <label for="postal_code">Kod pocztowy:</label>
                                <input type="text" id="postal_code" name="postal_code" placeholder="Wprowadź kod pocztowy" required>
                            </div>
                            <button type="submit">Zapisz Adres</button>
                        </form>
                        <?php if (isset($_SESSION['delivery_address'])): ?>
                            <p><strong>Zapisany adres:</strong> <?php echo htmlspecialchars($_SESSION['delivery_address']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="payment_section">
                        <h2>Opcje Płatności</h2>
                        
                        <div class="payment_methods">
                            <button id="show_card_payment" class="payment_method_btn">Karta Płatnicza</button>
                            <button id="show_blik_payment" class="payment_method_btn">BLIK</button>
                            <button id="show_gift_card_payment" class="payment_method_btn">Karta Podarunkowa</button>
                        </div>
                        
                        <div id="card_payment_form" class="payment_form" style="display: none;">
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
                        
                        <div id="blik_payment_form" class="payment_form" style="display: none;">
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
                        
                        <div id="gift_card_payment_form" class="payment_form" style="display: none;">
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
                <h4>Kontakt</h4>
                <p>Email: kontakt@fabrykamodeli.pl</p>
                <p>Tel: +48 123 456 789</p>
                <p>Adres: ul. Modelarska 1, 00-001 Warszawa</p>
            </div>
            <div class="container" id="footer_right">
                <h4>Informacje</h4>
                <ul>
                    <li><p>Regulamin</p></li>
                    <li><p>Polityka prywatności</p></li>
                    <li><p>Informacje o dostawie</p></li>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const card_btn = document.getElementById('show_card_payment');
            const blik_btn = document.getElementById('show_blik_payment');
            const gift_card_btn = document.getElementById('show_gift_card_payment');
            
            const card_form = document.getElementById('card_payment_form');
            const blik_form = document.getElementById('blik_payment_form');
            const gift_card_form = document.getElementById('gift_card_payment_form');
            
            function hideAllForms() {
                card_form.style.display = 'none';
                blik_form.style.display = 'none';
                gift_card_form.style.display = 'none';
            }
            
            if (card_btn) {
                card_btn.addEventListener('click', function() {
                    hideAllForms();
                    card_form.style.display = 'block';
                });
            }
            
            if (blik_btn) {
                blik_btn.addEventListener('click', function() {
                    hideAllForms();
                    blik_form.style.display = 'block';
                });
            }
            
            if (gift_card_btn) {
                gift_card_btn.addEventListener('click', function() {
                    hideAllForms();
                    gift_card_form.style.display = 'block';
                });
            }
        });
    </script>
</body>
</html>