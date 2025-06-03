<?php
function calculate_cart_total($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

function count_cart_items($cart) {
    $count = 0;
    foreach ($cart as $item) {
        $count += $item['quantity'];
    }
    return $count;
}

function get_product_details($connection, $product_id, $product_table) {
    if ($product_table === 'military') {
        $id_column = 'military_id';
    } 
    elseif ($product_table === 'civ_vehicles') {
        $id_column = 'civ_vehicle_id';
    }
    elseif ($product_table === 'buildings') {
        $id_column = 'building_id';
    }
    else {
        $id_column = 'material_id';
    }
    
    $sql = "SELECT name, price FROM $product_table WHERE $id_column = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        return $row;
    }
    return null;
}

function add_to_cart($connection, &$cart, $product_id, $product_table, $quantity = 1) {
    $cart_key = $product_table . '_' . $product_id;
    
    if (isset($cart[$cart_key])) {
        $cart[$cart_key]['quantity'] += $quantity;
    } else {
        $product_details = get_product_details($connection, $product_id, $product_table);
        
        if ($product_details) {
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

function update_cart_quantity(&$cart, $cart_key, $quantity) {
    if (isset($cart[$cart_key])) {
        if ($quantity > 0) {
            $cart[$cart_key]['quantity'] = $quantity;
        } else {
            unset($cart[$cart_key]);
        }
    }
}

function remove_from_cart(&$cart, $cart_key) {
    if (isset($cart[$cart_key])) {
        unset($cart[$cart_key]);
    }
}

function clear_cart(&$cart) {
    $cart = [];
}
?>