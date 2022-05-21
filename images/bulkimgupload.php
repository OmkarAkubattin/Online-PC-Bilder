<!-- UPDATE `processor` SET `img` = -->
<?php
    include "../partials/_conn.php"; 
    $i=0;
    $result=sql_query("SELECT * FROM `components`");
      if (mysqli_num_rows($result) >0) {
        while($row = mysqli_fetch_assoc($result)){
        $result1=sql_query("SELECT * FROM ".$row['component']."");
        if (mysqli_num_rows($result1) >0) {
            while($row1 = mysqli_fetch_assoc($result1)){
                $fileName = basename("$row/$i.jpg"); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);   
                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['img']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    $result=sql_query("UPDATE `$row` SET `img` = $imgContent where id=");
                }
            }
        }
    }
}
?>