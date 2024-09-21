<?php
$showalert = false;
$error = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include 'partials/dbconnect.php';
$username = $_POST["Username"];
$password = $_POST["Password"];
$cpassword = $_POST["cpassword"];


$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

$sql ="SELECT username FROM requirement WHERE username='$username'";
$result = mysqli_query($conn , $sql);
$count_user = mysqli_num_rows($result);

if($count_user == 0 )
{
 if($password == $cpassword && $uppercase && $lowercase && $number && $specialChars && strlen($password) > 8)
 {
  $hash = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO requirement ( `username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
   $result = mysqli_query($conn , $sql);
   if($result)
   {
    $showalert = true;
   }
  }
}
   if($count_user > 0){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error</strong> User already exists.
  <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
   }
   if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
   {
   $error = true;
   }
   
   if($password != $cpassword){
    $showError = "password don't match";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="sign.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>signup</title>
  </head>
  <body>
    <?php require 'partials/nav.php' ?>
    <?php
    if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error</strong> '.$showError.';
  <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
    }
 if($error){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error</strong> Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.;
<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
    }
    if($showalert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> Account createde and you can login.
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
   </div>';
      }
 ?>
    <h1 class="text-center">signup to our website</h1>
    <div class="container" my-4>
    
    <form action="/optcl/signup.php" method="post">
  <div class="mb-3 ">
    <label for="Username" class="form-label">Username</label>
    <input type="text" class="form-control" id="Username" name="Username" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3 ">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="Password" name="Password">
  </div>
  <div class="mb-3 ">
    <label for="cpassword" class="form-label">confirm password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">make sure to type the same password</div>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>