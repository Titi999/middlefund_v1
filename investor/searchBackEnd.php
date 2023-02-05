<?php
include '..\connection.php';
$output = '';
    if(isset($_POST['query'])){
        $search =$_POST['query'];
         $sql = "SELECT * FROM startup WHERE name LIKE CONCAT('%',?,'%') OR 
         industry LIKE CONCAT('%',?,'%')";
         $stmt = $conn -> prepare($sql);
         $stmt -> bind_Param ('ss', $search, $search);
    } 
   
    else{
        $stmt =$conn->prepare("SELECT * FROM startup");
    }    
            $stmt -> execute();
            $result = $stmt ->get_result();
            if($result->num_rows>0){
                while($row = $result -> fetch_assoc()){
                    $output="<div class='card'>
                    <img class='verify' src='assets\images\icons8-verified-account-42.png' width=30; height=30;>
                    <div class='text'>
                  <img src='https://www.shareicon.net/data/512x512/2016/09/15/829452_user_512x512.png' alt=''>
                  <h3>".$row['name']."</h3>
                  <p>".$row['industry']."</p>
                  <p>
                  ".$row['about']."
                  </p>
              </div> 
              <a class='viewMore' href='viewMore.php'>View More</a>
              
          </div>&nbsp; &nbsp; &nbsp;";   
          echo $output;    
        }
       
        }
        else{
            echo "<h3>No Records Found</h3>";
        }
                   
                             
?>