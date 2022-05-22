<?php 
  session_start();
  include "_conn.php";
  if(isset($_SESSION['email'])){
    header("Location: admin/index.php");
    exit;
}
  if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['sign_in'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $result=sql_query("SELECT * FROM `pcbuild_user` WHERE user='$email'");
    if($result){
      echo '<script>
        alert("Invalid Credentials");
        </script>';
      }
    if (mysqli_num_rows($result) >0) { 
      while($row = mysqli_fetch_assoc($result)) { 
        if($row['user']==$email && password_verify($pass,$row['pass'])){ 
          $_SESSION['email']=$email;
          $_SESSION['firstname']=$row['firstname']; 
          $_SESSION['id']=$row['id'];
          header("Location: admin/index.php"); 
        }; 
      } 
    } 
  } 
$signup=0;
  if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['sign_up'])){
    $email=$_POST['email'];
    $pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $fname=$_POST['first_name'];
    $lname=$_POST['last_name'];
    $result=sql_query("INSERT INTO `pcbuild_user` (`user`, `pass`, `f_name`, `l_name`, `user_type`) VALUES ('$email', '$pass', '$fname', '$lname', 'Admin')");
    if(!$result){
      // die("SELECT * FROM `pcbuild_user` WHERE 'user'='$email'");
        $signup=0;
        echo '<script>
          alert("Username is Already Available");
          </script>';
    }
    else{
      $signup=1;
    }
  //   else if(isset($result)){
  //     header("Location: login.php");
  //     exit;
  // }
}
?>

<html lang="en">
  <head>
    <link rel="icon" type="image/x-icon" href="../images/Logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login</title>
<!-- <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      .no_line:hover{
        text-decoration: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <script>
  function validateForm() {
  let x = document.forms["myForm"]["confirm_password"].value;
  let y = document.forms["myForm"]["password"].value;
  if (x != y) {
    alert("Confirm Password Doesn\'t match");
    return false;
}
    </script>
    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" name="myForm" onsubmit="return validateForm()" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="text-center mb-4">
    <img src="../images/Logo.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 font-weight-normal"><b>PC Picker</b></h1>
    <p>Login first to Build You'r Dream Pc</p>
  </div>
  <?php
  if($signup){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfully !! </strong> Account is Created.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>';
  }
  ?>
  <div class="form-label-group">
    <input type="email" class="form-control" name="email" placeholder="Email address" required="" autofocus="">
    <label>Email address</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required="">
    <label>Password</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="86400" name="remember_me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name='sign_in'>Login</button>
  
    <p class="pt-4 text-center"><a class="no_line"; href=""><b>Forgot password?</b></a></p>
  <p class="pt-1 text-center">Don't have an account? <a class="no_line"; href="sign_up.php"><b>Sign up</b></a></p>
  <p class="mt-3 mb-3 text-muted text-center">© 2021-2022</p>
</form>


</body></html>