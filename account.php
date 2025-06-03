<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$connection = include('PHP_scripts/connect_script.php');

$user_id = (int)$_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $connection->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabryka Modeli - Moje Konto</title>
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
            </div>
        </div>

        <div class="container" id="content_main">
            <div class="container" id="account_info">
                <h2>Moje Konto</h2>
                
                <div class="user_details">
                    <h3>Dane osobowe</h3>
                    <p><strong>Login:</strong> <?php echo htmlspecialchars($user['login']); ?></p>
                    <p><strong>Imię:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Nazwisko:</strong> <?php echo htmlspecialchars($user['surname']); ?></p>
                    <p><strong>E-mail:</strong> <?php echo htmlspecialchars($user['e_mail']); ?></p>
                    <?php if (!empty($user['address'])): ?>
                        <p><strong>Adres:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="logout_section">
                    <form action="PHP_scripts/logout_script.php" method="post">
                        <button type="submit" class="logout_button">Wyloguj się</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
