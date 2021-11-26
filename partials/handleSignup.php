<?php
    $showError = "false";  // If passwords does not get match

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            include 'dbconnect.php';
            $user_email = $_POST['signupEmail'];
            $signupPassword = $_POST['signupPassword'];
            $signupcPassword = $_POST['signupcPassword'];

    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError = "Email already in use";
    }

    else{
        if($signupPassword == $signupcPassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result){
                $showAlert = true;
                 header("Location: /form/index.php?signupsuccess=true");
                 exit();
            }
        }
        else{
            $showError = "Passwords do not match";

        }

    }
    header("Location: /form/index.php?signupsuccess=false&error=$showError");

} // end of post request if condition
    
?>

