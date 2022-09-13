<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$item_code = $_POST["item_code"];
$item_name = $_POST["item_name"];


/////////////////////////////////////////////////////////////////////검색
//조건 중 하나라도 입력이 되었으면 WHERE 추가
if ($item_code != null || $item_name != null) {
    $temp0 = "where";
} else {
    $temp0 = "";
}

//검색조건 1
if ($item_code != null) {
    $temp1 = " item_code like '%" . $item_code . "%'";
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
        $temp2 = " item_name like '%" . $item_name . "%'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from item
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " order by id desc";
$res = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bom/css/pop2_top_view.css">
    <title>East Company | BOM등록 :: TOP_VIEW</title>
</head>

<body style="background-color: #f0f4f5;">

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for ($count = 1; $row = mysqli_fetch_array($res); $count++) {

            if ($row['supply'] == '1') {
                $supply_value1 = "유상";
            } else if ($row['supply'] == '2') {
                $supply_value1 = "무상";
            }

            if ($row['status'] == '1') {
                $status_value1 = "사용";
            } else if ($row['status'] == '2') {
                $status_value1 = "미사용";
            }

            echo "
            <tr class='td'>
            <td class='td1'>" . $count . "</td>
            <td class='td2'>아쎄이</td>
            <td class='td3'>" . $row['item_code'] . "</td>
            <td class='td4'>" . $row['item_name'] . "</td>
            <td class='td5'>" . $row['unit'] . "</td>
            <td class='td6'>" . $row['client'] . "</td>
            <td class='td7'>" . $supply_value1 . "</td>
            <td class='td8'>" . $row['safe_stock'] . "</td>
            <td class='td9'>" . $row['acc'] . "</td>
            <td class='td10'>" . $status_value1 . "</td>
            <form action='/page/bom/bom_edit.php' method='post' target='bom_edit'>
            <input type = 'hidden' name = 'type' value= '아쎄이'>
            <input type = 'hidden' name = 'item_code' value= " . $row['item_code'] . ">
            <td class='td_btn'><input type='submit' class='btn' value='BOM보기'></td>
            </form>
            </tr>
            ";
        }
        

        ////////////////////////////////////////////로그 남기기
        // $date = date('Y-m-d');
        // $time = date('H:i:s');
        // $location = "bom_view.php";
        // $acc = "BOM 팝업 정보 VIEW";

        // $sql = "insert into log (date, time, location, acc) 
        //  values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        // $res = mysqli_query($conn, $sql);

        mysqli_close($conn); // 종료
        ?>
    </table>
</body>

</html>