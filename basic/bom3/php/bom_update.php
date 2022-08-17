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

// post 값 session 선언 및 함수 선언&사용
$_SESSION["_01_item_code"] = $_POST["_01_item_code"];
$_SESSION["_01_item_name"] = $_POST["_01_item_name"];

$_01_itemCode = $_SESSION["_01_item_code"];
$_01_itemName = $_SESSION["_01_item_name"];
$_01_bomId = $_SESSION["_01_bomValue"];
$conn = new mysqli("localhost", "server", "00000000", "dataset");

// 아이템 정보 일부 수정하기
$sql = "update m_item set cycleTime = 	'".$_POST["_01_cycleTime_01"]."', 
					m_type = 			'".$_POST["m_type"]."', 
					cvt = 				'".$_POST["_01_cvt"]."', 
					electricityUsed = 	'".$_POST["_01_electricityUsed_01"]."', 
					weight = 			'".$_POST["_01_weight_01"]."', 
					spool_weight = 		'".$_POST["_01_spool_weight_01"]."', 
					workPrice = 		'".$_POST["_01_workPrice_01"]."', 
					mk_mc = 			'".$_POST["_01_mk_mc"]."',
					acc = 				'".$_POST["_01_acc_01"]."' 
				where item_code = '".$_01_itemCode."'
		";
		
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);




/* 자품목 수정 하기 */

$sql02 = "UPDATE m_bom set mo_itemcode = '".$_POST["_01_item_code"]."',
							mo_itemName = '".$_POST["_01_item_name"]."',
							so_itemCode = '".$_POST["_01_item_code_02"]."',
							so_itemName = '".$_POST["_01_item_name_02"]."',
							useage = '".$_POST["_01_useage"]."',
							acc = '".$_POST["_01_acc"]."'
			where id = ".$_01_bomId."
		";				
$res02 = mysqli_query($conn, $sql02);

//등록한 자품목 확인하기
$sql03 = "select * from m_bom where mo_itemCode like '".$_01_itemCode."' order by id desc";
$res03 = mysqli_query($conn, $sql03);
$row03 = mysqli_fetch_array($res03);

	echo "[id] :"				. $row03[0]."<br>";
	echo "[mo_itemCode] :"		. $row03[1]."<br>";
	echo "[mo_itemName] :"		. $row03[2]."<br>";
	echo "[inTurn] :"			. $row03[3]."<br>";
	echo "[so_itemCode] :"		. $row03[4]."<br>";
	echo "[so_itemName] :"		. $row03[5]."<br>";
	echo "[useage] :"			. $row03[6]."<br>";
	echo "[acc] :"				. $row03[7]."<br>";
	echo "[acc0] :"				. $row03[8]."<br>";
	echo "[acc1] :"				. $row03[9]."<br><br>";

echo "현재 날짜:update".date("Y-m-d")."<br>";

echo "데이터 확인: ".$sql."<br>";
echo "데이터 확인: ".$sql02."<br>";


//log 남기기
$dateTime = date("Y:m:d H:i:s");
$acc0 = "김범수";
$description = "품목 정보 업데이트 하기 & bom 정보 인서트 하기 ";
$module_id = "upin_01_07_**";

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

	echo "[현재 시간 날짜] : "	.$dateTime."<br>
			[acc0] : "			.$acc0."<br>
			[description] : "	.$description."<br>
			[_01_user] : "		.$_01_user."<br>
			[module_id] : "		.$module_id."<br>
	  <br>";
  // log 남기기 끝


mysqli_close($conn); // 종료

?>

<script type="text/javascript">
	opener.opener.close();
	opener.close();
	
</script>