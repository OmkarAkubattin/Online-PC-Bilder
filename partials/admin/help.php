<!DOCTYPE html>
<html lang="en">
<head>
<?php
include "../_conn.php";
include "../_nav.php";
?>
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
            border: 2px solid black;
            font-size: 20px;
        }
        .container{
            border-style: solid;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5 pt-3">
    <h1>Import and Export Products</h1>
    <p>You can upload your products in bulk from a CSV or XLS file. You can add multiple products with minimal effort.</p>

    <h3 class="pt-3">Import File Requirements </h3>
    <p>While preparing your CSV or XLS file for import, ensure that your column headers match the headers given below.</p>

    <table style="margin-left:auto;margin-right:auto;" class="pt-3 mb-3">
        <thead>
            <tr>
                <th>CSV Column Header</th>
                <th>Definition</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Name</th>
                <td>Enter the product's title</td>
            </tr>
            <tr>
                <th>Cores</th>
                <td>Enter the product's title</td>
            </tr>
            <tr>
                <th>Speed</th>
                <td>Enter the product's title</td>
            </tr>
            <tr>
                <th>Power</th>
                <td>Enter the product's title</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>Enter the product's title</td>
            </tr>
            <tr>
                <th>URL</th>
                <td>Enter the product's title</td>
            </tr>
        </tbody>
    </table>
    </div>
<?php
include "../_footer.php";
?>
</body>
</html>