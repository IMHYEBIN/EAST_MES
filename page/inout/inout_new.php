<?php session_start(); ?>
<?php $conn = new mysqli("localhost", "server", "00000000", "dataset"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inout_new.css">
    <title>East Company</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</head>

<body>
    <form method="post" action="php/inout_insert.php" target="_blank">
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
                            <select name="item_code" id="item_code" required>
                                <option value="">==선택==</option>
                                <?php
                                $sql = "SELECT * FROM item";
                                $res = mysqli_query($conn, $sql);
                                for (; $row = mysqli_fetch_array($res);) {
                                    echo "<option value='" . $row['item_code'] . "' data-unit='" . $row['unit'] . "' data-now_q='" . $row['now_q'] . "' data-safe_stock='" . $row['safe_stock'] . "'>
                                        " . $row['item_code'] . " / " . $row['item_name'] . "
                                        </option>";
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
                        <td><input name="unit" id="unit" type="text"></td>
                    </tr>
                    <tr>
                        <th>입출고수량</th>
                        <td><input name="inout_q" id="inout_q" type="text"></td>
                        <th>금액</th>
                        <td><input name="inout_a" id="inout_a" type="text"></td>
                    </tr>
                    <tr>
                        <th>현재고수량</th>
                        <td><input name="now_q" id="now_q" type="text" disabled></td>
                        <th>안전재고</th>
                        <td><input name="safe_stock" id="safe_stock" type="text" disabled></td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" class="acc" type="text"></td>
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
        $('#item_code').change(function() {
            var unit = $(this).find(':selected').data('unit');
            var now_q = $(this).find(':selected').data('now_q');
            var safe_stock = $(this).find(':selected').data('safe_stock');
            var inout_q = safe_stock - now_q;

            if (inout_q < 0) {
                inout_q = '0';
            }

            $("#unit").val(unit);
            $("#now_q").val(now_q);
            $("#safe_stock").val(safe_stock);
            $("#inout_q").val(inout_q);
        });

        $('#unit').change(function() {
            var sum1 = parseInt($("#unit").val() || 0);
            var sum2 = parseInt($("#inout_q").val() || 0);
            var sum = sum1 * sum2;

            $("#inout_a").val(sum);
        });

        $('#inout_q').change(function() {
            var sum1 = parseInt($("#unit").val() || 0);
            var sum2 = parseInt($("#inout_q").val() || 0);
            var sum = sum1 * sum2;

            $("#inout_a").val(sum);
        });
    </script>
</body>

</html>