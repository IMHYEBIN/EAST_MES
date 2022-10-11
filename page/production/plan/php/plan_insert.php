<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

$date = $_POST['date'];
$location1 = $_POST['location1'];

////////////////////////////////////////////////////// INSERT
$sql1 = "select * from machine where location = '1공장'";
$res1 = mysqli_query($conn, $sql1);

for ($count = 1; $row1 = mysqli_fetch_array($res1); $count++) {

	$machine_num_1_ . "" . $count = $_POST["machine_num_1_$count"];
	$machine_name1_ . "" . $count = $_POST["machine_name1_$count"];
	$car_type1_1_ . "" . $count = $_POST["car_type1_1_$count"];
	$item_code1_1_ . "" . $count = $_POST["item_code1_1_$count"];
	$item_name1_1_ . "" . $count = $_POST["item_name1_1_$count"];
	$raw_item1_1_ . "" . $count = $_POST["raw_item1_1_$count"];
	$quantity1_1_ . "" . $count = $_POST["quantity1_1_$count"];
	$people1_1_ . "" . $count = $_POST["people1_1_$count"];
	$car_type2_1_ . "" . $count = $_POST["car_type2_1_$count"];
	$item_code2_1_ . "" . $count = $_POST["item_code2_1_$count"];
	$item_name2_1_ . "" . $count = $_POST["item_name2_1_$count"];
	$raw_item2_1_ . "" . $count = $_POST["raw_item2_1_$count"];
	$quantity2_1_ . "" . $count = $_POST["quantity2_1_$count"];
	$people2_1_ . "" . $count = $_POST["people2_1_$count"];
	$people_count_1_ . "" . $count = $_POST["people_count_1_$count"];
	$acc_1_ . "" . $count = $_POST["acc_1_$count"];
}

$sql = "insert into plan (
	date,
	location,
	machine_num,
	machine_name,
	car_type1,
	item_code1,
	item_name1,
	raw_item1,
	quantity1,
	people1,
	car_type2,
	item_code2,
	item_name2,
	raw_item2,
	quantity2,
	people2,
	people_count,
	acc
	)
		values (
			$date,
			$location1,
			$machine_num_1_$count,
			$machine_name1_$count,
			$car_type1_1_$count,
			$item_code1_1_$count,
			$item_name1_1_$count,
			$raw_item1_1_$count,
			$quantity1_1_$count,
			$people1_1_$count,
			$car_type2_1_$count,
			$item_code2_1_$count,
			$item_name2_1_$count,
			$raw_item2_1_$count,
			$quantity2_1_$count,
			$people2_1_$count,
			$people_count_1_$count,
			$acc_1_$count
				)";

$res = mysqli_query($conn, $sql);



//////////////////////////////////////////////////////미리보기

echo $date;
echo $location1;
echo $machine_num_1_."".$count;
echo $machine_name1_."".$count;
echo $car_type1_1_."".$count;
echo $item_code1_1_."".$count;
echo $item_name1_1_."".$count;
echo $raw_item1_1_."".$count;
echo $quantity1_1_."".$count;
echo $people1_1_."".$count;
echo $car_type2_1_."".$count;
echo $item_code2_1_."".$count;
echo $item_name2_1_."".$count;
echo $raw_item2_1_."".$count;
echo $quantity2_1_."".$count;
echo $people2_1_."".$count;
echo $people_count_1_."".$count;
echo $acc_1_."".$count;

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "plan_insert.php";
$acc = "생산계획정보 INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.document.location.href = "../plan_new.php" //부모의 부모창 다시 열기
</script>