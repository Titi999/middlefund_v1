 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
$msg2 = "";

	session_start();
    include '../connection.php';

    if(isset($_POST['updateInvestment'])){
    $commitment = $_POST['commitment'];
    $recentInvesment = $_POST['recentInvestment'];
    $interests = $_POST['interests'];
    
  
    $sql = "UPDATE investor SET commitment = '$commitment',  recent_investment = '$recentInvesment', interests = '$interests'
           WHERE email = '".$_SESSION['email']."'";
				if($conn->query($sql)){
                      echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success!',
                                        'Invesment information Saved!',
                                        'success'
)
                               });
                        </script>
                        ";
                    // $css_class2 = "alert--success";
					// $msg2 = "Update successful";
					
				}
                else {
                     echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Oops!',
                                        'Something went wrong!',
                                        'error'
)
                               });
                        </script>
                        ";
                }

            }
     if(isset($_POST['updateSocials'])){
         $twitter = $_POST['twitter'];
         $instagram = $_POST['instagram'];
         $facebook = $_POST['facebook'];
         $linkedin = $_POST['linkedin'];

          $sql = "UPDATE investor SET facebook = '$facebook',  twitter = '$twitter', instagram = '$instagram', linkedin = '$linkedin'
           WHERE email = '".$_SESSION['email']."'";
				if($conn->query($sql)){
                      echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success!',
                                        'Social Media information Saved!',
                                        'success'
)
                               });
                        </script>
                        ";
                    // $css_class3 = "alert--success";
					// $msg3 = "Update successful";
					
				}
                else {
                      echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Oops!',
                                        'Something went wrong!',
                                        'error'
)
                               });
                        </script>
                        ";
                    // $css_class3 = "alert--danger";
					// $msg3 = "Update Failed";
                }
     }
         
?>