<?php
// Include the database connection and common functions
include_once 'connect_script.php';
include_once 'functions_script.php';

// Get civilian vehicles products
$sql = "SELECT 
            civ_vehicle_id as id, 
            name, 
            description, 
            price,
            'civ_vehicles' as table_name
        FROM 
            civ_vehices";

$result = $connection->query($sql);

// Display products
display_product_tiles($result);

// Close the connection
$connection->close();
?>