<?php
session_start();

$servername = "localhost";
$dbname = "authen";
$username = "root";
$password = "vertrigo";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang nhap va Dang ki</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <?php if(isset($login_error)) echo "<p>$login_error</p>"; ?>
    <form method="post" action="">
        <label for="user_name">Tên đăng nhập:</label><br>
        <input type="text" id="user_name" name="user_name" required><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="login" value="Đăng nhập">
    </form>

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
</body>
</html>
