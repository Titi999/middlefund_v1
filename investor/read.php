<?php 
include '../connection.php';
session_start();
 $queryGet =mysqli_query($conn, "UPDATE notification SET status='read', date = date WHERE id='".$_GET[id]."' AND email='".$_SESSION['email']."'");
    header('Location: ' . $_SERVER['HTTP_REFERER']);

    
?>