<?php
include '../connection.php';
include ("functions.php");
include ("login.php");
session_start();


error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sign Up / Sign In</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
  <link rel="stylesheet" href="css/signup.css">
  <link rel="icon" href="../Assets/MiddlefundLogo.png">

</head>
<body>
    <header>
		    <nav class="navigation">
			    <div class="logo">
				    <h1><a href="../index.html"><img src="../Assets/MiddlefundLogo.png" width="90"></a></h1>
			    </div>
            </nav>
        </header>
	<div class="main">
	<!-- partial:index.partial.html -->
	<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="functions.php" method="post">
		
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<!-- <span>or use your email for registration</span> -->
			<h5><?php $msg;?></h5>
			<input type="text" placeholder="Name" name="username"  value="<?php echo $username; ?>" required/>
			<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required/>
			<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required/>
			<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>"  required/>
            <div class="controls">
            <label class="radio">
                <input type="radio" name="user_type" value="investor" required>
                Investor
            </label>&nbsp;&nbsp;&nbsp;
            <label class="radio">
                <input type="radio" name="user_type" value="startup" required>
                Startup
              </label></div>
              <h6>By signing up, you agree to our <a href="#"><h5 style="color: #A49370;">Terms and Conditions</h5></a></h6><br>
			<button name="register_btn">Sign Up</button>
        
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" placeholder="Email" name="useremail"  value="<?php echo $email; ?>" required/>
			<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required/>
			<br>
			<a href="#">Forgot your password?</a>
			<button name="login_btn">Sign In</button>
			<br><br>
			<h5 style="color:red"><?php echo $msg; ?></h5>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
    </div>
<!-- partial -->
  <script  src="javascript/signup.js"></script>
</body>
</html>
