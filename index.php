<html>
    <head>

    </head>
    <body>
        <div class="">
            <form action="uploadCsv.php" name="" method="post" enctype="multipart/form-data">
                <input type="file" accept="csv|xls" name="fileToUpload">
                <input type="submit" name="upload_btn" value="Upload File">
            </form>
            <?php echo isset($_GET['error']) ? ($_GET['error'] == 0) ? 'Csv file imported successfully' : 'Something Got messed up' : ''; ?>
        </div>
    </body>
</html>