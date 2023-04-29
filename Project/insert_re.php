<?php
if(!empty($_POST)){
	$content = getPost('content');
	$star = getPost('star');
    $id_product = $productId;
    $created_at = date('Y-m-d H:i:s');

    $x = getUserToken();
    $id_user = $x['id'];
    
    if($content != null && $star != 0){
        $sql = "insert into review(id_user,id_product,star,content,created_at,deleted) values('$id_user','$id_product','$star','$content','$created_at',0)";
        execute($sql);
    }

    header("Location: detail.php?id=$id_product");
    die();
 }
