<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
$loggedin = true;
}else{
  $loggedin = false;
}
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <div class="dropdown-menu">';

        $sql =  "SELECT category_name,category_id FROM `categories`Limit 4";
  $result = mysqli_query($conn,$sql);

  while($row=mysqli_fetch_assoc($result)){
  
    echo'<a class="dropdown-item" href="/forum/threadList.php?catId='.$row['category_id'].'">'.$row['category_name'].'</a>';
  }
         
        echo'</div>
      </li>
      <li class="nav-item">
      <a class="nav-link "href="contact.php" >Contact</a>
      </li>
    </ul>
    <form action="search.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" name="Query" type="search" placeholder="Search for threads" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>';
      if ($loggedin) {
      echo'
      <h4 class = "text-light mx-1">Welcome '.$_SESSION["username"].'</h4>
      <a href=partials/_logout.php><button  class="btn btn-outline-danger mx-2" >logout</button></a>' ;
      }else{
        echo'
        <button  data-toggle="modal" data-target="#loginModal"class="btn btn-outline-danger mx-2" >Login</button>
        <button data-toggle="modal" data-target="#signupModal" class="btn btn-outline-danger" >SignUp</button>
        ';
      }
     
 echo'</div>
 </nav>'; 



require "partials/_login.php";
require "partials/_signup.php";

?>