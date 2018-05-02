<?php
// M. Kaan Tasbas | mktasbas@gmail.com

/* form GET names

search: query
*/
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
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Results</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="css/shop-homepage.css">
        <link rel="stylesheet" href="css/search.css">
        <link rel="stylesheet" href="css/shop.css">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"> </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script><!-- log out -->    
    </head>

    <body>    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">OwlShack</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.html">Cart</a>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-default btn-sm" style="float: right">
                        <span class="glyphicon glyphicon-log-out"></span> Logout
                    </button>
                </div>
            </div>
        </nav>

        <div>
            <!--
                <img src="Logo-FAU.jpg" alt="FAU College of Engineering logo" class="logoResults">
            -->
        </div>

        <div class="parentButtonResults">
            <form class = "searchForm" action = "search.php" method = "GET">
                <input type="text" class="" placeholder="Search.." name="query">
                <button type="submit" class ="srh-btn">Search</button>
            </form>
            <br><br>
        </div>

        <?php
            // check if a search was made
            if(isset($_GET['query'])){
                $query = $_GET['query'];

                // check for search key length
                $min_length = 3;
                if(strlen($query) < $min_length) {
                    echo "\nMinimum length for search is ".$min_length;
                }
                else {
                    $query = htmlspecialchars($query);
                    $query = escape($query);

                    // prepare search query
                    $raw_results = mysqli_query($db, "SELECT * FROM inventory 
                            WHERE (part_desc LIKE '%".$query."%') OR (keyword1 LIKE '%".$query."%') OR (keyword2 LIKE '%".$query."%')") 
                        or die(mysqli_error($db));

                    // print database results from search query
                    if(mysqli_num_rows($raw_results) > 0) {
                        
                        echo "<br>";
                        echo "
                            <div class='container'>
                                <div class='row'>
                        ";
                        while($results = mysqli_fetch_array($raw_results)){
                            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                            echo "
                                <div class='card-deck col-lg-4 col-md-6 mb-4'>
                                    <div class='card mb-4 box-shadow'>
                                        <div class='card-body'>
                                            <h4 class='card-title'> $results['sku'] </h4>
                                            <p class='card-text'> $results['part_desc'] </p>
                                            <h5> Quantity: $results['quantity'] </h5>
                                            <div>
                                                <div id='quantity' >
                                                    <input id='inputQ' type='number' name='quantity' min='0' max='$results['quantity']' step='1' value='0'>
                                                </div>
                                                <div id = 'cart'>
                                                    <button  type='button' class='btn btn-lg btn-block btn-outline-primary'>Add To Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                            // posts results gotten from database(title and text) you can also show id ($results['id'])
                        }
                        echo "
                                </div>
                            </div>
                        ";
                    }
                    else {
                        echo "No matches found<br>";
                    }
                }
            }
            // close the database connection
            $db->close();
        ?>
    </body>
</html>