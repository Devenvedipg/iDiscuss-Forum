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
    <style>
        #maincontainer{
            min-height: 100vh;
        }
    </style>

</head>

<body>
    <!-- Including header.php and dbconnect.php -->
    <?php include 'partials/dbconnect.php';   ?>
    <?php include 'partials/header.php';   ?>


    <!-- Search Results -->
    <div class="container my-3"  id= "maincontainer">
        <h2 class="py-3">Search results for "<em><?php echo $_GET['search'] ?>" are...</em>
        </h2>
        

        <?php
             $noresults = true;
             $query = $_GET['search'];
             $sql = " select * from threads where match(thread_title,thread_desc) against('$query')";    
             $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id= $row['thread_id'];
                $noresults = false;
                $url = "thread.php?threadid=".$thread_id;

                //Display the search result
               echo '<div class="result">
                     <h4><a href="'. $url.'" class="text-dark">'. $title. '</a> </h4>
                      <p>'. $desc .'</p>
                </div>
                <hr>'; 
              }

              if($noresults){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">No Results Found</p>
                            <p class="lead"> Suggestions: <ul>
                                    <li>Make sure that all words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords. </li></ul>
                            </p>
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