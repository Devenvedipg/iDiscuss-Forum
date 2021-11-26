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
            
      <!-- Caraousal (Slider) starts here -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner"  id="first">
    <div class="carousel-item active">
     <img src="img/slider-1.jpeg" class="d-block w-100" alt="image not found">
    </div>

    <div class="carousel-item" id="second">
    <img src="img/slider-2.jpeg" class="d-block w-100" alt="image not found">
    </div>

    <div class="carousel-item" id="third">
    <img src="img/slider-3.jpeg" class="d-block w-100" alt="image not found">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#second" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#third" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    <!-- Category container starts here -->
    <div class="container my-3">
        <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>

        <div class="row">
              <!-- Fetch all the categories from categories db and Use a loop to iterate through categories -->
              <?php 
                  $sql = "SELECT * FROM `categories`";
                  $result = mysqli_query($conn,$sql);

                   while($row = mysqli_fetch_assoc($result)){
                         $cat_id = $row['category_id']; 
                         $cat_name = $row['category_name'];
                         $cat_des = $row['category_description'];

                       echo '<div class="col-md-4 my-3">
                        <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/500x400/?'.$cat_name.',coding" class="card-img-top" alt="'.$cat_name.' image">
                            <div class="card-body">
                                <h5 class="card-title"><a href = "threadlist.php?catid='.$cat_id.'"> '.$cat_name.' </a></h5>
                                <p class="card-text">'.substr($cat_des,0,120).'...</p> 
                                <a href="threadlist.php?catid='.$cat_id.'" class="btn btn-success">View threads</a>
                            </div>
                        </div> 
                   </div>';}
                           
    ?>
          <!-- footer of the idiscuss forum website -->
             <div >
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