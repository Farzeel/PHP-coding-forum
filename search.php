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
    <style>
        #maincontainer{
            min-height: 86vh;
        }
    </style>
  </head>
  <body>
    <?php require "partials/_dbconnect.php" ?>
   <?php require "partials/_header.php" ?>
  
    <div class="container" id="maincontainer">
   
        <?php
         $query = $_GET['Query'] ;
         $sql =  "SELECT * FROM threads WHERE thread_title LIKE '%$query%' OR thread_description LIKE '%$query%'";
         $result = mysqli_query($conn,$sql);
        $resultfound =  mysqli_num_rows($result);
        echo' <h1 class="my-3">Search result for <em>"'.$_GET['Query'].'"</em> <span class = "text-primary">('.$resultfound.' result found)</span></h1>';
        $noresult = true;
         $boldQuery = "<b class='text-success'>$query</b>";

 
        //  $sql =  "SELECT * FROM threads WHERE MATCH(thread_title,thread_description) AGAINST (' $query');";
        
       
         while($row=mysqli_fetch_assoc($result)){
            $noresult = false;
            $title = str_ireplace($query, $boldQuery, $row['thread_title']);
    $description = str_ireplace($query, $boldQuery, $row['thread_description']);
           $id = $row['thread_id'];

           echo' 
           <a href="thread.php?threadId="'.$id.' class="text-dark my-2"><h4>'.$title.'</h4></a>
           <p>'.$description.'</p>';
         }
         if ($noresult) {
         echo'<div class="jumbotron">
         <h2 class="display-4 ">No results Found</h2>
         <p class="lead">Suggestions:
         <ul>
         <li>Make sure that all words are spelled correctly.</li>
         <li> Try different keywords.</li>
         <li>Try more general keywords.</li>
         </ul></p>
           </div>' ;  
         }
        ?>
       
    </div>
     
  
   <?php require "partials/_footer.php" ?>
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

  </body>
</html>