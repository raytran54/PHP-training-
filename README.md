# TRAN CONG DANH - SVTT - Mentor: LUU VAN LAN - PHP-training/Kết nối DataBase - Day Started: 30/04/2024.
- PHP 5 trở lên có thể hoạt động với cơ sở dữ liệu MySQL bằng cách sử dụng:

   *MySQLi extention (chữ "i" là viết tắt của "improve")
   *PDO (Đối tượng dữ liệu PHP)

- Nên sử dụng MySQLi hay PDO?
Một câu trả lời ngắn gọn thì đó sẽ là "Bất cứ điều gì bạn thích".

- Cả MySQLi và PDO đều có những ưu điểm:

   *PDO sẽ hoạt động trên 12 hệ thống cơ sở dữ liệu khác nhau, trong khi MySQLi sẽ chỉ hoạt động với cơ sở dữ liệu MySQL.

- Vì vậy, nếu bạn phải chuyển dự án của mình sang sử dụng cơ sở dữ liệu khác, PDO sẽ giúp quá trình này trở nên dễ dàng. Bạn chỉ phải thay đổi chuỗi kết nối và một vài truy vấn. Với MySQLi, bạn sẽ cần phải viết lại toàn bộ mã - bao gồm cả các truy vấn.

- Example (MySQLi Object-Oriented)
```
<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
```
- Example (MySQLi Procedural)
```
<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
```
- Example (PDO)
```
<?php
$servername = "localhost";
$username = "username";
$password = "password";

try {
  $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
