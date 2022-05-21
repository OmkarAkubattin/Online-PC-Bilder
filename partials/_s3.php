<div class="px-4 py-5">
<div class="text-center">
       <h1 class="text-center pb-4"><b>Components</b></h1>
</div>
<div class="py-3">
</div>
<?php
    $result=sql_query("SELECT * FROM `components`");
    if (mysqli_num_rows($result) >0) {
      while($row = mysqli_fetch_assoc($result)){
        echo '<div class="container">
        <div class="row justify-content-md-center">
        <div class="col mr-5">
        <ul class="list-unstyled">
        <li class="media">
            <img src="data:image/png;base64,'.base64_encode($row["img"]).'" class="align-self-center mr-3" alt="..." width="80px">
            <div class="ml-4 media-body">
            <h4 class="mt-0 mb-1">'.ucwords($row['component']).'</h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
        </li>
        </ul>
        </div>
        <div class="col ml-5">
        <ul class="list-unstyled">
        <li class="media">
            <img src="data:image/png;base64,';
            if ($row = mysqli_fetch_assoc($result)) {echo base64_encode($row["img"]);
            echo'" class="align-self-center mr-3" alt="..." width="80px">
            <div class="mx-4 media-body">
            <h4 class="mt-0 mb-1">';echo ucwords($row['component']);
        }
            echo'</h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
        </li>
        </ul>
        </div>';
        if($row['id']!=14){
        echo '<div class="col ml-5">
        <ul class="list-unstyled">
        <li class="media">
        <img src="data:image/png;base64,';
            if ($row = mysqli_fetch_assoc($result)) {echo base64_encode($row["img"]);
            echo'" class="align-self-center mr-3" alt="..." width="80px">
            <div class="mx-4 media-body">
            <h4 class="mt-0 mb-1">';echo ucwords($row['component']);
        }
        echo'</h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
        </li>
        </ul>
        </div>
        </div>
        </div>';
    }
    else {
        echo '<div class="col ml-5">
        </div>
        </div>
        </div>';
    }
            }
        }
    ?>
</div>

