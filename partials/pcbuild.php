<!doctype html>
<html lang="en">
  <head>
    <?php
    include "_conn.php";
    $price=0.00;
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['delcookies'])){
      setcookie($_POST['delcookies'],'',time()-3600,'/');
      header("Location: pcbuild.php");
    }
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../images/Logo.png">
    <title>Component</title>
  </head>
  <body>
  <?php
  include "_nav.php";
  ?>
  <div style="background: linear-gradient(135deg, #f403d1, #64b5f6);" class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-white"><b>Select Component</b></h1>
      </div>
    </div>
    <div class="container">
      <div class="float-right col-md-4 pr-4 pb-4">
        <div class="input-group-append">
          <span class="input-group-text">₹</span>
          <?php
          $i=1;
          $buyall='https://www.amazon.in/gp/aws/cart/add.html?AssociateTag=pcpapi-a2c-20&AWSAccessKeyId=AKIAITM6762AGQCFUNQA';
          $result2=sql_query("SELECT * FROM `components`");
          if (mysqli_num_rows($result2) >0) {
            while($row2 = mysqli_fetch_assoc($result2)){
              if(isset($_COOKIE[$row2['component']])){
                $result3=sql_query("SELECT * FROM ".$row2['component']." WHERE `id`=".$_COOKIE[$row2['component']]."");
                if (mysqli_num_rows($result3) >0) {
                  while($row3 = mysqli_fetch_assoc($result3)){
                      $price=$price+floatval($row3['price']);
                      $rep=str_replace("https://amazon.in/dp/","",$row3['url']);
                      $rep=str_replace("?tag=aypc-21","",$rep);
                      $buyall=$buyall.'&ASIN.'.$i.'='.$rep.'&Quantity.'.$i.'=1';
                      $i=$i+1;
                  }
                }
              }
            }
          }
          if(isset($result3)){
            echo '<span class="input-group-text col-md-6">'.$price.'</span><a class="btn btn-success" href="'.$buyall.'" role="button">Buy From Amazon</a>';
          }
          else{
            echo '<span class="input-group-text col-md-12">'.$price.'</span>';
          }
          ?>
        </div>
      </div>
    <table class="table my-5">
        <thead>
          <tr>
            <th scope="col">Component</th>
            <th scope="col">Selection</th>
            <th scope="col">Price</th>
            <th scope="col">Buy Online</th>
          </tr>
        </thead>
        
        <tbody>
    <?php
      $result=sql_query("SELECT * FROM `components`");
      if (mysqli_num_rows($result) >0) {
        while($row = mysqli_fetch_assoc($result)){
          if(isset($_COOKIE[$row['component']])){
          $result1=sql_query("SELECT * FROM ".$row['component']." WHERE `id`=".$_COOKIE[$row['component']]."");}
          if(!isset($_COOKIE[$row['component']])){
            echo'<tr>
            <td>'.ucwords($row['component']).'</td>
            <td><a class="btn btn-primary btn-sm" href="'.'components/'.$row['component'].'.php'.'">'.'+ Select '.ucwords($row['component']).'</a></td>
            <td></td>
            <td></td>
            </tr>';
          }
          else if (mysqli_num_rows($result1) >0) {
            while($row1 = mysqli_fetch_assoc($result1)){
              if(isset($_COOKIE[$row['component']])){
                echo'<tr>
                <td>'.ucwords($row['component']).'</td>
                <td><img src="data:image/png;base64,'.base64_encode($row1['img']).'" width="40px" height="40px"/>&nbsp;&nbsp;&nbsp;<a href="'.$row1['url'].'">'.$row1['name'].'</a></td>
                <td>₹ '.$row1['price'].'</td>
                <td><form action="pcbuild.php" method="POST"><a class="btn btn-success btn-sm" href="'.$row1['url'].'" role="button">Buy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-close" aria-label="Close" name="delcookies" value="'.$row['component'].'"></button></form></td>
                </tr>';
                $price=$price+floatval($row1['price']);
              }
            }
          }
        }
      }
    ?>
        </tbody>
      </table>
    </div>
    <?php
    include "_footer.php";
    ?>
  </body>
</html>