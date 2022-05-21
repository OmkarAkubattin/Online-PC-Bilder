<?php
    function sql_query($sql){
        $conn=mysqli_connect("localhost","root","","pcdb");
        return mysqli_query($conn,$sql);
    }
?>