<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$item_code = $_POST['item_code'];
$item_name = $_POST['item_name'];
$unit = $_POST['unit'];
$status = $_POST['status'];
$client = $_POST['client'];
$supply = $_POST['supply'];
$safe_stock = $_POST['safe_stock'];
$maker = $_POST['maker'];
$grade = $_POST['grade'];
$color = $_POST['color'];
$acc = $_POST['acc'];
$add_date = date('Y-m-d');
$edit_date = date('Y-m-d');

echo $sql = "insert into item (
							item_code,
							item_name,
							unit,
							status,
							client,
							supply,
							safe_stock,
							acc,
							add_date,
							edit_date,
							index1,
							now_q
							)
		values (
			'" . $item_code . "',
			'" . $item_name . "',
			'" . $unit . "',
			'" . $status . "',
			'" . $client . "',
			'" . $supply . "',
			'" . $safe_stock . "',
			'" . $acc . "',
			'" . $add_date . "',
			'" . $edit_date . "',
			'3',
			'0' 
				)";

$res = mysqli_query($conn, $sql);

echo $sql = "insert into item3 (
							item_code,
							maker,
							grade,
							color
							)
		values (
			'" . $item_code . "',
			'" . $maker . "',
			'" . $grade . "',
			'" . $color . "'
				)";

$res = mysqli_query($conn, $sql);

//////////////////////////////////////////////////////미리보기

echo $item_code;
echo $item_name;
echo $unit;
echo $status;
echo $client;
echo $supply;
echo $safe_stock;
echo $maker;
echo $grade;
echo $color;
echo $acc;
echo $add_date;
echo $edit_date;
echo $index1;
echo $now_q; //재고 0으로 추가

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "item3_insert.php";
$acc = "원재료정보 INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.document.location.href = "../item3.php" //부모의 부모창 다시 열기
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>