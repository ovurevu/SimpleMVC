<?php


function redirectToIndex($session_status, $session_message){
    $_SESSION[$session_status] = $session_message;
    //Redirect to index
    header('location:index.php');
    exit();
}