<?php
include '../connection.php';
if (isset($_POST['login_btn'])) {
	$email = $_POST['useremail'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['name'];
        $_SESSION['email'] = $row['email'];
		$_SESSION['role'] = $row['user_type'];
        $_SESSION['user_image'] =  $row['user_image'];
        $_SESSION['location'] = $row['location'];
		if($_SESSION['role'] == "investor"){		
			
		header("Location: ../investor/index.php");
			}
		else {
			header("Location: ../startup/myindex.php");
		}	
	} else {
		$msg="Woops! Email or Password is Wrong.";
	}
}

?>	