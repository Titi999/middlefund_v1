<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include '../connection.php';
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_POST['verifyInvestor'])){
    $idType = $_POST['passport'];
    // $pResidence = $_POST['utility']; 
    $token = md5(rand());  
    $errors= array();

    $file_nameFront = time().'_'.$_FILES['front']['name'];
    $file_sizeFront = $_FILES['front']['size'];
    $file_tmpFront = $_FILES['front']['tmp_name'];
    $target = 'verificationFiles/'. $file_nameFront;

    $file_nameBack = time().'_'.$_FILES['back']['name'];
    $file_sizeBack = $_FILES['back']['size'];
    $file_tmpBack = $_FILES['back']['tmp_name'];
    $target1 = 'verificationFiles/'. $file_nameBack;

    // $file_nameUtility = time().'_'.$_FILES['utilityFile']['name'];
    // $file_sizeUtility = $_FILES['utilityFile']['size'];
    // $file_tmpUtility = $_FILES['utilityFile']['tmp_name'];
    // $target2 = 'verificationFiles/'. $file_nameUtility;
    

    // echo "<pre>", print_r($file_nameID),"</pre>";
    // echo "<pre>", print_r($file_nameIDBack),"</pre>";
       
    
    if($file_sizeFront > 2097152 && $file_sizeBack > 2097152) {
        $errors[]='All file size must be 2 MB or less';
    }
    
    if(empty($errors)==true) {
        move_uploaded_file($file_tmpFront, $target);
        move_uploaded_file($file_tmpBack, $target1);
        // move_uploaded_file($file_tmpUtility, $target2);
        $sql = "UPDATE investor SET id_type ='$idType', front_id = '$file_nameFront',  back_id = '$file_nameBack' token = '$token', verification_status = 'awaiting' WHERE email = '".$_SESSION['email']."'";
        if($conn->query($sql)){
            $title1 = "Verification";
            $message1 = "We will go through your documents and make a decision";
            $sql1 = "INSERT INTO notification (email, title, message, status )
                        VALUES ('".$_SESSION['email']."', '$title1', '$message1', 'unread')";
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
            $mail->addAttachment("verificationFiles/".$file_nameFront);
            $mail->addAttachment("verificationFiles/".$file_nameBack);
            $mail -> Port = 465;
            $mail -> SMTPSecure = "ssl";
            $mail -> isHTML(true);
            $mail -> setFrom('malti@ripplesfoundation.org', 'MiddleFund');
            $mail -> AddAddress('abubakaribilal99@gmail.com');
            $mail -> Subject = ('Email verification - Middlefund');
            $mail -> Body = "<html>

            <head>
            <title>{$subject}</title>
            </head>
            <body>
            <p><strong>Hi There,</strong></p>
            <p>An Investor with the name; {$_SESSION['username']} and email; {$_SESSION['email']} has asked to be verified. Please review the documents attached. </p>
            <p>ID TYPE : {$idType} </p>
            <p>PROOF DOCUMENT : {$pResidence} </p>
            <p><a href='{$base_url1}verifyProcess.php?token={$token}'>Verify Investor</a></p>
            <p><a href='{$base_url1}notVerifyProcess.php?token={$token}'>Do not Verify Investor</a></p>
            </body>
            </html>
            ";
            
            if($mail->Send()){
                echo "
                    <script>
                        $(function(){
                            Swal.fire('Thank You', 'We will get back to you after due process', 'success',).then(okay => {
                                if (okay) {
                                    window.location.href = 'verify.php';
                                }
                            });

                        }); 
                    </script>
                ";
            }
            else{
                echo "
                <script>
                    $(function(){
                        Swal.fire('Oops!', 'Something Went Wrong', 'error',).then(okay => {
                            if (okay) {
                                window.location.href = 'verify.php';
                            }
                        });

                    }); 
                </script>
            ";
            }
        }

      
    }
    else{
       print_r($errors);
    }
     
    
}