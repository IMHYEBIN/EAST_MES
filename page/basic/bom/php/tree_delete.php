<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////// 삭제할 BOM ID를 가져옴
$id = $_POST['id'];

echo $sql = "delete FROM bom WHERE id = '" . $id . "'";

$res = mysqli_query($conn, $sql);

if ($res) {
	echo "<script>
		alert('삭제 성공했습니다.');
		</script>";
} else {
	echo "<script>
		alert('삭제 실패했습니다.');
		</script>";
};

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "tree_view.php";
$acc = "BOM 하위 항목 삭제";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	document.location.href = "../tree_view.php" //부모의 부모창 다시 열기
</script>