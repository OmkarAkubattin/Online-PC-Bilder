<!DOCTYPE html>
<html lang="en">
<?php
include "../_conn.php";
include "../_nav.php";
?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            font-size: 20px;
        }

        th{
         padding: 5px 15px;   
        }
        td{
            padding: 5px 150px;
        }
        table{
            margin-left:auto;
            margin-right:auto;
            margin-top:35px;
        }
        .container{
            border: 1px solid #DDDDDD;
            margin-top: 50px;
        }
    </style>
</head>

<body>
<div class="container-fluid">
<div class="row">
    <div class="col-3 pt-3">
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action active">Component</a>
        <a href="#" class="list-group-item list-group-item-action">Processor</a>
        <a href="#" class="list-group-item list-group-item-action">Motherboard</a>
        <a href="#" class="list-group-item list-group-item-action">Memory</a>
        <a href="#" class="list-group-item list-group-item-action">Storage</a>
        <a href="#" class="list-group-item list-group-item-action">Graphicscard</a>
        <a href="#" class="list-group-item list-group-item-action">Cabinet</a>
        <a href="#" class="list-group-item list-group-item-action">Powersupply</a>
        <a href="#" class="list-group-item list-group-item-action">Cpucooler</a>
        <a href="#" class="list-group-item list-group-item-action">Cabinetfan</a>
        <a href="#" class="list-group-item list-group-item-action">Monitor</a>
        <a href="#" class="list-group-item list-group-item-action">Keyboard</a>
        <a href="#" class="list-group-item list-group-item-action">Mouse</a>    
        <a href="#" class="list-group-item list-group-item-action">Headphones</a>
        <a href="#" class="list-group-item list-group-item-action" tabindex="-1" aria-disabled="true">Speakers</a>
    </div>
    </div>
    <div class="col-7 container">
    <?php
include "../help/help-processor.php";
?>
    </div>
  </div>
</div>



    
<?php
include "../_footer.php";
?>
</body>
</html>