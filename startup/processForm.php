<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<?php
session_start();
$sessionEmail = $_SESSION['email'];
include '../connection.php';
$msg = "";
$css_class = "";
if (isset($_POST['accountBtn'])){
    // echo "<pre>", print_r($_FILES['profileImage']['name']),"</pre>";
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userLocation = $_POST['userLocation']; 
    $oldProfileImage = $_POST['profileImage'];
    $name=$_FILES['profileImage']['name'];
    $profileImage = time().'_'.$_FILES['profileImage']['name'];
    

    $target = '../Assets/userImages/'. $profileImage;
    $checkOld ='../Assets/userImages/'. $oldProfileImage;
    
    if (isset($name)) {
        if(move_uploaded_file($_FILES['profileImage']['tmp_name'], $target)){
                $sql = "UPDATE users SET name='$userName',email='$userEmail',user_image='$profileImage',location='$userLocation' WHERE                                              email='$sessionEmail'";
                if(mysqli_query($conn, $sql)){
                    echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success!',
                                        'Information Saved!',
                                        'success'
)
                               });
                        </script>
                        ";
                    // $msg = "Image Uploaded and Saved to Database";
                    // $css_class = "alert--success";
                    $_SESSION['username'] = $userName;
                    $_SESSION['email'] = $userEmail;
                    $_SESSION['user_image'] = $profileImage;
                    $_SESSION['location'] = $userLocation;
            }
            else{
                // $msg = "Database Error: Failed to save user";
                // $css_class = "alert--danger";
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
        else{
        $sql = "UPDATE users SET name='$userName',email='$userEmail',location='$userLocation' WHERE email='$sessionEmail'";
        if(mysqli_query($conn, $sql)){
             echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success!',
                                        'Information Saved!',
                                        'success'
)
                               });
                        </script>
                        ";
            // $msg = "Information Saved Successfully";
            // $css_class = "alert--success";
            $_SESSION['username'] = $userName;
            $_SESSION['email'] = $userEmail;
            $_SESSION['location'] = $userLocation;
        }
        else{
            // $msg = "Database Error: Failed to save user";
            // $css_class = "alert--danger";
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

    
        // $msg = "Profile Updated Successfully";
        // $css_class = "alert-success";
    }  
    }
    
    


    // else {
    //     $msg = "Failed to Update";
    //     $css_class = "alert-danger";
    // }

    
}
?>