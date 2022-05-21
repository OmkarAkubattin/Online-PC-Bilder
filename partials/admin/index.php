<?php
  include "../_conn.php";
  session_start();
  if(!isset($_SESSION['email'])){
        header("Location: ../login.php");
        exit;
    }
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['logout'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit;
}
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['product_delete'])){
  $word=explode(" ", $_POST['product_delete']);
  $tablename=$word[0];
  $eid=intval($word[1]);
  $result=sql_query("DELETE FROM ".$tablename." WHERE id=".$eid."");
}
  $tablename='';
  if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add_products']) || isset($_POST['save_changes']) ){
    if(isset($_POST['add_products'])){
      $tablename=$_POST['add_products'];
      // die($tablename);
    }
    else if(isset($_POST['save_changes'])){
      $word=explode(" ", $_POST['save_changes']);
      $tablename=$word[0];
      $eid=intval($word[1]);
      // die($tablename);
    }
    $fields = array();
    $insertarr = array();
    $result=sql_query("SHOW COLUMNS FROM ".$tablename."");
    // die(var_dump($result));
    while ($x = mysqli_fetch_assoc($result)){
      $fields[] = $x['Field'];
    }
    foreach ($fields as $f) {
      if($f=="fk_".$tablename){
        $result2=sql_query("SELECT * FROM `components` WHERE 'component'='$tablename'");
      // die("SELECT * FROM `components` WHERE 'component'='$tablename'");
        if (mysqli_num_rows($result2) >0) {
          while($row2 = mysqli_fetch_assoc($result2)){
            $insertarr[$f]=$row2["component"];
      }
    }
  }
      else if($f=="id"){
        continue;
      }
      else if($f=="img"){
        $status = $statusMsg = ''; 
        if(isset($_POST["add_products"]) || isset($_POST['save_changes'])){ 
            $status = 'error'; 
            if(!empty($_FILES["img"]["name"])) { 
                // Get file info 
                $fileName = basename($_FILES["img"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                
                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['img']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                
                    // Insert image content into database 
                    $insertarr[$f]="'".$imgContent."'";
                }
              }
            }
          }
          else{
            $insertarr[$f]="'".$_POST[$f]."'";
          }
    }
    $idskey = implode(', ', array_keys($insertarr));
    $idsvalue = implode(', ', array_values($insertarr));
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['save_changes'])){
      foreach ($fields as $value) {
        if($value=="id"){
          continue;
        }
        else if(!isset($insertarr[$value])){
          continue;
        }
        $result=sql_query("UPDATE $tablename SET $value = $insertarr[$value] WHERE $tablename.`id` = ".$eid."");
        // die("UPDATE $tablename SET $value = $insertarr[$value] WHERE $tablename.`id` = ".$eid."");
      }
    // die(var_dump($insertarr).'<br>'.var_dump($fields));
    }
  else if(isset($_POST['add_products'])){
    $result=sql_query("INSERT INTO $tablename ($idskey) VALUES ($idsvalue)");
  }
  }
?>
<html lang="en"><script type="text/javascript" src="chrome-extension://fholmcjfabjmfdkpojgmakdkoakgihpk/disable-visibility-detection.js"></script><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Dashboard Template · Bootstrap</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
  </script>
    

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
    /*!
    Customs CSS stylesheet
  */

    body {
      background-color: #EEEEEE;
    }

    .layout-margin-8 {
      margin: 3% 8%;
    }

    .card-img-top-custom {
      width: 50%;
      margin: 0 auto;
    }

    .card-title {
      text-align: center;
    }

    .card-shadow {
      -webkit-box-shadow: 0px 0px 28px 14px rgba(232,232,232,1);
      -moz-box-shadow: 0px 0px 28px 14px rgba(232,232,232,1);
      box-shadow: 0px 0px 28px 14px rgba(232,232,232,1);
    }

    .card-deck {
      display: flex;
      justify-content: space-around;
      flex-flow: row wrap;
      align-items: stretch;
    }

    .card {
      padding: 3% 1.5%;
      border: none;
      max-width: 375px;
      flex-grow: 1;
    }

    @media (min-width: 768px) {
    .form-control {
      width: 500px !important;
      height: 50px;
    }
    }

    .bg-blue {
      background-color: #005EB8;
    }
  </style>
  <script>
    $(document).ready(function() {
    $("#searchbox").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $('div[data-role="recipe"]').filter(function() {
            $(this).toggle($(this).find('h6').text().toLowerCase().indexOf(value) > -1)
        });
    });
});
  </script>
  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
<body>
<!-- fixed-top -->
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/project/partials/pcbuild.php">
  <?php
  $result1=sql_query("SELECT * FROM `website_info`");
  if(mysqli_num_rows($result1) > 0){
    while($row1 = mysqli_fetch_assoc($result1)){
    echo '<img src="data:image/png;base64,'.base64_encode($row1["img"]).'" alt="" width="30" height="30" class="d-inline-block align-text-center">
    <b>'.$row1["name"].'</b>';
  }
}
?>
  </a>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<ul class="navbar-nav px-3">
  <li class="nav-item text-nowrap">
    <button class="nav-link btn btn-link" type="submit" name='logout'>Sign out</button>
  </li>
</ul>
</form>
</nav>

<div class="container-fluid ">
<div class="row">
  <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-5">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
        <form action="index.php" method="GET">
          <button class="nav-link <?php if(isset($_GET['dashboard'])){echo 'active';}?> btn btn-link" href="#" type="submit" name="dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Dashboard <span class="sr-only">(current)</span>
          </button>
        </form>
        </li>
        <li class="nav-item">
        <form action="index.php" method="GET">

          <button class="nav-link <?php if(isset($_GET['products'])){echo 'active';}?> btn btn-link" href="#" type="submit" name="products">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
          <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
          <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
          </svg> 
          Cocmponents
          <?
          echo $err;
          ?>
          </button>
        </form>
        </li>
      </ul>
      </ul>
    </div>
  </nav>

  <main role="main" class="pt-5 col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
  <script type="text/javascript"  src="search.js"></script>
  <?php
  if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['dashboard'])){
    include "dashboard.php";
  }
  else if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['products'])){
    include "products.php";  
  }
  else if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['cat_name'])){
    include "add_products.php"; 
  }
  else{
    include "dashboard.php";
  }
  ?>



  </main>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.9.0/dist/feather.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
      <script src="dashboard.js"></script>

</body></html>