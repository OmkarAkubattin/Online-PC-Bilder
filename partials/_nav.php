<nav class="navbar navbar-expand-lg navbar-light shadow-sm p-3 px-4 border border-bottom"
  style="background-color: #ffffff; border-color: rgb(197, 197, 197);">
  <a class="navbar-brand" href="partials/pcbuild.php">
  <?php
  $result1=sql_query("SELECT * FROM `website_info`");
  if(mysqli_num_rows($result1) > 0){
    while($row1 = mysqli_fetch_assoc($result1)){
    echo '<img src="data:image/png;base64,'.base64_encode($row1["img"]).'" alt="" width="50" height="50" class="d-inline-block align-text-center">
    <b>'.$row1["name"].'</b>';
  }
}
?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item <?php if($_SERVER["PHP_SELF"]=="/project/partials/pcbuild.php"){echo 'active font-weight-bold';}?> mr-3">
        <a class="nav-link" href="/project/partials/pcbuild.php">Build PC<span class="sr-only">(urrent)</span></a>
      </li>
      <li class="nav-item dropdown mr-3">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Components
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
          $result=sql_query("SELECT * FROM `components`");
          if (mysqli_num_rows($result) >0) {
          while($row = mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="'.'/project/partials/components/'.$row['component'].'.php'.'">'.ucwords($row['component']).'</a>';
          if($row['id']==5){
            break;
          }
          }
        }
          ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/project/partials/pcbuild.php">See all</a>
        </div>
      </li>
      <li class="nav-item <?php if($_SERVER["PHP_SELF"]=="/project/partials/about.php"){echo 'active font-weight-bold';}?>">
        <a class="nav-link mr-3" href="/project/partials/about.php">About us</a>
      </li>
      <li class="nav-item <?php if($_SERVER["PHP_SELF"]=="/project/partials/contact.php"){echo 'active font-weight-bold';}?>">
        <a class="nav-link mr-3" href="/project/partials/contact.php">Contact us</a>
      </li>
    </ul>
    <!-- <a class="btn btn-primary my-2 my-sm-0 px-4" href="partials/pcbuild.php" role="button">Build PC</a> -->
    <a class="btn btn-primary ml-3 my-2 my-sm-0 px-4" href="/project/partials/login.php" role="button">Login</a>
  </div>
</nav>