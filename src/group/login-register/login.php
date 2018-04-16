<?php
// M. Kaan Tasbas

/* form POST names
 login_username: inputUsername
 login_password: inputPassword

 register_firstname: firstName
 register_lastname: lastName
 register_email: email
 register_znumber: zNumber
 register_phonenumber: phoneNumber
 register_password: password
 register_college: college
*/
    // connect to CEN4010_S2018g07 database. Creates $db pointer
    require_once("../database_connection.php");

    print_r($_POST);
    //$username = $_POST['inputUsername'];
    //$password = $_POST['inputPassword'];

    //echo "username: " . $username . " password: " . $password;

    // close connection to database
    $db->close();
?>
