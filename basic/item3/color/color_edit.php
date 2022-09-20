<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<?php
$id = $_POST['id'];

$sql = "select * from item3_color where id = '" . $id . "'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/color_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/color_update.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    COLOR수정
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>COLOR명</th>
                        <td><input name="color" type="text" required value="<?= $row['color']; ?>"></td>
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