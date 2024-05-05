# PHP-training/Tim_kiem_danh_sach_SV

Bước 1: Kết nối database:

```
 $conn = mysqli_connect("localhost","root","vertrigo","quanlysinhvien");
```
Bước 2: Tìm kết keyword trong database thông qua "LIKE"
```
 if(isset($_GET["search"]) && !empty($_GET["search"]))
    {
        $key= $_GET["search"];
        $sql="SELECT * FROM sinhvien WHERE idSV LIKE '%$key%' OR fullname LIKE '%$key%' OR gender LIKE '%$key%'
        OR address LIKE '%$key%' OR date LIKE '%$key%' OR specialized LIKE '%$key%' ";
    }else
    {
    $sql="SELECT * FROM sinhvien";
    }
 ?>
```
Bước 3: Tạo những đầu vào cần thiết:
```
<h3 align ="center" >Danh sach sinh vien </h3>
    <table claas="search-form" align ="center" cellpadding="5">
        <tr>
            <td>
                <form action="" method="get">
                    <input type="text" name="search" placeholder="Nhap tu khoa can tim" value="<?php
                    if (isset($_GET["search"]))
                    {echo $_GET["search"];} ?>">
                    <input type="submit" value="Tim">
                    <input type="button" value="Tat ca" onclick ="window.location.href =/tim_kiem/index.php">
                </form>
            </td>
        </tr>
    </table>
```
Bước 4: Tạo bảng để xuất kết quả tìm kiếm:
```
 <table border ="1" align ="center" cellspacing="0" cellpadding="5" width ="850px">
        <tr>
            <th>MSV</th>
            <th>Ho va Ten</th>
            <th>Gioi tinh</th>
            <th>Que quan</th>
            <th>Ngay sinh</th>
            <th>Nganh hoc</th>
        </tr>    
        <?php
       
        while($row = mysqli_fetch_assoc($result))
        {
            
            $maSV=$row["idSV"];
            $tenSV=$row["fullname"];
            $gioitinh=$row["gender"];
            $diachi=$row["address"];
            $ngaysinh=$row["date"];
            $nganhhoc=$row["specialized"];
        
        ?>
        <tr>
            <td><?php echo $maSV ?></td>
            <td><?php echo $tenSV ?></td>
            <td><?php if($gioitinh==0) echo "Nam"; else echo "Nu"; ?></td>
            <td><?php echo $diachi ?></td>
            <td><?php echo $ngaysinh ?></td>
            <td><?php echo $nganhhoc ?></td>
        </tr>
        <?php } ?>
        <?php mysqli_close($conn); ?>
    </table>
```
