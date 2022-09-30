<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php

$sql = "select * from item3_grade order by id desc";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/grade_view.css">
    <title>East Company</title>
</head>

<body>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        for (; $row = mysqli_fetch_array($res);) {

            echo "
            <tr>
            <td class='td1' name='id'>" . $row['id'] . "</td>
            <td class='td2'>" . $row['grade'] . "</td>
            <form action='grade_edit.php' method='post' target='grade_edit'>
            <input type = 'hidden' name = 'id' value= " . $row['id'] . ">
            <td class='td_btn'><input type='submit' class='btn' onclick='popup_edit()' value='수정'></td>
            </form>
            </tr>
            ";
        }

        ////////////////////////////////////////////로그 남기기
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $location = "grade_view.php";
        $acc = "원재료 GRADE VIEW";

        $sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
        $res = mysqli_query($conn, $sql);

        mysqli_close($conn); // 종료

        ?>
    </table>
    <script type="text/javascript">
        function popup_edit() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("grade_edit.php", "grade_edit", "width=600, height=180, top=200, left=100");

        }
    </script>
</body>

</html>