# PHP-training-

Đường dẫn tới trang : http://192.168.1.10:8888/Login_Register/index.php

Bước 1: Tạo database và một bảng lưu danh sách người dùng

Để lưu danh sách các tài khoản, tôi tạo một database ở phpmyadmin có tên là ‘authen’ và chọn bảng mã là unicode_utf8_ci để có thể lưu dữ liệu tiếng Việt vào database. Trong database này tôi tạo 1 bảng tên là ‘users’ để lưu thông tin của các user. Bảng này có các trường sau (chọn uft8 là bảng mã có thể viết tiếng VIệt)

- user_name : kiểu varchar(50), trường này sẽ lưu tài khoản đăng nhập của người dùng.
- password: kiểu text, trường này sẽ lưu mật khẩu của người dùng.

Bước 2: tạo folder và các file cần thiết:
- Tạo folder có tên là login ở trong Vertrigo/www/ Trong folder này sẽ có:
     *Index.php: sẽ là trang chủ, thực hiện việc xử lý, tính toán, và lấy dữ liệu cho phù hợp.
     *Welcome.php: sẽ là trang chủ được điều hướng tới nếu đăng nhập thành công.

Bước 3: kết nối database:

Mọi thao tác xử lý chúng ta đều thực hiên trên trang index.php, do vậy mà việc kết nối database tôi cũng sẽ thực hiện ở trang index.php.

Ở trang này tôi thực hiện việc kết nối tới database với lệnh sau: $conn = new mysqli($servername, $username, $password, $dbname);
Trong đó:

$servername: là tên host của bạn. Nếu cài localhost thì bạn sẽ đặt trường này là localhost (tên máy chủ hoặc địa chỉ ip máy chủ).
$username: tài khoản đăng nhập database (nếu cài xampp, tài khoản mặc định là ‘root’).
$password: mật khẩu đăng nhập database (mặc định xampp không đặt mật khẩu đăng nhập, nên trường này bạn để trống).
$dbname: tên database mà bạn cần thao tác.

```
$servername = "localhost";
$dbname = "authen";
$username = "root";
$password = "vertrigo";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
```
Bước 4: Tạo form đăng kí người dùng:

Code:
```
 <h2>Đăng ký</h2>
    <?php if(isset($register_error)) echo "<p>$register_error</p>"; ?>
    <?php if(isset($register_success)) echo "<p>$register_success</p>"; ?>
    <form method="post" action="">
        <label for="user_name_reg">Tên đăng nhập:</label><br>
        <input type="text" id="user_name_reg" name="user_name" required><br>
        <label for="password_reg">Mật khẩu:</label><br>
        <input type="password" id="password_reg" name="password" required><br><br>
        <input type="submit" name="register" value="Đăng ký">
    </form>
```
Bước 5: Xử lí request đăng kí với db:
```
if(isset($_POST["register"])){
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $hashed_password = md5($password); 
    $sql = "INSERT INTO users (user_name, password) VALUES ('$user_name', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        $register_success = "Dang ki thanh Cong!";
    } else {
        $register_error = "Dang ki thanh cong! " . $conn->error;
    }
}
```
Bước 6: Tạo form đăng nhập:
```
 <h2>Đăng nhập</h2>
    <?php if(isset($login_error)) echo "<p>$login_error</p>"; ?>
    <form method="post" action="">
        <label for="user_name">Tên đăng nhập:</label><br>
        <input type="text" id="user_name" name="user_name" required><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="login" value="Đăng nhập">
    </form>
```
Bước 7: Xử lí request đăng nhập với db:
```
if(isset($_POST["login"])){
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $hashed_password = md5($password); 
    $sql = "SELECT * FROM users WHERE user_name = '$user_name' AND password = '$hashed_password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $_SESSION["user_name"] = $user_name;
        header("location: welcome.php");
    } else {
        $login_error = "Ten dang nhap hoac mat khau khong chinh xac!";
    }
}
```
