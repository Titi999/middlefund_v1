<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php

include '../connection.php';

session_start();

error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;

if ($_SESSION["user_type"] == "investor") {
  header("Location: ../investor/index.php");
}
elseif ($_SESSION["user_type"] == "startup") {
  header("Location: ../startup/myindex.php");
}

if (isset($_POST["signup"])) {
  $full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
  $cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));
  $user_type = mysqli_real_escape_string($conn, $_POST["user_type"]);
  $token = md5(rand());

  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));
    // Validate password strength
$uppercase = preg_match('@[A-Z]@', $_POST["signup_password"]);
$lowercase = preg_match('@[a-z]@', $_POST["signup_password"]);
$number    = preg_match('@[0-9]@', $_POST["signup_password"]);
$specialChars = preg_match('@[^\w]@', $_POST["signup_password"]);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo "
					<script>
						   $(function(){
							Swal.fire(
									'Weak Password!',
									'Password must contain an upper case, a number,symbol and 8 or more Characters',
									'info',
							)
                            });
                           
					</script>
					";
    }
         
  elseif ($password !== $cpassword) {
    // echo "<script>alert('Password did not match.');</script>";
    echo "
					<script>
						   $(function(){
							Swal.fire(
									'Trg Again!',
									'Passwords do not match',
									'question',
							)
                            });
                           
					</script>
					";
  } elseif ($check_email > 0) {
    // echo "<script>alert('Email already exists in out database.');</script>";
    echo "
					<script>
						   $(function(){
							Swal.fire(
									'Please Log in',
									'Email already exists in our database',
									'info',
							).then(okay => {
   if (okay) {
    window.location.href = 'index.php';
  }
});

                            });
                           
					</script>
					";
  } else {
    $sql = "INSERT INTO users (name, email, user_type, password, token, status) VALUES ('$full_name', '$email', '$user_type', '$password', '$token', '0')";
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
            $title = 'Welcome '.$full_name.'.';
            $message = "We would like to welcome you into the MiddleFund Family.";
            $status = "unread";

            $sql2 = "INSERT INTO notification (email, title, message, status )
            VALUES ('$email', '$title', '$message', '$status')";
            $result2 = mysqli_query($conn, $sql2);
    
            $_POST["signup_full_name"] = "";
            $_POST["signup_email"] = "";
            $_POST["signup_password"] = "";
            $_POST["signup_cpassword"] = "";
            $_POST["user_type"] = "";

            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
			

			$mail = new PHPMailer();

			$mail -> IsSMTP();
			$mail -> Host = "smtp.gmail.com";
			$mail-> SMTPAuth = true;
			$mail -> Username = "noreply.middlefund@gmail.com";
            $mail -> Password = 'zunclgvoyzirxotg';
			$mail -> Port = 465;
			$mail -> SMTPSecure = "ssl";
			$mail -> isHTML(true);
			$mail -> setFrom('no-reply@middlefund.co', 'MiddleFund');
			$mail -> AddAddress($email);
			$mail -> Subject = ('Email verification - Middlefund');
			$mail -> Body = "<html lang='en-US'>
<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>{$subject}</title>
    <meta name='description' content='New Account Email Template.'>
    <style type='text/css'>
        a:hover {text-decoration: underline !important;}

        #verifyLink:hover{
                background-color: #A49370 !important;
                border: 2px solid #A49370 !important;
            }
        
    </style>
</head>

