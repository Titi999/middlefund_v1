<?php 
include '../connection.php';
session_start();
echo $_GET[email];
$queryGet =mysqli_query($conn, "DELETE FROM notification  WHERE email='".$_GET[email]."'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>