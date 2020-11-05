<?php
include("../_connect.php");
$secure_code_base = "ABC";
if(isset($_GET["email"]) && isset($_GET["password"]) && isset($_GET["re_password"]) && isset($_GET["first_name"]) && isset($_GET["last_name"]) && isset($_GET["secure_code"]) && isset($_GET["phone_number"]) && isset($_GET["gender"])){
    $email = mysqli_real_escape_string($conn,$_GET["email"]);
    $password = mysqli_real_escape_string($conn,$_GET["password"]);
    $re_password = mysqli_real_escape_string($conn,$_GET["re_password"]);
    $first_name = mysqli_real_escape_string($conn,$_GET["first_name"]);
    $last_name = mysqli_real_escape_string($conn,$_GET["last_name"]);
    $secure_code = mysqli_real_escape_string($conn,$_GET["secure_code"]);
    $phone_number = mysqli_real_escape_string($conn,$_GET["phone_number"]);
    $gender = mysqli_real_escape_string($conn,$_GET["gender"]);
    //$captcha = mysqli_real_escape_string($conn,$_GET["captcha"]);
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        echo "Email không hợp lệ!";
        die; //Thoát khỏi chương trình
    }
    if($password != $re_password){
        echo "Mật khẩu không khớp!";
        die;
    }
    $password = md5($password);
    if($secure_code != $secure_code_base){
        echo "Secure code không hợp lệ!";
        die;
    }
    if($gender != 1 && $gender != 2){
        echo "Giới tính không hợp lệ!";
        die;
    }
    $result = mysqli_query($conn,"INSERT INTO `table_account` (`email`,`password`,`first_name`,`last_name`,`phone_number`,`gender`) VALUES ('$email','$password','$first_name','$last_name','$phone_number',$gender)");
    if($result){
        echo "Đăng ký thành công!";
    }
    else{
        echo "Đăng ký thất bại! Vui lòng thử lại sau!";
    }
}
?>