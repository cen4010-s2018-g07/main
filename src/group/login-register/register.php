<?php
// M. Kaan Tasbas

/* form POST names

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
    // include various custom functions
    require_once("../functions.php");

    $errors = [];

    $first_name = escape($_POST['firstName']);
    $last_name = escape($_POST['lastName']);
    $email = escape($_POST['email']);
    $znumber = escape($_POST['zNumber']);
    $phone_number = escape($_POST['phoneNumber']);
    $password = escape($_POST['password']);
    $college = escape($_POST['college']);

    // Check for empty inputs
    if(empty($first_name)) {
        array_push($errors, "First Name is required");
    }
    if(empty($last_name)) {
        array_push($errors, "Last Name is required");
    }
    if(empty($email)) {
        array_push($errors, "Email is required");
    }
    if(empty($znumber)) {
        array_push($errors, "Znumber is required");
    }
    if(empty($password)) {
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0) {
        // No empty required fields
        
    }



?>