<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

session_start();
include '../connection.php';
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_GET["token"])) {
    
   
    $sql = "UPDATE investor SET verification_status='verified' WHERE token='{$_GET["token"]}'";
    if(mysqli_query($conn, $sql)){
        echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success',
                                        'Investor Successfully Verified',
                                        'success'
                                      )
                               });
                        </script>
                        ";
        $queryGet = mysqli_query($conn, "SELECT  * FROM investor WHERE token='{$_GET["token"]}'");   
        $data = mysqli_fetch_array($queryGet);
        $accountEmail = $data['email'];
        
            $title1 = "Congratulations!!!";
            $message1 = "Your account has been successfully verified";
            $sql1 = "INSERT INTO notification (email, title, message, status )
                        VALUES ('$accountEmail', '$title1', '$message1', 'unread')";
            $result1 = mysqli_query($conn, $sql1);
             require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            

            $mail = new PHPMailer();

            $mail -> IsSMTP();
            $mail -> Host = "smtp.gmail.com";
            $mail-> SMTPAuth = true;
            $mail -> Username = "malti@ripplesfoundation.org";
            $mail -> Password = 'rabiatu99';
            $mail -> Port = 465;
            $mail -> SMTPSecure = "ssl";
            $mail -> isHTML(true);
            $mail -> setFrom('malti@ripplesfoundation.org', 'MiddleFund');
            $mail -> AddAddress($accountEmail);
            $mail -> Subject = ('Congratulations! - Middlefund');
            $mail -> Body = "<html>

            <head>
            <title>{$subject}</title>
            </head>
            <body>
            <p><strong>Dear Investor,</strong></p>
            <p>Your account has been successfully verified</p>
            <p>Thank You</p>
            <p>The Middlefund Account Team</p>
           
            </body>
            </html>
            ";
            
            if($mail->Send()){
                echo "<script>window.close();</script>";
            }
            
    }
    else{
        echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Oops!',
                                        'Something Went Wrong!',
                                        'error'
                                        )
                               });
                        </script>
                        ";
    }
    
}