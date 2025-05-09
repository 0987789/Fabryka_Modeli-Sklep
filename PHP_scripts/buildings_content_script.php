<?php
// Include the database connection and common functions
include_once 'connect_script.php';
include_once 'functions_script.php';

// Get buildings products
$sql = "SELECT 
            building_id as id, 
            name, 
            description, 
            price,
            'buildings' as table_name
        FROM 
            buildings";

$result = $connection->query($sql);

// Display products
display_product_tiles($result);

// Close the connection
$connection->close();
?>