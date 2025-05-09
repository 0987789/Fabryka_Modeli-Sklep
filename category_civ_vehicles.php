<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabryka Modeli - Pojazdy Cywilne</title>
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
            </div>
        </div>

        <div class="container" id="content_main">
            <div class="container" id="content_suggested">
                <!-- Content will be added here -->
                <?php
                 include('PHP_scripts/civ_vehicles_content_script.php');
                 ?>
            </div>
        </div>

        <div class="container" id="footer">
            <div class="container" id="footer_left">
                
            </div>
            <div class="container" id="footer_right">
                
            </div>
        </div>
    </div>
</body>
</html>