<?php

session_start();
if (isset($_GET["token"])) {
    include '../connection.php';
    $sql = "UPDATE users SET status='1' WHERE token='{$_GET["token"]}'";
    mysqli_query($conn, $sql);
    
    $showUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE token='{$_GET["token"]}'"));
    $_SESSION["user_id"] = $showUser['id'];
    $_SESSION["username"] = $showUser['name'];
    $_SESSION["email"] = $showUser['email'];
    $_SESSION["user_type"] = $showUser['user_type'];

    if($_SESSION['user_type'] == "startup"){
        header("Location: ../startup/myindex.php");
    }
    elseif($_SESSION['user_type'] == "investor"){
        $stmt = $conn -> prepare("SELECT * FROM investor WHERE email ='{$_SESSION["email"]}'");
        $stmt ->execute();
        $result =$stmt ->get_result();       
        $row=$result->fetch_assoc();
        if(empty($row['regAs'])) {      
            header("Location: ../investor/investorInfo/index.php");
        }
        else{
            header("Location: ../investor/index.php");
        }
    }
} else {
    header("Location: index.php");
}

?>