<?php
// M. Kaan Tasbas | mktasbas@gmail.com

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
    require_once("./include/database_connection.php");
    // include various custom functions
    require_once("./include/functions.php");

    session_start();

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
        //print_r($_POST);

        // get fau net id from email
        $email_parts = explode("@", $email);
        $username = $email_parts[0];

        // hash password for storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // prepare sql query to insert into users table
        $users_query = "INSERT INTO users VALUES ('$znumber', NULL, '$first_name', 
            '$last_name', '$email', '$phone_number', NULL, NULL);";
        $db->query($users_query);

        // prepare sql query to insert into accounts table
        $accounts_query = "INSERT INTO accounts VALUES (NULL, '$znumber', '$username', '$hashed_password');";
        $db->query($accounts_query);

        // get generated login_id and update users table with it
        $accounts_id = $db->insert_id;
        $users_login_id_query = "UPDATE users SET login_id = $accounts_id 
            WHERE znumber = $znumber;";
        $db->query($users_login_id_query);

        // set session login_id
        $_SESSION['login_id'] = $accounts_id;

        // direct to home page
        header('location: ./home.php');
    }
    else {
        echo "Missing fields. Redirecting to login page.";
        // return user back to registration page
        DelayedRedirect("./register.html", "2500");
    }

    // close connection to database
    $db->close();
?>