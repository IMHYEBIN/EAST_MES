<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php

$item_code = $_POST["item_code"];


/////////////////////////////////////////////////////////////////////검색

//조건 중 하나라도 입력이 되었으면 WHERE 추가
if ($item_code != null) {
    $temp0 = "where";
} else {
    $temp0 = "";
}

//검색조건 1
if ($item_code != null) {
    $temp1 = " parent like '" . $item_code . "'";
    //검색O = 플래그1
    $flag1 = 1;
} else {
    $temp1 = "";
    //검색X = 플래그0
    $flag1 = 0;
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from bom
" . $temp0 . "
" . $temp1 . " order by id desc";

$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/basic/bom/css/pop_bottom_view.css">
    <title>East Company | BOM등록 :: BOTTOM_VIEW</title>
</head>

<body>

    <div>선택된 제품</div>
    <div class="parent"><input type="text" value="<?= $item_code ?>"></div>
    <div class="result">
        <table>
            <?php
            /////////////////////////////////////////////////////////////////////테이블 뷰
            for (; $row = mysqli_fetch_array($res);) {

                echo "
            <tr>
            <td class='td1'>" . $row['parent'] . "</td>
            <form action='bom_edit.php' method='post' target='bom_edit'>
            <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
            <td class='td_btn'><input type='submit' class='btn' onclick='popup_edit()' value='삭제'></td>
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
    </div>
    <div>추가할 제품</div>
    <div class="parent"><input type="text"><button>추가</button></div>

    <table>



        <script type="text/javascript">
            function popup_edit() {

                //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
                window.open("bom_edit.php", "bom_edit", "width=1110, height=200, top=200, left=100");

            }
        </script>
        <?php mysqli_close($conn); // 종료 
        ?>
</body>

</html>