<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<?php
session_start();
$sessionEmail = $_SESSION['email'];
include '../../connection.php';

if(isset($_POST['infoBtn'])){
  $regAs = $_POST['regAs'];
  $OrgName = $_POST['OrgName'];
  $position = $_POST['position'];
  $commitment = $_POST['commitment'];
  $avgChequeSize = $_POST['avgChequeSize'];
  $maxChequeSize = $_POST['maxChequeSize'];
  $investmentStages = "";
  $interests = "";
  $twitter = $_POST['twitter'];
  $linkedIn = $_POST['linkedIn'];   
    $numStages = count($_POST['investmentStages']);
    $i = 0;
  foreach ($_POST['investmentStages'] as $key=>$stage){
    if(++$i === $numStages) {
        $investmentStages .= $stage;
    }
    else{
    $investmentStages .= $stage.", ";
    }
    }
    $numInterests = count($_POST['interests']);
    $j = 0;
    foreach ($_POST['interests'] as $key=>$interest){
         if(++$j === $numInterests) {
              $interests .= $interest;
         }
         else{
              $interests .= $interest.", ";
         }
   
    }
  $sql = "UPDATE investor SET regAs='$regAs', OrgName='$OrgName', position='$position', commitment='$commitment', avgChequeSize='$avgChequeSize', maxChequeSize='$maxChequeSize', investmentStages='$investmentStages', interests='$interests', twitter='$twitter', linkedin='$linkedIn' WHERE email='$sessionEmail'";
  $results = mysqli_query($conn, $sql);
    if($results){
     echo "
						<script>
							$(function(){
								Swal.fire(
										'Success',
										'Information Saved Successfully',
										'success',
								).then(okay => {
								if (okay) {
									window.location.href = '../index.php';
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
								Swal.fire(
										'Oops!',
										'Something went wrong',
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
?>