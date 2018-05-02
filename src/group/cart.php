<!DOCTYPE html>
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

            <!-- Product 1 -->
            <div class="prodListDisplay">

                <div class="product-box">			   
                    <form action="cart.php" method="post">		   

                        <div class="productItem clearfix">

                            <div class="productTitle">
                                <h3>
                                    <span class="product-url">Item #1</span>	
                                </h3>

                            </div><!-- /.productTitle -->

                            <div class="purchaseBlock clearfix">	

                                <div class="productInput">
                                    <input name="quantity" type="number" value="1" title="Quantity for Another Awesome Product">
                                </div>

                                <div class="priceBlock">

                                    <span class="price currency">
                                        <small>$</small>456.32
                                    </span>

                                </div>

                                <a href="#" role="link" class="ct-removeSingle">
                                    <span class="ico">Remove</span>
                                </a>

                            </div><!-- /.purchaseBlock -->

                        </div><!-- /.productItem -->

                        <!-- Remove Single Product Confirmation -->
                        <div class="ct-confirmation-single">
                            <div class="centerContent">
                                <div class="centerContentInner">
                                    <p class="ct-removeSingleConfirmation clearfix">
                                        <span class="message">Remove this item?</span>
                                        <span class="ct-buttons ct-inline-buttons">
                                            <button class="btn-red ct-singleRemoveOK">OK</button>
                                            <button class="btn-blue ct-singleRemoveCancel">Cancel</button>
                                        </span>
                                    </p>

                                </div>
                            </div>
                        </div><!-- /.remove Confirmation -->

                    </form>

                </div><!-- /.product-box -->

            </div><!-- /.prodListDisplay -->  <!--end product 1-->

            <!-- Product 2 -->
            <div class="prodListDisplay">

                <div class="product-box">			   
                    <form action="cart.php" method="post">		   

                        <div class="productItem clearfix">

                            <div class="productTitle">
                                <h3>
                                    <span class="product-url">Item #2</span>	
                                </h3>

                            </div><!-- /.productTitle -->

                            <div class="purchaseBlock clearfix">	

                                <div class="productInput">
                                    <input name="quantity" type="number" value="1" title="Quantity for Another Awesome Product">
                                </div>

                                <div class="priceBlock">

                                    <span class="price currency">
                                        <small>$</small>456.32
                                    </span>

                                </div>

                                <a href="#" role="link" class="ct-removeSingle">
                                    <span class="ico">Remove</span>
                                </a>

                            </div><!-- /.purchaseBlock -->

                        </div><!-- /.productItem -->

                        <!-- Remove Single Product Confirmation -->
                        <div class="ct-confirmation-single">
                            <div class="centerContent">
                                <div class="centerContentInner">
                                    <p class="ct-removeSingleConfirmation clearfix">
                                        <span class="message">Remove this item?</span>
                                        <span class="ct-buttons ct-inline-buttons">
                                            <form action="cart.php" method="GET">
                                                <button class="btn-red ct-singleRemoveOK">OK</button>
                                                <button class="btn-blue ct-singleRemoveCancel">Cancel</button>
                                            </form>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div><!-- /.remove Confirmation -->

                    </form>

                </div><!-- /.product-box -->

            </div><!-- /.prodListDisplay --> <!--end product 2-->

        </div>

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