<?php
// M. Kaan Tasbas | mktasbas@gmail.com

    // check if user is logged in
    session_start();
    if(!isset($_SESSION['login_id'])){
        header('location: login.html');
        exit();
    }

    // connect to CEN4010_S2018g07 database. Creates $db pointer
    require_once("./include/database_connection.php");
    // include various custom functions
    require_once("./include/functions.php");

    // get user znumber
    $login_id = $_SESSION['login_id'];
    $znumber_query = "SELECT * FROM accounts WHERE login_id = $login_id;";
    $znumber_result = $db->query($znumber_query);
    $znumber_row = mysqli_fetch_assoc($znumber_result);
    $znumber = $znumber_row['znumber'];

    // get cart info
    $carts_query = "SELECT * FROM carts WHERE znumber = '$znumber';";
    $carts_result = $db->query($carts_query);
?>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Cart</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/shop-homepage.css" rel="stylesheet">
        <link href="css/cart.css" rel="stylesheet">

        <!-- Search -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Log out -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- log out -->

        <!-- Cart -->
        <script src="cart.js"></script>
    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="home.php">OwlShack</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="cart.php">Cart
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-default btn-sm" style="float: right">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                    </button>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <br><br>
        <div id="ct-content">

            <h1>Shopping Cart</h1>

            <?php
                if(mysqli_num_rows($carts_result) > 0) {
                    while($results = mysqli_fetch_array($carts_result)) {

                        // get item sku
                        $item_id = $results['item_id'];
                        $item_query = "SELECT * FROM inventory WHERE item_id = $item_id;";
                        $item_result = $db->query($item_query);
                        $item_row = mysqli_fetch_assoc($item_result);
                        $sku = $item_row['sku'];

                        $price = $item_row['price_each'];
                        $price = $price * $results['quantity'];

                        echo "
                        <!-- Product 1 -->
                        <div class='prodListDisplay'>
                            <div class='product-box'>			   
                                <form action='addtocart.php' method='POST'>		   
                                    <div class='productItem clearfix'>
                                        <div class='productTitle'>
                                            <h3>
                                                <span class='product-url'>". $sku ."</span>
                                                <input name='sku' type='hidden' value='". $sku ."'>
                                            </h3>
                                        </div><!-- /.productTitle -->
                                        <div class='purchaseBlock clearfix'>	
                                            <div class='productInput'>
                                                <input name='quantity' type='number' value='". $results['quantity'] ."'>
                                            </div>
                                            <div class='priceBlock'>
                                                <span class='price currency'>
                                                    <small>$</small>". $price ."
                                                </span>
                                            </div>
                                            <a href='#' role='link' class='ct-removeSingle'>
                                                <span class='ico'>Remove</span>
                                            </a>
                                        </div><!-- /.purchaseBlock -->
                                    </div><!-- /.productItem -->
                                    <!-- Remove Single Product Confirmation -->
                                    <div class='ct-confirmation-single'>
                                        <div class='centerContent'>
                                            <div class='centerContentInner'>
                                                <p class='ct-removeSingleConfirmation clearfix'>
                                                    <span class='message'>Remove this item?</span>
                                                    <span class='ct-buttons ct-inline-buttons'>
                                                        <button class='btn-red ct-singleRemoveOK'>OK</button>
                                                        <button class='btn-blue ct-singleRemoveCancel'>Cancel</button>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div><!-- /.remove Confirmation -->
                                </form>
                            </div><!-- /.product-box -->
                        </div><!-- /.prodListDisplay -->  <!--end product 1-->
                        ";
                    }
                }
            ?>
        <!-- Checkout -->
        <div class="checkout">
            <button type="submit" class="chk-btn">Check Out</button>
        </div>

        <!-- Footer -->
        <div id="footer"></div>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
