<?php session_start();  // 세션 선언 필수

/*
 # 작업자 : 김범수
 # 생성일자 : 2021-12-21
 # 코멘트 :
 - 제품 bom 정보 추가 페이지

 - 주요 변수선언 및 용도 (구체적으로)

 % 변수 설명 %

m_item table

1) item_code_01      
2) item_name_01      
3) item_type_01      
4) model_type_01     
5) perUnit_01        
6) itemGrade_01      
7) cycleTime_01      
8) m_type_01         
9) itemSpec_01       
10) p_class_01        
11) p_process_01      
12) u_class_01        
13) c_code_01         
14) HS_code_01        
15) i_location_01     
16) safetyStock_01    
17) cvt_01            
18) weight_01         
19) line_container_01 
20) line_quantity_01  
21) sell_container_01 
22) sell_quantity_01  
23) spool_weight_01   
24) workPrice_01      
25) electricityUsed_01
26) mk_mc				
27) acc_01            
28) acc0_01           
29) acc1_01           

m_bom table

1)	mo_itemCode	varchar(60)	YES		모품번
2)	mo_itemName	varchar(60)	YES		모품명
3)	inTurn		int(5)	YES			순번(미사용)
4)	so_itemCode	varchar(60)	YES		자품번
5)	so_itemName	varchar(60)	YES		자품명
6)	useage		varchar(60)	YES		소요량
7)	acc			varchar(60)	YES		기타

% 변수 설명 끝 %
*/


//mysql root계정으로 접속
$conn = mysqli_connect('localhost', 'server', '00000000', 'dataset');

//sql문을 sql변수에 저장함
$sql = "SELECT accessLicense_1 FROM c_user where user_id = '$_02_accessLicense_session'";


		// ven 처리 일시 정지
		$conn = new mysqli("localhost", "server", "00000000", "dataset");

		# 세션 사용 및 변수 선언
		$_01_item_code = $_SESSION["_01_item_code"];
		$_01_item_name = $_SESSION["_01_item_name"];


		//3개 조건 중 하나라도 입력이 되었으면 WHERE 추가
		if ($_01_item_code != null || $_01_item_name != null) {
			$temp0 = "where";
		} else {
			$temp0 = "";
		}

		//검색조건 1
		if ($_01_item_code != null) {
			$temp1 = " item_code like '" . $_01_item_code . "'";
			//검색O = 플래그1
			$flag1 = 1;
		} else {
			$temp1 = "";
			//검색X = 플래그0
			$flag1 = 0;
		}

		//검색조건 2
		if ($_01_item_name != null) {
			//앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
			if ($flag1 == 1) {
				$temp2 = " and item_name like '" . $_01_item_name . "'";
			}
			//앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
			else
				$temp2 = " item_name like '" . $_01_item_name . "'";
			//플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
			$flag1 = 1;
		} else {
			$temp2 = "";
		}




//SQL 결과값
$sql = "select * from m_item
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " 
 order by id desc";

	$res = mysqli_query($conn, $sql);

	$row = mysqli_fetch_array($res);

	$_01_item_code_01       = $row[1];
	$_01_item_name_01       = $row[2];
	$_01_item_type_01       = $row[3];
	$_01_model_type_01      = $row[4];
	$_01_perUnit_01         = $row[5];
	$_01_itemGrade_01       = $row[6];
	$_01_cycleTime_01       = $row[7];
	$_01_m_type_01          = $row[8];
	$_01_itemSpec_01        = $row[9];
	$_01_p_class_01         = $row[10];
	$_01_p_process_01       = $row[11];
	$_01_u_class_01         = $row[12];
	$_01_c_code_01          = $row[13];
	$_01_HS_code_01         = $row[14];
	$_01_i_location_01      = $row[15];
	$_01_safetyStock_01     = $row[16];

	$_01_cvt_01             = $row[20];
	$_01_weight_01          = $row[21];
	$_01_line_container_01  = $row[22];
	$_01_line_quantity_01   = $row[23];
	$_01_sell_container_01  = $row[24];
	$_01_sell_quantity_01   = $row[25];
	$_01_spool_weight_01    = $row[26];
	$_01_workPrice_01       = $row[27];
	$_01_electricityUsed_01 = $row[28];
	$_01_mk_mc_01			= $row[29];
	$_01_acc_01             = $row[30];
	$_01_acc0_01            = $row[31];
	$_01_acc1_01            = $row[32];

	// ven 처리 재 시작



//쿼리문의 결과가 없으면 로그인 실패를 출력한다.

// ven 처리 완료

// 수정 또는 삭제를 위한 session값을 남김
$_SESSION["_01_bomValue"] = $_POST["_01_bomValue"];

// 값 확인차 세션을 사용
$_01_bomValue = $_SESSION["_01_bomValue"];

//SQL 결과값

$sql01 = "select * from m_bom where id like ".$_01_bomValue." order by id desc";
$result01 = mysqli_query($conn, $sql01);
$row01 = mysqli_fetch_array($result01);

