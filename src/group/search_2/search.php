<?php
    require_once("../database_connection.php");
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Results</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
        <link rel="stylesheet" href="search.css">
        <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar">Home</nav>
            <img src="Logo-FAU.jpg" alt="FAU College of Engineering logo" class="logoResults">
        <div class="parentButtonResults">
            <form action = "search.php" method = "GET">
                <input type="text" name="query" class="searchbox" />  
                
            </form>
        </div>
        <?php
            $query = $_GET['query'];

            $min_length = 3;

            if(strlen($query) < $min_length) {
                echo "Minimum length for search is ".$min_length;
            }
            else {
                $query = htmlspecialchars($query);
                $query = mysqli_real_escape_string($db, $query);
                $raw_results = mysqli_query($db, "SELECT * FROM Inventory 
                    WHERE (part_desc LIKE '%".$query."%') OR (keyword1 LIKE '%".$query."%') OR (keyword2 LIKE '%".$query."%')") 
                    or die(mysqli_error($db));

                if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

                    echo "<p>Showing results for: ".ucfirst($query)."</p>";
                    echo "<div class='container'> <div class='row'>";
                    

                    while($results = mysqli_fetch_array($raw_results)){
                    // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                    
                        echo "<div class='card-deck col-lg-4 col-md-6 mb-4'>
                <div class='card mb-4 box-shadow'>
                <div class='card-body'><h4 class='card-title'>".$results['sku']."</h4><p class='card-text'>". $results['part_desc']."</p><h5>Quantity: ".$results['quantity']."</h5><div><div id='quantity' ><input id='inputQ'type='number' name='quantity' min='0' max=".$results['quantity']."step='1' value=''></div><div id = 'cart'><button  type='button' class='btn btn-lg btn-block btn-outline-primary'>Add To Cart</button></div></div></div></div></div>";
                        // posts results gotten from database(title and text) you can also show id ($results['id'])
                    }
                    echo "</div></div>";
                }
                else {
                    echo "No matches found<br>";
                }
            }
            $db->close();
        ?>
        <br>
        <form action="http://lamp.cse.fau.edu/~CEN4010_S2018g07">
            <input type="submit" value="Home" />
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <script> src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"</script>
    </body>
</html>
