<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss - Forums</title>
</head>

<body>
    <!-- Including header.php and dbconnect.php -->
    <?php include 'partials/dbconnect.php';   ?>
    <?php include 'partials/header.php';   ?>


    <?php 
     
     $id = $_GET['threadid'];
     $sql = "SELECT * FROM `threads` WHERE thread_id = $id ";
     $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){
          $tname = $row['thread_title'];
          $tdesc = $row['thread_desc'];
          $thread_user_id = $row['thread_user_id'];

          // Query for the users table to find out the name of OP(Original Poster)
          $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
          $result2 = mysqli_query($conn, $sql2);
          $row2 = mysqli_fetch_assoc($result2);
          $posted_by = $row2['user_email'];
  
        }

     ?>

    <?php 
          $showAlert = false;
         $method = $_SERVER['REQUEST_METHOD'];
        //   echo $method;
            if($method == 'POST'){
                $comment = $_POST['comment'];
                $comment = str_replace("<", "&lt;", $comment);
                $comment = str_replace(">", "&gt;", $comment); 
                $sno = $_POST['sno'];

            
          $sql = " INSERT INTO `comments` ( `coment_content`, `thread_id`, `comment_by` ) VALUES ( '$comment', '$tid', '$sno')";
          $result = mysqli_query($conn,$sql);
           $showAlert = true;
             if($showAlert){
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your comment has been added!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
             }

        }
     
     ?>

    <!-- Container for showing large view of the thread(problem) -->
    <div class="container my-4">
        <div class="jumbotron">
            <h3 class="display-4"><?php echo $tname;?></h3>
            <p class="lead"><?php   echo $tdesc;   ?></p>
            <hr class="my-4">
            <h4>This is a peer to peer to forum</h4>
            <ul> 
                <li> No Spam / Advertising / Self-promote in the forums<br></li>
                <li> Do not post copyright-infringing material<br></li>
                <li> Do not post “offensive” posts, links or images<br></li>
                <li> Do not cross post questions<br></li>
                <li> Remain respectful of other members at all times</li>
            </ul>
            <!-- <p>Posted by:<b> Deven</b></p> -->
            <p><b>Posted by:</b> <em><?php echo $posted_by; ?></em></p>
        </div>
    </div>
    <hr>

    <!-- Form for posting comments-->
    <?php
     if( isset($_SESSION['loggedin']) && isset($_SESSION['loggedin']) == true ){
        echo'<div class="container">
        <h2 py-2>Post a Comment</h2>
        <form action= " '.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="form-group">
                <label for="Typing comment">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type = "hidden" name = "sno" value ="'.$_SESSION['sno'].'" >

            </div>
            <button type="submit" class="btn btn-success my-3">Post Comment</button>
        </form>
    </div>';
     }

     else{
         echo '<div class="container">
            <h1 class="py-2">Post a Comment</h1> 
              <p class = "lead" >You are not logged in . Please login to be able to post comments.</p>
            </div>
            <hr>';
      
        }
    ?>


    <!-- Query for fetching Comment content from Comments db-->
    <div class="container py-3">
        <?php 
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id = $id ";
            $result = mysqli_query($conn,$sql);
            $noResult = true;

          while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $co_id = $row['comment_id'];
                    $co_content = $row['comment_content'];
                    $comment_time = $row['comment_time'];
                    $thread_user_id = $row['comment_by']; 

                    $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id' ";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
        
            //  It shows us the comment by fetching from comments db 
        echo'<div class="media my-3">
            <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="font-weight-bold my-0"><b>Posted by: </b>'. $row2['user_email'] .' at '. $comment_time. '</p> '. $co_content . '
            </div>
        </div>';

    }

       // If no comments found inside the comment db,then if condition will get executed
         if($noResult){
            echo'<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-6">No Comments Found</p>
              <p class="lead">Be the first person to post a comment on this thread</p>
            </div>
          </div>';
         }

 ?>

        <!-- footer of the idiscuss forum website -->
        <div>
            <?php include 'partials/footer.php'?>
        </div>


        <!-- Optional JavaScript  -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
</body>

</html>