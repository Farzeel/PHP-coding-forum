<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {
    include "./_dbconnect.php";
         
      $user_email = $_POST['loginemail'];
      $password = $_POST['loginpassword'];
  
    $sql = "SELECT * FROM `users` WHERE `user_email` = '$user_email' ";
    $result = mysqli_query($conn,$sql);
     $num = mysqli_num_rows($result);
   
     $row = mysqli_fetch_assoc($result);
     echo password_hash($password,PASSWORD_DEFAULT);
     echo "<br>";
     echo $row['user_password'];
     echo "<br>";
     echo $row['user_email'];
     if ($num==1) {
        echo var_dump(password_verify($row['user_password'],$password));
       if (password_verify($password,$row['user_password'])) {
       session_start();
       $_SESSION['loggedin'] = true;
       $_SESSION['username'] = $row['user_name'];
       $_SESSION['userId'] = $row['user_id'];
       header("location: /forum/index.php");
       exit();
       }
       else{
        echo "invalid Credentials!";
       }
     }
     
     
}


?>