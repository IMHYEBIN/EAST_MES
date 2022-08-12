<?php session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");

$id = $_POST['id'];
$cop_code = $_POST['cop_code'];
$cop_name = $_POST['cop_name'];
$cop_num = $_POST['cop_num'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$type = $_POST['type'];
$acc = $_POST['acc'];
$edit_date = date('Y-m-d');

$sql= "update client set
cop_code = '". $cop_code ."',
cop_name = '". $cop_name ."',
cop_num = '". $cop_num ."',
address1 = '". $address1 ."',
address2 = '". $address2 ."',
address3 = '". $address3 ."',
type = '". $type ."',
acc = '". $acc ."',
edit_date = '". $edit_date ."'
							
where id = ".$id;

				//values 뒤에꺼는 필드의 삽입될 값 
$res= mysqli_query($conn, $sql);

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "client_update.php";
$acc = "거래처정보 UPDATE";

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