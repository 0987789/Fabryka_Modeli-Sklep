<?php
include_once 'connect_script.php';
include_once 'functions_script.php';

$sql = "SELECT material_id as id, name, description, price, 'materials' as table_name FROM materials";
$result = $connection->query($sql);
product_tiles($result);
$connection->close();
?>