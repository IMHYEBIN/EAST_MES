<?php session_start(); ?>
<?php $conn = new mysqli("localhost", "server", "00000000", "dataset"); ?>

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
    <form method="post" action="php/item2_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    부자재등록
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
                        <th>상태</th>
                        <td>
                            <select name="status">
                                <option value="3">양산</option>
                                <option value="4">단종</option>
                                <option value="5">A/S</option>
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
                        <th>성형작업</th>
                        <td>
                            <select name="auto">
                                <option value="1">자동</option>
                                <option value="2">수동</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>공법</th>
                        <td><input name="method" type="text"></td>
                        <th>C/T</th>
                        <td><input name="ct" type="text"></td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" type="text"></td>
                    </tr>
                    <!-- <tr>
                        <th>사진</th>
                        <td>
                            <input class="short" name="photo" type="text" placeholder="보류">
                            <input class="btn" type="button" value="파일찾기">
                        </td>
                        <th>도면</th>
                        <td>
                            <input class="short" name="paper" type="text" placeholder="보류">
                            <input class="btn" type="button" value="파일찾기">
                        </td>
                    </tr> -->
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