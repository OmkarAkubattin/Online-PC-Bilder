<!-- Search functionality -->
<nav class="navbar navbar-light justify-content-center mt-4">
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Type a name" aria-label="Search" id="searchbox">
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </form>
</nav>

  <div class="row">
    <?php
    $result=sql_query("SELECT * FROM `components`");
    if (mysqli_num_rows($result) >0) {
      while($row = mysqli_fetch_assoc($result)){
        $result1=sql_query("SELECT * FROM ".$row['component']."");
        if (mysqli_num_rows($result1) >0) {
          while($row1 = mysqli_fetch_assoc($result1)){
            echo '<div class="col text-center p-3" data-role="recipe">
              <div class="card" style="width: 14rem;height: 14rem;">
                <img class="ml-5 mx-auto d-block" src="data:image/png;base64,'.base64_encode($row1["img"]).'" width="80px" height="80px"/>
                <div class="card-body">
                  <h6 class="card-title">'.$row1["name"].'</h6>
                  <p class="card-text">'.$row["component"].'</p>
                  <form class="form-inline" action="index.php" method="POST">
                    <button type="button" class="btn btn-primary btn-sm ml-5" data-toggle="modal" data-target="#exampleModal">Edit</button>
                    <button class="btn btn-primary btn-sm ml-2 mr-3" type="submit" name="product_delete" value="'.$tablename.' '.$row1["id"].'">Delete</button>
                  </form>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">'.$row1["name"].'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="background-color: #EEEEEE;">
                      <form action="'.$_SERVER["PHP_SELF"].'" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">';
                          $tablename=$row["component"];
                          $fields = array();
                          $result2=sql_query("SHOW COLUMNS FROM $tablename");
                          while ($x = mysqli_fetch_assoc($result2)){
                            $fields[] = $x['Field'];
                          }
                          foreach ($fields as $f) {
                            if($f=="img" || $f=="fk_".$tablename || $f=="id"){
                              continue;
                            }
                            echo '<div class="form-group">
                              <label>'.ucwords($f).' : </label>
                              <input type="text" name="'.$f.'" class="form-control col-md-11 ml-2" placeholder="'.$row1[$f].'">
                            </div>';
                          }
                          echo '</div>
                          <div class="form-group">
                            <label>Select Product Image</label>
                            <input type="file" name="img" class="form-control-file">
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="save_changes" value="'.$tablename.' '.$row1["id"].'" class="btn btn-primary">Save changes</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>';
          }
        }
      }
    }
    ?>
  </div>
