<!doctype html>
<html lang="en">
  <head>
  <?php
    $tablename='monitor';
    include "../stcomp.html";
    include "../_conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
      setcookie($tablename,$_POST['getcookies'],time()+3600,'/');
      header("Location: ../pcbuild.php");
    }
    ?>
    <link rel="icon" type="image/x-icon" href="../../images/Logo.png">
    <title>Monitor</title>
  </head>
  <body>
  <?php
  include "../_nav.php";
  ?>
  <div style="background: linear-gradient(135deg, #f403d1, #64b5f6);" class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-white"><b>Select Computer Monitor</b></h1>
        <p class="lead text-white"><b>(Primary Display)</b></p>
      </div>
    </div>
    
    <div class="container">
    <table class="table my-5" id="myTable">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Size</th>
            <th scope="col">Res.</th>
            <th scope="col">RT</th>
            <th scope="col">Refresh r.</th>
            <th scope="col">Panel</th>
            <th scope="col">x:y</th>
            <th scope="col">CR</th>
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
            <td>'.$row['size'].'</td>
            <td>'.$row['res'].'</td>
            <td>'.$row['rt'].'</td>
            <td>'.$row['refresh'].'</td>
            <td>'.$row['panel'].'</td>
            <td>'.$row['x_y'].'</td>
            <td>'.$row['cr'].'</td>
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