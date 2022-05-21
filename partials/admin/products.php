<h1 class="mb-4">Components</h1>
<div class="row">
<?php
    $result=sql_query("SELECT * FROM `components`");
    if (mysqli_num_rows($result) >0) {
      while($row = mysqli_fetch_assoc($result)){
            echo '<div class="col text-center p-3" data-role="recipe">
              <div class="card" style="width: 10rem;height: 13rem;">
               <img class="ml-5 mx-auto d-block" src="data:image/png;base64,'.base64_encode($row["img"]).'" width="80px"/>
                <div class="card-body">
                  <h6 class="card-title">'.$row["component"].'</h6>
                  <form action="index.php" method="GET">
                  <button href="#" name="cat_name" value="'.$row["component"].'" class="btn btn-primary btn-sm ml-2">Add Products</button>
                  </form>
                </div>
              </div>
            </div>';
          }
        }
        ?>
</div>