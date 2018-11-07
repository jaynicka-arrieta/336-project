<?php
//project functions
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
    function displayCart() {
        //If there are items in the Session, display them
        if(isset($_SESSION['cart'])) {
            
            echo "<table class='table'>";
            foreach ($_SESSION['cart'] as $item) {
                $itemId = $item['productID'];
                $itemQuant = $item['quantity'];
                
                echo '<tr>';
                
                //Display data for item
                echo "<td><img src='" . $item['productImg'] . " '></td>";
                echo "<td><h4>" . $item['productName'] . "</h4></td>";
                //echo "<td><h4>" . $item['productDes'] . "</h4></td>";
                echo "<td><h4>" . $item['price'] . " V-Bucks" . "</h4></td>";
                
                //Update form for this item
                echo '<form method="post">';
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<td><input type='text' name='update' class='form-control' placeHolder='$itemQuant'></td>";
                echo '<td><button class="btn btn-danger">Update<button></td>';
                echo '</form>';
                
                //Create seperate form for delete
                echo '<form method="post">';
                echo "<input type='hidden' name='removeId' value='$itemId'>"; // Hidden itemId to update correct item
                echo '<td><button class="btn btn-danger">Remove<button></td>';
                echo '</form>';
                
                echo '</tr>';
            }
            echo "</table>";
        }
        
    }
   

?>