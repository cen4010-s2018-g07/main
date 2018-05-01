<!doctype html>
<html>
    <body>
        <?php
            $con = mysql_connect("localhost", "root","");
            $db = mysql_select_db("cart");
            
            if($con){
                echo "Successfully connected.";
            }
        
            else {
                die("Error.");
            }
        ?>

    </body>

</html>


