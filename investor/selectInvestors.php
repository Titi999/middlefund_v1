<?php
session_start();
    include '../connection.php';
    
    $queryGet = mysqli_query($conn, "SELECT * FROM investor WHERE email='".$_SESSION["email"]."'");   
    $data = mysqli_fetch_array($queryGet);
?>