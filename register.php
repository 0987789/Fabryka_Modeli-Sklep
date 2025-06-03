<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabryka Modeli - Rejestracja</title>
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
            </div>
        </div>

        <div class="container" id="content_main">
            <div class="container" id="register_form">
                <h2>Rejestracja</h2>
                
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'login_exists') {
                        echo '<p style="color: red;">Ten login jest już zajęty. Wybierz inny.</p>';
                    } elseif ($_GET['error'] == 'email_exists') {
                        echo '<p style="color: red;">Ten adres e-mail jest już w użyciu. Użyj innego.</p>';
                    }
                }
                ?>
                
                <form action="PHP_scripts/register_script.php" method="post">
                    <div class="form_group">
                        <label for="login">Login:</label>
                        <input type="text" id="login" name="login" required>
                    </div>
                    
                    <div class="form_group">
                        <label for="password">Hasło:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form_group">
                        <label for="name">Imię:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form_group">
                        <label for="surname">Nazwisko:</label>
                        <input type="text" id="surname" name="surname" required>
                    </div>
                    
                    <div class="form_group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form_group">
                        <button type="submit">Zarejestruj się</button>
                    </div>
                </form>
                
                <div class="login_link">
                    <p>Masz już konto? <a href="login.php">Zaloguj się</a></p>
                </div>
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