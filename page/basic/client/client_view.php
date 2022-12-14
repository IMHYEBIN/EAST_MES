<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$cop_code = $_POST["cop_code"];
$cop_name = $_POST["cop_name"];
$type = $_POST["type"];


/////////////////////////////////////////////////////////////////////검색
//조건 중 하나라도 입력이 되었으면 WHERE 추가
if ($cop_code != null || $cop_name != null || $type > 0) {
    $temp0 = "where";
} else {
    $temp0 = "";
}

//검색조건 1
if ($cop_code != null) {
    $temp1 = " cop_code like '%" . $cop_code . "%'";
    //검색O = 플래그1
    $flag1 = 1;
} else {
    $temp1 = "";
    //검색X = 플래그0
    $flag1 = 0;
}

//검색조건 2
if ($cop_name != null) {
    //앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
    if ($flag1 == 1) {
        $temp2 = " and cop_name like '%" . $cop_name . "%'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp2 = " cop_name like '%" . $cop_name . "%'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

//검색조건 3
if ($type > 0) {
    if ($flag1 == 1) {
        $temp3 = " and type like '" . $type . "'";
    } else
        $temp3 = " type like '" . $type . "'";
    $flag1 = 1;
} else {
    $temp3 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from client
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
    <link rel="stylesheet" href="css/client_view.css">
    <title>East Company</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for (; $row = mysqli_fetch_array($res);) {

            if ($row['type'] == '1') {
                $type_value = "고객사";
            }
            if ($row['type'] == '2') {
                $type_value = "외주처";
            }
            if ($row['type'] == '3') {
                $type_value = "부자재";
            }
            if ($row['type'] == '4') {
                $type_value = "원재료";
            }
            if ($row['type'] == '5') {
                $type_value = "협력사";
            }

            echo "
            <tr>
            <td class='td1' name='id'>" . $row['id'] . "</td>
            <td class='td2'>" . $row['cop_code'] . "</td>
            <td class='td3'>" . $row['cop_name'] . "</td>
            <td class='td4'>" . $type_value . "</td>
            <td class='td5'>" . $row['cop_num'] . "</td>
            <td class='td6'>" . $row['address2'] . "" . $row['address3'] . "</td>
            <td class='td7'>" . $row['acc'] . "</td>
            <form action='client_edit.php' method='post' target='client_edit'>
            <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
            <td class='td8'><input type='submit' class='btn' onclick='popup_edit()' value='수정'></td>
            </form>
            </tr>
            ";
        }

        ////////////////////////////////////////////로그 남기기
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $location = "client_view.php";
        $acc = "거래처정보 VIEW";

        $sql = "insert into log (date, time, location, acc) 
             values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        $res = mysqli_query($conn, $sql);
        ?>
    </table>
    
    <script type="text/javascript">
        function popup_edit() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("client_edit.php", "client_edit", "width=800, height=300, top=200, left=100");

        }
    </script>
</body>

</html>