# TRAN CONG DANH - SVTT - Mentor: LUU VAN LAN - PHP-training/CommentOnBlog - Day Started: 08/05/2024.

Địa chỉ trang: csr301.click:8888/Comment_on_Blog/

- Kết nối Database:
```
$conn= mysqli_connect("localhost","root","vertrigo","blogs");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
```
- Thêm bình luận vào database:
```
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    // Thêm bình luận vào cơ sở dữ liệu
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
    if ($conn->query($sql) === TRUE) {
        echo "Bình luận đã được thêm thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
```
- Hiển thị bình luận:
```
$sql = "SELECT name, comment FROM comments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>" . $row["name"] . ":</strong> " . $row["comment"] . "<br>";
    }
} else {
    echo "Chưa có bình luận nào.";
}

$conn->close();
```
- Phần code html:
```
 <form action="Index.php" method="post">
        <label for="name">Tên:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="comment">Bình luận:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Gửi">
    </form>
```
