<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
include '../connection.php';

session_start();
error_reporting(0);

$email = $_SESSION['email'];
$name = $_SESSION['username'];

use PHPMailer\PHPMailer\PHPMailer;

$queryGet = mysqli_query($conn, "SELECT * FROM startup WHERE email = '".$_GET['startupEmail']."'");   
$startupData = mysqli_fetch_array($queryGet);
$startupName = $startupData['name'];
$startupIndustry = $startupData['industry'];
$startupEmail =  $startupData['email'];

$title = "Investor Interested";
$message = "An investor is interested in your startup, we will notify after due process";
$status = "unread";
$sql = "INSERT INTO notification (email, title, message, status )
            VALUES ('$startupEmail', '$title', '$message', '$status')";
$result = mysqli_query($conn, $sql);

$title1 = "Thank you for your interest in ".$startupName." startup";
$message1 = "We will send you an email after conducting a due diligence process";
$sql1 = "INSERT INTO notification (email, title, message, status )
            VALUES ('$email', '$title1', '$message1', '$status')";
$result1 = mysqli_query($conn, $sql1);

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
			

			$mail = new PHPMailer();

			$mail -> IsSMTP();
			$mail -> Host = "smtp.gmail.com";
			$mail-> SMTPAuth = true;
			$mail -> Username = "malti@ripplesfoundation.org";
			$mail -> Password = 'M"ltitiB99';
			$mail -> Port = 465;
			$mail -> SMTPSecure = "ssl";
			$mail -> isHTML(true);
			$mail -> setFrom('no-reply@middlefund.co', 'MiddleFund');
			$mail -> AddAddress('info@middlefund.co');
			$mail -> Subject = ('Investor Interested');
			$mail -> Body = "<html>
      <head>
      <title>{$subject}</title>
      </head>
      <body>
      <p><strong> Hi there,</strong></p>
      <p>An investor with the name; {$name} and email; {$email} is interested in investing in one of our startups</p>
      <p>Startup Name : {$startupName}</p>
      <p>Startup Industry : {$startupIndustry}</p>
      <p>Email : {$startupEmail}</p>
    
      </body>
      </html>
      ";
  if($mail -> send()) {
      header('Location: interested.php');
      }
      else{
          echo "
                    <script>
                        $(function(){
                            Swal.fire('Oops!!!', 'Something Went Wrong', 'error',).then(okay => {
                                if (okay) {
                                    window.location.href = 'viewMore.php';
                                }
                            });

                        }); 
                    </script>
                ";
      } 
?>