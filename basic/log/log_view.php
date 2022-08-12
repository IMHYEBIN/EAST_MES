<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$date = $_POST["date"];
$time1 = $_POST["time1"];
$time2 = $_POST["time2"];


/////////////////////////////////////////////////////////////////////검색
//조건 중 하나라도 입력이 되었으면 WHERE 추가
if ($date != null || ($time1 != null && $time2 != null)) {
    $temp0 = "where";
} else {
    $temp0 = "";
}

//검색조건 1
if ($date != null) {
    $temp1 = " date like '" . $date . "'";
    //검색O = 플래그1
    $flag1 = 1;
} else {
    $temp1 = "";
    //검색X = 플래그0
    $flag1 = 0;
}

//검색조건 2
if ($time1 != null && $time2 != null) {
    //앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
    if ($flag1 == 1) {
        $temp2 = " and time >= '" . $time1 . "' and time <= '" . $time2 . "'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp2 = " time >= '" . $time1 . "' and time <= '" . $time2 . "'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from log
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
    <link rel="stylesheet" href="css/log_view.css">
    <title>East Company | 설비관리 :: VIEW</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for (; $row = mysqli_fetch_array($res);) {

            echo "
            <tr>
            <td class='td1' name='id'>" . $row['id'] . "</td>
            <td class='td2'>" . $row['date'] . "</td>
            <td class='td3'>" . $row['time'] . "</td>
            <td class='td4'>" . $row['location'] . "</td>
            <td class='td5'>" . $row['acc'] . "</td>
            </tr>
            ";
        }
        ?>
    </table>
</body>

</html>