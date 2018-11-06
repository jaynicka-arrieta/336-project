<?php

include '../../inc/dbConnection.php';
$dbConn = startConnection("ottermart");

function displayProductInfo(){
    global $dbConn;
    
    $productId = $_GET['productId'];
    $sql = "SELECT * 
            FROM om_purchase 
            NATURAL RIGHT JOIN om_product 
            WHERE productId = $productId";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAll returns an Array of Arrays
    
    echo "<img src='" . $records[0]['productImage'] . "'  width='150'>";
    
    if (empty($records[0]['purchaseId'])) {
        
        echo "<h3> Product hasn't been purchased yet </h3>";
        
    }
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Quantity</th><th>Unit Price</th><th> Purchase Date</th>";
    foreach ($records as $record) {
        echo "<tr>";    
        echo "<td>" . $record[quantity] . "</td>";
        echo "<td>" . $record[unitPrice] . "</td>";
        echo "<td>" . $record[purchaseDate] . "</td>";
        echo "</tr>";  
    }
    echo "</table>";
    
    //print_r($records);
    
}


?>


<!DOCTYPE html>
<html>
    <head>
        <title> Product Purchase History </title>
        <link rel='stylesheet' href='css/styles.css' type='text/css' />
    </head>
    <body>
        <center><div id = "tb">
            <hr>
            <h1>Product Purchase History</h1>
            <hr>
            <?=displayProductInfo()?>
            
            <hr>
        </div></center>

        
    </body>
</html>