$_01_id			=$row01[0];
$_01_mo_itemCode=$row01[1];
$_01_mo_itemName=$row01[2];
$_01_inTurn		=$row01[3];
$_01_so_itemCode=$row01[4];
$_01_so_itemName=$row01[5];
$_01_useage		=$row01[6];
$_01_acc 		=$row01[7];
$_01_acc0		=$row01[8];
$_01_acc1		=$row01[9];

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- 특징이 없어서 공통의 css사용 -->
	<link href="css/bom_popTable.css" rel="stylesheet" type="text/css">

	<!-- 상세창을 띄우기 위한 자바스크립트 -->
	<script src="js/bom_mod.js?ver.0"></script>
	<title>BOM 수정</title>
</head>

<body>
	<!-- 팝업창을 띄우기 위해서 formname을 통일 시킴 -->
	<form method="POST" name="bomform">
		<span class="new_title">제품 BOM 수정</span>
		<table id="new_table">
			<tr>
				<th colspan="4">모 품목 정보</th>
			</tr>
			<tr>
				<th width="100px">* 품번</th>
				<td width="150px">
					<input type="text" size="16" style="text-align:center;" value="<?php echo $_01_item_code_01; ?>" disabled>
					<input type="hidden" style="text-align:center;" name="_01_item_code" value="<?php echo $_01_item_code_01; ?>" id="_01_item_code">
				</td>

				<th width="100px">* 품명</th>
				<td width="150px">
					<input type="text" size="16" style="text-align:center;" value="<?php echo $_01_item_name_01; ?>" disabled>
					<input type="hidden" style="text-align:center;" name="_01_item_name" value="<?php echo $_01_item_name_01; ?>" id="_01_item_name">
				</td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th colspan="4">모품목 관리 입력 정보</th>
			</tr>
			<tr>
				<th>사이클타임</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_cycleTime_01" value="<?php echo $_01_cycleTime_01; ?>" id="_01_cycleTime_01">
				</td>
				<th>생산방식</th>
				<td>
					<select name="m_type">
						<option value="1" <?php if ($_02_m_type == "1") {echo "selected";} else {echo "";} ?>>사내생산(자동)</option>
						<option value="2" <?php if ($_02_m_type == "2") {echo "selected";} else {echo "";} ?>>사내생산(수동)</option>
						<option value="3" <?php if ($_02_m_type == "3") {echo "selected";} else {echo "";} ?>>생산/외주</option>
						<option value="4" <?php if ($_02_m_type == "4") {echo "selected";} else {echo "";} ?>>구매/매입</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>캐비티 수량</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_cvt" value="<?php echo $_01_cvt_01; ?>">
				</td>
				<th>전력량</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_electricityUsed_01" value="<?php echo $_01_electricityUsed_01; ?>">
				</td>
			</tr>
			<tr>
				<th>중량</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_weight_01" value="<?php echo $_01_weight_01; ?>">
				</td>
				<th>스풀 중량</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_spool_weight_01" value="<?php echo $_01_spool_weight_01; ?>">
				</td>
			</tr>
			<tr>
				<th>임률</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_workPrice_01" value="<?php echo $_01_workPrice_01; ?>">
				</td>
				<th>주 생산 기기 / 구매 외주처</th>
				<td>
					<input type="text" size="16" style="text-align: center;" name="_01_mk_mc" value="<?php echo $_01_mk_mc_01; ?>">
				</td>
			</tr>
			<tr>
				<th>비 고</th>
				<td colspan="3" width='150px;'>
					<input type="text" size="52" style="text-align:center;" name="_01_acc_01" value="<?php echo $_01_acc_01; ?>">
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<th colspan="9">자품목 수정</th>
			</tr>
			<tr>
				<th width="120px">*자품번</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_item_code_02" list="_01_item_code_02" value="<?php echo $_01_so_itemCode; ?>">
					
				</td>
				<th width="120px">*자 품명</th>
				<td>
					<input type="text" size="30" style="text-align:center;" name="_01_item_name_02" list="_01_item_name_02" value="<?php echo $_01_so_itemName; ?>">
				</td>
				<th width="120px">*소요량</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_useage" id="_01_useage" value="<?php echo $_01_useage; ?>">
				</td>
				<th width="120px">비고</th>
				<td>
					<input type="text" size="34" style="text-align:center;" name="_01_acc" id="_01_acc" value="<?php echo $_01_acc; ?>">
				</td>
				<td>
					<button type="submit" formaction="php/bom_del.php" formtarget="_blank" style="width:70px; height:30px;">
					삭제하기
					</button>
				</td>
			</tr>
		</table>
		<!-- <form method="post" action="php/bom_update_insert.php" target="_blank"> -->
		<input type="submit" value="수정" formaction="php/bom_update.php" formtarget="_blank" style="width:70px; height:30px;">
		<input id="new_back" type="button" value="취소" onClick="self.close();" style="width:70px; height:30px;">
		
		<!-- <br><?php echo $sql01; ?> -->
	</form>

</body>

</html>