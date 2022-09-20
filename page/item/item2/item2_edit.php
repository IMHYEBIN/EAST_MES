<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<?php
$id = $_POST['id'];

$sql = "select * from item where id = '" . $id . "'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

$sql01 = "select * from item2 where item_code = '" . $row['item_code'] . "'";
$res01 = mysqli_query($conn, $sql01);
$row01 = mysqli_fetch_array($res01);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/item2_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/item2_update.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    부자재수정
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>제품코드</th>
                        <td><input name="item_code" type="text" required value="<?= $row['item_code']; ?>"></td>
                        <th>제품명</th>
                        <td><input name="item_name" type="text" required value="<?= $row['item_name']; ?>"></td>
                    </tr>
                    <tr>
                        <th>단가</th>
                        <td><input name="unit" type="text" value="<?= $row['unit']; ?>"></td>
                        <th>상태</th>
                        <td>
                            <select name="status">
                                <option value="3" <?php if ($row['status'] == "3") {
                                                        echo "selected";
                                                    } ?>>양산</option>
                                <option value="4" <?php if ($row['status'] == "4") {
                                                        echo "selected";
                                                    } ?>>단종</option>
                                <option value="5" <?php if ($row['status'] == "5") {
                                                        echo "selected";
                                                    } ?>>A/S</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>외부업체</th>
                        <td>
                            <select name="client">
                                <?php
                                echo "<option value='" . $row['client'] . "' selected>" . $row['client'] . "</option>";
                                $sql00 = "select * from client";
                                $res00 = mysqli_query($conn, $sql00);
                                for (; $row00 = mysqli_fetch_array($res00);) {
                                    echo "<option value='" . $row00['cop_name'] . "'>" . $row00['cop_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <th>사급구분</th>
                        <td>
                            <select name="supply">
                                <option value="1" <?php if ($row['supply'] == "1") {
                                                        echo "selected";
                                                    } ?>>유상</option>
                                <option value="2" <?php if ($row['supply'] == "2") {
                                                        echo "selected";
                                                    } ?>>무상</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>안전재고</th>
                        <td><input name="safe_stock" type="text" value="<?= $row['safe_stock']; ?>"></td>
                        <th>성형작업</th>
                        <td>
                            <select name="auto">
                                <option value="1" <?php if ($row['auto'] == "1") {
                                                        echo "selected";
                                                    } ?>>자동</option>
                                <option value="2" <?php if ($row['auto'] == "2") {
                                                        echo "selected";
                                                    } ?>>수동</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>공법</th>
                        <td><input name="method" type="text" value="<?= $row01['method']; ?>"></td>
                        <th>C/T</th>
                        <td><input name="ct" type="text" value="<?= $row01['ct']; ?>"></td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" type="text" name="auto" value="<?= $row['acc']; ?>"></td>
                    <tr>
                        <!-- <tr>
                        <th>사진</th>
                        <td>
                            <input class="short" name="photo" type="text" value="<?= $row['photo']; ?>" placeholder="보류">
                            <input class="btn" type="button" value="파일찾기">
                        </td>
                        <th>도면</th>
                        <td>
                            <input class="short" name="paper" type="text" value="<?= $row['paper']; ?>" placeholder="보류">
                            <input class="btn" type="button" value="파일찾기">
                        </td>
                    </tr> -->
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