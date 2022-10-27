<div class="px-4 py-5">
<h1 class="mb-4">Bulk Export Products</h1>
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
                    echo '<form action="index.php" method="POST">
                    <button class="dropdown-item" type="submit" name="export" value="'.$row["component"].'">'.$row["component"].'</button>';
              }
            }
                    ?>
  </div>
</div>
</div>
</div>
