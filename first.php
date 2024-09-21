//require 'signup.php';
//i//f($_SERVER["REQUEST_METHOD"] == "POST")
//<?php
//{
    

   // if(!isset(($_POST["password"]) || $error == 1)
  //  {
   //     echo
   // })
//}
//?>
 //if($password == $cpassword && $exists == false)
 //  {
 //   $sql = "INSERT INTO `requirement` ( `username`, `password`, `date`) VALUES ('$username', '$password', current_timestamp())";
 //  $result = mysqli_query($conn , $sql);
 //  if($result){
 //   $showalert = true;
 //  }
 //  }
 //  else{
 //   $showError = "password don't match";
 //  }
 $uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 && $password == $cpassword ) {
    echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
}else{
    echo 'Strong password.';
}