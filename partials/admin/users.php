<!-- Search functionality -->
<nav class="navbar navbar-light justify-content-center mt-4">
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Type a name" aria-label="Search" id="searchbox">
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </form>
</nav>

  <div class="row">
    <?php
    $i=0;
    $result=sql_query("SELECT * FROM `pcbuild_user`");
    if (mysqli_num_rows($result) >0) {
      while($row = mysqli_fetch_assoc($result)){
            echo '<div class="col-2 text-center p-3" data-role="recipe">
              <div class="card" style="width: 14rem;height: 17rem;">
                <img class="ml-5 pt-3 mx-auto d-block" src="data:image/png;base64,'.base64_encode($row["img"]).'" width="80px" height="80px"/>
                <div class="card-body">
                  <h6 class="card-title">'.$row["user"].'</h6>
                  <p class="card-text">'.$row["user_type"].'</p>
                  <form action="index.php" method="POST">
                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#exampleModal'.$i.'">Edit</button>
                    <button class="btn btn-danger btn-sm btn-block" type="submit" name="user_delete" value="'.$row["id"].'">Delete</button>
                  </form>
                  <div class="modal fade" id="exampleModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">'.$row["user"].'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="background-color: #EEEEEE;">
                      <form action="'.$_SERVER["PHP_SELF"].'" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">';
                          $tablename="pcbuild_user";
                          $fields = array();
                          $result2=sql_query("SHOW COLUMNS FROM $tablename");
                          while ($x = mysqli_fetch_assoc($result2)){
                            $fields[] = $x['Field'];
                          }
                          foreach ($fields as $f) {
                            if($f=="img" || $f=="pass" || $f=="id" || $f=="created"){
                              continue;
                            }
                            echo '<div class="form-group">
                              <label>'.ucwords($f).' : </label>
                              <input type="text" name="'.$f.'" class="form-control col-md-11 ml-2" value="'.$row[$f].'" placeholder="">
                            </div>';
                          }
                          echo '</div>
                          <div class="form-group">
                            <label>Select Product Image</label>
                            <input type="file" name="img" class="form-control-file">
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="save_changes" value="'.$tablename.' '.$row["id"].'" class="btn btn-primary">Save changes</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>';
            $i=$i+1;
          }
        }
    ?>
  </div>
