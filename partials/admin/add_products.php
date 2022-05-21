<?php
  $tablename='';
  if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['cat_name'])){
    $tablename=$_GET['cat_name'];
  }
?>
<div class="px-4 py-5">
<div class="container">

  <form action="index.php" method="POST" enctype="multipart/form-data">
  <h2>Add <?php echo ucwords($tablename);?> Component</h2>
  <div class="form-group row">
    <?php
    $fields = array();
    $result=sql_query("SHOW COLUMNS FROM $tablename");
    while ($x = mysqli_fetch_assoc($result)){
      $fields[] = $x['Field'];
    }
    foreach ($fields as $f) {
      if($f=="img" || $f=="fk_".$tablename || $f=="id"){
        continue;
      }
      echo '<div class="form-group col-md-6">
        <label>'.ucwords($f).' : </label>
        <input type="text" name="'.$f.'" class="form-control" placeholder="'.ucwords($f).'">
      </div>';
    }
      ?>
      </div>
      <div class="form-group">
        <label>Select Product Image</label>
        <input type="file" name="img" class="form-control-file">
      </div>
      <button type="submit" name="add_products" value="<?php echo $tablename;?>" class="btn btn-primary btn-block">Add Products</button>
    </form>
</div>
</div>

