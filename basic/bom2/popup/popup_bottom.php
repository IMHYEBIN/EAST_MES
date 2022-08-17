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
$sql01 = "select * from item1
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " order by id desc";

$res01 = mysqli_query($conn, $sql01);

$sql02 = "select * from item2
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " order by id desc";

$res02 = mysqli_query($conn, $sql02);

$sql03 = "select * from item3
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " order by id desc";

$res03 = mysqli_query($conn, $sql03);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pop_top_view.css">
    <title>East Company | BOM등록 :: TOP_VIEW</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for ($count = 1; $row01 = mysqli_fetch_array($res01); $count++) {

            if ($row01['supply'] == '1') {
                $supply_value1 = "유상";
            } else if ($row01['supply'] == '2') {
                $supply_value1 = "무상";
            }

            if($row01['status'] == '1'){
                $status_value1 = "사용";
            }else if ($row01['status'] == '2') {
                $status_value1 = "미사용";
            }

            echo "
            <tr>
            <td class='td1'>" . $count . "</td>
            <td class='td2'>아쎄이</td>
            <td class='td3'>" . $row01['item_code'] . "</td>
            <td class='td4'>" . $row01['item_name'] . "</td>
            <td class='td5'>" . $row01['unit'] . "</td>
            <td class='td6'>" . $row01['client_name'] . "</td>
            <td class='td7'>" . $supply_value1 . "</td>
            <td class='td8'>" . $row01['safe_stock'] . "</td>
            <td class='td9'>" . $row01['acc'] . "</td>
            <td class='td10'>" . $status_value1 . "</td>
            <form action='/basic/bom/popup/pop_bottom_view.php' method='post' target='bottom_frame'>
            <input type = 'hidden' name = 'type' value= '아쎄이'>
            <input type = 'hidden' name = 'item_code' value= " . $row01['item_code'] . ">
            <td class='td_btn'><input type='submit' class='btn' value='선택'></td>
            </form>
            </tr>
            ";
        }
        for (; $count < 10; $count++) {

            if ($row02['supply'] == '1') {
                $supply_value2 = "유상";
            } else if ($row02['supply'] == '2') {
                $supply_value2 = "무상";
            }

            if($row02['status'] == '1'){
                $status_value2 = "사용";
            }else if ($row02['status'] == '2') {
                $status_value2 = "미사용";
            }

            echo "
            <tr>
            <td class='td1'>" . $count . "</td>
            <td class='td2'>부자재</td>
            <td class='td3'>" . $row02['item_code'] . "</td>
            <td class='td4'>" . $row02['item_name'] . "</td>
            <td class='td5'>" . $row02['unit'] . "</td>
            <td class='td6'>" . $row02['client_name'] . "</td>
            <td class='td7'>" . $supply_value2 . "</td>
            <td class='td8'>" . $row02['safe_stock'] . "</td>
            <td class='td9'>" . $row02['acc'] . "</td>
            <td class='td10'>" . $status_value2 . "</td>
            <form action='/basic/bom/popup/pop_bottom_view.php' method='post' target='bottom_frame'>
            <input type = 'hidden' name = 'type' value= '부자재'>
            <input type = 'hidden' name = 'item_code' value= " . $row02['item_code'] . ">
            <td class='td_btn'><input type='submit' class='btn' value='선택'></td>
            </form>
            </tr>
            ";
        }
        for (; $row03 = mysqli_fetch_array($res03); $count++) {

            if ($row03['supply'] == '1') {
                $supply_value3 = "유상";
            } else if ($row03['supply'] == '2') {
                $supply_value3 = "무상";
            }

            if($row03['useable'] == '1'){
                $useable_value = "사용";
            }else if ($row03['useable'] == '2') {
                $useable_value = "미사용";
            }

            echo "
            <tr>
            <td class='td1'>" . $count . "</td>
            <td class='td2'>원재료</td>
            <td class='td3'>" . $row03['item_code'] . "</td>
            <td class='td4'>" . $row03['item_name'] . "</td>
            <td class='td5'>" . $row03['unit'] . "</td>
            <td class='td6'>" . $row03['client_name'] . "</td>
            <td class='td7'>" . $supply_value3 . "</td>
            <td class='td8'>" . $row03['safe_stock'] . "</td>
            <td class='td9'>" . $row03['acc'] . "</td>
            <td class='td10'>" . $useable_value . "</td>
            <form action='/basic/bom/popup/pop_bottom_view.php' method='post' target='bottom_frame'>
            <input type = 'hidden' name = 'type' value= '원재료'>
            <input type = 'hidden' name = 'item_code' value= " . $row03['item_code'] . ">
            <td class='td_btn'><input type='submit' class='btn' value='선택'></td>
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

        ?>
    </table>

            <!-- ////////////////////////////////////////////하단 섹션/////////////////////////////////////////////// -->
            <form method="post" action="/basic/bom/popup/pop_bottom_view.php" target="_blank">
            <div class="table_section2">
                <div class="header2_1">
                    <div class="th">제품 BOM</div>
                </div>
            </div>
            <!-- 하단 VIEW -->
            <iframe frameborder="0" class="bottom_frame" name="bottom_frame" src="/basic/bom/popup/pop_bottom_view.php"></iframe>
        </form>

        <?php 
                mysqli_close($conn); // 종료
        ?>
</body>

</html>