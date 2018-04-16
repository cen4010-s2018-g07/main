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
    require_once("../functions.php");

    $errors = [];

    $username = escape($_POST['inputUsername']);
    $password = escape($_POST['inputPassword']);

    if(empty($username)) {
        array_push($errors, "Username is required");
    }
    if(empty($password)) {
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0) {
        //echo "Username: " . $username;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        //echo "<br>Hashed Password: " . $hashed_password;
        $password_query = "SELECT * FROM accounts WHERE username = '$username' LIMIT 1;";
        
        //echo "<br>password_query: " . $password_query;
        
        $password_result = $db->query($password_query);
        $password_row = mysqli_fetch_assoc($password_result);

        //echo "<br>DB Password: " . $password_row['password'];

        if(password_verify($password, $password_row['password'])){
            // account verified
            echo "<br>Account exists. Username: " . $username;
        }
        else{
            // password failed verification
            echo "<br>Invalid username/password. Try again.";
        }
    }
    else {
        // errors exist
        echo "Username/Password required. Try again.";
    }

    // close connection to database
    $db->close();
?>
