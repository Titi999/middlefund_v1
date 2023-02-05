<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

<?php 
session_start();
include '../connection.php';

error_reporting(0);



if (isset($_SESSION['username'])) {
    header("Location: signup.php");
}

if (isset($_POST['register_btn'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$user_type = $_POST['user_type'];

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!($result->num_rows > 0)) {
			$sql = "INSERT INTO users (name, email, user_type, password )
					VALUES ('$username', '$email', '$user_type', '$password')";
			$result = mysqli_query($conn, $sql);
                if($user_type == "startup"){
            $sql1 = "INSERT INTO startup (email) 
                        VALUES('$email')";
		    $result1 = mysqli_query($conn, $sql1);
            }
                else{
                    $sql1 = "INSERT INTO investor (email) 
                        VALUES('$email')";
		    $result1 = mysqli_query($conn, $sql1);
                }
            
            
			if ($result) {
				$parts = explode(" ", $name);
				$lastname = array_pop($parts);
				$firstname = implode(" ", $parts);
				$title = 'Welcome '.$username.'';
				$message = "We will like to welcome you into the Middlefund Family.";
				$status = "unread";

				$sql2 = "INSERT INTO notification (email, title, message, status )
					VALUES ('$email', '$title', '$message', '$status')";
                    $result2 = mysqli_query($conn, $sql2);
					echo "
					<script>
						   $(function(){
							Swal.fire(
									'Success!',
									'Account Created Successfully!',
									'success',
							).then(okay => {
   if (okay) {
    window.location.href = 'signup.php';
  }
});

                            });
                           
					</script>
					";
				// echo "<script>alert('Wow! User Registration Completed.'); window.location.href='signup.php';</script>";
				// $username = "";
				// $email = "";
				// $_POST['password'] = "";
				// $_POST['cpassword'] = "";
			} else {
				// echo "<script>alert('Woops! Something Wrong Went.'); window.location.href='signup.php';</script>";
				echo "
					<script>
						   $(function(){
							Swal.fire(
									'Woops!',
									'Something Went Wrong',
									'error',
							).then(okay => {
   if (okay) {
    window.location.href = 'signup.php';
  }
});

                            });
                           
					</script>
					";
			
			}
		} else {
			// echo "<script>alert('Woops! Email Already Exists.'); window.location.href='signup.php';</script>";
			echo "
					<script>
						   $(function(){
							Swal.fire(
									'Email Already Exists!',
									'Please Log in',
									'info',
							).then(okay => {
   if (okay) {
    window.location.href = 'signup.php';
  }
});

                            });
                           
					</script>
					";
			
		}
		
	} else {
		// echo "<script>alert('Password Not Matched.'); window.location.href='signup.php';</script>";
		echo "
		<script>
			   $(function(){
				Swal.fire(
						'Try again!',
						'Passwords Do not Match',
						'question',
				).then(okay => {
if (okay) {
window.location.href = 'signup.php';
}
});

				});
			   
		</script>
		";
		
		
	}
}

?>
