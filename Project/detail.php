<?php
    session_start();
    require_once('database/dbhelper.php');
    require_once('utils/utility.php');

    $productId = getGet('id');
    require_once('insert_re.php');
    
    $sql = "select product.*, category.name as category_name from product left join category on product.category_id = category.id where product.id = $productId";
    $product = executeResult($sql,true);
    $sqlre = "select count(id) as number from review where id_product = $productId";
    $result = executeResult($sqlre);
    $number = 0;
    if($result!=null && count($result)>0){
        $number = $result[0]['number'];
    }
    $page = ceil($number/5);
    $current_page = 1;
    if(isset($_GET['page'])){
        $current_page = $_GET['page'];
    }
    $index = ($current_page-1)*5;
    $sqlre = "select * from review where id_product = $productId limit $index,5";
    $data = executeResult($sqlre);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MBShop</title>
        <link rel="shortcut icon" href="img/logonho.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">  
        <link rel="stylesheet" href="css/chi-tiet-sp.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
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
        <section>
            <div id="productNotFound" style="min-height: 50vh; text-align: center; margin: 50px; display: none;">
                <h1 style="color: red; margin-bottom: 10px;">Không tìm thấy sản phẩm</h1>
                <a href="index.php" style="text-decoration: underline;">Quay lại trang chủ</a>
            </div>

            <div class="chitietSanPham" style="margin-bottom: 100px;">


                <div class="ctsanpham">
                    <h1 class="title">Điện thoại <?=$product['title']?></h1>
                    <div class="rating">
                        <?php
                            for ($j = 0; $j < getStar($productId); $j++) {
                        ?>
                        <i class="fa fa-star"></i>                           
                        <?php
                            }
                        ?>
                        <?php
                            for ($j = getStar($productId); $j < 5; $j++) {
                        ?>
                        <i class="fa fa-star-o"></i>                           
                        <?php
                            }
                        ?>
                        <span><?=getDanhgia($productId,0)?> đánh giá</span>  
                    </div>
                </div>

                <div class="rowdetail group">
                    <div class="picture">
                        <img src="<?=fixUrl($product['thumbnail'],'')?>"> 
                    </div>
                    <div class="price_sale">
                        <div class="area_price">
                            <p class="price" style="font-size: 25px; padding: 5px 0px;"><?= number_format($product['discount'])?> VNĐ</p>
                        </div>
                        <!-- <div class="ship" style="display: none;">
    
                        </div> -->
                        <div class="area_promo">
                            <strong>Khuyến mãi</strong>
                            <div class="promo">
                                <img src="img/icon-tick.png" alt="">
                                <div id="detailPromo"><p style="margin: 0px;">Khách hàng có thể mua trả góp sản phẩm với lãi suất 0% với thời hạn 6 tháng kể từ khi mua hàng.</p></div>
                            </div>
                            <div class="promo">
                                <img src="img/icon-tick.png" alt="">
                                <div id="detailPromo"><p style="margin: 0px;">Giảm giá 5% khi mua phụ kiện.</p></div>
                            </div>
                            <div class="promo">
                                <img src="img/icon-tick.png" alt="">
                                <div id="detailPromo"><p style="margin: 0px;">Thu cũ đổi mới: Giá thu cao - Thủ tục nhanh chóng - Trợ giá tốt nhất.</p></div>
                            </div>
                        </div>

                        <div class="policy">
                            <div>
                                <img src="img/box.png" alt="">
                                <p>Bộ sản phẩm gồm: Hộp, Sách hướng dẫn, Cây lấy sim, Củ sạc nhanh rời đầu Type A, Cáp Type C</p>
                            </div>
                            <div>
                                <img src="img/icon-baohanh.png" alt="">
                                <p>Bảo hành chính hãng 12 tháng</p>
                            </div>
                            <div class="last">
                                <img src="img/1-1.jpg" alt="">
                                <p>1 đổi 1 trong 1 tháng nếu lỗi, đổi trong vòng 1 ngày hoặc đổi tại cửa hàng</p>
                            </div>
                        </div>
                    <?php
                        $user = getUserToken();
                        if($user != null){
                    ?>
                        <div class="area_order">
                            <button style="border: solid #e0dede 2px; border-radius: 5px; background: #202c4f; color:#fff;width: 30px; height: 2em;" onclick="addMoreCart(-1)">-</button>
                            <input type="number" name="num" class="form-control" step="1" value="1" style="max-width: 90px;border: solid #e0dede 2px; border-radius: 3px; text-align:center; background:#f2f2f2; height:30px;width: 70px; font-size:15px" onchange="fixCartNum()">
                            <button style="border: solid #e0dede 2px; border-radius: 5px; background: #202c4f; color: #fff;width: 30px; height: 2em;" onclick="addMoreCart(1)">+</button>
                            <button onclick="addCart(<?=$product['id']?>, $('[name=num]').val())" class="buy_now" style="width: 376px; margin-top:9px; ">
                                <b><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</b>
                            </button>
                        </div>
                    <?php
                        } else {
                    ?>
                    <div class="area_order">
                            <a href="login.php" class="buy_now">
                                <b><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</b>
                            </a>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <div class="info_product">
                        <h2>Cấu hình điện thoại</h2>
                        <ul class="info">
                            <li>
                                <p>Màn hình: </p>
                                <div><?=$product['KTmanHinh']?></div>
                            </li>
                            <li>
                                <p>Camera trước: </p>
                                <div><?=$product['cameraTruoc']?> MP</div>
                            </li>
                            <li>
                                <p>Camera sau: </p>
                                <div><?=$product['cameraSau']?> MP</div>
                            </li>
                            <li>
                                <p>CPU: </p>
                                <div><?=$product['CPU']?></div>
                            </li>
                            <li>
                                <p>RAM: </p>
                                <div><?=$product['ram']?> GB</div>
                            </li>
                            <li>
                                <p>Bộ nhớ trong: </p>
                                <div><?=$product['rom']?> GB</div>
                            </li>
                            <li>
                                <p>Dung lượng pin: </p>
                                <div><?=$product['pin']?> mAh</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="overlaycertainimg" class="overlaycertainimg">
                    <div class="close" onclick="closecertain()">&times;</div>
                    <div class="overlaycertainimg-content">
                        <img id="bigimg" class="bigimg" src="img/oppo-f9-red-2-400x460.png" alt="">
                    </div>
                </div>
            </div>
            <div class="box-border">
                <div class="rate">
                    <h2 class="rating_title">Đánh giá sản phẩm</h2>
                    <div class="rating-star left">
                        <div class="rating-left">
                            <div class="rating-top">
                                <p class="point"><?= getStar($productId)?></p>        
                                <div class="list-star">
                                    <i class="fa fa-star">

                                    </i>
                                </div>
                                <a href="" class="rating-total"><?=getDanhgia($productId,0)?> đánh giá </a>
                            </div>
                            <div class="product-rating">
                                <div class="all">Tất cả</div>
                                <div class="product-rating-rate">5 sao (<?=getDanhgia($productId,5)?>)</div>
                                <div class="product-rating-rate">4 sao (<?=getDanhgia($productId,4)?>)</div>
                                <div class="product-rating-rate">3 sao (<?=getDanhgia($productId,3)?>)</div>
                                <div class="product-rating-rate">2 sao (<?=getDanhgia($productId,2)?>)</div>
                                <div class="product-rating-rate">1 sao (<?=getDanhgia($productId,1)?>)</div> 
                            </div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-comment">
                                <div class="rating-comment-product">
                                    <a class="rating-avata" href="">
                                        <div class="comment-avata">
                                            <div class="avata-placeholder">

                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                        foreach($data as $item) {
                                    ?>

                                    <div class="comment-all">
                                        <div class="comment-item">
                                            <div class="item-top">
                                                <p class="txtname"><?=getUsername($item['id_user'])?></p>
                                            </div>
                                        </div>
                                        <div class="item-rate">
                                            <div class="comment-rate">
                                                <?php
                                                    for ($j = 0; $j < $item['star']; $j++) {
                                                ?>
                                                <i class="fa fa-star"></i>                           
                                                <?php
                                                    }
                                                ?>
                                                <?php
                                                    for ($j = $item['star']; $j < 5; $j++) {
                                                ?>
                                                <i class="fa fa-star-o"></i>                           
                                                <?php
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="product-rating-time">
                                            <?= $item['created_at']?> 
                                        </div>
                                        <div class="comment-content">
                                            <p class="cmt-txt"><?= $item['content']?></p>
                                        </div>
                                        <div class="item-click">
                                            <a href="" class="clicklike">
                                                <i class="fa fa-thumbs-up"></i>
                                                Hữu ích
                                            </a>
                                            <a href="" class="clicklike">
                                                <i class="fa fa-thumbs-down"></i>
                                                Không hữu ích
                                            </a>
                                            <a href="" class="clicklike">
                                                <i class="fa fa-envelope"></i>
                                                Trả lời
                                            </a>
                                        </div>
                                    </div>


                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="pagecomment">
                            <?php
                                for ($i = 1; $i <= $page; $i++) {
                                    // if (i == page1) {
                            ?>
                            <!-- <a href="" class="active"><= i></a> -->
                            <!-- <php
                            } else {
                            ?> -->
                           <a href="detail.php?id=<?= $productId?>&page=<?= $i?>" class="active1"><?= $i?></a>
                            <?php 
                                    
                                }
                            ?> 
                        </div>
                        <?php
                            $user = getUserToken();
                            if($user != null){
                        ?>
                        
                        <div>
                            <form id="form_cmt" method="post">
                                <br><br>
                                <label >Ðánh giá sản phẩm <input type="text" id="ten_sp" name="ten_sp" value="<?= $product['title'] ?>" readonly>:</label>
                                <br><br>
                                
                                <input type="text" id="text_danh_gia" name="content" placeholder="Mời bạn để lại bình luận"  ><br>
                                <input type="radio" id="1sao" name="star" value="1">
                                <label >1 Sao</label><br>
                                <input type="radio" id="2sao" name="star" value="2">
                                <label >2 Sao</label><br>
                                <input type="radio" id="3sao" name="star" value="3">
                                <label >3 Sao</label><br>
                                <input type="radio" id="3sao" name="star" value="4">
                                <label >4 Sao</label><br>
                                <input type="radio" id="3sao" name="star" value="5">
                                <label >5 Sao</label><br>
                                <input type="submit" value="Gửi">
                            </form>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="product-list">
                <div class="name-text-container">
                    <p class="name-text">Bạn có thể thích</p>
                </div>
                <div class="product">

                    <?php
                        $cate = $product['category_id'];
                        $sqldexuat  = "select product.*,category.name as category_name from product left join category on product.category_id = category.id where product.category_id = $cate order by product.updated_at desc limit 0,4";  
                        $dataitem = executeResult($sqldexuat);                     
                        foreach ($dataitem as $items ){
                    ?>
                    <div class="card">
                        <div class="product-promo-container">
                            <div class="product-promo">
                                <p> Đề xuất </p>
                            </div>
                        </div>
                        <img src="<?= $items['thumbnail']?>" style="width:100%">
                        <a href="detail.php?id=<?= $items['id']?>"><?=$items['title']?></a>
                        </br>
                        </br>
                        </br>                    
                        <p class="price"><?= number_format($items['discount'])?> VNĐ</p>
                        </br>
                        <div class="ratingresult">
                            <?php
                                for ($j = 0; $j < getStar($items['id']); $j++) {
                            ?> 
                            <i class="fa fa-star"></i>                           
                            <?php
                                }
                            ?>  
                            <?php
                                for ($j = getStar($items['id']); $j < 5; $j++) {
                            ?>
                            <i class="fa fa-star-o"></i>                           
                            <?php
                                }
                            ?> 
                            <span><?= getDanhgia($items['id'],0)?> đánh giá</span>
                        </div>

                    </div> 
                    <?php
                        }
                    ?>

                </div>
            </div> 
        </section>
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
                margin-top: 65px;
                margin-bottom: 25px;
            }
            .banner{
                margin-bottom: 55px;
            }
        </style>
        <script src="js/back-to-top.js"></script>
        <script type="text/javascript">
            function addMoreCart(delta) {
                num = parseInt($('[name=num]').val())
                num += delta
                if(num < 1) num = 1;
                $('[name=num]').val(num)
            }

            function fixCartNum() {
                $('[name=num]').val(Math.abs($('[name=num]').val()))
            }

            function addCart(productId, num) {
                $.post('insert_cart.php', {
                    'action': 'cart',
                    'id': productId,
                    'num': num
                }, function(data){
                    location.reload()
               })
           }
        </script>
    </body>
</html>