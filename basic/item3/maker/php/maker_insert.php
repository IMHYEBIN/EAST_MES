<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$maker = $_POST['maker'];
$add_date = date('Y-m-d');
$edit_date = date('Y-m-d');

echo $sql = "insert into item3_maker (
							maker,
							add_date,
							edit_date
							)
		values (
			'" . $maker . "',
			'" . $add_date . "',
			'" . $edit_date . "'
				)";

$res = mysqli_query($conn, $sql);

//////////////////////////////////////////////////////미리보기

echo $maker;
echo $add_date;
echo $edit_date;

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "maker.php";
$acc = "원재료 MAKER INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.document.location.href = "../maker.php" //부모의 부모창 다시 열기
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>