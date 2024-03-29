<!DOCTYPE html>
<html lang="en">
<?php
include "../_conn.php";
include "../_nav.php";
?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            font-size: 20px;
        }

        th{
         padding: 5px 15px;   
        }
        td{
            padding: 5px 150px;
        }
        table{
            margin-left:auto;
            margin-right:auto;
            margin-top:35px;
        }
        .container{
            border: 1px solid #DDDDDD;
            margin-top: 50px;
        }
    </style>
</head>

<body>
<div class="container-fluid">
<div class="row">
    <div class="col-3 pt-3">
    <form action="help.php" method="get">
    <div class="list-group list-group-flush">
    <?php
    $result=sql_query("SELECT * FROM `components`");
      if (mysqli_num_rows($result) >0) {
        while($row = mysqli_fetch_assoc($result)){
        if($_GET['help_cat']==$row['component']){
        echo '<button href="#" type="submit" class="list-group-item list-group-item-action active" name="help_cat" value="'.$row['component'].'">'.$row['component'].'</button>';
        }
        else{
        echo '<button href="#" type="submit" class="list-group-item list-group-item-action" name="help_cat" value="'.$row['component'].'">'.$row['component'].'</button>';
        }
      }
      }
        ?>
    </div>
      </form>
    </div>
    <div class="col-7 container">
    <?php
    if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['help_cat'])){
      // setcookie($_POST['delcookies'],'',time()-3600,'/');
      // header("Location: pcbuild.php");
      include "../help/help-".$_GET['help_cat'].".php";
    }
    else{
      include "../help/help-processor.php";
    }
?>
    </div>
  </div>
</div>



    
<?php
include "../_footer.php";
?>
</body>
</html>