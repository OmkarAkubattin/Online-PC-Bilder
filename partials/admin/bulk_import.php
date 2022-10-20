<div class="px-4 py-5">
<h1 class="mb-4">Bulk Import Products</h1>
  <div class="row">
    <div class="col">
        <label class="ml-1 mr-4">Export Demo CSV Sheet</label>
        <div class="dropdown">
  <button class="btn btn-Primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Download Sheet
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php
            $result=sql_query("SELECT * FROM `components`");
            if (mysqli_num_rows($result) >0) {
              while($row = mysqli_fetch_assoc($result)){
                    echo '<a class="dropdown-item" href="product_demo_sheets/'.$row["component"].'.csv">'.$row["component"].'</a>';
              }
            }
                    ?>
  </div>
</div>
</div>
    <div class="col">
        <div class="row ml-2">
            <div id="wrapper">
                <form method="post" action="import_file_csv.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Select CSV File: </label>
                        <input type="file" name="img" class="form-control-file">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" name="submit_file" value="Import Products"/>
                </form>
            </div>
        </div>
        </div>
    </div>
  </div>
