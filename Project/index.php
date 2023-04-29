<?php
session_start();
    require_once('utils/utility.php');
    require_once('database/dbhelper.php');
    $sql = "select product.*,category.name as category_name from product left join category on product.category_id = category.id order by product.updated_at desc limit 0,4";
    $data = executeResult($sql);
    $sq = "select * from category limit 0,3";
    $menuItems = executeResult($sq);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logonho.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <title>MBShop</title>
    </head>
    <body>
        <div class="container-menu">
            <div class = "Menu">
                <div class="logo">
                    <a href="index.php"> <img src="img/logo.png" style="width: 100%; margin-top: 3px;"> </a>
                </div>
                <div class="search">
                    <input type="text" placeholder="Bạn cần tìm gì?">
                    <button type="submit" class="btn-search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
                <ul class="topnav">
                    <li>
                        <a href="index.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Trang chủ</p>
                        </a>
                    </li>
                    <li>
                        <a href="category.php">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            <p>Sản phẩm</p> 
                        </a>
                    </li>
                    <?php
                        $user = getUserToken();
                        if($user != null){
                    ?>
                    <li>
                        <a href="cart.php">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <p>Giỏ hàng</p>
                        </a>
                    </li>
                    <?php
                    } else {
                    ?>
                    <li>
                        <a href="login.php">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <p>Giỏ hàng</p>
                        </a>
                    </li>
                    <?php
                        }
                    ?>

                    <li>
                        <a href="intro.php">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <p>Giới thiệu</p>
                        </a>
                    </li>

                    <?php
                        $user = getUserToken();
                        if($user != null){
                    ?>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <p>Đăng xuất</p>
                        </a>
                    </li> 
                    <?php
                    } else {
                    ?>
                    <li>
                        <a href="login.php">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <p>Đăng nhập</p>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <a onclick="topFunction()" id="back-to-top" title="Go to top">
            <div class="top">
                <i class="fa fa-lg fa-chevron-up" aria-hidden="true" style="zoom: 0.75;"></i>
            </div>
        </a>
        <div class="slideshow-container">

            <div class="mySlides fade">
                <img src="img/banners/banner4.png" style="width:100%">
            </div>

            <div class="mySlides fade">
                <img src="img/banners/banner8.png" style="width:100%">
            </div>

            <div class="mySlides fade">
                <img src="img/banners/banner7.png" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="img/banners/banner9.png" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="img/banners/banner6.png" style="width:100%">
            </div>

        </div>
        <br>
        <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
        </div>
        <div class="banner">
            <a href="#"> <img src="img/banners/blackFriday.gif" style="width:100%"> </a>
        </div>

        <div class="product-container">
            <div class="product-list">
                <div class="name-text-container">
                    <p class="name-text">Sản phẩm mới</p>
                </div>
                <div class="product">  
                    <?php
                        foreach($data as $item) {
                    ?>
                                  <div class="card">
                                    <div class="product-promo-container">
                                        <div class="product-promo">
                                            <p> Mới </p>
                                        </div>
                                    </div>
                                    <img src="<?=fixUrl($item['thumbnail'],'')?>" style="width:100%">
                                    <a href="detail.php?id=<?=$item['id']?>"><?=$item['title']?></a>
                                    </br>
                                    </br>
                                    </br> 
                                    <p class="price"><?=number_format($item['discount'])?> VNĐ</p>
                                    <div class="ratingresult">
                                    <?php
                                        for ($j = 0; $j < getStar($item['id']); $j++) {
                                    ?> 
                                        <i class="fa fa-star"></i>                           
                                    <?php
                                        }
                                    ?>  
                                    <?php
                                        for ($j = getStar($item['id']); $j < 5; $j++) {
                                    ?>
                                        <i class="fa fa-star-o"></i>                           
                                    <?php
                                        }
                                    ?> 
                                        <span><?= getDanhgia($item['id'],0)?> đánh giá</span>
                                   </div>
                                   </div> 
                    <?php
                            }
                    ?>
                </div>
            </div>
            <div class="banner">
                <a href="#"><img src="img/banners/banner0.gif" style="width:100%"></a>
            </div>
<?php
    foreach($menuItems as $item) {
    $sql = "select product.*, category.name as category_name from product left join category on product.category_id = category.id where product.category_id = ".$item['id']." order by product.updated_at desc limit 0,4";
    $items = executeResult($sql);
    if($items == null || count($items) < 4) continue;
?> 
            <div class="product-list">
                <div class="name-text-container">
                    <p class="name-text">Sản phẩm <?=$item['name']?></p>
                </div>
                <div class="product">
                    <?php
                        foreach($items as $pItem) {
                    ?>
                                <div class="card">
                                    <div class="product-promo-container">
                                        <div class="product-promo">
                                            <p> <?=$item['name']?> </p>
                                        </div>
                                    </div>
                                    <img src="<?=fixUrl($pItem['thumbnail'],'')?>" style="width:100%">
                                    <a href="detail.php?id=<?=$pItem['id']?>"><?=$pItem['title']?></a>
                                    </br>
                                    </br>
                                    </br> 
                                    <p class="price"><?=number_format($pItem['discount'])?> VNĐ</p>                    
                                    <div class="ratingresult">
                                    <?php
                                    
                                        for($j = 0; $j < getStar($pItem['id']); $j++) {
                                     ?>                
                                        <i class="fa fa-star"></i>                           
                                    <?php
                                        }
                                    ?>  
                                    <?php
                                        for ($j = getStar($pItem['id']); $j < 5; $j++) {
                                    ?>
                                        <i class="fa fa-star-o"></i>                           
                                    <?php
                                        }
                                    ?> 
                                        <span><?=getDanhgia($pItem['id'],0)?> đánh giá</span>
                                   </div>
                                </div> 
                    <?php    
                            }
                    ?>
                </div>
            </div>
        </div> 
<?php
}
?>
       
    <div class="footer">
        <div class="plc">
            <ul class="flex-contain">
                <li>Giao hàng hỏa tốc trong 1 giờ</li>
                <li>Thanh toán linh hoạt: tiền mặt, visa / master, trả góp</li>
                <li>Trải nghiệm sản phẩm tại nhà</li>
                <li>Lỗi đổi tại nhà trong 1 ngày</li>
                <li>Hỗ trợ suốt thời gian sử dụng.
                    <br>Hotline:
                    <a href="tel:12345678" style="color: #288ad6;">12345678</a>
                </li>
            </ul>
        </div>
        <div class="main-footer">
            <div class="container-main-footer">
                <div class="about-us">
                    <p style="font-size: 19px; font-weight: 600; margin: 11px 0px -6px 0px;">Về chúng tôi</p>
                    <p style="line-height: 1.4;">MBShop là chuỗi cửa hàng điện thoại uy tín, chất lượng hàng đầu Việt Nam.
                    </p>
                    <div class="mxh">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="information">
                    <p style="font-size: 19px; font-weight: 600; margin: 11px 0px -6px 0px;">Thông tin</p>
                    <ul>
                        <li><a href="index.html">Trang chủ</a></li>
                        <li style="margin: 6px 0px 6px 0px;"><a href="danh-muc-sp.html">Sản phẩm</a></li>
                        <li style="margin: 6px 0px 6px 0px;"><a href="gio-hang.html">Giỏ hàng</a></li>
                        <li><a href="gioi-thieu.html">Giới thiệu</a></li>
                    </ul>
                </div>
                <div class="contact-us">
                    <p style="font-size: 19px; font-weight: 600; margin: 11px 0px -6px 0px;">Liên hệ</p>
                    <div class="contact-us-ele">
                        <i class="fa fa-map-marker" aria-hidden="true" style="margin-top: 10px; zoom: 1.7;"></i>
                        <p>96A Trần Phú, P. Mộ Lao, Hà Đông, Hà Nội</p>
                    </div>
                    <div class="contact-us-ele">
                        <i class="fa fa-envelope" aria-hidden="true" style="margin: 0px 12px 0px 0px; zoom: 1.2;"></i>
                        <p style="margin-top: 1px;">mbshop@gmail.com</p>
                    </div>
                    <div class="contact-us-ele">
                        <i class="fa fa-phone" aria-hidden="true" style="zoom: 1.6;"></i>
                        <p style="margin-top: 2px;">0123456789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>Copyright © 2022 by Team 14</p>
    </div>
    <script src="js/index.js"></script>   
    <style>
        .product-promo-container .product-promo p{
            font-size: 12px;
            font-weight: 700;
            text-align: center;
            color: #fff;
            width: 100%;
            margin: 5px 0 0;
            padding: 9px 0px 0px 0px;
        }
        .product-promo-container .product-promo{
            width: 96px;
            height: 31px;
            top: -1px;
            left: -15px;
            background: #151f3c;
            border-radius: 21px;
        }

        .product-promo-container{
            width: 66px;
            background: #151f3c;
        }
        .card{
            height: 364px;
        }
        .product-list p.name-text {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
            margin-bottom: 35px;
            background: #151f3c;
            width: 1000px;
            border-radius: 27px;
            height: 40px;
            padding: 8px 0px 0px 0px;
            margin: 0 auto;
        }
        .name-text-container{
            margin-bottom: 25px;
        }
        .banner{
            margin-bottom: 55px;
        }
    </style>
</body>
</html>
