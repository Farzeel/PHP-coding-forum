<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {
    include "./_dbconnect.php";
         
      $user_email = $_POST['signupemail'];
      $password = $_POST['signuppassword'];
      $cpassword = $_POST['signupcpassword'];
      $username = $_POST['signupusername'];
    $existSql = "SELECT * FROM `users` WHERE `user_email` = '$user_email' ";
    $result = mysqli_query($conn,$existSql);
     $num = mysqli_num_rows($result);
     if ($num>0) {
        $showerror = "email already in use";
        echo $showerror;
     }
     else{
        if ($password==$cpassword) {
            $hashPassword = password_hash($password,PASSWORD_DEFAULT);
            $sql  = "INSERT INTO `users` ( `user_email`, `user_password`, `dateTime`,`user_name`) 
            VALUES ( '$user_email', '$hashPassword', current_timestamp(),'$username')";
            $result2 = mysqli_query($conn,$sql);
            if($result2){
                echo "signup sucessfully";
                header("location: /forum/index.php?signup=ok");
            }
        }else{
            $showerror =  "password do not match";
            echo $showerror;
        }
     }
}


?>