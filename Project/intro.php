<?php
    session_start();
    require_once('utils/utility.php');
    require_once('database/dbhelper.php');
    if(!empty($_POST)){
        $fullname = getPost('fullname');
        $email = getPost('email');
        $phone_number = getPost('phone_number');
        $subject_name = getPost('subject_name');
        $note = getPost('note');
        $created_at = $updated_at = date('Y-m-d H:i:s');
        
        $sql = "insert into feedback(fullname, email, phone_number, subject_name, note, status, created_at, updated_at) values('$fullname', '$email', '$phone_number', '$subject_name', '$note', 0, '$created_at', '$updated_at')";
        execute($sql);
    }

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
    <link rel="stylesheet" href="css/gioi-thieu.css">
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
    <section>
        <div class="phan1">
            <h1></h1>
        </div>
        <div class="phan2">
            <div class="info" style="background-color:white;">
                <b>Địa chỉ:</b> 96A Trần Phú, P. Mộ Lao, Hà Đông, Hà Nội<br /><br />
                <b>Telephone:</b> 0123456789<br /><br />
                <b>Hotline:</b> 12345678<br /><br />

                <b>E-mail:</b> mbshop@gmail.com<br /><br />
                <b>Mã số thuế:</b> 01 02 03 04 05<br /><br />

                <b>Số TK:</b> 0123456789 <br /><br />
                <b>Tại Ngân hàng:</b> Viettinbank<br /><br /><br /><br />
            </div>
            <div class="ggmap" style="background-color:white;">

                <p><iframe width="100%" height="370"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2377.047905436281!2d105.7861024999787!3d20.980965400359043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135accdd8a1ad71%3A0xa2f9b16036648187!2zSOG7jWMgdmnhu4duIEPDtG5nIG5naOG7hyBCxrB1IGNow61uaCB2aeG7hW4gdGjDtG5n!5e0!3m2!1svi!2s!4v1652710005304!5m2!1svi!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"><a
                            href="https://www.maps.ie/create-google-map/">Embed
                            Google Map
                        </a>
                    </iframe>
                    <br />
                </p>
            </div>
        </div>
        <div class="phan3">
            <div class="lienhe">
                <div>
                    <div class="headerlienhe">
                        <h2>Gửi ý kiến đóng góp phản hồi: </h2>
                    </div>
                    <form name="formlh" method="post">
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
                                <td style="font-weight: bold;">Tiêu đề</td>
                                <td><input style="padding: 6px 5px;" type="text" name="subject_name" size="40" maxlength="100" placeholder="Tiêu đề" required>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Nội dung</td>
                                <td><textarea style="padding: 6px 5px;" name="note" rows="5" cols="44" maxlength="500" wrap="physical"
                                        placeholder="Nội dung liên hệ" required></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" style="background:#202c4f;border-radius: 5px;color:#fff;height: 40px; width: 300px;">Gửi thông tin liên hệ</button></td>
                            </tr>
                        </table>
                    </form>
                </div>  
            </div>
            <div class="thongtinnhom">
                <div class="headerthongtinnhom">
                    <h2>Thông tin thành viên nhóm: </h2>
                </div>
                <table class="tb" border="5">
                    <tr>
                        <th>Họ tên</th>
                        <th>MSSV</th>
                        <th>Giới tính</th>
                        <th>Lớp</th> 
                    </tr>
                    <script>
                        var thongtin = [
                            ["Phạm Đức Hải ", "B19DCCN218", "Nam", "D19CQCN12-B",],
                            ["Vũ Việt Anh  ", "B19DCCN050", "Nam", "D19CQCN12-B",],
                            ["Nguyễn Tiến Hải  ", "B19DCCN217", "Nam", "D19CQCN09-B",],
                            ["Trần Vũ Minh Quý   ", "B19DCCN540", "Nam", "D19CQCN12-B",]
                        ]
                        for (var i = 0; i < thongtin.length; i++) {
                            document.write(
                                `
                                            <tr>
                                                <td class="tablerow">` +
                                thongtin[i][0] + `</td>
                                                <td class="tablerow">` +
                                thongtin[i][1] + `</td>
                                                <td>` +
                                thongtin[i][2] + `</td>
                                                <td class="tablerow">` +
                                thongtin[i][3] + `</td>
                                                </td>
                                            </tr>
                                        `
                            )
                        }
                    </script>
                </table>
            </div>
        </div>
    </section>
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
</body>

</html>