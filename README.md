# TRAN CONG DANH - SVTT - Mentor: LUU VAN LAN - PHP-training/Upload-Download - Day Started: 07/05/2024.
## Mục lục:
1.[Upload](#upload)

2.[Download](#download)

## Upload

- Phần code HTML tạo button upload

```
<form action="Upload.php" method="post" enctype="multipart/form-data">
        Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>
```
- Phần code PHP nhằm kiểm tra size, extension, file exist
```
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
```
## Download
- Phần code PHP để tải file từ dir /uploads
```
<?php
$file = 'uploads/sample.txt'; // Đường dẫn tới file cần tải xuống

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File không tồn tại.";
}
?>

```
