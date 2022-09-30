<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$date = $_POST['date'];
$item_code = $_POST['item_code'];
$type = $_POST['type'];
$unit = $_POST['unit'];
$inout_q = $_POST['inout_q'];
$inout_a = $_POST['inout_a'];
$acc = $_POST['acc'];
$add_date = date('Y-m-d');
$edit_date = date('Y-m-d');

$now_q = $_POST['now_q'];

echo $sql = "insert into in_out (
							date,
							item_code,
							type,
							unit,
							inout_q,
							inout_a,
							live,
							acc,
							add_date,
							edit_date
							)
		values (
			'" . $date . "',
			'" . $item_code . "',
			'" . $type . "',
			'" . $unit . "',
			'" . $inout_q . "',
			'" . $inout_a . "',
			'1',
			'" . $acc . "',
			'" . $add_date . "',
			'" . $edit_date . "'
				)";

$res = mysqli_query($conn, $sql);

echo $sql00 = "SELECT * FROM item WHERE item_code = '" . $item_code . "'";
$res00 = mysqli_query($conn, $sql00);
$row00 = mysqli_fetch_array($res00);

if ($type == '1') { //입고
	$now_q_edit = $row00['now_q'] + $inout_q;
} else if ($type == '2') { //출고
	$now_q_edit = $row00['now_q'] - $inout_q;
}

echo $sql01 = "update item set
now_q = '" . $now_q_edit . "'
							
where item_code = '" . $item_code . "'";
$res01 = mysqli_query($conn, $sql01);



//////////////////////////////////////////////////////미리보기

echo $date;
echo $item_code;
echo $type;
echo $unit;
echo $inout_q;
echo $inout_a;
echo $acc;
echo $add_date;
echo $edit_date;

echo $now_q;

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "inout_insert.php";
$acc = "입출고정보 INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.document.location.href = "../inout.php" //부모의 부모창 다시 열기
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>