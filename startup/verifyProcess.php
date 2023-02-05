<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

session_start();
include '../connection.php';
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_GET["email"])) {
    
   
    $sql = "UPDATE startup SET status='verified' WHERE email='{$_GET["email"]}'";
    
    if(mysqli_query($conn, $sql)){
        echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success',
                                        'Startup Pitch Verified',
                                        'success'
                                      )
                               });
                        </script>
                        ";
        $queryGet = mysqli_query($conn, "SELECT * FROM startup WHERE email='{$_GET["email"]}'");   
        $queryGet1 = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_GET["email"]}'");   
        $data = mysqli_fetch_array($queryGet);
        $data1 = mysqli_fetch_array($queryGet1);
        $accountEmail = $data['email'];
        $accountName = $data1['name'];
        
            $title1 = "Congratulations!!!";
            $message1 = "Your pitch has been successfully verified";
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
            $mail -> Username = "noreply.middlefund@gmail.com";
            $mail -> Password = 'zunclgvoyzirxotg';
            $mail -> Port = 465;
            $mail -> SMTPSecure = "ssl";
            $mail -> isHTML(true);
            $mail -> setFrom('noreply.middlefund@gmail.com', 'MiddleFund');
            $mail -> AddAddress($accountEmail);
            $mail -> Subject = ('Congratulations! - Middlefund');
            $mail -> Body = "<html lang='en-US'>
<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>Startup Awaiting Review</title>
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
                                        <p style='text-align:left;'><strong>Dear {$accountName},</strong></p> 
                                        <h1 font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Pitch Verification
                                        </h1>
                                        <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                         Congratulations!!!. Your pitch passed our review successfully. Your pitch has been upload to the investors
                                         page. Hopefully one of our investors will show interest in your startup.
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
            
            if($mail->Send()){
                $queryGet = mysqli_query($conn, "SELECT * FROM startup WHERE email='{$_GET["email"]}'");   
                $queryGet1 = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_GET["email"]}'");   
                $data = mysqli_fetch_array($queryGet);
                $data1 = mysqli_fetch_array($queryGet1);
                $startupIndustry = $data['industry'];
                $startupStage = $data['stage'];
                $queryInvestor = mysqli_query($conn, "SELECT  * FROM investor");
                while($row = mysqli_fetch_array($queryInvestor)){

                    $investorIndustry = $row[10];
                    $investorStages = $row[8];
                    if (strpos($investorIndustry, $startupIndustry) !== false && strpos($investorStages, $startupStage) !== false ) {
                    $email = $row[1];
                    $title1 = "New Startup Pitch!";
                    $message1 = "A new startup has pitch has been upload. You might be interested";
                    $sql1 = "INSERT INTO notification (email, title, message, status )
                        VALUES ('$email', '$title1', '$message1', 'unread')";
                    $result1 = mysqli_query($conn, $sql1);   

                $queryUser = mysqli_query($conn, "SELECT name FROM users WHERE email='{$email}'");
                 $data2 = mysqli_fetch_array($queryUser);
                    $investorName = $data2[0];
                    $mail = new PHPMailer();

            $mail -> IsSMTP();
            $mail -> Host = "smtp.gmail.com";
            $mail-> SMTPAuth = true;
            $mail -> Username = "noreply.middlefund@gmail.com";
            $mail -> Password = 'zunclgvoyzirxotg';
            $mail -> Port = 465;
            $mail -> SMTPSecure = "ssl";
            $mail -> isHTML(true);
            $mail -> setFrom('noreply.middlefund@gmail.com', 'MiddleFund');
            $mail -> AddAddress($email);
            $mail -> Subject = ('New Pitch Uploaded! - Middlefund');
            $mail -> Body = "<html lang='en-US'>
<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>New Pitch Uploaded</title>
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
                                        <p style='text-align:left;'><strong>Dear {$investorName},</strong></p> 
                                        <h1 font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>New Pitch Uploaded
                                        </h1>
                                        <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                         A new pitch has been uploaded. You might be interested
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
    $mail->Send();
                    }
                }
                
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