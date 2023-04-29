<?php
function fixSqlInject($sql){
	$sql = str_replace('\\', '\\\\', $sql);
	$sql = str_replace('\'', '\\\'', $sql);
	return $sql;
}

function getGet($key){
	$value = '';
	if(isset($_GET[$key])){
		$value = $_GET[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getPost($key){
	$value = '';
	if(isset($_POST[$key])){
		$value = $_POST[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getCookie($key){
	$value = '';
	if(isset($_COOKIE[$key])){
		$value = $_COOKIE[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}

function getSercurityMD5($pwd){
	return md5(md5($pwd).PRIVATE_KEY);
}

function getUserToken(){
	if(isset($_SESSION['user'])){
		return $_SESSION['user'];
	}
	$token = getCookie('token');
	$sql = "select * from tokens where token = '$token'";
	$item = executeResult($sql, true);
	if($item != null){
		$userId = $item['user_id'];
        $sql = "select * from user where id = '$userId' and deleted = 0";
        $item = executeResult($sql, true);
        if($item != null){
        	$_SESSION['user'] = $item;
        	return $item;
        }
	}

	return null;
}

function moveFile($key,$rootPath = "../../"){
	if(!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name'] == ''){
		return '';
	}

	$pathTemp = $_FILES[$key]['tmp_name'];

	$filename = $_FILES[$key]['name'];

	$newPath = "assets/photos".$filename;

	move_uploaded_file($pathTemp, $rootPath.$newPath);

	return $newPath;
}

function fixUrl($thumbnail, $rootPath = "../../"){
	if(stripos($thumbnail, "http://") !== false ||stripos($thumbnail, "https://") !== false){
	} else{
		$thumbnail = $rootPath.$thumbnail;
	}
	return $thumbnail;
}

function getDanhgia($productId,$value){
	if($value != 0){
	    $sql = "select COUNT(content) as count from review where id_product = $productId and star = $value";
	} else {
		$sql = "select COUNT(content) as count from review where id_product = $productId";
	}
	$data = executeResult($sql,true);

	return $data['count'];
}

function getUsername($userId){
	$sql = "select * from user where id = $userId";
	$xname = executeResult($sql,true);

	return $xname['fullname'];
}

function getStar($productId){
	$sql = "select SUM(star) as sum, COUNT(star) as count from review where id_product = $productId";
	$result = executeResult($sql,true);
	$x = 0;
	if($result['count'] != 0){
        $x = round($result['sum']/$result['count']);
    }
    return $x;
}