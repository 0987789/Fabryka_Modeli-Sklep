<?php
// Include the database connection and common functions
include_once 'connect_script.php';
include_once 'functions_script.php';

// Get materials products
$sql = "SELECT 
            material_id as id, 
            name, 
            description, 
            price,
            'materials' as table_name
        FROM 
            materials";

$result = $connection->query($sql);

// Display products
display_product_tiles($result);

// Close the connection
$connection->close();
?>