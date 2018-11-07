<?php

include 'inc/dbConnection.php';
    $dbConn = startConnection("fortnite");

function displayProductInfo(){
    global $dbConn;
    
    $productId = $_GET['productId'];
    $sql = "SELECT * 
            FROM table_purchase 
            NATURAL RIGHT JOIN table_product";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAll returns an Array of Arrays
    
    // echo "<img src='" . $records[0]['productImage'] . "'  width='150'>";
    
    // if (empty($records[0]['purchaseId'])) {
        
    //     echo "<h3> Product hasn't been purchased yet </h3>";
        
    // }
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th><th>Quantity</th><th>Unit Price</th><th> Purchase Date</th>";
    foreach ($records as $record) {
        if (!$record['quanitity']) {
            $record['quanitity'] = 0;
        }
        echo "<tr>";
        echo "<td>" . $record['productName'] . "</td>";
        echo "<td><center>" . $record['quanitity'] . "</center></td>";
        echo "<td><center>" . $record['price'] . "</center></td>";
        echo "<td><center>" . $record['purchaseDate'] . "</center></td>";
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
    <link rel='stylesheet' href='css/styles.css' type='text/css' />
    <style>
        img {
            width:200px;
        }
        body {
            background-image: url("img/4685.jpg"); /* new tag */
            background-size: 100%;
            color: white;
        } 
        header {
            text-align:center;
            width: 100%;
        }
        #img_header {
            width:650px;
        }
    </style>
    <body>
        <center><div id = "tb">
            <hr>
            <h1>Product Purchase History</h1>
            <hr>
            <?=displayProductInfo()?>
            </br></br>
            <form action="index.php">
                <input type="submit" name="history" value="Return"/>
            </form>
            <hr>
        </div></center>

        
    </body>
</html>