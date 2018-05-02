<?php
// M. Kaan Tasbas | mktasbas@gmail.com

/* form POST names

sku = sku
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

    // get user znumber
    $znumber_query = "SELECT * FROM accounts WHERE login_id = '$_SESSION['login_id'];";
    $znumber_result = $db->query($znumber_query);
    $znumber_row = mysqli_fetch_assoc($znumber_result);
    $znumber = $znumber_row['znumber'];

    // get item_id
    $item_query = "SELECT * FROM inventory WHERE sku = $_POST['sku'];";
    $item_result = $db->query($item_query);
    $item_row = mysqli_fetch_assoc($item_result);
    $item_id = $item_row['item_id'];

    // remove item from cart
    $delete_query = "DELETE FROM carts WHERE znumber = '$znumber' AND item_id = '$item_id';";
    $delete_result = $db->query($delete_query);

    // send user back to cart page
    header('location: cart.php');
    // close connection to db
    $db->close();