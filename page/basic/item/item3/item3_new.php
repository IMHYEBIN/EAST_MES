<?php session_start(); ?>
<?php $conn = new mysqli("localhost", "server", "00000000", "dataset"); ?>

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
    <form method="post" action="php/item3_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    원재료등록
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>제품코드</th>
                        <td><input name="item_code" type="text" required></td>
                        <th>제품명</th>
                        <td><input name="item_name" type="text" required></td>
                    </tr>
                    <tr>
                        <th>단가</th>
                        <td><input name="unit" type="text"></td>
                        <th>Color</th>
                        <td>
                            <select name="color" required>
                                <option value="">==선택==</option>
                                <?php
                                $sql = "SELECT * FROM item3_color";
                                $res = mysqli_query($conn, $sql);
                                for (; $row = mysqli_fetch_array($res);) {
                                    echo "<option value='" . $row['color'] . "'>" . $row['color'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Maker</th>
                        <td>
                            <select name="maker" required>
                                <option value="">==선택==</option>
                                <?php
                                $sql = "SELECT * FROM item3_maker";
                                $res = mysqli_query($conn, $sql);
                                for (; $row = mysqli_fetch_array($res);) {
                                    echo "<option value='" . $row['maker'] . "'>" . $row['maker'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <th>Grade</th>
                        <td>
                        <select name="grade" required>
                                <option value="">==선택==</option>
                                <?php
                                $sql = "SELECT * FROM item3_grade";
                                $res = mysqli_query($conn, $sql);
                                for (; $row = mysqli_fetch_array($res);) {
                                    echo "<option value='" . $row['grade'] . "'>" . $row['grade'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>외부업체</th>
                        <td>
                            <select name="client" required>
                                <option value="">==선택==</option>
                                <?php
                                $sql = "SELECT * FROM client";
                                $res = mysqli_query($conn, $sql);
                                for (; $row = mysqli_fetch_array($res);) {
                                    echo "<option value='" . $row['cop_name'] . "'>" . $row['cop_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <th>사급구분</th>
                        <td>
                            <select name="supply">
                                <option value="1">유상</option>
                                <option value="2">무상</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>안전재고</th>
                        <td><input name="safe_stock" type="text"></td>
                        <th>사용여부</th>
                        <td>
                            <select name="status">
                                <option value="1">사용</option>
                                <option value="2">미사용</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" type="text"></td>
                    </tr>
                </table>
            </div>
            <div class="btn_section">
                <button type="submit" class="btn add_btn">등록</button>
                <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
            </div>
        </div>
    </form>
</body>

</html>