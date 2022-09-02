<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
echo $_GET['select_bom'];
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
$sql = "select * from machine
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
    <title>East Company | 설비관리 :: VIEW</title>
</head>

<body>


    <table>

        <?php
        for (; $row = mysqli_fetch_array($res);) {

            echo "
            <tr>
            <td class='td1' name='id'>" . $row['id'] . "</td>
            <td class='td2'>" . $row['item_code'] . "</td>
            <td class='td3'>" . $row['item_name'] . "</td>
            <td class='td4'>" . $row['ton'] . "</td>
            <td class='td5'>" . $row['acc'] . "</td>
            <form action='machine_edit.php' method='post' target='machine_edit'>
            <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
            <td class='td_btn'><input type='submit' class='btn' onclick='popup_edit()' value='수정'></td>
            </form>
            </tr>
            ";
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
            window.open("machine_edit.php", "machine_edit", "width=1110, height=200, top=200, left=100");

        }

        console.log(document.getElementById('select_bom'));
    </script>
</body>

</html>