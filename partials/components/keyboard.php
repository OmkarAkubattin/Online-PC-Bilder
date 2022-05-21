<!doctype html>
<html lang="en">
  <head>
  <?php
    $tablename='keyboard';
    include "../stcomp.html";
    include "../_conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
      setcookie($tablename,$_POST['getcookies'],time()+3600,'/');
      header("Location: ../pcbuild.php");
    }
    ?>
    <link rel="icon" type="image/x-icon" href="../../images/Logo.png">
    <title>Keyboard</title>
  </head>
  <body>
  <?php
  include "../_nav.php";
  ?>
  <div style="background: linear-gradient(135deg, #f403d1, #64b5f6);" class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-white"><b>Select A Keyboard</b></h1>
        <p class="lead text-white"><b>(Tip : Use mechanical ones for comfort and joy of typing)</b></p>
      </div>
    </div>
    
    <div class="container">
    <table class="table my-5" id="myTable">
        <thead>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Style</th>
            <th scope="col">Switch</th>
            <th scope="col">Backlit</th>
            <th scope="col">Connection type</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        
        <tbody>
        <?php
        $result=sql_query("SELECT * FROM `$tablename`");
        if (mysqli_num_rows($result) >0) {
        while($row = mysqli_fetch_assoc($result)){
        echo'<tr>
            <td><img src="data:image/png;base64,'.base64_encode($row['img']).'" width="40px" height="40px"/></td>
            <td><a href="'.$row['url'].'">'.$row['name'].'</a></td>
            <td>'.$row['style'].'</td>
            <td>'.$row['switch'].'</td>
            <td>'.$row['backlit'].'</td>
            <td>'.$row['connection_type'].'</td>
            <td><form action="'.$tablename.'.php" method="POST">₹ '.$row['price'].'&nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-sm" type="submit" name="getcookies" value="'.$row['id'].'">Add</button></form></td>
          </tr>';
      }
    }
    ?>
        </tbody>
      </table>
    </div>
    <?php
    include "../_footer.php";
    ?>
  </body>
</html>