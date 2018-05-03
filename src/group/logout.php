<?php
// M. Kaan Tasbas | mktasbas@gmail.com

if(isset($_SESSION['login_id'])){
    session_destroy();
    unset($_SESSION['login_id']);
}

header('location: login.html');