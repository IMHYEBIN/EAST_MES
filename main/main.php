<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<?php
$sql = "select * from item where safe_stock >= now_q order by now_q / safe_stock";
$res = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main/css/main.css">
    <title>East Company</title>
</head>

<body>
    <div class="container">
        <div class="left_section">
            <div class="left_section__bom"><img src="/img/main/intro.jpg" alt=""></div>
        </div>
        <div class="right_section">
            <div class="right_section__stock">
                <div class="title">재고</div>
                <table>
                    <th>번호</th>
                    <th>제품코드</th>
                    <th>제품명</th>
                    <th>제품구분</th>
                    <th>금일 입고</th>
                    <th>금일 출고</th>
                    <th>현재고</th>
                    <th>안전재고</th>
                    <th>상태</th>
                    <?php
                    for ($count = 1; $row = mysqli_fetch_array($res); $count++) {

                        if ($row['index1'] == '1') {
                            $index1_value = "아쎄이";
                        } else if ($row['index1'] == '2') {
                            $index1_value = "부자재";
                        } else if ($row['index1'] == '3') {
                            $index1_value = "원재료";
                        } else if ($row['index1'] == '4') {
                            $index1_value = "반제품";
                        } else {
                            $index1_value = "ERROR";
                        }

                        //안전재고보다 많으면 초록
                        if ($row['now_q'] > $row['safe_stock']) {
                            $status = "darkgreen";
                        }
                        //안전재고보다 적을 때
                        else if ($row['now_q'] <= $row['safe_stock']) {

                            //안전재고의 30%보다 적을때
                            if ($row['now_q'] <= (($row['safe_stock'] / 100) * 30)) {
                                $status = "red";
                            }
                            //안전재고의 50%보다 적을때
                            else if ($row['now_q'] <= (($row['safe_stock'] / 100) * 50)) {
                                $status = "orange";
                            }
                            //안전재고의 70%보다 적을때
                            else if ($row['now_q'] <= (($row['safe_stock'] / 100) * 70)) {
                                $status = "yellow";
                            } else {
                                $status = "green";
                            }
                        }

                        $sql00 = "select sum(inout_q) as in_q from in_out where date = '" . date('Y-m-d') . "' and item_code = '" . $row['item_code'] . "' and type='1'";
                        $res00 = mysqli_query($conn, $sql00);
                        $row00 = mysqli_fetch_array($res00);

                        if ($row00['in_q'] == null) {
                            $in_q = '0';
                        } else {
                            $in_q = $row00['in_q'];
                        }

                        $sql01 = "select sum(inout_q) as out_q from in_out where date = '" . date('Y-m-d') . "' and item_code = '" . $row['item_code'] . "' and type='2'";
                        $res01 = mysqli_query($conn, $sql01);
                        $row01 = mysqli_fetch_array($res01);

                        if ($row01['out_q'] == null) {
                            $out_q = '0';
                        } else {
                            $out_q = $row01['out_q'];
                        }

                        echo "
                            <tr>
                            <td class='td1' name='id'>" . $count . "</td>
                            <td class='td2'>" . $row['item_code'] . "</td>
                            <td class='td3'>" . $row['item_name'] . "</td>
                            <td class='td4'>" . $index1_value . "</td>
                            <td class='td5'>+" . $in_q . "</td>
                            <td class='td5'>-" . $out_q . "</td>
                            <td class='td5'>" . $row['now_q'] . "</td>
                            <td class='td6'>" . $row['safe_stock'] . "</td>
                            <td class='td7' style='background-color:" . $status . ";'></td>
                            </tr>
                            ";
                    }
                    ?>
                </table>
            </div>
            <div class="right_section__plan">
                <div class="title">생산계획</div>
                <table>
                    <th>번호</th>
                    <th>날짜</th>
                    <th>담당자</th>
                    <th>관리</th>
                </table>
            </div>
        </div>
    </div>
</body>

</html>