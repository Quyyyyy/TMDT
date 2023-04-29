<?php

if(!empty($_POST)){
	$id = getPost('id');
	$title = getPost('title');
	$price = getPost('price');
	$discount = getPost('discount');
	$thumbnail = moveFile('thumbnail');
	$description = getPost('description');
	$category_id = getPost('category_id');
	$created_at = $updated_at = date('Y-m-d H:s:i');
	$symbol = getPost('symbol');
    $pin = getPost('pin');
    $ram = getPost('ram');
    $rom = getPost('rom');
    $CPU = getPost('CPU');
    $KTmanHinh = getPost('KTmanHinh');
    $cameraTruoc = getPost('cameraTruoc');
    $cameraSau = getPost('cameraSau');

	if($id > 0){
		//update
		if($thumbnail != ''){
			$sql = "update product set thumbnail='$thumbnail',title='$title',price='$price',discount='$discount',description='$description',updated_at='$updated_at',category_id='$category_id',symbol='$symbol',pin='$pin',ram='$ram',rom='$rom',CPU='$CPU',KTmanHinh='$KTmanHinh',cameraTruoc='$cameraTruoc',cameraSau='$cameraSau' where id = '$id'";
		} else{
			$sql = "update product set title='$title',price='$price',discount='$discount',description='$description',updated_at='$updated_at',category_id='$category_id',symbol='$symbol',pin='$pin',ram='$ram',rom='$rom',CPU='$CPU',KTmanHinh='$KTmanHinh',cameraTruoc='$cameraTruoc',cameraSau='$cameraSau' where id = '$id'";
		}
		execute($sql);
		header("Location: index.php");
		die();
	} else{
		//insert
		$sql = "insert into product(thumbnail,title,price,discount,description,category_id,updated_at,created_at,deleted,symbol,pin,ram,rom,CPU,KTmanHinh,cameraTruoc,cameraSau) values ('$thumbnail','$title','$price','$discount','$description','$category_id','$updated_at','$created_at',0,$symbol,$pin,$ram,$rom,$CPU,$KTmanHinh,$cameraTruoc,$cameraSau)";
		execute($sql);
		header("Location: index.php");
		die();
	}
}