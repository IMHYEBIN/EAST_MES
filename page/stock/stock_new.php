<?php session_start(); ?>
<?php $conn = new mysqli("localhost", "server", "00000000", "dataset"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stock_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/stock_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    입출고등록
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>날짜</th>
                        <td><input name="date" type="date" value="<?php echo date('Y-m-d'); ?>" required></td>
                        <th>제품코드 / 제품명</th>
                        <td>
                            <select name="item_code" onchange="select_item()" required>
                                <option value="">==선택==</option>
                                <?php
                                $sql = "SELECT * FROM item";
                                $res = mysqli_query($conn, $sql);
                                for (; $row = mysqli_fetch_array($res);) {
                                    echo "<option value='" . $row['item_code'] . "'>" . $row['item_name'] . " / " . $row['item_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>입출고구분</th>
                        <td>
                            <select name="type">
                                <option value="1">입고</option>
                                <option value="2">출고</option>
                            </select>
                        </td>
                        <th>단가</th>
                        <td><input name="unit" id="unit" type="text" disabled></td>
                    </tr>
                    <tr>
                        <th>수량</th>
                        <td><input name="inout_q" type="text"></td>
                        <th>금액</th>
                        <td><input name="inout_a" type="text"></td>
                    </tr>
                    <tr>
                        <th>현재고수량</th>
                        <td><input name="stock_q" type="text" value="<?php echo $stock_q; ?>" disabled></td>
                        <th>비고</th>
                        <td><input name="acc" type="text"></td>
                    </tr>
                    </tr>
                </table>
            </div>
            <div class="btn_section">
                <button type="submit" class="btn add_btn">등록</button>
                <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
            </div>
        </div>
    </form>

    <script>
        function select_item() {
            document.getElementById("unit").value = <?php echo $row['unit']; ?>;
        }
    </script>
</body>

</html>