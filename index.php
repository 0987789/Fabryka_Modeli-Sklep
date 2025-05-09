<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabryka Modeli</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS -->
</head>
<body>
    <div cllass="container" id="main"> <!-- Whole body of the page -->
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
        <div class="container" id="content_main"> <!-- container with page content-->
            <div class="container" id="content_suggested"> <!-- container for main page content -->
                <?php
                 include('PHP_scripts/index_content_script.php');
                 ?>
            </div>
        </div>
        <div class="container" id="footer"> <!-- divider for footer-->
            <div class="container" id="footer_left"> <!-- left side of the footer with informations for customer-->

            </div>

            <div class="container" id="footer_right"> <!-- right side of the footer with information about store-->

            </div>
        </div>
    </div>
</body>
</html>