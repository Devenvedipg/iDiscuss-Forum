<?php
    session_start();
    //  include 'partials/dbconnect.php'; 

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

              $sql = "SELECT category_name,category_id FROM `categories` LIMIT 3";
               $result = mysqli_query($conn,$sql);
              while($row = mysqli_fetch_assoc($result)){
                $cat_id = $row['category_id'];
               echo'<a class="dropdown-item " href="threadlist.php?catid='.$cat_id.'">'.$row['category_name'].'</a>';
              
             }
            
        echo'</div>
        </li>
            <li class="nav-item">
              <a class="nav-link " href="contact.php">Contact</a>
            </li>
        </ul>

        <div class="row mx-2">';
         //If user is  logged in(then show search,logout buttons only)
        if(  isset($_SESSION['loggedin']) && isset($_SESSION['loggedin']) == true   ){
               echo'<form class="d-flex" action = "search.php" method = "get">
              <input class="form-control me-2" type="search" name = "search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
                     <p class = "text-light my-0 mx-2"> Welcome '.$_SESSION['useremail'].'</p>
                     <a href = "partials/logout.php"  type="button" class="btn btn-outline-success mx-2">Logout</a>
                     </form>';
  
                }

                //If user is not logged in(then show search, login ,signup buttons)
                else{
                      echo'<form class="d-flex" action = "search.php" method = "get">
                        <input class="form-control me-2" type="search" name = "search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#LoginModal" >Login</button>
                        <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#SignupModal">Signup</button>
                         </form>';
                     }
          echo'</div>
      </div>
  </div>
</nav>';

    include 'loginmodal.php';
    include 'signupmodal.php';
              // If user successfully gets sign up
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
       echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> You can now login using your email and password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
               </button>
            </div> ';
            
 }
            // If user successfully gets sign up
 if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
           <strong>Success!</strong> Welcome.You are now logged in to iDiscuss Forums.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
          </button>
       </div> ';
       
}
  
  
?>