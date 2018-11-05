<?php
    include 'functions.php';
    //post submit
    session_start();
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (isset($_POST['productName'])) {
        $_SESSION['cart'] = $_POST['productName'];
    }
    
    if (isset($_POST['productName'])) {
        
        $newItem = array();
        $newItem['productName'] = $_POST['itemName'];
        $newItem['productDes'] = $_POST['itemDes'];
        $newItem['price'] = $_POST['itemPrice'];
        $newItem['productImg'] = $_POST['itemImg'];
        $newItem['productID'] = $_POST['itemID'];
        
        foreach ($_SESSION['cart'] as &$item) {
            if ($newItem['productID'] == $item['productID']) {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if ($found != true) {
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }

    }
    
    
    
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title> </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
</html>