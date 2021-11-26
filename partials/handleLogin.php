<?php 
     $showUsernameError = "false";
    $showError = "false"; //variable to check valid credentials
if($_SERVER["REQUEST_METHOD"] == "POST"){
         include'dbconnect.php';  //for connecting to database
         $email = $_POST["loginEmail"];
         $password = $_POST["loginPassword"];
 
          $sql = "Select * from users where user_email  = '$email'"; 
          $result = mysqli_query($conn,$sql);
          $num = mysqli_num_rows($result);
         if($num == 1){
              $row = mysqli_fetch_assoc($result);
                       if( password_verify( $password, $row['user_pass'])){
                              session_start();
                              $_SESSION['loggedin'] = true;
                              $_SESSION['sno'] = $row['$sno'];
                              $_SESSION['useremail'] = $email;
                            //   echo "logged in".$email;
                            header("Location: /form/index.php?loginsuccess=true");
                                  exit();
                         }
                        else{
                         // If user enters wrong password then this will get execute
                                 $showError = "Passwords do not match";
                 header("Location: /form/index.php?loginsuccess=false&error=$showError");
                               exit();

                            }
               }
           else{    
          // If user enters wrong username then this will get execute
             $showUsernameError = "Username does not exist";
              header("Location: /form/index.php?loginsuccess=false&error=$showUsernameError");
                exit();
           }
 }

?>

  
   