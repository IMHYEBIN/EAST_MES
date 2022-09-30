<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
if($_POST["show__item_code"] != null){
    $show__item_code = $_POST["show__item_code"];
    $show__item_name = $_POST["show__item_name"];

    $_SESSION["show__item_code"] = $show__item_code;
    $_SESSION["show__item_name"] = $show__item_name;
}

// $item_name = $_POST["item_name"];



// ///////////////////////////////////////////////////////////////////////SQL
// $sql = "select * from bom where parent like '" . $item_code . "' order by id desc";
// $res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tree_view.css">
    <title>East Company</title>
</head>

<body style="background-color: #f0f4f5;">
    <div class="root">
        <div class="root__item_code">제품코드 : <?= $_SESSION["show__item_code"] ?></div>
        <div class="root__item_name">제품명 : <?=  $_SESSION["show__item_name"] ?></div>
    </div>

    <table>
        <?php
        /////////////////////////////////////////////////////////////////////테이블 뷰
        $sql = "SELECT * FROM bom WHERE parent = '" . $_SESSION["show__item_code"] . "'";
        $res = mysqli_query($conn, $sql);
        for (; $row = mysqli_fetch_array($res);) {

            $sql00 = "SELECT * FROM item WHERE item_code = '" . $row['child'] . "'";
            $res00 = mysqli_query($conn, $sql00);
            $row00 = mysqli_fetch_array($res00);

            echo "
            <tr>
            <td class='td1'>ㄴ 제품코드 : " . $row['child'] . "</td>
            <td class='td2'>제품명 : " . $row00['item_name'] . "</td>
            <form action='php/tree_delete.php' method='post' target='_self'>
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




    <!-- 
    <div class="result">
        <iframe frameborder="0" class="result_frame" name="result_frame" src="/page/basic/bom/tree_in_view.php"></iframe>
    </div> -->


    <?php mysqli_close($conn); ?>
</body>

</html>