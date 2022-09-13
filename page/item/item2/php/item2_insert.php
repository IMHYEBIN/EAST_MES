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
$auto = $_POST['auto'];
$method = $_POST['method'];
$ct = $_POST['ct'];
$photo = $_POST['photo'];
$paper = $_POST['paper'];
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
							index1
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
			'2'
				)";
$res = mysqli_query($conn, $sql);

echo $sql = "insert into item2 (
							item_code,
							auto,
							method,
							ct,
							photo,
							paper
							)
		values (
			'" . $item_code . "',
			'" . $auto . "',
			'" . $method . "',
			'" . $ct . "',
			'" . $photo . "',
			'" . $paper . "'
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
echo $auto;
echo $method;
echo $ct;
echo $photo;
echo $paper;
echo $acc;
echo $add_date;
echo $edit_date;

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "item2_insert.php";
$acc = "부자재정보 INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.document.location.href = "../item2.php" //부모의 부모창 다시 열기
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>