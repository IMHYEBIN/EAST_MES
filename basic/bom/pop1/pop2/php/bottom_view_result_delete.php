<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$id = $_POST['id'];

echo $sql = "delete FROM bom WHERE id = '" . $id . "'";

$res = mysqli_query($conn, $sql);



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
	opener.document.location.href = "/basic/bom/pop1/pop2/bottom_view_result.php" //부모의 부모창 다시 열기
	self.close();
</script>