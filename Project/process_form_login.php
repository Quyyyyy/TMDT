<?php
$email = $msg = '';

if(!empty($_POST)){
	$email = getPost('email');
	$pwd = getPost('password');
	$pwd = getSercurityMD5($pwd);
    
    $sql = "select * from user where email = '$email' and password = '$pwd'";

    $userExist = executeResult($sql, true);
    if($userExist == null){
    	$msg = "Đăng nhập không thành công vui lòng kiểm tra lại email hoặc mật khẩu!!!";
    } else{
    	//login thanh cong
    	$token = getSercurityMD5($userExist['email'].time());
    	setcookie('token', $token, time() + 7 * 24 * 60 *60, '/');
    	$created_at = date('Y-m-d H:i:s');

    	$_SESSION['user'] = $userExist;

    	$userID = $userExist['id'];
    	$sql = "insert into tokens(user_id, token, created_at) values ('$userID', '$token', '$created_at')";

    	execute($sql);
        if($userExist['role_id'] == 1){
            header("Location: admin/");
            die();
        } else{
            header("Location: index.php");
            die();
        }
    }
}