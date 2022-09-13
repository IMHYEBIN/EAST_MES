<meta charset="UTF-8">

<?php session_start(); ?>

<?php $conn = new mysqli("localhost", "server", "00000000", "dataset");

////////////////////////////////////////////////////// INSERT
$cop_code = $_POST['cop_code'];
$cop_name = $_POST['cop_name'];
$cop_num = $_POST['cop_num'];
$address1 = $_POST['address1']; //우편번호
$address2 = $_POST['address2']; //기본주소
$address3 = $_POST['address3']; //상세주소
$type = $_POST['type'];
$acc = $_POST['acc'];
$add_date = date('Y-m-d');
$edit_date = date('Y-m-d');

echo $sql = "insert into client (
							cop_code,
							cop_name,
							cop_num,
							address1,
							address2,
							address3,
							type,
							acc,
							add_date,
							edit_date
							)
		values (
				'" . $cop_code . "',
				'" . $cop_name . "',
				'" . $cop_num . "',
				'" . $address1 . "',
				'" . $address2 . "',
				'" . $address3 . "',
				'" . $type . "',
				'" . $acc . "',
				'" . $add_date . "',
				'" . $edit_date . "'
				)";

$res = mysqli_query($conn, $sql);

//////////////////////////////////////////////////////미리보기

echo $cop_code;
echo $cop_name;
echo $cop_num;
echo $address1;
echo $address2;
echo $address3;
echo $type;
echo $acc;
echo $add_date;
echo $edit_date;

////////////////////////////////////////////로그 남기기
$date = date('Y-m-d');
$time = date('H:i:s');
$location = "client_insert.php";
$acc = "거래처정보 INSERT";

$sql = "insert into log (date, time, location, acc) 
		 values ('" . $date . "', '" . $time . "', '" . $location . "', '" . $acc . "')";
$res = mysqli_query($conn, $sql);

mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.document.location.href = "../client.php" //부모의 부모창 다시 열기
	opener.close(); //부모창 닫기
	self.close(); //본인창 닫기
</script>