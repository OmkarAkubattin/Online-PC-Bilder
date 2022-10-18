<div class="px-4 py-5">
<h1 class="mb-4">Bulk Import Products</h1>
<div class="row">
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