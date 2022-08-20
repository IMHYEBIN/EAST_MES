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
    $temp1 = " item_code like '" . $item_code . "'";
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
        $temp2 = " and item_name like '" . $item_name . "'";
    }
    //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
    else
        $temp2 = " item_name like '" . $item_name . "'";
    //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
    $flag1 = 1;
} else {
    $temp2 = "";
}

///////////////////////////////////////////////////////////////////////SQL
$sql = "select item_code,item_name from item1
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " 
UNION
select item_code,item_name from item2
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . "
";

$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>East Company | Tree View</title>
</head>

<body>
    <div>
        <?php
        echo "제품코드 : <strong>" . $row['item_code'] . "</strong>";
        echo "제품명 : <strong>" . $row['item_name'] . "</strong>"; ?>
    </div>
    <div>
        <?php

        //찾은 코드를 기반으로 BOM 테이블에서 검색
        for ($count = 1; $row . "" . $count[0] = ''; $count++) {
            $query = $sql . "" . $count;
            $result = $res . "" . $count;
            $rowdata = $row . "" . $count;
            
            $query = "select * from bom where parent = '" . $row['item_code'] . "'";
            $result = mysqli_query($conn, $query);
            $rowdata . "" . $count = mysqli_fetch_array($result);

            echo "<tr>ㄴ" . $row . "" . $count['child'] . "</tr>";
        }


        ?>
    </div>
</body>

</html>