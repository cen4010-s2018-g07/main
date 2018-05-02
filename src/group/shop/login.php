<?php
// M. Kaan Tasbas

/* form POST names

 login_username: inputUsername
 login_password: inputPassword
*/
    // connect to CEN4010_S2018g07 database. Creates $db pointer
    require_once("../include/database_connection.php");
    // include various custom functions
    require_once("../include/functions.php");
    
    session_start();

    $errors = [];

    $username = escape($_POST['inputUsername']);
    $password = escape($_POST['inputPassword']);

    // Check for empty inputs
    if(empty($username)) {
        array_push($errors, "Username is required");
    }
    if(empty($password)) {
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0) {  
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);       
        $password_query = "SELECT * FROM accounts WHERE username = '$username' LIMIT 1;"; 
        $password_result = $db->query($password_query);
        $password_row = mysqli_fetch_assoc($password_result);

        // Debug messages:
        //echo "Username: " . $username;
        //echo "<br>password_query: " . $password_query;
        //echo "<br>Hashed Password: " . $hashed_password;
        //echo "<br>DB Password: " . $password_row['password'];

        if(password_verify($password, $password_row['password'])){
            // account verification succeeded
            $_SESSION['login_id'] = $password_row['login_id'];
            // direct user to home page
            header('location: ../search/search.php');
        }
        else{
            // account verification failed
            echo "Invalid username/password. Try again.";
        }
    }
    else {
        // errors exist
        echo "Username/Password required. Try again.";
    }

    // close connection to database
    $db->close();
?>