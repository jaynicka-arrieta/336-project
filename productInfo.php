<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("fortnite");
include 'inc/functions.php';

if (isset($_GET['productID'])) {
  $productInfo = getProductInfo($_GET['productID']);    
  //print_r($productInfo);
}

function getProductInfo($productID) {
    global $dbConn;
    $sql = "SELECT * FROM table_product WHERE productID = $productID";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return $record;
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Product Info </title>
    </head>
    <style> 
        img {
            width: 20%;
        }
    </style>
    <body>
    <h3><?=$productInfo['productName']?></h3>
     Description: <?=$productInfo['productDes']?>
     <br>
     <br>
     <img src='<?=$productInfo['productImg']?>'/>
     
    </body>
</html>