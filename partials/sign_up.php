<?php 
  session_start();
  include "_conn.php";
  if(isset($_SESSION['email'])){
    header("Location: admin/index.php");
    exit;
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
    <title>Sign up</title>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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
  else if (y.length <8) {
    alert("Password Length Must 8 to 20 Character");
    return false;
  }
  else if (x =='') {
    alert("Confirm Password Cannot be Empty");
    return false;
  }
}
    </script>
    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" name="myForm" onsubmit="return validateForm()" action="login.php" method="POST">
  <div class="text-center mb-4">
    <img src="../images/Logo.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 font-weight-normal"><b>PC Picker</b></h1>
    <p>Login first to Build You'r Dream Pc</p>
  </div>

  <div class="form-label-group">
    <input type="text" class="form-control" name="first_name" placeholder="First Name" required="" autofocus="">
    <label>First Name</label>
  </div>
  <div class="form-label-group">
    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="">
    <label>Last Name</label>
  </div>
  <div class="form-label-group">
    <input type="email" name="email" class="form-control" placeholder="Email address" required="">
    <label>Email Address</label>
  </div>
  <div class="form-label-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required="">
    <label>Password</label>
  </div>
  <div class="form-label-group">
    <input type="text" name="confirm_password" class="form-control" placeholder="Confirm Password" required="">
    <label>Confirm Password</label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name='sign_up'>Sign up</button>
  
    <p class="pt-4 text-center"></p>
  <p class="pt-1 text-center">Do you have an account? <a class="no_line"; href="login.php"><b>Sign in</b></a></p>
  <p class="mt-3 mb-3 text-muted text-center">© 2021-2022</p>
</form>
</body>
</html>