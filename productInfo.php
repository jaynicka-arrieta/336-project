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
        <title> Product Info</title>
    </head>
    <body>
    <h3><?=$productInfo['productName']?></h3>
     <?=$productInfo['productDes']?><br>
     <img src='<?=$productInfo['productImg']?>' height='75'/>
 
    </body>
</html>