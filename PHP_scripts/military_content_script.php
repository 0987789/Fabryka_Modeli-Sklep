<?php
// Include the database connection and common functions
include_once 'connect_script.php';
include_once 'functions_script.php';

// Get military products
$sql = "SELECT 
            military_id as id, 
            name, 
            description, 
            price,
            'military' as table_name
        FROM 
            military";

$result = $connection->query($sql);

// Display products
display_product_tiles($result);

// Close the connection
$connection->close();
?>