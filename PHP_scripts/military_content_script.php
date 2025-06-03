<?php
include_once 'connect_script.php';
include_once 'functions_script.php';

$sql = "SELECT military_id as id, name, description, price, 'military' as table_name FROM military";
$result = $connection->query($sql);
product_tiles($result);
$connection->close();
?>