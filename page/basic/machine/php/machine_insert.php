<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$machine_code = $_POST['machine_code'];
$machine_name = $_POST['machine_name'];
$ton = $_POST['ton'];
$location = $_POST['location'];
$acc = $_POST['acc'];
$add_date = date('Y-m-d');
$edit_date = date('Y-m-d');

echo $sql = "insert into machine (
							machine_code,
							machine_name,
							ton,
							location,
							acc,
							add_date,
							edit_date
							)
		values (
			'" . $machine_code . "',
			'" . $machine_name . "',
			'" . $ton . "',
			'" . $location . "',
			'" . $acc . "',
			'" . $add_date . "',
			'" . $edit_date . "'
				)";

$res = mysqli_query($conn, $sql);

//////////////////////////////////////////////////////미리보기

echo $machine_code;
echo $machine_name;
echo $ton;
echo $location;
echo $acc;
echo $add_date;
echo $edit_date;

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "machine_insert.php";
$acc = "설비정보 INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.document.location.href = "../machine.php" //부모의 부모창 다시 열기
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>