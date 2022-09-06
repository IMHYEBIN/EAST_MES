<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php 

///////////////////////////////////////////////////////////////////////SQL
$sql = "select * from bom where parent like '" . $_SESSION['item_code'] . "' order by id desc";
$res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/basic/bom/css/bottom_view_result.css">
    <title>Document</title>
</head>
<body>
<table>
            <?php
            /////////////////////////////////////////////////////////////////////테이블 뷰
            for (; $row = mysqli_fetch_array($res);) {

                echo "
            <tr>
            <td class='td'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ㄴ " . $row['child'] . "</td>
            <form action='php/bottom_view_result_delete.php' method='post' target='_self'>
            <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
            <td class='td_btn'><input type='submit' class='btn' value='삭제'></td>
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
</body>
</html>