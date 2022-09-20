<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<?php
$id = $_POST['id'];

$sql = "select * from item where id = '" . $id . "'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

$sql01 = "select * from item3 where item_code = '" . $row['item_code'] . "'";
$res01 = mysqli_query($conn, $sql01);
$row01 = mysqli_fetch_array($res01);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/item3_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/item3_update.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    원재료수정
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
                        <th>Color</th>
                        <td>
                            <select name="color">
                                <?php
                                echo "<option value='" . $row01['color'] . "' selected>" . $row01['color'] . "</option>";
                                $sql02 = "select * from item3_color";
                                $res02 = mysqli_query($conn, $sql02);
                                for (; $row02 = mysqli_fetch_array($res02);) {
                                    echo "<option value='" . $row02['color'] . "'>" . $row02['color'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Maker</th>
                        <td>
                            <select name="maker">
                                <?php
                                echo "<option value='" . $row01['maker'] . "' selected>" . $row01['maker'] . "</option>";
                                $sql03 = "select * from item3_maker";
                                $res03 = mysqli_query($conn, $sql03);
                                for (; $row03 = mysqli_fetch_array($res03);) {
                                    echo "<option value='" . $row03['maker'] . "'>" . $row03['maker'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <th>Grade</th>
                        <td>
                            <select name="grade">
                                <?php
                                echo "<option value='" . $row01['grade'] . "' selected>" . $row01['grade'] . "</option>";
                                $sql04 = "select * from item3_grade";
                                $res04 = mysqli_query($conn, $sql04);
                                for (; $row04 = mysqli_fetch_array($res04);) {
                                    echo "<option value='" . $row04['grade'] . "'>" . $row04['grade'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>외부업체</th>
                        <td>
                            <select name="client">
                                <?php
                                echo "<option value='" . $row['client'] . "' selected>" . $row['client'] . "</option>";
                                $sql05 = "select * from client";
                                $res05 = mysqli_query($conn, $sql05);
                                for (; $row05 = mysqli_fetch_array($res05);) {
                                    echo "<option value='" . $row05['cop_name'] . "'>" . $row05['cop_name'] . "</option>";
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
                        <th>상태</th>
                        <td>
                            <select name="status">
                                <option value="1" <?php if ($row['status'] == "1") {
                                                        echo "selected";
                                                    } ?>>사용</option>
                                <option value="2" <?php if ($row['status'] == "2") {
                                                        echo "selected";
                                                    } ?>>미사용</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td><input name="acc" type="text" value="<?= $row['acc']; ?>"></td>
                    </tr>
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