<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #3A3838;' leftmargin='0'>
    <!-- 100% body table -->
    <table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#3A3838'>
        <tr>
            <td>
                <table style='background-color: #3A3838; max-width:670px; margin:0 auto;' width='100%' border='0'
                    align='center' cellpadding='0' cellspacing='0'>
                   
                    <tr>
                        <td>
                            <table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
                                style='max-width:670px; background:#3A3838; color:white; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
                        
                                <td style='text-align:center;'> 
                                    <br><br>
                                    <a href='https://rakeshmandal.com' title='logo' target='_blank'>
                                    <img width='100' src='https://i.ibb.co/DffbM50/Middlefund-Logo.png' title='logo' alt='logo'>
                                  </a>
                                </td>
                                <tr>
                                    <td style='height:40px;'>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style='padding:0 35px;'>
                                        <p style='text-align:left;'><strong>Dear {$full_name},</strong></p> 
                                        <h1 font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Verify Your Email
                                        </h1>
                                        <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                           Thanks for registration! Verify your email to to finish setting up your account. Click the link below to verify your email.</p>
                <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                      If you didn't authorize this, you can safely ignore this email. Someone else might have typed your email address by mistake.      </p>
                                        <!-- <span
                                            style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span> -->
                                        <!-- <p
                                            style='color:#455056; font-size:18px;line-height:20px; margin:0; font-weight: 500;'>
                                            <strong
                                                style='display: block;font-size: 13px; margin: 0 0 4px; color:rgba(0,0,0,.64); font-weight:normal;'>Username</strong>wendell@xyz.com
                                            <strong
                                                style='display: block; font-size: 13px; margin: 24px 0 4px 0; font-weight:normal; color:rgba(0,0,0,.64);'>Password</strong>f1_M1@j3[I2~
                                        </p> -->
                                       
                                        <a href='{$base_url}verify-email.php?token={$token}' id='verifyLink'
                                            style='border: 2px solid white; text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Verify your Account</a><br>
                                            <p style='text-align:left;'>Thanks,<br>
                                                The Middlefund account team</p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td style='height:40px;'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:20px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style='text-align:center;'>
                            <p style='font-size:14px; color:white; line-height:18px; margin:0 0 0;'>&copy; <strong>www.middlefund.epizy.com</strong> </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:80px;'>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
   
</body>

</html>";
      
		


      // $to = $email;
      // $subject = "Email verification - Middlefund";

      // $message = "
      // <html>
      // <head>
      // <title>{$subject}</title>
      // </head>
      // <body>
      // <p><strong>Dear {$full_name},</strong></p>
      // <p>Thanks for registration! Verify your email to access our website. Click the link below to verify your email.</p>
      // <p><a href='{$base_url}verify-email.php?token={$token}'>Verify Email</a></p>
      // </body>
      // </html>
      // ";

      // // Always set content-type when sending HTML email
      // $headers = "MIME-Version: 1.0" . "\r\n";
      // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // // More headers
      // $headers .= "From: ". $my_email;

      if($mail -> send()) {

       // echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
       echo "
					<script>
						   $(function(){
							Swal.fire(
									'Success!',
									'We have sent a verification link to your email - {$email}.',
									'success',
							)

                            });
                           
					</script>
					";

      } else {
          echo "
					<script>
						   $(function(){
							Swal.fire(
									'Something went wrong!',
									'Unable to send verification email',
									'error',
							).then(okay => {
   if (okay) {
    window.location.href = 'index.php';
  }
});

                            });
                           
					</script>
					";
       // echo "<script>alert('Mail not sent. Please try again.');</script>";
      }
    } else {
      //echo "<script>alert('User registration failed.');</script>";
      echo "
					<script>
						   $(function(){
							Swal.fire(
									'Something went wrong',
									'User Registration failed',
									'error',
							).then(okay => {
   if (okay) {
    window.location.href = 'index.php';
  }
});

                            });
                           
					</script>
					";
    }
  }
}

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

  $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='1'");
  $check_emailUnverified = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='0'");
  $token = mysqli_query($conn, "SELECT token FROM users WHERE email='$email' AND password='$password' AND status='0'");


  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $_SESSION["user_id"] = $row['id'];
    $_SESSION["username"] = $row['name'];
    $_SESSION["email"] = $row['email'];
    $_SESSION["user_type"] = $row['user_type'];
    $_SESSION['user_image'] =  $row['user_image'];
    $_SESSION['location'] = $row['location'];
    
    if($_SESSION['user_type'] == "startup"){
      header("Location: ../startup/myindex.php");
    }
    elseif($_SESSION['user_type'] == "investor"){
      header("Location: ../investor/index.php");
    }
    
  }
  elseif(mysqli_num_rows($check_emailUnverified) > 0){
     

      require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
      $mail = new PHPMailer();

			$mail -> IsSMTP();
			$mail -> Host = "smtp.gmail.com";
			$mail-> SMTPAuth = true;
			$mail -> Username = "noreply.middlefund@gmail.com";
            $mail -> Password = 'zunclgvoyzirxotg';
			$mail -> Port = 465;
			$mail -> SMTPSecure = "ssl";
			$mail -> isHTML(true);
			$mail -> setFrom('no-reply@middlefund.co', 'MiddleFund');
			$mail -> AddAddress($email);
			$mail -> Subject = ('Email verification - Middlefund');
			$mail -> Body = "<html lang='en-US'>
<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>{$subject}</title>
    <meta name='description' content='New Account Email Template.'>
    <style type='text/css'>
        a:hover {text-decoration: underline !important;}

        #verifyLink:hover{
                background-color: #A49370 !important;
                border: 2px solid #A49370 !important;
            }
        
    </style>
</head>

