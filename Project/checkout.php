<?php
    session_start();
    require_once('database/dbhelper.php');
    require_once('utils/utility.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logonho.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/gioi-thieu.css">

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
                        if ($user != null) {
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
                        if ($user != null) {
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
        <section>
        <div class="phan1">
            <h1></h1>
        </div>
        <div class="phan3">
            <div class="lienhe">
                <div>
                    <div class="headerlienhe" style="margin-top: 50px;">
                        <h2>Thông tin khách hàng: </h2>
                    </div>
                    <form name="formlh" method="post" onsubmit="return completeCheckout()">
                        <table cellspacing="10px">
                            <tr>
                                <td style="font-weight: bold;">Họ và tên</td>
                                <td><input style="padding: 6px 5px;" type="text" name="fullname" size="40" maxlength="40" placeholder="Họ tên"
                                        autocomplete="off" required></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Điện thoại liên hệ</td>
                                <td><input style="padding: 6px 5px;" type="text" name="phone_number" size="40" maxlength="11" minlength="10"
                                        placeholder="Điện thoại" required ></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Địa chỉ Email</td>
                                <td><input style="padding: 6px 5px;" type="email" name="email" size="40" placeholder="Email" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Địa chỉ</td>
                                <td><input style="padding: 6px 5px;" type="text" name="address" size="40" maxlength="100" placeholder="địa chỉ" required>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Nội dung</td>
                                <td><textarea style="padding: 6px 5px;" name="note" rows="5" cols="44" maxlength="500" wrap="physical"
                                        placeholder="Nội dung liên hệ" required></textarea></td>
                            </tr>
                                <!-- <label >Phương thức thanh toán</label><br>                               
                                <input type="radio" id="1sao" name="star" value="tienmat">
                                <label >Tiền mặt</label><br>
                                <input type="radio" id="3sao" name="star" value="chuyenkhoan">
                                <label >Chuyển khoản</label><br>
                                <input type="radio" id="3sao" name="star" value="momo">
                                <label >Thanh toán momo</label><br> -->
                            <tr>
                                <td></td>
                                <td><button type="submit" style="border: solid #e0dede 2px; background: #202c4f; color:#fff;  border-radius: 5px; height: 40px; width: 300px; font-size:15px">Thanh toán</button></td>
                            </tr>
                        </table>
                    </form>
                </div>  
            </div>
            <div class="thongtinnhom">
                <div class="headerthongtinnhom" style="margin-top:50px">
                    <h2>Thông tin đơn hàng: </h2>
                </div>
                <table style="text-indent: initial;border-spacing: 2px; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <th style="border: 1px solid #ddd;padding-top: 12px;padding-bottom: 12px;text-align: center;background:-webkit-linear-gradient(top, #202c4f, #5e698b);color: #ddd;text-align: center;">STT</th>
                            <th style="border: 1px solid #ddd;padding-top: 12px;padding-bottom: 12px;text-align: center;background:-webkit-linear-gradient(top, #202c4f, #5e698b);color: #ddd;text-align: center;">Tên sản phẩm</th>
                            <th style="border: 1px solid #ddd;padding-top: 12px;padding-bottom: 12px;text-align: center;background:-webkit-linear-gradient(top, #202c4f, #5e698b);color: #ddd;text-align: center;">Giá</th>
                            <th style="border: 1px solid #ddd;padding-top: 12px;padding-bottom: 12px;text-align: center;background:-webkit-linear-gradient(top, #202c4f, #5e698b);color: #ddd;text-align: center;">Số Lượng</th>
                            <th style="border: 1px solid #ddd;padding-top: 12px;padding-bottom: 12px;text-align: center;background:-webkit-linear-gradient(top, #202c4f, #5e698b);color: #ddd;text-align: center;">Tổng Giá</th>
                        </tr>
                        <?php
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            }
            $index = 0;
            $total = 0;
            foreach($_SESSION['cart'] as $item){
            ?>  
                    <tr style="display: table-row;vertical-align: inherit;border-color: inherit;">
                        <td style="text-align: center;border: 1px solid #ddd;"><?=(++$index)?></td>
                        <td style="text-align: center;border: 1px solid #ddd;"><?=$item['title']?></td>
                        <td style="text-align: center;border: 1px solid #ddd;"><?=number_format($item['discount'])?> VNĐ</td>
                        <td style="text-align: center;border: 1px solid #ddd;"><?=$item['num']?></td>
                        <td style="text-align: center;border: 1px solid #ddd;"><?=number_format($item['discount']*$item['num'])?> VNĐ</td>
                    </tr>                    
                    
                    <?php
                        $total += $item['discount']*$item['num'];
                        }
                    
                    ?>                    
                    </tbody>
                </table>
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
    <script type="text/javascript">
        function completeCheckout(){
            $.post("insert_cart.php",{
                'action':'checkout',
                'fullname':$('[name=fullname]').val(),
                'phone_number':$('[name=phone_number]').val(),
                'email':$('[name=email]').val(),
                'address':$('[name=address]').val(),
                'note':$('[name=note]').val()
            }, function(data){
                window.open('complete.php','_self')
            })
        }
    </script>
    </body>
</html>