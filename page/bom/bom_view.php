<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bom_view.css?ver=11">
    <title>East Company</title>
</head>

<body>
    <table>
        <?php
        if ($_POST['select_bom'] != null) {
            $sql = "select count(*) from item where item_code = '" . $_POST['select_bom'] . "'";
            $res = mysqli_query($conn, $sql);
        }

        ?>

        <?php
        //행개수 결과가 있는지 확인
        $row = mysqli_fetch_array($res);
        if ($row['count(*)'] == 0) {
            echo "
            <thead>
            <tr class='th'>
            <th>번호</th>
            <th>품목구분</th>
            <th>제품코드</th>
            <th>제품명</th>
            <th>단가</th>
            <th>거래업체</th>
            <th>사급구분</th>
            <th>안전재고</th>
            <th>비고</th>
            <th>사용구분</th>
            <th>관리</th>
            </tr>
            </thead>
            <td>검색 결과가 없습니다.</td>
            ";
        } else {
            $sql00 = "select * from item where item_code = '" . $_POST['select_bom'] . "'";
            $res00 = mysqli_query($conn, $sql00);
            for ($count00 = 1; $row00 = mysqli_fetch_array($res00); $count00++) {

                if ($row00['index1'] == '1') {
                    $index1_value = "아쎄이";
                    echo "
                    <thead>
                    <tr class='th'>
                    <th>번호</th>
                    <th>품목구분</th>
                    <th>제품코드</th>
                    <th>제품명</th>
                    <th>단가</th>
                    <th>거래업체</th>
                    <th>사급구분</th>
                    <th>안전재고</th>
                    <th>비고</th>
                    <th>사용구분</th>
                    <th>관리</th>
                    </tr>
                    </thead>
                    ";
                } else if ($row00['index1'] == '2') {
                    $index1_value = "부자재";
                    echo "
                    <thead>
                    <tr class='th'>
                    <th>번호</th>
                    <th>품목구분</th>
                    <th>제품코드</th>
                    <th>제품명</th>
                    <th>단가</th>
                    <th>거래업체</th>
                    <th>사급구분</th>
                    <th>안전재고</th>
                    <th>비고</th>
                    <th>사용구분</th>
                    <th>관리</th>
                    </tr>
                    </thead>
                    ";
                } else if ($row00['index1'] == '3') {
                    $index1_value = "원재료";
                    echo "
                    <thead>
                    <tr class='th'>
                    <th>번호</th>
                    <th>품목구분</th>
                    <th>제품코드</th>
                    <th>제품명</th>
                    <th>단가</th>
                    <th>거래업체</th>
                    <th>사급구분</th>
                    <th>안전재고</th>
                    <th>비고</th>
                    <th>사용구분</th>
                    <th>관리</th>
                    </tr>
                    </thead>
                    ";
                }

                if ($row00['status'] == '0') {
                    $status_value = "미사용";
                } else if ($row00['status'] == '1') {
                    $status_value = "사용";
                }

                if ($row00['supply'] == '0') {
                    $supply_value = "무상";
                } else if ($row00['supply'] == '1') {
                    $supply_value = "유상";
                }

                echo "
                <tr class='td'>
                <td>" . $count00 . "</td>
                <td>" . $index1_value . "</td>
                <td>" . $row00['item_code'] . "</td>
                <td>" . $row00['item_name'] . "</td>
                <td>" . $row00['unit'] . "</td>
                <td>" . $row00['client'] . "</td>
                <td>" . $supply_value . "</td>
                <td>" . $row00['safe_stock'] . "</td>
                <td>" . $row00['acc'] . "</td>
                <td>" . $status_value . "</td>
                <form method='post' target='bom_edit'  action='bom_edit.php'>
                <input type = 'hidden' name = 'item_code' value= " . $row00['item_code'] . ">
                <td class='td_btn'><input type='submit' class='btn' onclick='popup_edit()' value='수정'></td>
                </form>
                </tr>
                ";
            }
        }




        ////////////////////////////////////////////로그 남기기
        // $date = date('Y-m-d');
        // $time = date('H:i:s');
        // $location = "machine_view.php";
        // $acc = "설비정보 VIEW";

        // $sql = "insert into log (date, time, location, acc) 
        //  values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        // $res = mysqli_query($conn, $sql);

        mysqli_close($conn); // 종료
        ?>
    </table>
    <script type="text/javascript">
        function popup_edit() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("bom_edit.php", "bom_edit", "width=1310, height=930, top=100, left=500");

        }
        // setTimeout(() => {
        //     location.reload();
        // }, 3000);
    </script>
</body>

</html>