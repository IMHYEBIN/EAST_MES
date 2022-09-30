<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$item_code = $_POST["item_code"];
$item_name = $_POST["item_name"];
$index1 = $_POST["index1"];


/////////////////////////////////////////////////////////////////////검색
if ($item_code != null || $item_name != null || $index1 > 0) {
    $temp0 = "where";
} else {
    $temp0 = "";
}

//검색조건 1
if ($item_code != null) {
    $temp1 = "item_code like '%" . $item_code . "%'";
    //검색O = 플래그1
    $flag1 = 1;
} else {
    $temp1 = "";
    //검색X = 플래그0
    $flag1 = 0;
}

//검색조건 2
if ($item_name != null) {
    //앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
    if ($flag1 == 1) {
        $temp2 = "and item_name like '%" . $item_name . "%'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp2 = "item_name like '%" . $item_name . "%'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

//검색조건 3
if ($index1 > 0) {
    if ($flag1 == 1) {
        $temp3 = "and index1 like '" . $index1 . "'";
    } else
        $temp3 = "index1 like '" . $index1 . "'";
    $flag1 = 1;
} else {
    $temp3 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from item
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " 
" . $temp3 . " order by id desc";

$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stock_view.css">
    <title>East Company</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for (; $row = mysqli_fetch_array($res);) {

            if ($row['index1'] == '1') {
                $index1_value = "아쎄이";
            } else if ($row['index1'] == '2') {
                $index1_value = "부자재";
            } else if ($row['index1'] == '3') {
                $index1_value = "원재료";
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
                <td class='td1' name='id'>" . $row['id'] . "</td>
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

        // 수정버튼 잠시
        // <form action='stock_edit.php' method='post' target='stock_edit'>
        // <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
        // <td class='td10'><input type='submit' class='btn' onclick='popup_edit()' value='수정'></td>
        // </form>

        ////////////////////////////////////////////로그 남기기
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $location = "stock_view.php";
        $acc = "재고관리 VIEW";

        $sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        $res = mysqli_query($conn, $sql);

        mysqli_close($conn); // 종료
        ?>
    </table>
    <script type="text/javascript">
        function popup_edit() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("stock_edit.php", "stock_edit", "width=1110, height=320, top=200, left=100");

        }
    </script>
</body>

</html>