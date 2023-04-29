<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken();
if($user == null) {
    //header('Location: '.$baseUrl.'authen/login.php');
    die();
}

if(!empty($_POST)){
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteCategory();
			break;
	}
}

function deleteCategory(){
	$id = getPost('id');

    $sql = "select count(*) as total from product where category_id = '$id' and deleted = 0";
    $data = executeResult($sql,true);
    $total = $data['total'];
    if($total > 0){
    	echo 'Danh muc đang chứa sản phẩm nên không được xóa!!!!';
    	die();
    }

	$sql = "delete from category where id = '$id'";
	execute($sql);
}