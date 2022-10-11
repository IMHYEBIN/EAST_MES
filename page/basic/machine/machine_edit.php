<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<?php
$id = $_POST['id'];

$sql = "select * from machine where id = '" . $id . "'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/machine_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/machine_update.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    설비수정
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>제품코드</th>
                        <td><input name="machine_code" type="text" required value="<?= $row['machine_code']; ?>"></td>
                        <th>제품명</th>
                        <td><input name="machine_name" type="text" required value="<?= $row['machine_name']; ?>"></td>
                    </tr>
                    <tr>
                        <th>TON</th>
                        <td><input name="ton" type="text" value="<?= $row['ton']; ?>"></td>
                        <th>설치위치</th>
                        <td><input name="location" type="text" value="<?= $row['location']; ?>"></td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" type="text" value="<?= $row['acc']; ?>"></td>
                    </tr>
                </table>
            </div>
            <div class="btn_section">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <button type="submit" class="btn add_btn">수정</button>
                <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
            </div>
        </div>
    </form>
</body>

</html>