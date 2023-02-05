<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

session_start();
if (isset($_GET["token"])) {
    include '../connection.php';
    $sql = "UPDATE investor SET verification_status='unverified' WHERE token='{$_GET["token"]}'";
    if(mysqli_query($conn, $sql)){
        echo "
                        <script>
                               $(function(){
                                Swal.fire(
                                        'Success',
                                        'Verified Declined',
                                        'success'
                                        )
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
                                        'Something Went Wrong!',
                                        'error'
                                        )
                               });
                        </script>
                        ";
    }
    echo "<script>window.close();</script>";
}