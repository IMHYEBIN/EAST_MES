<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$item_code = $_POST["item_code"];
$item_name = $_POST["item_name"];
$status = $_POST["status"];


/////////////////////////////////////////////////////////////////////검색
//조건 중 하나라도 입력이 되었으면 WHERE 추가
if ($item_code != null || $item_name != null || $status > 0) {
    $temp0 = "";
} else {
    $temp0 = "";
}

//검색조건 1
if ($item_code != null) {
    $temp1 = " and item_code like '%" . $item_code . "%'";
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
        $temp2 = " and item_name like '%" . $item_name . "%'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp2 = " and item_name like '%" . $item_name . "%'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

//검색조건 3
if ($status > 0) {
    if ($flag1 == 1) {
        $temp3 = " and status like '" . $status . "'";
    } else
        $temp3 = " and status like '" . $status . "'";
    $flag1 = 1;
} else {
    $temp3 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from item where index1 = '2'
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
    <link rel="stylesheet" href="css/item2_view.css">
    <title>East Company</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for (; $row = mysqli_fetch_array($res);) {

            $sql01 = "select * from item2 where item_code = '" . $row['item_code'] . "'";
            $res01 = mysqli_query($conn, $sql01);
            $row01 = mysqli_fetch_array($res01);

            if ($row['status'] == '양산') {
                $status_value = "양산";
            } else if ($row['status'] == '단종') {
                $status_value = "단종";
            } else if ($row['status'] == 'A/S') {
                $status_value = "A/S";
            } else {
                $status_value = "ERROR";
            }


            if ($row['supply'] == '1') {
                $supply_value = "유상";
            }
            if ($row['supply'] == '2') {
                $supply_value = "무상";
            }

            if ($row01['auto'] == '1') {
                $auto_value = "자동";
            } else if ($row01['auto'] == '2') {
                $auto_value = "수동";
            }
            echo "
            <tr>
            <td class='td1' name='id'>" . $row['id'] . "</td>
            <td class='td2'>" . $row['item_code'] . "</td>
            <td class='td3'>" . $row['item_name'] . "</td>
            <td class='td4'>" . $row['unit'] . "</td>
            <td class='td4'>" . $status_value . "</td>
            <td class='td4'>" . $row['client'] . "</td>
            <td class='td4'>" . $supply_value . "</td>
            <td class='td4'>" . $row['safe_stock'] . "</td>
            <td class='td4'>" . $auto_value . "</td>
            <td class='td4'>" . $row01['method'] . "</td>
            <td class='td4'>" . $row01['ct'] . "</td>
            <td class='td12'>" . $row['acc'] . "</td>
            <form action='item2_edit.php' method='post' target='item2_edit'>
            <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
            <td class='td_btn'><input type='submit' class='btn' onclick='popup_edit()' value='수정'></td>
            </form>
            </tr>
            ";
        }

        ////////////////////////////////////////////로그 남기기
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $location = "item2_insert.php";
        $acc = "부자재정보 INSERT";

        $sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        $res = mysqli_query($conn, $sql);

        mysqli_close($conn); // 종료

        ?>
    </table>
    <script type="text/javascript">
        function popup_edit() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("item2_edit.php", "item2_edit", "width=1110, height=420, top=200, left=100");

        }
    </script>
</body>

</html>