<?php
include_once 'connect_script.php';
include_once 'functions_script.php';

$sql = "SELECT civ_vehicle_id as id, name, description, price, 'civ_vehicles' as table_name FROM civ_vehicles";
$result = $connection->query($sql);
product_tiles($result);
$connection->close();
?>