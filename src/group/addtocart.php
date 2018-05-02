<?php
// M. Kaan Tasbas | mktasbas@gmail.com

/* form POST names

quantity = quantity
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
    $znumber_query = "SELECT * FROM accounts WHERE login_id = '$_SESSION['login_id'];"
    $znumber_result = $db->query($znumber_query);
    $znumber_row = mysqli_fetch_assoc($znumber_result);
    $znumber = $znumber_row['znumber'];

    // get item_id of sku
    $item_query = "SELECT * FROM inventory WHERE sku = $_POST['sku'];"
    $item_result = $db->query($item_query);
    $item_row = mysqli_fetch_assoc($item_result);
    $item_id = $item_row['item_id'];

    // insert into carts
    $carts_query = "INSERT INTO carts VALUES ('$znumber', $item_id, $_POST['quantity'], NULL);";
    $db->query($carts_query);

    // send user to carts page
    header('location: cart.html')
    // close connection to database
    $db->close();