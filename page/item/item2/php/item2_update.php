<meta charset="UTF-8">

<?php session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");

$id = $_POST['id'];
$item_code = $_POST['item_code'];
$item_name = $_POST['item_name'];
$unit = $_POST['unit'];
$status = $_POST['status'];
$client = $_POST['client'];
$supply = $_POST['supply'];
$safe_stock = $_POST['safe_stock'];
$auto = $_POST['auto'];
$method = $_POST['method'];
$ct = $_POST['ct'];
$acc = $_POST['acc'];
$photo = $_POST['photo'];
$paper = $_POST['paper'];
$edit_date = date('Y-m-d');

//아이템코드가 변경될 경우
//아이템코드가 변경되기 전에 아이템코드가 같은 항목을 찾음
//item2의 세부 항목을 바꾸고 본 아이템의 항목도 변경함
echo $sql = "select * from item where id='" . $id . "'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

echo $sql01 = "update item2 set
item_code = '" . $item_code . "',
auto = '" . $auto . "',
method = '" . $method . "',
ct = '" . $ct . "',
photo = '" . $photo . "',
paper = '" . $paper . "'
							
where item_code = '" . $row['item_code'] . "'";
$res01 = mysqli_query($conn, $sql01);

echo $sql02 = "update item set
item_code = '" . $item_code . "',
item_name = '" . $item_name . "',
unit = '" . $unit . "',
status = '" . $status . "',
client = '" . $client . "',
supply = '" . $supply . "',
safe_stock = '" . $safe_stock . "',
acc = '" . $acc . "',
edit_date = '" . $edit_date . "'
							
where id = " . $id;
$res02 = mysqli_query($conn, $sql02);


////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "item2_update.php";
$acc = "부자재정보 UPDATE";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료
?>

<script type="text/javascript">
	opener.opener.parent.location.reload(); //부모의 부모창 새로고침
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>