<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #3A3838;' leftmargin='0'>
    <!-- 100% body table -->
    <table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#3A3838'>
        <tr>
            <td>
                <table style='background-color: #3A3838; max-width:670px; margin:0 auto;' width='100%' border='0'
                    align='center' cellpadding='0' cellspacing='0'>
                   
                    <tr>
                        <td>
                            <table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
                                style='max-width:670px; background:#3A3838; color:white; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
                        
                                <td style='text-align:center;'> 
                                    <br><br>
                                    <a href='http://middlefund.epizy.com' title='logo' target='_blank'>
                                    <img width='100' src='https://i.ibb.co/DffbM50/Middlefund-Logo.png' title='logo' alt='logo'>
                                  </a>
                                </td>
                                <tr>
                                    <td style='height:40px;'>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style='padding:0 35px;'>
                                        <p style='text-align:left;'><strong>Dear {$full_name},</strong></p> 
                                        <h1 font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Verify Your Email
                                        </h1>
                                        <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                           Thanks for registration! Verify your email to to finish setting up your account. Click the link below to verify your email.</p>
                <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                      If you didn't authorize this, you can safely ignore this email. Someone else might have typed your email address by mistake.      </p>
                                        <!-- <span
                                            style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span> -->
                                        <!-- <p
                                            style='color:#455056; font-size:18px;line-height:20px; margin:0; font-weight: 500;'>
                                            <strong
                                                style='display: block;font-size: 13px; margin: 0 0 4px; color:rgba(0,0,0,.64); font-weight:normal;'>Username</strong>wendell@xyz.com
                                            <strong
                                                style='display: block; font-size: 13px; margin: 24px 0 4px 0; font-weight:normal; color:rgba(0,0,0,.64);'>Password</strong>f1_M1@j3[I2~
                                        </p> -->
                                       
                                        <a href='{$base_url}verify-email.php?token={$token}' id='verifyLink'
                                            style='border: 2px solid white; text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Verify your Account</a><br>
                                            <p style='text-align:left;'>Thanks,<br>
                                                The Middlefund account team</p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td style='height:40px;'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:20px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style='text-align:center;'>
                            <p style='font-size:14px; color:white; line-height:18px; margin:0 0 0;'>&copy; <strong>www.middlefund.epizy.com</strong> </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:80px;'>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
   
</body>

</html>";
      if($mail -> send()) {

       // echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
       echo "
					<script>
						   $(function(){
							Swal.fire(
									'Success!',
									'We have sent a verification link to your email - {$email}.',
									'success',
							)

                            });
                           
					</script>
					";

      } else {
          echo "
					<script>
						   $(function(){
							Swal.fire(
									'Something went wrong!',
									'Unable to send verification email',
									'error',
							).then(okay => {
   if (okay) {
    window.location.href = 'index.php';
  }
});

                            });
                           
					</script>
					";
       // echo "<script>alert('Mail not sent. Please try again.');</script>";
      }
  }
else {
      echo "
					<script>
						   $(function(){
							Swal.fire(
									'Woops!',
									'Email or Password is Incorrect. Try again!',
									'error',
							)
                            });
                           
					</script>
					";
    // echo "<script>alert('Login details is incorrect. Please try again.');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="../Assets/MiddlefundLogo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Sign in & Sign up - Middlefund</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email Address" name="email" value="<?php echo $_POST['email']; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required />
          </div>
          <input type="submit" value="Login" name="signin" class="btn solid" />
          <p style="display: flex;justify-content: center;align-items: center;margin-top: 20px;"><a href="forgot-password.php" class="forgotPassword">Forgot Password?</a></p>
        </form>
        <form action="" class="sign-up-form" method="post">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Full Name" name="signup_full_name" value="<?php echo $_POST["signup_full_name"]; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email Address" name="signup_email" value="<?php echo $_POST["signup_email"]; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="signup_password" value="<?php echo $_POST["signup_password"]; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirm Password" name="signup_cpassword" value="<?php echo $_POST["signup_cpassword"]; ?>" required />
          </div>
          <div class="" style="text-align:center;">
          <div class="controls">
            <label class="radio">
                <input type="radio" name="user_type" value="investor" required>
                Investor
            </label>&nbsp;&nbsp;&nbsp;
            <label class="radio">
                <input type="radio" name="user_type" value="startup" required>
                Startup
              </label></div><br>
              <h5>By signing up, you agree to our <a target="_blank" href="termsAndConditions.html" class="termsConditions"><h4>Terms and Conditions</h4></a></h5><br>
          </div>
          <input type="submit" class="btn" name="signup" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
         <!-- <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
            ex ratione. Aliquid!
          </p> --><br>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log.svg" width="2px" height="250" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3><br>
         <!-- <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
            laboriosam ad deleniti.
          </p> -->
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/register.svg" width="2px" height="250" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>

</html>