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
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search_component'])){
  
}
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['product_delete'])){
  $word=explode(" ", $_POST['product_delete']);
  $tablename=$word[0];
  $eid=intval($word[1]);
  $result=sql_query("DELETE FROM ".$tablename." WHERE id=".$eid."");
}
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['user_delete'])){
  $tablename="pcbuild_user";
  $result=sql_query("DELETE FROM ".$tablename." WHERE id=".$_POST['user_delete']."");
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
        $result2=sql_query("SELECT * FROM `components` WHERE `component`='$tablename'");
      // die("SELECT * FROM `components` WHERE `component`='$tablename'");
        if (mysqli_num_rows($result2) >0) {
          while($row2 = mysqli_fetch_assoc($result2)){
            $insertarr[$f]=$row2["id"];
            // die($row2['component']);

          }
        }
      }
      else if($f=="id"){
        continue;
      }
      else if($f=="created"){
        continue;
      }
      else if($f=="fk_user"){
        $insertarr[$f]=$_SESSION["id"];
      }
      else if($f=="img"){
        $status = $statusMsg = ''; 
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
                // die($imgContent);
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
        // if($value=='img'){
        //   // die("UPDATE $tablename SET $value = $insertarr[$value] WHERE $tablename.`id` = ".$eid."");
        // }
      }
    // die(var_dump($insertarr).'<br>'.var_dump($fields));
    }
  else if(isset($_POST['add_products'])){
    $result=sql_query("INSERT INTO $tablename ($idskey) VALUES ($idsvalue)");
    // die("INSERT INTO $tablename ($idskey) VALUES ($idsvalue)");
  }
  }
  if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit_file"]))
    {
    $tablename=str_replace(".csv","", $_FILES["file"]["name"]);;
    $fields = array();
    $insertarr = array();
    $result11=sql_query("SHOW COLUMNS FROM ".$tablename."");
    // die("SHOW COLUMNS FROM ".$tablename."");
    $importsheet = $_FILES["file"]["tmp_name"];
    $importsheet_open = fopen($importsheet,"r");
    while(($csv = fgetcsv($importsheet_open, 1000, ",")) !== false)
    {
      $i=0;
      die($csv[1]);
      if($csv[0]=="name"){
      continue;
      }
      else{
      while ($x = mysqli_fetch_assoc($result11)){
        $fields[] = $x['Field'];
      }
      foreach ($fields as $f) {
        if($f=="fk_".$tablename){
          $result2=sql_query("SELECT * FROM `components` WHERE `component`='$tablename'");
          if (mysqli_num_rows($result2) >0) {
            while($row2 = mysqli_fetch_assoc($result2)){
              $insertarr[$f]=$row2["id"];
            }
          }
          continue;
        }
        else if($f=="id"){
          continue;
        }
        else if($f=="img"){
          continue;
        }
        else if($f=="fk_user"){
          $insertarr[$f]=$_SESSION["id"];
          continue;
        }
        else{
          // die($csv[5]);
          $insertarr[$f]=$csv[$i];
        }
      $i=$i+1;
  }
  }
  $idskey = implode(', ', array_keys($insertarr));
  $idsvalue = implode(', ', array_values($insertarr));
  $idsvalue = "'".$idsvalue."'";
  $idsvalue = str_replace(",","','",$idsvalue);
  $result=sql_query("INSERT INTO $tablename ($idskey) VALUES ($idsvalue)");
  // die("INSERT INTO $tablename ($idskey) VALUES ($idsvalue)");
}
}

if(isset($_POST["export"])) {
  $tablename=$_POST["export"];
  $fields = array();
  $insertarr = array();
  $result11=sql_query("SHOW COLUMNS FROM ".$tablename."");
  // die("SHOW COLUMNS FROM ".$tablename."");
  while ($x = mysqli_fetch_assoc($result11)){
    $fields[] = $x['Field'];
  }
  foreach ($fields as $f) {
    if($f=="fk_".$tablename){
      continue;
    }
    if($f=="fk_user"){
      continue;
    }
    else if($f=="id"){
      continue;
    }
    else if($f=="img"){
      continue;
    }
    else{
    $insertarr[] = $f;
    }
  }
  // die(var_dump($insertarr));
  $idskey = implode(', ', array_values($insertarr));
  $items = array();
  // die("SELECT $idskey FROM $tablename WHERE fk_user=".$_SESSION["id"]."");
  $result=sql_query("SELECT $idskey FROM $tablename WHERE fk_user=".$_SESSION["id"]."");
          if (mysqli_num_rows($result) >0) {
            while($row = mysqli_fetch_assoc($result)){
              $items[] = $row;
              // die(var_dump($row));
            }
          }
          // die(var_dump($items));
  //Define the filename with current date
  $fileName = $tablename.".xls";

  //Set header information to export data in excel format
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename='.$fileName);
  header("Pragma: no-cache");
  header("Expires: 0");

  //Set variable to false for heading
  $heading = false;

  //Add the MySQL table data to excel file
  if(!empty($items)) {
  foreach($items as $item) {
    if(sizeof($items)==1){
      echo implode("\t", array_keys($item)) . "\n";
      echo implode("\t", array_values($item)) . "\n";
    }
    else if(!$heading) {
      echo implode("\t", array_keys($item)) . "\n";
      $heading = true;
    }
    else{
      echo implode("\t", array_values($item)) . "\n";
  }
  }
  }
  exit();
}


?>

<html lang="en"><script type="text/javascript" src="chrome-extension://fholmcjfabjmfdkpojgmakdkoakgihpk/disable-visibility-detection.js"></script><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <link rel="icon" type="image/x-icon" href="../../images/Logo.png">
  <title>Dashboard</title>
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
           Components
          <?
          echo $err;
          ?>
          </button>
        </form>
        </li>
        <li class="nav-item">
        <form action="index.php" method="GET">
          <button class="nav-link <?php if(isset($_GET['bulk_import'])){echo 'active';}?> btn btn-link" href="#" type="submit" name="bulk_import">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
  <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg>
            Bulk Import
          </button>
        </form>
        </li>
        <li class="nav-item">
        <form action="index.php" method="GET">
          <button class="nav-link <?php if(isset($_GET['export_product'])){echo 'active';}?> btn btn-link" href="#" type="submit" name="export_product">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
  <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
</svg>
            Export Product
          </button>
        </form>
        </li>
        <li class="nav-item">
        <form action="../help/help.php" method="GET">
          <button class="nav-link <?php if(isset($_GET['help'])){echo 'active';}?> btn btn-link" href="#" type="submit" name="help_cat" value="processor">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
          Help : Product Import
          </button>
        </form>
        </li>
        <?php
        if($_SESSION['user_type']=="Admin"){
        echo '<li class="nav-item">
        <form action="index.php" method="GET">
          <button class="nav-link btn btn-link '.(isset($_GET["help"])?"active":"").'" href="#" type="submit" name="users">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
          <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
          <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z"/>
        </svg>
          Users
          </button>
        </form>
        </li>';
        }
        ?>
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
  else if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['bulk_import'])){
    include "bulk_import.php"; 
  }
  else if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['export_product'])){
    include "export_product.php"; 
  }
  else if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['users'])){
    include "users.php"; 
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