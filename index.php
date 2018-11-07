<?php
//Project Index
    include 'inc/functions.php';
    include 'inc/dbConnection.php';
    $dbConn = startConnection("fortnite");
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
    
    //added by sam
    function displayCategories() { 
        global $dbConn;
        
        $sql = "SELECT * FROM table_category ORDER BY catName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            echo "<option value='".$record['catID']."'>" . $record['catName'] . "</option>";
        }
    }
    function filterProducts() {
        global $dbConn;
        
        $namedParameters = array();
        $product = $_GET['productName'];
        
        //This SQL works but it doesn't prevent SQL INJECTION (due to the single quotes)
        //$sql = "SELECT * FROM om_product
        //        WHERE productName LIKE '%$product%'";
      
        $sql = "SELECT * FROM table_product WHERE 1"; //Gettting all records from database
        
        if (!empty($product)){
            //This SQL prevents SQL INJECTION by using a named parameter
             $sql .=  " AND productName LIKE :product OR productDes LIKE :product";
             $namedParameters[':product'] = "%$product%";
        }
        
        if (!empty($_GET['category'])){
            //This SQL prevents SQL INJECTION by using a named parameter
             $sql .=  " AND catID =  :category";
              $namedParameters[':category'] = $_GET['category'] ;
        }
        
        if(!empty($_GET['priceFrom'])) {
            $sql .= " AND price >= :priceFrom";
            $namedParameters["priceFrom"] = $_GET['priceFrom'];
        }
        
        if(!empty($_GET['priceTo'])) {
            $sql .= " AND price <= :priceTo";
            $namedParameters["priceTo"] = $_GET['priceTo'];
        }
        
        //echo $sql;
        
        if (isset($_GET['orderBy'])) {
            
            if ($_GET['orderBy'] == "productPrice") {
                
                $sql .= " ORDER BY price";
            } else {
                
                  $sql .= " ORDER BY productName";
            }
        }
    
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);  
        
        echo "<table class='table'>";
        foreach ($records as $record) {
            echo '<tr>';
            // echo "<a href='productInfo.php?productID=".$record['productID']."'>";
            //echo $record['productID'];
            echo "<td><img src='" . $record['productImg'] . " '></td>";
            echo "<td><h4>" . $record['productName'] . "</h4></td>";
            echo "<td><h4>[<a onclick='openModal()' target='productModal' href='productInfo.php?productID=".$record['productID']."'>". "More Info" ."</a>]</h4></td>";
            echo "<td><h4>" . " " . $record['price'] . " V-Bucks" . "</h4></td>";
           
            
            echo '</tr>';
        }
        echo "</table>";
    
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Products Page</title>
        
        <script>
            
            function openModal() {
                
                $('#myModal').modal("show");
            }
            
        </script>
        
    </head>
    <link rel='stylesheet' href='css/styles.css' type='text/css' />
    <style>
        img {
            width:200px;
        }
        body {
            background-image: url("img/4685.jpg"); /* new tag */
            background-size: 100%;
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
    
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'><img src="https://fontmeme.com/permalink/181107/4bb525cda1d6a2d85d45e7f20cd305b1.png" alt="tattoo-fonts"></a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href = 'cart.php'>
                        <span class = 'glyphicon glyphicon-shopping-cart' aria-hidden = 'true'>
                        </span> Cart: <?php displayCartCount(); ?> </a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <header>
                <!--<div id="dv_header"><h1>Welcome to Fortnite MiniMart!</h1></div>-->
                <img src="https://fontmeme.com/permalink/181107/4bb525cda1d6a2d85d45e7f20cd305b1.png" alt="tattoo-fonts" id="img_header">
            </header>
            </br></br>
            
            <!-- Search Form -->
            <center><div id="dv">
            <form>
                <table>
                    <tbody>
                    <tr>
                    <td><b>Product:</b> <input type="text" name="productName" placeholder="Product keyword" /> </br></br></td>
                    <td>
                        <b>Category:</b> 
                            <select name="category">
                               <option value=""> Select one </option>
                               <?=displayCategories()?>
                            </select>
                        </br></br>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <b>Price:</b> From: <input type="text" name="priceFrom" size="7"  /> 
                        To: <input type="text" name="priceTo" size="7" />
                    </br></br>
                    </td>
                    <td>
                        <b>Order By:</b>
                        Price <input type="radio" name="orderBy" value="productPrice">
                        Name <input type="radio" name="orderBy" value="productName">
                        </br></br>
                    </td>
                    </tr>
                    </tbody>
                </table>
                
                <input type="submit" name="submit" value="Search!"/>
            </form>
            </br></br>
            <hr>
            <?php
                if($_GET['submit'] == "Search!") {
                    echo "<h2> Results: </h2>";
                    // echo "<div id='dv2'";
                    filterProducts();
                    // echo "</div";
                }
            ?>
            
        </div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Product Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe name="productModal" width="450" height="250"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>            
    
    </body>
</html>



