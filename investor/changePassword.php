<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<?php
$msg1 = "";
$css_class1 = "";
	session_start();

    include '../connection.php';

	if(isset($_POST['updatePassword'])){
		//get POST data
		$old = md5($_POST['old']);
		$new = md5($_POST['new']);
		$retype = md5($_POST['retype']);
 
		//create a session for the data incase error occurs
		$_SESSION['old'] = $old;
		$_SESSION['new'] = $new;
		$_SESSION['retype'] = $retype;
 
		//get user details
		$sql = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

 
		//check if old password is correct
		if($old == $row['password']){
			//check if new password match retype
			if($new == $retype){
				//hash our password
			
 
				//update the new password
				$sql = "UPDATE users SET password = '$new' WHERE email = '".$_SESSION['email']."'";
				if($conn->query($sql)){
                     echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success!',
                                        'Password Changed!',
                                        'success'
)
                               });
                        </script>
                        ";
                    // $css_class = "alert--success";
					// $msg1 = "Password updated successfully";
					//unset our session since no error occured
					unset($_SESSION['old']);
					unset($_SESSION['new']);
					unset($_SESSION['retype']);
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
			else{
                 echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Error!',
                                        'Passwords do not match!',
                                        'error'
)
                               });
                        </script>
                        ";
                // $css_class1 = "alert--danger";
				// $msg1 = "New Password and Confirm Password did not match";
			}
		}
		else{
             echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Error!',
                                        'Incorrect Old Password!',
                                        'error'
)
                               });
                        </script>
                        ";
            // $css_class1 = "alert--danger";
			// $msg1 = "Incorrect Old Password";
		}
	}
	else{
        $css_class = "";
		$msg1 = "";
	}
 
	// header('location:index.php');
 
?>