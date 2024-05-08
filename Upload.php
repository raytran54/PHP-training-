<!DOCTYPE html>
<html>
    <head>
        <title>Upload File</title>
    </head>
<body>
    <h2>Upload File</h2>
    <form action="Upload.php" method="post" enctype="multipart/form-data">
        Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>    
    <?php
    if(isset($_POST["submit"])){
        $target_dir="uploads/";
        $target_file=$target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOK = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));;
        if(file_exists($target_file))
        {
            echo"sorry, file is existed!";
            $uploadOK=0;
        }

        if($_FILES["fileToUpload"]["size"]> 500000){
            echo"sory, your file is too large!";
            $uploadOK=0;
        }
        if($uploadOK==0)
        {
            echo"sorry, your file is not uploaded!";
        }else{
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
                echo "File".basename($_FILES["fileToUpload"]["name"])." has been uploaded successfully";
        }else{
            echo"sorry, An error has appeared when the file is uploaded";
        }
    }   
}
    ?>
</body>
</html>