<?php
include '..\connection.php';
$output = '';
    if(isset($_POST['query'])){
        $search =$_POST['query'];
         $sql = "SELECT * FROM investor INNER JOIN users on  investor.email = users.email WHERE name LIKE CONCAT('%',?,'%') OR 
         interests LIKE CONCAT('%',?,'%')";
         $stmt = $conn -> prepare($sql);
         $stmt -> bind_Param ('ss', $search, $search);
    } 
   
    else{
        $stmt =$conn->prepare("SELECT * FROM investor INNER JOIN users on  investor.email = users.email");
    }    
            $stmt -> execute();
            $result = $stmt ->get_result();
            if($result->num_rows>0){
                while($row = $result -> fetch_assoc()){
                    $output="<div class='item contain'>
                    <div class='text-white contain-item'  style='text-align: center;'><h8>".$row['name']."</h8>&nbsp;<span style='color: #BCA576; vertical-align: middle; display: inline-block;' class='material-icons'> check_circle </span></div>
                    <div style='margin-top: 25px;'><h8 class='text-gold'>Commitment:</h8><h8 class='text-white space'>$".$row['commitment']."</h8></div>
                    <div class='mytop'><h8 class='text-gold'>Recent Investments</h8><h8 class='text-white space'>".$row['recent_investment']."</h8></div>
                   <h8 class='text-gold mytop'>Interests:</h8><h8 class='text-white'>".$row['interests']."</h8>
                   <div>
                   <a href=".$row['facebook']." class='fa fa-facebook'></a>
                   <a href=".$row['twitter']." class='fa fa-twitter'></a>
                   <a href=".$row['instagram']." class='fa fa-instagram'></a>
                   <a href=".$row['linkedin']." class='fas fa-envelope'></a>
                   </div>
                  </div>";   
          echo $output;    
        }
       
        }
        else{
            echo "<h3>No Records Found</h3>";
        }
                   
                             
?>