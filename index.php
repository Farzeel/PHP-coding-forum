<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/footer.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php require "partials/_dbconnect.php" ?>
   <?php require "partials/_header.php" ?>
   <?php
  
  if (isset($_GET['signup'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>sucess!</strong> your account has been registered sucessfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
 
 
   ?>

  <!-- Crousel Starts Here -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/random/2400x800/?programming" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/random/2400x800/?coding" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/random/2400x800/?css" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>
   
   <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
   <div class="container">
   <div class="row my-2">
   
   <!-- Loop through alll categories -->
   <?php
    $sql = "SELECT * FROM `categories`;";
    $result = mysqli_query($conn,$sql);
   
    while($row = mysqli_fetch_assoc($result)){
      echo'
      <div class="col-md-4 my-2">
        <div class="card" style="width: 18rem;">
    <img src="https://source.unsplash.com/random/400x300/?programming,'.$row["category_name"].'" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">'.$row["category_name"].'</h5>
        <p class="card-text">'.substr($row["category_description"],0,170).'....</p>
        <a href="threadList.php?catId='.$row["category_id"].'" class="btn btn-primary">View Thread</a>
    </div>
    </div>
    </div>
    
      
      ';
    }
   ?>
    
   </div>

   </div>
  
   <?php require "partials/_footer.php" ?>
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

  </body>
</html>