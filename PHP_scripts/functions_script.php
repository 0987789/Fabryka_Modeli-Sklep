<?php
function product_tiles($result) {
    echo '<div class="product_grid">';
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $img_path = "Assets/products/" . $row['table_name'] . "/" . $row['id'] . ".jpg";
            
            echo '<div class="product_card">';
            echo '<div class="product_image_container">';
            echo '<img src="' . $img_path . '" alt="' . $row['name'] . '" onerror="this.src=\'Assets/products/no_image.jpg\'">';
            echo '</div>';
            echo '<div class="product_info">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<div class="price_cart_wrapper">';
            echo '<p class="product_price">' . $row['price'] . ' zł</p>';
            echo '<form method="post" action="cart.php">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<input type="hidden" name="product_table" value="' . $row['table_name'] . '">';
            echo '<input type="hidden" name="action" value="add_to_cart">';
            echo '<button type="submit">Dodaj do koszyka</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Brak produktów w tej kategorii.</p>';
    }
    
    echo '</div>';
}
?>