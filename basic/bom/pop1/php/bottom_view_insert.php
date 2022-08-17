<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$child = $_POST['child'];
$add_date = date('Y-m-d');

echo $sql = "insert into bom (
							parent,
							child,
							add_date
							)
		values (
			'" . $_SESSION['item_code'] . "',
			'" . $child . "',
			'" . $add_date . "'
				)";

$res = mysqli_query($conn, $sql);

//////////////////////////////////////////////////////미리보기

echo $parent;
echo $child;
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
	opener.opener.document.location.href = "/basic/bom/pop1/bottom_view.php" //부모의 부모창 다시 열기
	// opener.close(); 
    self.close();
</script>