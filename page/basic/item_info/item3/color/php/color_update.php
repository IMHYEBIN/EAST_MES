<meta charset="UTF-8">

<?php session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");

$id = $_POST['id'];
$color = $_POST['color'];
$edit_date = date('Y-m-d');

echo $sql = "update item3_color set
color = '" . $color . "',
edit_date = '" . $edit_date . "'
							
where id = '" . $id . "'";
$res = mysqli_query($conn, $sql);

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "color_update.php";
$acc = "원재료 COLOR UPDATE";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.parent.location.reload(); //부모의 부모창 새로고침
 	opener.close();					//부모창 닫기
 	self.close();						//본인창 닫기
	</script>