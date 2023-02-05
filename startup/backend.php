<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
$sessionEmail = $_SESSION['email'];

include '../connection.php';
$base_url = "http://middlefund.lovestoblog.com/startup/";
if(isset($_POST['pitchBtn'])){
  $name = $_POST['name'];
  $industry = $_POST['industry'];
  $regInfo = $_POST['regInfo'];
  $regCountry = $_POST['regCountry'];
  $country = $_POST['country'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $website = $_POST['website'];
  $stage = $_POST['stage'];
  $linkedIn = $_POST['linkedIn'];
  $raised = $_POST['raised'];
  $purpose = $_POST['purpose'];
  $intendedRaise = $_POST['intendedRaise'];
  $bio = $_POST['bio'];
  $equity = $_POST['equity'];
  $repName = $_POST['repName'];
  $position = $_POST['position'];
  $repLinkedin = $_POST['repLinkedin'];
  $repBio = $_POST['repBio'];
  $sql = "UPDATE startup SET name='$name', industry='$industry', regInfo='$regInfo', regCountry='$regCountry', country='$country', state='$state', city='$city', website='$website', stage='$stage', linkedin='$linkedIn', raised='$raised', purpose='$purpose', intended_raise='$intendedRaise', bio='$bio', equity='$equity', rep_name='$repName', rep_position='$position', rep_linkedin='$repLinkedin', rep_bio='$repBio', status='awaiting' WHERE email='$sessionEmail'";
 // VALUES "('$linkedIn', '$raised', '$purpose', '$intendedRaise', '$bio', '$equity', '$repName', '$position', '$repLinkedin', '$repBio')";
  $results = mysqli_query($conn, $sql);
    if($results){
        $logoName=$_FILES['logo']['name'];
        $logo = time().'_'.$_FILES['logo']['name'];
        //setting a target folder where logo will be stored
        $logoTarget = 'startupLogo/'.$logo;
        if (isset($logoName)) {
            //uploading video to the target folder 
            if(move_uploaded_file($_FILES['logo']['tmp_name'], $logoTarget)){
            $sql1 = "UPDATE startup SET logo='$logo' WHERE email='$sessionEmail'";
            $results = mysqli_query($conn, $sql1);
            }
        }


        $pitchName =$_FILES['pitchDeck']['name'];
        $pitchDeck = time().'_'.$_FILES['pitchDeck']['name'];

        //setting a target folder where logo will be stored
        $pitchTarget = 'pitchDeck/'. $pitchDeck;

        if (isset($pitchName)) {
            //uploading video to the target folder 
            if(move_uploaded_file($_FILES['pitchDeck']['tmp_name'], $pitchTarget)){
            $sql1 = "UPDATE startup SET pitch_deck='$pitchDeck' WHERE email='$sessionEmail'";
            $results = mysqli_query($conn, $sql1);
            }
        }


      //video maximum size
        $maxsize = 5242880;
      //echo "<pre>", print_r($_FILES['pitchVideo']['name']),"</pre>";

      //checking if video maximum size has exceeded
        if($_FILES['pitchVideo']['size'] >= $maxsize){
        echo "
						<script>
							$(function(){
								Swal.fire(
										'Unable to Upload Video',
										'Maximum video size should be 5MB',
										'info',
								).then(okay => {
								if (okay) {
                                    
								}
								});

								});
							
						</script>
					";
        }
      //if video size has not exceed the set maximum
        else{
            //getting the name of the video
            $VideoName=$_FILES['pitchVideo']['name'];
            //setting a new name with respect with time to prevent videos having the same name
            $pitchVideo = time().'_'.$_FILES['pitchVideo']['name'];
            // echo "<script>alert('$pitchVideo')</script>" ;
            
            //setting a target folder where video will be stored
            $videoTarget = 'pitchVideos/'. $pitchVideo;

            //checking if a video has actually being selected
            if (isset($VideoName)) {
                //uploading video to the target folder 
                if(move_uploaded_file($_FILES['pitchVideo']['tmp_name'], $videoTarget)){
                    $sql1 = "UPDATE startup SET video='$pitchVideo' WHERE email='$sessionEmail'";
                    $results1 = mysqli_query($conn, $sql1);
                
                
                }
            }
        }

        $idName=$_FILES['repID']['name'];
        $ID = time().'_'.$_FILES['repID']['name'];

        //setting a target folder where logo will be stored
        $idTarget = 'ID/'. $ID;
        if (isset($idName)) {
            //uploading  to the target folder 
            if(move_uploaded_file($_FILES['repID']['tmp_name'], $idTarget)){
            $sql1 = "UPDATE startup SET rep_id='$ID' WHERE email='$sessionEmail'";
            $results = mysqli_query($conn, $sql1);
            }
        }

        $locate = '1659219239_anas (1).png';

        require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            

            $mail = new PHPMailer();

            $mail -> IsSMTP();
            $mail -> Host = "smtp.gmail.com";
            $mail-> SMTPAuth = true;
            $mail -> Username = "noreply.middlefund@gmail.com";
            $mail -> Password = 'zunclgvoyzirxotg';
            $mail->addAttachment("startupLogo/".$logo);
            $mail->addAttachment("pitchDeck/".$pitchDeck);
            $mail->addAttachment("ID/".$ID);
            $mail->addAttachment("pitchVideos/".$pitchVideo);
            $mail -> Port = 465;
            $mail -> SMTPSecure = "ssl";
            $mail -> isHTML(true);
            $mail -> setFrom('noreply.middlefund@gmail.com', 'MiddleFund');
            $mail -> AddAddress('abubakaribilal99@gmail.com');
            $mail -> AddAddress('tuahirud@gmail.com');
            $mail -> Subject = ('Verify Startup - Middlefund');
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
                                        <p style='text-align:left;'><strong>Dear Sir,</strong></p> 
                                        <h1 font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Review Startup
                                        </h1>
                                        <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                          A new startup has been uploaded with the following details:<br>
                                          Name: {$_POST['name']} <br>
                                          Industry: {$_POST['industry']}<br>
                                            Registration Information: {$_POST['regInfo']}<br>
                                            Registration Country: {$_POST['regCountry']}<br>
                                            Country: {$_POST['country']}<br>
                                            State: {$_POST['state']}<br>
                                            City: {$_POST['city']}<br>
                                            Website: {$_POST['website']}<br>
                                            Stage: {$_POST['stage']}<br>
                                            LinkedIn: {$_POST['linkedIn']}<br>
                                            Amount Raised: {$_POST['raised']}<br>
                                            Purpose: {$_POST['purpose']}<br>
                                            Amount Intented to Raise: {$_POST['intendedRaise']}<br>
                                            Bio: {$_POST['bio']}<br>
                                            Equity: {$_POST['equity']}<br>
                                            Rep's Name: {$_POST['repName']}<br>
                                            Rep's Position: {$_POST['position']}<br>
                                            Rep's LinkedIn: {$_POST['repLinkedin']}<br>
                                            Rep's Bio: {$_POST['repBio']}<br>
                                          </p>
                <p style='font-size:15px; color:#fff; margin:8px 0 0; line-height:24px;'>
                                    Find the attached documents of the startup      </p>
                                       <a href='{$base_url}verifyProcess.php?email={$sessionEmail}' id='verifyLink'
                                            style='border: 2px solid white; text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Verify Startup</a><br>
                                            <a href='{$base_url}notVerifyProcess.php?email={$sessionEmail}' id='verifyLink'
                                            style='border: 2px solid white; text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Reject Startup</a><br>
                                       
                                       
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
            

        echo "
						<script>
							$(function(){
								Swal.fire(
										'Success',
										'Pitch Uploaded Successfully',
										'success',
								).then(okay => {
								if (okay) {
									window.location.href = 'submitPitch.php';
								}
								});

								});
							
						</script>
					";
            }        
        
    }
    else{
        echo "
						<script>
							$(function(){
								Swal.fire(
										'Oops!',
										'Something went wrong',
										'error',
								).then(okay => {
								if (okay) {
									window.location.href = 'submitPitch.php';
								}
								});

								});
							
						</script>
					";
    }

}
?>