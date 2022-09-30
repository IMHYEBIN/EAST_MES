<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$add__item_code = $_POST['add__item_code'];
$add_date = date('Y-m-d');

///////////////////////ROOT와 같은 제품이 아닐때만 실행
if ($_SESSION["show__item_code"] != $add__item_code) {

	$sql = "SELECT * FROM bom WHERE parent = '" . $_SESSION["show__item_code"] . "' and child = '" . $add__item_code . "'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($res);

	/////////////////////이미 등록되어 있는 제품이면 실행하지 않음
	if ($row['id'] == null) {
		$sql00 = "insert into bom (
				parent,
				child,
				add_date
				)
				values (
				'" . $_SESSION["show__item_code"] . "',
				'" . $add__item_code . "',
				'" . $add_date . "'
				)";

		$res00 = mysqli_query($conn, $sql00);

		if ($res00) {
			echo "<script>alert('추가 성공했습니다.');</script>";
		} else {
			echo "<script>alert('추가 실패했습니다.');</script>";
		};
	} else {
		echo "<script>alert('이미 등록된 제품입니다.');</script>";
	}
} else {
	echo "<script>alert('최상위 제품과 동일한 항목은 추가하실 수 없습니다.');</script>";
}



//////////////////////////////////////////////////////미리보기

echo $_SESSION["show__item_code"];
echo $add__item_code;
echo $add_date;

////////////////////////////////////////////로그 남기기
// $date = date('Y-m-d');
// $time = date('H:i:s');
// $location = "machine_insert.php";
// $acc = "설비정보 INSERT";

// $sql = "insert into log (date, time, location, acc) 
// 		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
// $res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	document.location.href = "../tree_view.php" //부모의 부모창 다시 열기
	// // opener.close(); 
	// self.close();
</script>