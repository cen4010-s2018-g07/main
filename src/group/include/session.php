<?php
    // M. Kaan Tasbas | mktasbas@gmail.com

    // connect to CEN4010_S2018g07 database. Creates $db pointer
    require_once("../include/database_connection.php");
    // include various custom functions
    require_once("../include/functions.php");
    // start user session
    
    session_start();
    // check session user
    $session_login_id = $_SESSION['login_id'];
    $prepared_query = $db->prepare("SELECT login_id FROM accounts WHERE login_id = ?");
    $prepared_query->bind_param("s", $session_login_id);
    $prepared_query->execute();
    
    $prepared_query->bind_result($query_login_id);
    $prepared_query->fetch();
      
    if(!($session_login_id == $query_login_id)) {
        // session user does not have a valid account
        // close the connection to db
        $db->close();
        // redirect to login page
        header('location: ../login-register/login.html');
    }
?>