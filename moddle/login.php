<?php
session_start();
include("../_connect.php");
if(isset($_GET["email"]) && isset($_GET["password"])){
    $email = mysqli_real_escape_string($conn,$_GET["email"]);
    $password = mysqli_real_escape_string($conn,$_GET["password"]);
    $password = md5($password);
    $result = mysqli_query($conn,"SELECT * FROM `table_account` WHERE `email` = '$email' AND `password` = '$password'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) >= 1){
        $_SESSION["email"] = $row["email"];
        $_SESSION["id"] = $row["id"];
        echo "Đăng nhập thành công!";
    }
    else{
        echo "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
