<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$date = $_POST["date"];
$item_code = $_POST["item_code"];
$item_name = $_POST["item_name"];
$index1 = $_POST["index1"];
$type = $_POST["type"];


/////////////////////////////////////////////////////////////////////검색
if ($date != null || $item_code != null || $item_name != null || $index1 > 0 || $type > 0) {
    $temp0 = "where";
} else {
    $temp0 = "";
}

//검색조건 1
if ($item_code != null) {
    $temp1 = "in_out.item_code like '%" . $item_code . "%'";
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
        $temp2 = "and item.item_name like '%" . $item_name . "%'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp2 = "item.item_name like '%" . $item_name . "%'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

//검색조건 3
if ($index1 > 0) {
    if ($flag1 == 1) {
        $temp3 = " and item.index1 like '" . $index1 . "'";
    } else
        $temp3 = "item.index1 like '" . $index1 . "'";
    $flag1 = 1;
} else {
    $temp3 = "";
}

//검색조건 4
if ($type > 0) {
    if ($flag1 == 1) {
        $temp4 = " and in_out.type like '" . $type . "'";
    } else
        $temp4 = "in_out.type like '" . $type . "'";
    $flag1 = 1;
} else {
    $temp4 = "";
}

//검색조건 5
if ($date != null) {
    //앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
    if ($flag1 == 1) {
        $temp5 = "and in_out.date like '" . $date . "'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp5 = "in_out.date like '" . $date . "'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp5 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select in_out.id, in_out.date, in_out.item_code, item.item_name, in_out.type, in_out.unit, in_out.inout_q, in_out.inout_a, item.safe_stock, in_out.acc from in_out join item on (in_out.item_code = item.item_code)
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " 
" . $temp3 . "
" . $temp4 . "
" . $temp5 . " order by in_out.id desc";

$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inout_view.css">
    <title>East Company</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for (; $row = mysqli_fetch_array($res);) {

            if ($row['type'] == '1') {
                $type_value = "입고";
                $mark = "+";
            } else if ($row['type'] == '2') {
                $type_value = "출고";
                $mark = "-";
            } else {
                $type_value = "ERROR";
            }


            if ($row['supply'] == '1') {
                $supply_value = "유상";
            }
            if ($row['supply'] == '2') {
                $supply_value = "무상";
            }


            $sql00 = "select * from item where item_code = '" . $row['item_code'] . "'";
            $res00 = mysqli_query($conn, $sql00);
            $row00 = mysqli_fetch_array($res00);

            echo "
            <tr>
            <td class='td1' name='id'>" . $row['id'] . "</td>
            <td class='td2'>" . $row['date'] . "</td>
            <td class='td3'>" . $row['item_code'] . "</td>
            <td class='td4'>" . $row00['item_name'] . "</td>
            <td class='td5'>" . $type_value . "</td>
            <td class='td6'>" . $row00['unit'] . "</td>
            <td class='td7'>" . $mark . "" . $row['inout_q'] . "</td>
            <td class='td8'>" . $row['inout_a'] . "</td>
            <td class='td9'>" . $row00['now_q'] . "</td>
            <td class='td10'>" . $row['acc'] . "</td>
            </tr>
            ";
        }

        ////////////////////////////////////////////로그 남기기
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $location = "inout_view.php";
        $acc = "입출고관리 VIEW";

        $sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        $res = mysqli_query($conn, $sql);

        mysqli_close($conn); // 종료
        ?>
    </table>
    <script type="text/javascript">
        function popup_edit() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("inout_edit.php", "inout_edit", "width=1110, height=320, top=200, left=100");

        }
    </script>
</body>

</html>