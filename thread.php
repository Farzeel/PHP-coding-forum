
<?php

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
$loggedin = true;
}else{
  $loggedin = false;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>thread Discussion</title>
    <style>
      #textSmall{
        font-size: 12px;
      }
    </style>
  </head>
  <body>
    <?php require "partials/_dbconnect.php" ?>
   <?php require "partials/_header.php" ?>

  <?php
 
  $threadId = $_GET['threadId'] ;
 
  $sql =  "SELECT * FROM `threads` WHERE thread_id=$threadId;";
  $result = mysqli_query($conn,$sql);

  while($row=mysqli_fetch_assoc($result)){
   
    $thread_title = $row['thread_title'];
    $thread_description = $row['thread_description'];
    $thread_user_id = $row['thread_user_id'];
    $sql2 =  "SELECT user_name FROM `users` WHERE `user_id` ='$thread_user_id' ";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $postedBy = $row2['user_name'];
  }

  ?>
  <?php
$showalert = false;
 if ($_SERVER['REQUEST_METHOD']=="POST") {

  $comment = $_POST['comment'];
  $comment  = str_replace("<","&lt;",$comment);
  $comment  = str_replace(">","&gt;",$comment);
 

  if ($comment==" " ) {
    echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> please fill the fields
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
    ';
  }else{
    
    $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) 
    VALUES ( '$comment', '$threadId', '$_SESSION[userId]', current_timestamp())";
    $result = mysqli_query($conn,$sql);
   if ($result) {
     $showalert = true;
   }
  }

if ($showalert) {
  echo'
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sucess!</strong> your Comment has been Added.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';
}
 }
?>

   <div class="container my-3">
   <div class="jumbotron">
  <h4 class=" fs-5"> <?php echo $thread_title ?> ? </h4>
  <p class="lead"><?php echo $thread_description ?></p>
  <p>posted by: <b><?php echo $postedBy; ?></b></p>
  <hr class="my-4">
 
  <ol>
    <li>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate speech.</li>
    <li>Respect each other. Don't harass or grief anyone, impersonate people, or expose their private information.</li> 
</ol>

</div>

   </div>
   <div class="container">
   <h2>Post a Comment :</h2>
   <?php
    if ($loggedin) {
    echo'
    <form action=" '. $_SERVER['REQUEST_URI'].'" method="post">
    <div class="form-group">
    <label for="comment">Type your comment</label>
    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Post comment</button>
  </form>';
    
    }else{
      echo'  <p class="lead">login to post a comment</p>';
    }
    ?>

   </div>
   <div class=" container my-3">
   <h2>Discussion:</h2>
  
<?php
  $threadId = $_GET['threadId'] ;
 
  $sql =  "SELECT * FROM `comments` WHERE thread_id = $threadId;";
  $result = mysqli_query($conn,$sql);
 $noresult = true;
  while($row=mysqli_fetch_assoc($result)){
    $noresult = false;
    $comment_content= $row['comment_content'];
    $comment_id= $row['comment_id'];
    $dateObj = new DateTime($row['comment_time']);
    $formattedDate = $dateObj->format("d F Y \a\\t g:i a");
    $comment_by = $row['comment_by'];
    $sql2 =  "SELECT user_name FROM `users` WHERE `user_id` ='$comment_by' ";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);

    echo'
    <div class="media my-3 align-items-center">
    <img src="https://img.freepik.com/premium-vector/account-icon-user-icon-vector-graphics_292645-552.jpg" width="70px" class="mr-3" alt="...">
    <div class="media-body">
    <p class="lead my-0"><b>'.$row2['user_name'].'</b> <sapn id="textSmall">('. $formattedDate.')</span></p>
   
     '.$comment_content.'
      
    </div>
  </div>
    ';
   
  }
  
  if ($noresult) {
        
    echo' <div class="jumbotron jumbotron-fluid">
<div class="container">
  <h1 class="display-4">No Comments yet</h1>
  <p class="lead">be the first person to Answer a Question </p>
</div>
</div>';
}
?> 
   </div>
  
   <?php require "partials/_footer.php" ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>