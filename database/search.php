<?php
    // Do not change the following two lines.
    $teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
    $server_root = dirname($_SERVER['PHP_SELF']);

    // You will need to require this file on EVERY php file that uses the database.
    // Be sure to use $db->close(); at the end of each php file that includes this!

    $dbhost = 'localhost';  // Most likely will not need to be changed
    $dbname = 'CEN4010_S2018g07';   // Needs to be changed to your designated table database name
    $dbuser = 'CEN4010_S2018g07';   // Needs to be changed to reflect your LAMP server credentials
    $dbpass = 'cengroup7'; // Needs to be changed to reflect your LAMP server credentials

    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Results</title>
        <link rel="stylesheet" href="search.css">
        <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar">Home</nav>
            <img src="Logo-FAU.jpg" alt="FAU College of Engineering logo" class="logoResults">
        <div class="parentButtonResults">
            <form action = "search.php" method = "GET">
                <input type="text" name="query" />
                <input type="submit" value="Search" />
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
                    echo "<div id='outer'> <div class='results'>";

                    while($results = mysqli_fetch_array($raw_results)){
                    // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                    
                        echo "<ul id='searchResult'><li>SKU: ".$results['sku']."<br />Description: ".$results['part_desc']."<br />Quantity: ".$results['quantity']."</ul>";
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
    </body>
</html>
