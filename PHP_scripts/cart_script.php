<?php
// Function to calculate the total price of items in the cart
function calculate_cart_total($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Function to count the number of items in the cart
function count_cart_items($cart) {
    $count = 0;
    foreach ($cart as $item) {
        $count += $item['quantity'];
    }
    return $count;
}

// Function to get product details from database
function get_product_details($connection, $product_id, $product_table) {
    // Create the column name based on the table name
    // Check if the table name ends with 's' or is a special case
    if ($product_table === 'military') {
        $id_column = 'military_id';
    } else {
        // For regular tables that follow the plural naming convention
        $id_column = substr($product_table, 0, -1) . "_id";
    }
    
    $sql = "SELECT 
                name, 
                price
            FROM 
                $product_table
            WHERE 
                $id_column = ?";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        return $row;
    }
    
    return null;
}

// Function to add an item to the cart
function add_to_cart($connection, &$cart, $product_id, $product_table, $quantity = 1) {
    // Create a unique key for the product
    $cart_key = $product_table . '_' . $product_id;
    
    // Check if the product is already in the cart
    if (isset($cart[$cart_key])) {
        // Update quantity
        $cart[$cart_key]['quantity'] += $quantity;
    } else {
        // Get product details from database
        $product_details = get_product_details($connection, $product_id, $product_table);
        
        if ($product_details) {
            // Add new item to cart
            $cart[$cart_key] = [
                'id' => $product_id,
                'table' => $product_table,
                'name' => $product_details['name'],
                'price' => $product_details['price'],
                'quantity' => $quantity
            ];
        }
    }
}

// Function to update item quantity in the cart
function update_cart_quantity(&$cart, $cart_key, $quantity) {
    if (isset($cart[$cart_key])) {
        if ($quantity > 0) {
            $cart[$cart_key]['quantity'] = $quantity;
        } else {
            // Remove from cart if quantity is 0 or negative
            unset($cart[$cart_key]);
        }
    }
}

// Function to remove an item from the cart
function remove_from_cart(&$cart, $cart_key) {
    if (isset($cart[$cart_key])) {
        unset($cart[$cart_key]);
    }
}

// Function to clear the entire cart
function clear_cart(&$cart) {
    $cart = [];
}
?>