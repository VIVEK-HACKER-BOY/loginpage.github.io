<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;

    // Check whether this username Exist
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows >0){
      // $exists = true;
      $showError = "Username Already Exist";
    }
    else{
      // $exists = false;
      if(($password == $cpassword)){
          $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$password', current_timestamp())";
          $result = mysqli_query($conn, $sql);
          if ($result){
              $showAlert = true;
          }
      }
      else{
          $showError = "Passwords do not match";
    }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account is now created and you can login.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    if($showError){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong>' . $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
    </div>';
        }
    ?>
    <div class="container my-4">
     <h1 class="text-center">Signup to our website</h1>
     <form action="/loginsystem/signup.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter username">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" maxlength="23" class="form-control" id="username" name="password">
  </div>
  <div class="form-group">
    <label for="cpassword1">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" id="cpassword" name="cpassword">
    <small id="emailHelp" class="form-text text-muted">Make Sure To Type The Same Password</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
    </div>