<?php
// Function to sanitize output (prevent XSS)
function sanitize_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Function to display product tiles
function display_product_tiles($result) {
    // Start product grid container
    echo '<div class="product-grid">';
    
    // Check if there are products
    if ($result && $result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Get product image path
            $img_path = "Assets/products/" . $row['table_name'] . "/" . $row['id'] . ".jpg";
            
            // Display product tile
            echo '<div class="product-tile">';
            
            // Product image
            echo '<div class="product-image">';
            echo '<img src="' . $img_path . '" alt="' . sanitize_output($row['name']) . '" onerror="this.src=\'Assets/products/no-image.jpg\'">';
            echo '</div>';
            
            // Product details
            echo '<div class="product-details">';
            echo '<h3 class="product-title">' . sanitize_output($row['name']) . '</h3>';
            
            // Product description (shortened)
            $short_desc = substr($row['description'], 0, 100) ;
            echo '<p class="product-description">' . sanitize_output($short_desc) . '</p>';
            
            // Product price
            echo '<p class="product-price">' . number_format($row['price'], 2) . ' zł</p>';
            
            // Add to cart form - Fixed form action to properly submit to cart.php
            echo '<form class="add-to-cart-form" method="post" action="cart.php">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<input type="hidden" name="product_table" value="' . $row['table_name'] . '">';
            echo '<input type="hidden" name="action" value="add_to_cart">';
            echo '<button type="submit" class="add-to-cart-button">Dodaj do koszyka</button>';
            echo '</form>';
            
            echo '</div>'; // Close product-details
            echo '</div>'; // Close product-tile
        }
    } else {
        echo '<p class="no-products">Brak produktów w tej kategorii.</p>';
    }
    
    // Close product grid container
    echo '</div>';
}
?>