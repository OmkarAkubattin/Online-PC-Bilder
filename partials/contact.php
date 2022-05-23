<?php 
include "_conn.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
  $email=$_POST['email'];
  $fname=$_POST['first_name'];
  $lname=$_POST['last_name'];
  $mobilenumber=$_POST['mobile_number'];
  $message=$_POST['message'];
  $result=sql_query("INSERT INTO `contact_us` (`email`, `f_name`, `l_name`, `mob_no`, `msg`) VALUES ('$email', '$fname', '$lname', '$mobilenumber', '$message')");
}
?>
<!doctype html>
<html lang="en">

<head>
  <link rel="icon" type="image/x-icon" href="../images/Logo.png">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>

  <title>Contact Us</title>

  <style>
    button{
      width: 25%;
    }
  </style>
    <script>
  function validateForm() {
  let x = document.forms["myForm"]["mobile_number"].value;
  if (x.length <10 || x.length > 11 ) {
    alert("Mobile Number Must 10 Character");
    return false;
  }
  else if (x =='') {
    alert("Mobile Number Cannot be Empty");
    return false;
  }
}
    </script>
</head>

<body>
<?php
  include "_nav.php";
  ?>
  <div style="background: linear-gradient(135deg, #f403d1, #64b5f6);" class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4 text-white"><b>Contact Us</b></h1>
    </div>
  </div>

  <div class="container col-xxl-10 px-4 border">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-4">
      <div class="col-10 col-sm-8 col-lg-6 ">
        <img src="../images/Contact.gif" class="d-block mx-lg-auto img-fluid" alt="Image error" width="700" height="700"
          loading="lazy">
      </div>


      <div class="col-lg-6 border-right">
        <div class="container col-xxl-10">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" name="myForm" onsubmit="return validateForm()"  method="POST">
            <div class="form-group pl-5 pr-5 pt-2">
              <input type="text" class="form-control" id="inputEmail4" name="first_name" placeholder="First name">
            </div>

            <div class="form-group pl-5 pr-5 pt-2">
              <input type="text" class="form-control" id="inputEmail4" name="last_name" placeholder="Last name">
            </div>

            <div class="form-group pl-5 pr-5 pt-2">
              <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email">
            </div>

            <div class="form-group pl-5 pr-5 pt-2">
              <input type="text" class="form-control" id="inputPassword4" name="mobile_number" placeholder="Mobile number">
            </div>

            <div class="form-group pl-5 pr-5 pt-2">
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="Write your message here.."></textarea>
            </div>

            <div id="design" class="form-group px-5 pt-2">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  include "_footer.php";
  ?>
</body>

</html>