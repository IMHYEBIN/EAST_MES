<meta charset="UTF-8">

<?php session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");

$id = $_POST['id'];
$machine_code = $_POST['machine_code'];
$machine_name = $_POST['machine_name'];
$ton = $_POST['ton'];
$acc = $_POST['acc'];
$edit_date = date('Y-m-d');


$sql= "update machine set
machine_code = '". $machine_code ."',
machine_name = '". $machine_name ."',
ton = '". $ton ."',
acc = '". $acc ."',
edit_date = '". $edit_date ."'
							
where id = ".$id;

				//values 뒤에꺼는 필드의 삽입될 값 
$res= mysqli_query($conn, $sql);

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "machine_update.php";
$acc = "설비정보 UPDATE";

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