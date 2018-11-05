<?php
    include 'inc/functions.php';
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
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Fortnite Mini Mart</a>
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
                <h1>Welcome to Fortnite Mini Mart!</h1>
            </header>
            </br></br>
            
            <!-- Search Form -->
            <center><div id="dv">
            <form>
                
                <b>Product:</b> <input type="text" name="productName" placeholder="Product keyword" /> </br></br>
                
                <b>Category:</b> 
                <select name="category">
                   <option value=""> Select one </option>  
                </select>
                </br></br>
                
                <b>Price:</b> From: <input type="text" name="priceFrom" size="7"  /> 
                 To: <input type="text" name="priceTo" size="7" />
                </br></br>
                <b>Order By:</b>
                Price <input type="radio" name="orderBy" value="productPrice">
                Name <input type="radio" name="orderBy" value="productName">
                </br></br>
                <input type="submit" name="submit" value="Search!"/>
            </form>
            </br></br>
            <hr>
            
        </div>
    </div>
    </body>
</html>