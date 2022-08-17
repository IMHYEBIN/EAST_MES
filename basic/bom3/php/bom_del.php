<meta charset="UTF-8">
<meta http-equiv="refresh" content="0.1; URL=../bom_new.php">

	<!-- 팝업 스크립트 적용 -->
<?php session_start();
$_01_user = $_SESSION['_02_user_id'];

/*
 # 작업자 : 김범수
 # 생성일자 : 2021-12-28
 # 코멘트 : 해당 페이지는 bom_new 에서 post로 보내준 정보를 update 및 insert하는 페이지임
*/

$_01_bomValue = $_SESSION["_01_bomValue"];

$conn = new mysqli("localhost", "server", "00000000", "dataset");

$sql00 = "DELETE from m_bom where id like '".$_01_bomValue."'";
$res00 = mysqli_query($conn, $sql00);


echo $sql00."<br>";
//log 남기기
$dateTime = date("Y:m:d H:i:s");
$acc0 = "김범수";
$description = "등록한 bom 정보 삭제하기 id=".$_01_bomValue."";
$module_id = "de_01_07_**";

  $sql= "insert into master_log (ndatetime, acc0, description, userId, module_id) 
		  values ('".$dateTime."', '".$acc0."', '".$description."', '".$_01_user."', '".$module_id."')";
  $res= mysqli_query($conn, $sql);

  $sql = "select * from master_log order by id desc";
  $res = mysqli_query($conn, $sql);

  $row = mysqli_fetch_array($res);

	echo "[id] : "				.$row[0]."<br>
			[ndatetime] : "		.$row[1]."<br>
			[acc0] : "			.$row[2]."<br>
			[description] : "	.$row[3]."<br>
			[userId] : "		.$row[4]."<br>
			[module_id] : "		.$row[5]."<br>
			[acc1] : "			.$row[6]."<br>
			[acc2] ; "			.$row[7]."<br><br>";

  // log 남기기 끝


mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.close();
	opener.close();
	
</script>