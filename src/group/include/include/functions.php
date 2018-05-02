<?php
// M. Kaan Tasbas

function escape($str){
    global $db;
    return mysqli_real_escape_string($db, trim($str));
}

?>