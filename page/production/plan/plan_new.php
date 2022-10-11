<?php session_start(); ?>
<?php $conn = new mysqli("localhost", "server", "00000000", "dataset"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/plan_new.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/plan_insert.php" target="_blank">
        <div class="container-fulid">
            <div class="main_section">
                <table class="table table-hover table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2" class="text-center align-middle">날짜</th>
                            <th colspan="3"><input type="date" class="date_input" name="date" value="<?php echo date('Y-m-d'); ?>"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><button type="submit" class="btn btn-success btn-sm">등록</button></th>
                            <th><button type="button" class="btn btn-danger btn-sm" onclick="self.close();">닫기</button></th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="factory_name text-center">공장</th>
                            <th rowspan="2" class="machine_num text-center">호기</th>
                            <th rowspan="2" class="machine_name text-center">설비</th>
                            <th colspan="6" class="time1 text-center">(8:00 ~ 12:10)</th>
                            <th colspan="6" class="time2 text-center">(13:10 ~ 15:30)</th>
                            <th rowspan="2" class="people_count text-center">인원</th>
                            <th rowspan="2" class="acc text-center">비고</th>
                        </tr>
                        <tr>
                            <th class="text-center">차종</th>
                            <th class="text-center">품번</th>
                            <th class="text-center">품명</th>
                            <th class="text-center">원재료</th>
                            <th class="text-center">지시수량</th>
                            <th class="text-center">작업자</th>
                            <th class="text-center">차종</th>
                            <th class="text-center">품번</th>
                            <th class="text-center">품명</th>
                            <th class="text-center">원재료</th>
                            <th class="text-center">지시수량</th>
                            <th class="text-center">작업자</th>
                        </tr>
                    </thead>

                    <?php
                    echo "
                    <tr>
                        <th rowspan='13' class='table-danger text-center' name='location1'>1공장</th>
                    </tr>
                    ";

                    $sql1 = "select * from machine where location = '1공장'";
                    $res1 = mysqli_query($conn, $sql1);

                    for ($count = 1; $row1 = mysqli_fetch_array($res1); $count++) {
                        echo " 
                            <tr class='table-danger'>
                                <td height='20' class='machine_num' name='machine_num_1_". $count ."'>" . $count . "</td>
                                <td height='20' class='machine_nam' name='machine_name1_". $count ."'>" . $row1['machine_name'] . "</td>
                                <td height='20' class='car_type1' name='car_type1_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='item_code1' name='item_code1_1_". $count ."'><input type='text'></td>
                                <td height='20' class='item_name1' name='item_name1_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='raw_item1' name='raw_item1_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='quantity1' name='quantity1_1_". $count ."'><input type='text'></td>
                                <td height='20' class='people1' name='people1_1_". $count ."'><input type='text'></td>
                                <td height='20' class='car_type2' name='car_type2_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='item_code2' name='item_code2_1_". $count ."'><input type='text'></td>
                                <td height='20' class='item_name2' name='item_name2_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='raw_item2' name='raw_item2_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='quantity2' name='quantity2_1_". $count ."'><input type='text'></td>
                                <td height='20' class='people2' name='people2_1_". $count ."'><input type='text'></td>
                                <td height='20' class='people_count' name='people_count_1_". $count ."'><input type='text' disabled></td>
                                <td height='20' class='acc' name='acc_1_". $count ."'><input type='text'></td>
                            </tr>
                            ";
                    }
                    echo "
                        <tr>
                            <th rowspan='9' class='table-primary text-center'name='location2'>2공장</th>
                        </tr>
                        ";

                    $sql2 = "select * from machine where location = '2공장'";
                    $res2 = mysqli_query($conn, $sql2);

                    for ($count = 1; $row2 = mysqli_fetch_array($res2); $count++) {
                        echo " 
                            <tr class='table-primary'>
                            <td height='20' class='machine_num'>" . $count . "</td>
                            <td height='20' class='machine_name'>" . $row2['machine_name'] . "</td>
                            <td height='20' class='car_type1'><input type='text' disabled></td>
                            <td height='20' class='item_code1'><input type='text'></td>
                            <td height='20' class='item_name1'><input type='text' disabled></td>
                            <td height='20' class='raw_item1'><input type='text' disabled></td>
                            <td height='20' class='quantity1'><input type='text'></td>
                            <td height='20' class='people1'><input type='text'></td>
                            <td height='20' class='car_type2'><input type='text' disabled></td>
                            <td height='20' class='item_code2'><input type='text'></td>
                            <td height='20' class='item_name2'><input type='text' disabled></td>
                            <td height='20' class='raw_item2'><input type='text' disabled></td>
                            <td height='20' class='quantity2'><input type='text'></td>
                            <td height='20' class='people2'><input type='text'></td>
                            <td height='20' class='people_count'><input type='text' disabled></td>
                            <td height='20' class='acc'><input type='text'></td>
                            </tr>
                            ";
                    }
                    echo "
                        <thead>                 
                            <tr>
                                <th colspan='19' class='table-dark text-center'>조립 검사반</th>
                            </tr>
                        </thead>
                        ";
                    echo "
                        <tr>
                            <th rowspan='4' class='table-danger text-center' name='location3'>1공장</th>
                        </tr>
                        ";
                    for ($count = 1; $count <= 3; $count++) {
                        echo " 
                    <tr class='table-danger'>
                    <td height='20' class='machine_num'>" . $count . "</td>
                    <td height='20' class='machine_name'><input type='text' disabled></td>
                    <td height='20' class='car_type1'><input type='text' disabled></td>
                    <td height='20' class='item_code1'><input type='text'></td>
                    <td height='20' class='item_name1'><input type='text'></td>
                    <td height='20' class='raw_item1'><input type='text'></td>
                    <td height='20' class='quantity1'><input type='text'></td>
                    <td height='20' class='people1'><input type='text'></td>
                    <td height='20' class='car_type2'><input type='text' disabled></td>
                    <td height='20' class='item_code2'><input type='text'></td>
                    <td height='20' class='item_name2'><input type='text' disabled></td>
                    <td height='20' class='raw_item2'><input type='text' disabled></td>
                    <td height='20' class='quantity2'><input type='text'></td>
                    <td height='20' class='people2'><input type='text'></td>
                    <td height='20' class='people_count'><input type='text' disabled></td>
                    <td height='20' class='acc'><input type='text'></td>
                    </tr>
                    ";
                    }
                    echo "
                    <tr>
                        <th rowspan='7' class='table-primary text-center' name='location4'>2공장</th>
                    </tr>
                    ";
                    for ($count = 1; $count <= 6; $count++) {
                        echo " 
                    <tr class='table-primary'>
                    <td height='20' class='machine_num'>" . $count . "</td>
                    <td height='20' class='machine_name'><input type='text' disabled></td>
                    <td height='20' class='car_type1'><input type='text' disabled></td>
                    <td height='20' class='item_code1'><input type='text'></td>
                    <td height='20' class='item_name1'><input type='text'></td>
                    <td height='20' class='raw_item1'><input type='text'></td>
                    <td height='20' class='quantity1'><input type='text'></td>
                    <td height='20' class='people1'><input type='text'></td>
                    <td height='20' class='car_type2'><input type='text' disabled></td>
                    <td height='20' class='item_code2'><input type='text'></td>
                    <td height='20' class='item_name2'><input type='text' disabled></td>
                    <td height='20' class='raw_item2'><input type='text' disabled></td>
                    <td height='20' class='quantity2'><input type='text'></td>
                    <td height='20' class='people2'><input type='text'></td>
                    <td height='20' class='people_count'><input type='text' disabled></td>
                    <td height='20' class='acc'><input type='text'></td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
            </div>
        </div>
    </form>
</body>

</html>