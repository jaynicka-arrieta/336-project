<?php
    //Project cart
    session_start();
    include 'inc/functions.php';
    include 'inc/dbConnection.php';
    $dbConn = startConnection("fortnite");
    if (isset($_POST['removeId'])) {
        foreach ($_SESSION['cart'] as $itemKey => $item) {
            if ($item['productID'] == $_POST['removeId']) {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    if(isset($_POST['itemId'])) {
        foreach($_SESSION['cart'] as &$item) {
            if($item['productID'] == $_POST['itemId']) {
                $item['quantity'] = $_POST['update'];
            }
        }
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
        <title>Shopping Cart</title>
    </head>
    <link rel='stylesheet' href='css/styles.css' type='text/css' />
    <body>
        <div class='container'>
            <div class='text-center'>
                
                <!-- Bootstrap Navagation Bar -->
                <nav class='navbar navbar-default - navbar-fixed-top'>
                    <div class='container-fluid'>
                        <div class='navbar-header'>
                            <a class='navbar-brand' href='#'><img src="https://fontmeme.com/permalink/181107/4bb525cda1d6a2d85d45e7f20cd305b1.png" alt="tattoo-fonts" width="200px"></a>
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
                <h2>Shopping Cart</h2>
                <?php displayCart(); ?>
            </div>
        </div>
    </body>
</html>