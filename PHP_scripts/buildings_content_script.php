<?php
include_once 'connect_script.php';
include_once 'functions_script.php';

$sql = "SELECT building_id as id, name, description, price, 'buildings' as table_name FROM buildings";
$result = $connection->query($sql);
product_tiles($result);
$connection->close();
?>