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

    <title>Hello, world!</title>
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
  $catId = $_GET['catId'] ;
 
  $sql =  "SELECT * FROM `categories` WHERE category_id=$catId;";
  $result = mysqli_query($conn,$sql);

  while($row=mysqli_fetch_assoc($result)){
    $cat_name = $row['category_name'];
    $cat_description = $row['category_description'];
  }

  ?>
<?php
$showalert = false;
 if ($_SERVER['REQUEST_METHOD']=="POST") {

  $title = $_POST['threadTitle'];
  $description = $_POST['threadDescription'];

  $title  = str_replace("<","&lt;",$title);
  $title  = str_replace(">","&gt;",$title);
  $description  = str_replace("<","&lt;",$description);
  $description  = str_replace(">","&gt;",$description);

  if ($title==" " || $description=="") {
    echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> please fill the fields
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
    ';
  }else{
    $sql = "INSERT INTO `threads` ( `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
    VALUES ( ' $title', '$description', $catId, '$_SESSION[userId]', current_timestamp())";
    $result = mysqli_query($conn,$sql);
   if ($result) {
     $showalert = true;
   }
  }

if ($showalert) {
  echo'
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sucess!</strong> Your question is uploaded. now please wait for community to respond to yor question.
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
  <h2 class="display-4 ">Welcome to <?php echo $cat_name ?> forums</h2>
  <p class="lead"><?php echo $cat_description ?></p>
  <hr class="my-4">
  <h4>RULES AND REGULATION:</h4>
  <ul>
    <li>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate speech.</li>
    <li>Respect each other. Don't harass or grief anyone, impersonate people, or expose their private information.</li>
  
</ul>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>

   </div>

   <div class="container">
    <h2>Start a Discussion :</h2>
    <?php
    if ($loggedin) {
    echo'
    <form action=" '. $_SERVER['REQUEST_URI'].'" method="post">
    <div class="form-group">
      <label for="threadTitle">Problem Title</label>
      <input type="text" class="form-control" id="threadTitle" name="threadTitle" aria-describedby="emailHelp">
      <small id="emailHelp" class="form-text text-muted">Make your problem Title as crisp and short as possible</small>
    </div>
    <div class="form-group">
      <label for="threadDescription">Eleborate your Problem</label>
      <textarea class="form-control" id="threadDescription" name="threadDescription" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Post</button>
  </form>';
    
    }else{
      echo'  <p class="lead">login to start the discussion</p>';
    }
   

    ?>

   </div>
   <div class=" container my-4">
   <h2>Browse Qusetion:</h2>

<?php
  $threadcatId = $_GET['catId'] ;
  $resultperpage = 10;
  $currentPage = isset($_GET['page']) ? $_GET['page']:1;
  $offset = ($currentPage-1)*$resultperpage;
 $totalresulutsql = "SELECT * FROM `threads`WHERE thread_cat_id = $threadcatId;";
 $resulttotal = mysqli_query($conn,$totalresulutsql);
$totalresult = mysqli_num_rows($resulttotal);

if ($totalresult==0) {
  $totalPages=1;
}else{
  $totalPages = ceil($totalresult / $resultperpage);
}

  $sql =  "SELECT * FROM `threads` WHERE thread_cat_id = $threadcatId LIMIT $offset,$resultperpage;";
  $result = mysqli_query($conn,$sql);
$noresult = true;
  while($row=mysqli_fetch_assoc($result)){
    $noresult = false;
    $thread_title= $row['thread_title'];
    $thread_description= $row['thread_description'];
    $thread_id= $row['thread_id'];
    $threadDate = $row['timestamp'];
    $dateObj = new DateTime($threadDate);
    $formattedDate = $dateObj->format("d F Y \a\\t g:i a");
    $thread_user_id = $row['thread_user_id'];
    $sql2 =  "SELECT user_name FROM `users` WHERE `user_id` ='$thread_user_id' ";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    
      
      
    echo'
    <div class="media my-3">
    <img src="https://img.freepik.com/premium-vector/account-icon-user-icon-vector-graphics_292645-552.jpg" width="70px" class="mr-3" alt="...">
    <div class="media-body">
    <p class="lead my-0"><b>'.$row2['user_name'].'</b> <sapn id="textSmall">('. $formattedDate.')</span></p>
      <h5 class="mt-0"> <a href="thread.php?threadId='.$thread_id.'">'.$thread_title.'</a> </h5>
      <p>'.$thread_description.'</p>
    </div>
  </div>
    ';
   
  }
  if ($noresult) {
    echo' <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">NO Threads Found</h1>
      <p class="lead">be the first person to ask a Question </p>
    </div>
  </div>';
  }
  $prevPage = max($currentPage - 1, 1);
  $nextPage = $currentPage + 1;

  echo '<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item ' . ($currentPage == 1 ? 'disabled' : '') . '">
      <a class="page-link" href="?catId=' . $threadcatId . '&page=' . $prevPage . '" tabindex="-1" aria-disabled="true">Previous</a>
    </li>';
    for ($i = 1; $i <= $totalPages; $i++) {
     echo'<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">
     <a class="page-link" href="?catId=' . $threadcatId . '&page=' . $i . '">' . $i . '</a>
   </li>' ;
    }
   echo ' <li class="page-item ' . ($currentPage == $totalPages ? 'disabled' : '') . '">
      <a class="page-link" href="?catId=' . $threadcatId . '&page=' . $nextPage . '">Next</a>
    </li>
  </ul>
</nav>';
 
?>
   </div>
  
   <?php require "partials/_footer.php" ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>