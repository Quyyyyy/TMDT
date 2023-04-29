<?php
    $title = "Quản lý phản hồi";
    $baseUrl = '../';
    require_once('../layouts/header.php');

    $sql = "select * from feedback order by status asc, updated_at desc";
    $data = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12  table-responsive">
        <h3>Quản Lý Phản Hồi</h3>

        <table class="table table-bordered table-hover" 
            style="margin-top: 20px;">
            <thead>
                <th>STT</th>
                <th>Họ Tên</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Chủ Đề</th>
                <th>Nội Dung</th>
                <th>Ngày Tạo</th>
                <th style="width: 50px;"></th>
            </thead>
            <tbody>
<?php
    $index = 0;
    foreach ($data as $item) {
        echo '<tr>
                <th>'.(++$index).'</th>
                <td>'.$item['fullname'].'</td>
                <td>'.$item['phone_number'].'</td>
                <td>'.$item['email'].'</td>
                <td>'.$item['subject_name'].'</td>
                <td>'.$item['note'].'</td>
                <td>'.$item['updated_at'].'</td>
                <th style="width: 50px;">';
            if($item['status'] == 0){
                echo '<button onclick ="markRead('.$item['id'].')" class="btn btn-danger">Đã Đọc</button>';
            }        
            echo    '</th>
             </tr>';
    }
?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function markRead(id){
        $.post('form_api.php',{
            'id':id,
            'action': 'mark' 
        }, function(data) {
            location.reload()
        })
    }
</script>

<?php
    require_once('../layouts/footer.php');
?>
