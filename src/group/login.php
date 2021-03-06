<?php
// M. Kaan Tasbas | mktasbas@gmail.com

/* form POST names

 login_username: inputUsername
 login_password: inputPassword
*/
    // connect to CEN4010_S2018g07 database. Creates $db pointer
    require_once("./include/database_connection.php");
    // include various custom functions
    require_once("./include/functions.php");
    
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
        // get row from accounts       
        $password_query = "SELECT * FROM accounts WHERE username = '$username' LIMIT 1;"; 
        $password_result = $db->query($password_query);
        $password_row = mysqli_fetch_assoc($password_result);

        // Debug messages:
        //echo "Username: " . $username;
        //echo "<br>password_query: " . $password_query;
        //echo "<br>Hashed Password: " . $hashed_password;
        //echo "<br>DB Password: " . $password_row['password'];

        // verify hashed passwords
        if(password_verify($password, $password_row['password'])){
            // account verification succeeded
            $_SESSION['login_id'] = $password_row['login_id'];
            // direct user to home page
            header('location: ./home.php');
        }
        else{
            // account verification failed
            echo "Invalid username/password. Redirecting to login page.";
            // redirect user back to login after 2.5 seconds
            DelayedRedirect("./login.html", "2500");
        }
    }
    else {
        // errors exist
        echo "Username/Password required. Redirecting to login page.";
        // redirect user back to login after 2.5 seconds
        DelayedRedirect("./login.html", "2500");
    }

    // close connection to database
    $db->close();
?>