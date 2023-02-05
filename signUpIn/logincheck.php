<?php
include '../connection.php';

function check_login($conn)
{
    if(empty(isset($_SESSION['username']))){
        header("Location: ../signUpIn/signup.php");
    }

}
?>