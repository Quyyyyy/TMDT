<?php
    session_start();
    require_once('utils/utility.php');
    require_once('database/dbhelper.php');
    $sqlcount = "select count(id) as number from product";
    $name = getGet('thuong-hieu');
    $gia = getGet('gia');
    $khuyenmai = getGet('khuyen-mai');
    $thutu = getGet('sap-xep');
    
    $sql = "select product.*, category.name as category_name from product left join category on product.category_id = category.id";

    $x = false;
    $sqlGia = "";
    $sqlName = "";
    $sqlKmai = "";
    if ($gia != null && $gia != ''){
            if(strcmp($gia,"duoi2trieu")==0){
                $sqlGia = "discount < 2000000";
            }
            if(strcmp($gia,"tu2den4trieu")==0){
                $sqlGia = "discount >= 2000000 and discount < 4000000";
            }
            if(strcmp($gia,"tu4den7trieu")==0){
                $sqlGia = "discount >= 4000000 and discount < 7000000";
            }
            if(strcmp($gia,"tu7den13trieu")==0){
                $sqlGia = "discount >= 7000000 and discount < 13000000";
            }
            if(strcmp($gia,"tren13trieu")==0){
                $sqlGia = "discount >= 13000000";
            }

        }
    if($name != null && $name != ''){
        $sqlName= "product.symbol like '%$name%'";
    }

    // if($khuyenmai != null && $khuyenmai != ''){
    //     if(strcmp($khuyenmai,"giamgia")==0){
    //         $sqlKmai = "discount ";
    //     }
    //     if(strcmp($khuyenmai,"tragop")==0){
    //         $sqlKmai = "category_name = 'trả góp'";
    //     }
    //     if(($khuyenmai,"moiramat")==0){
    //         $sqlKmai = "product.updated_at desc limit 0,4";
    //     }
    // }
    
    if($sqlGia != null){
            $sql .= " where ";
            $sql .=$sqlGia;
            $x = true;
    }

    if($sqlName != null){
        if($x == false){
            $sql .= " where ";
            $sql .=$sqlName;
            $x = true;
        }else{
            $sql .= " and ";
            $sql .= $sqlName;
        }
    }

    if($thutu != null && $thutu != ''){
        if(strcmp($thutu,"giatangdan")==0){
            $sql.= " order by discount ASC";
        }
        if(strcmp($thutu,"giagiamdan")==0){
            $sql.= " order by discount DESC";
        }
    }
    
    $result = executeResult($sql);
    $number = count($result);
    $page = ceil($number/8);
    $current_page = 1;
    if(isset($_GET['page'])){
        $current_page = $_GET['page'];
    }
    $index = ($current_page-1)*8;
    $sql .= " limit $index,8";
    $data = executeResult($sql);
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
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/danh-muc-sp.css">
        <link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css"> -->
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
                        <p>Đăng xuât</p>
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
        <div class="company-menu">
            <div class="company-menu-line">
                <a href="#" onclick="layUrl('thuong-hieu', 'apple')"><img src="img/company/Apple.jpg"></a>
                <a href="#" onclick="layUrl('thuong-hieu', 'coolpad')"><img src="img/company/Coolpad.png"></a>
                <a href="#" onclick="layUrl('thuong-hieu', 'xiaomi')"><img src="img/company/Xiaomi.png"></a>
                <a href="#" onclick="layUrl('thuong-hieu', 'huawei')"><img src="img/company/Huawei.jpg"></a>
            </div>
            <div class="company-menu-line">
                <a href="#" onclick="layUrl('thuong-hieu', 'samsung')"><img src="img/company/Samsung.jpg"></a>
                <a href="#" onclick="layUrl('thuong-hieu', 'oppo')"><img src="img/company/Oppo.jpg"></a>
                <a href="#" onclick="layUrl('thuong-hieu', 'nokia')"><img src="img/company/Nokia.jpg"></a>
                <a href="#" onclick="layUrl('thuong-hieu', 'realme')"><img src="img/company/Realme.png"></a>
            </div>
        </div>
        <div class="button-container">
            <div class="dropdown">
                <button class="all">Giá bán</button>
                <div class="dropdown-content">
                    <a href="#" onclick="layUrl('gia', 'duoi2trieu')">Dưới 2 triệu</a>
                    <a href="#" onclick="layUrl('gia', 'tu2den4trieu')">Từ 2 - 4 triệu</a>
                    <a href="#" onclick="layUrl('gia', 'tu4den7trieu')">Từ 4 - 7 triệu</a>
                    <a href="#" onclick="layUrl('gia', 'tu7den13trieu')">Từ 7 - 13 triệu</a>
                    <a href="#" onclick="layUrl('gia', 'tren13trieu')">Trên 13 triệu</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="sale">Khuyến mãi</button>
                <div class="dropdown-content">
                    <a href="#" onclick="layUrl('khuyen-mai', 'giamgia')">Giảm giá</a>
                    <a href="#" onclick="layUrl('khuyen-mai', 'tragop')">Trả góp</a>
                    <a href="#" onclick="layUrl('khuyen-mai', 'moiramat')">Mới ra mắt</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="sort">Sắp xếp</button>
                <div class="dropdown-content">
                    <a href="#" onclick="layUrl('sap-xep', 'giatangdan')">Giá tăng dần</a>
                    <a href="#" onclick="layUrl('sap-xep', 'giagiamdan')">Giá giảm dần</a>
                </div>
            </div>
        </div>
        
        <div class="filter" style="margin-bottom: 20px">

        </div>

        <div class="product-list container">
                <div class="product" style="display: grid; grid-template-columns: auto auto auto auto;">  
                    <?php
                            foreach($data as $item) {
                    ?>
                                <div class="card" style="margin-bottom:20px">
                                    <div class="product-promo-container">
                                    </div>
                                    <img src="<?=fixUrl($item['thumbnail'],'')?>" style="width:100%">
                                    </br>
                                    <a href="detail.php?id=<?=$item['id']?>"><?=$item['title']?></a>
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
            <div >                                    
                <?php
                    for($i=1;$i<=$page;$i++){
                ?>
                    <a href="#" onclick="layUrl('page', '<?= $i?>')" ><?= $i?></a>
                <?php
                    }
                ?>                                
            </div>

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
        <script>
                        const thuongHieu = {
                            apple: 'IPHONE',
                            coolpad: 'COOLPAD',
                            xiaomi: 'XIAOMI',
                            huawei: 'HUAWEI',
                            samsung: 'SAMSUNG',
                            oppo: 'OPPO',
                            nokia: 'NOKIA',
                            realme: 'REALME'
                        };
                        const gia = {
                            duoi2trieu: 'Dưới 2 triệu',
                            tu2den4trieu: 'Từ 2 - 4 triệu',
                            tu4den7trieu: 'Từ 4 - 7 triệu',
                            tu7den13trieu: 'Từ 7 - 13 triệu',
                            tren13trieu: 'Trên 13 triệu'
                        };
                        const khuyenMai = {
                            giamgia: 'Giảm giá',
                            tragop: 'Trả góp',
                            moiramat: 'Mới ra mắt'
                        };
                        const sapXep = {
                            giatangdan: 'Giá tăng dần',
                            giagiamdan: 'Giá giảm dần'

                        };

                        let thuongHieuActive = null;
                        let giaActive = null;
                        let khuyenMaiActive = null;
                        let sapXepActive = null;

                        locGia();
                        locThuongHieu();
                        locKhuyenMai();
                        locSapXep();

                        function locThuongHieu() {
                            thuongHieuActive = layUrlParameter('thuong-hieu');
                            if (!thuongHieuActive) {
                                return 0;
                            }
                            let html = '';
                            html += '<div class="choose-filter-container">';
                            html += `<button class="choose-filter-btn">`;
                            html += `<p style="margin: 0px 0px;">`;
                            html += thuongHieu[thuongHieuActive];
                            html += `</p>`;
                            html += `</button>`;
                            html += `</div>`;
                            document.querySelector('.filter').innerHTML += html;
                        }

                        function locGia() {
                            giaActive = layUrlParameter('gia');
                            if (!giaActive) {
                                return 0;
                            }
                            let html = '';
                            html += '<div class="price-filter-container">';
                            html += `<button class="choose-filter-btn">`;
                            html += `<p style="margin: 0px 0px;">`;
                            html += gia[giaActive];
                            html += `</p>`;
                            html += `</button>`;
                            html += `</div>`;
                            document.querySelector('.filter').innerHTML += html;
                        }

                        function locKhuyenMai() {
                            khuyenMaiActive = layUrlParameter('khuyen-mai');
                            if (!khuyenMaiActive) {
                                return 0;
                            }
                            let html = '';
                            html += '<div class="sale-filter-container">';;
                            html += `<button class="choose-filter-btn">`;;
                            html += `<p style="margin: 0px 0px;">`;
                            html += khuyenMai[khuyenMaiActive];
                            html += `</p>`;
                            html += `</button>`;
                            html += `</div>`;
                            document.querySelector('.filter').innerHTML += html;
                        }

                        function locSapXep() {
                            sapXepActive = layUrlParameter('sap-xep');
                            if (!sapXepActive) {
                                return 0;
                            }
                            let html = '';
                            html += '<div class="sort-filter-container">';
                            html += `<button class="choose-filter-btn">`;
                            html += `<p style="margin: 0px 0px;">`;
                            html += sapXep[sapXepActive];
                            html += `</p>`;
                            html += `</button>`;
                            html += `</div>`;
                            document.querySelector('.filter').innerHTML += html;
                        }

                        if (((thuongHieuActive !== null) || (giaActive !== null)
                                || (khuyenMaiActive !== null)||(sapXepActive !== null))
                                && (!document.querySelector('.delete-filter-container'))) {
                            let html = '';
                            html += '<div class="delete-filter-container">';
                            html += '<a href="category.php"><button class="delete-filter-btn">Xóa bộ lọc</button></a>';
                            html += '</div>';
                            document.querySelector('.filter').innerHTML += html;
                        }


                        function layUrl(key, value) {
                            const url_string = window.location.href;
                            const url = new URL(url_string);
                            url.searchParams.set(key, value);
                            window.location.href = url.href;
                        }

                        function layUrlParameter(key) {
                            let url_string = window.location.href;
                            let url = new URL(url_string);
                            let value = url.searchParams.get(key);
                            return value;
                        }
        </script>    
    </body>
</html>
