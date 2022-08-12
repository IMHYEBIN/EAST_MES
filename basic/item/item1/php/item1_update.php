<meta charset="UTF-8">

<?php session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");

$id = $_POST['id'];
$item_code = $_POST['item_code'];
$item_name = $_POST['item_name'];
$unit = $_POST['unit'];
$status = $_POST['status'];
$client_name = $_POST['client_name'];
$supply = $_POST['supply'];
$safe_stock = $_POST['safe_stock'];
$acc = $_POST['acc'];
$photo = $_POST['photo'];
$paper = $_POST['paper'];
$edit_date = date('Y-m-d');


$sql= "update item1 set
item_code = '". $item_code ."',
item_name = '". $item_name ."',
unit = '". $unit ."',
status = '". $status ."',
client_name = '". $client_name ."',
supply = '". $supply ."',
safe_stock = '". $safe_stock ."',
acc = '". $acc ."',
photo = '". $photo ."',
paper = '". $paper ."',
edit_date = '". $edit_date ."'
							
where id = ".$id;

				//values 뒤에꺼는 필드의 삽입될 값 
$res= mysqli_query($conn, $sql);

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "item1_update.php";
$acc = "아쎄이정보 UPDATE";

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