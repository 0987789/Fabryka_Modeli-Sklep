<?php
include_once 'connect_script.php';
include_once 'functions_script.php';

$sql = "
    (SELECT military_id as id, name, description, price, 'military' as table_name FROM military ORDER BY RAND() LIMIT 2)
    UNION
    (SELECT civ_vehicle_id as id, name, description, price, 'civ_vehicles' as table_name FROM civ_vehicles ORDER BY RAND() LIMIT 2)
    UNION
    (SELECT building_id as id, name, description, price, 'buildings' as table_name FROM buildings ORDER BY RAND() LIMIT 2)
    UNION
    (SELECT material_id as id, name, description, price, 'materials' as table_name FROM materials ORDER BY RAND() LIMIT 2)
    ORDER BY RAND() LIMIT 8";

$result = $connection->query($sql);
echo '<h2>Polecane produkty</h2>';
product_tiles($result);
$connection->close();
?>
