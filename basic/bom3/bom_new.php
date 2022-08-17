<?php session_start();  // 세션 선언 필수

/*
 # 작업자 : 김범수
 # 생성일자 : 2021-12-21
 # 코멘트 :
 - 제품 bom 정보 추가 페이지

 - 주요 변수선언 및 용도 (구체적으로)

 % 변수 설명 %

m_item table

1) item_code	   varchar(60)     품번 
2) item_name	   varchar(60)     품명
3) item_type	   int(11)         품목 구분(select) - 원재료, 반제품, 재공품, 부재료, 제품
4) model_type	   varchar(60)     차종or 모델 타입 (공용 : all)
5) perUnit	       varchar(60)     단위
6) itemGrade	   varchar(60)     아이템 등급(안전재고 관리)
7) cycleTime	   varchar(60)     사이클 타임(C/T)
8) m_type	       varchar(60)     생산방식(method)
9) itemSpec	       varchar(60)     품목 규격(item specification)
10) p_class 	   varchar(60)     생산 구분(생산 분류-Production classification)
11) p_process	   varchar(60)     생산공정(생산하는 라인명) line data 연계
12) u_class	       varchar(60)     용도분류(LH/RH/공용)
13) c_code  	   varchar(60)     고객 품번(내부와 다른 품번 사용시)
14) HS_code	       varchar(60)     FTA 사용 코드
15) i_location	   varchar(60)     보관위치
16) safetyStock    varchar(60)     안전재고

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
		$_01_mk_mc				= $row[29];
		$_01_acc_01             = $row[30];
		$_01_acc0_01            = $row[31];
		$_01_acc1_01            = $row[32];

		// ven 처리 재 시작



//쿼리문의 결과가 없으면 로그인 실패를 출력한다.

// ven 처리 완료


// 여기서 부터 db에 있는 정보 당겨쓰기

// item 정보 갖고 오기(자품번)
$sql00 = "select * from m_item order by id";
$res00 = mysqli_query($conn, $sql00);
// 본문에서 사용하기

// item 정보 갖고 오기(자품명)
$sql01 = "select * from m_item order by id";
$res01 = mysqli_query($conn, $sql01);
// 본문에서 사용하기

//검색조건 1 (모품번으로 찾기)
if ($_01_item_code != null) {
	$temp3 = " mo_itemCode like '" . $_01_item_code . "'";
	//검색O = 플래그1
	$flag0 = 1;
} else {
	$temp3 = "";
	//검색X = 플래그0
	$flag0 = 0;
}

//검색조건 2 (모품명으로 찾기)
if ($_01_item_name != null) {
	//앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
	if ($flag0 == 1) {
		$temp4 = " and mo_itemName like '" . $_01_item_name . "'";
	}
	//앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
	else
		$temp4 = " mo_itemName like '" . $_01_item_name . "'";
	//플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
	$flag0 = 1;
} else {
	$temp4 = "";
}

// 기 등록 된 bom 정보 갖고 오기
$sql02 = "select * from m_bom where
        " . $temp3 . "  
        " . $temp4 . " 
        order by id desc";
$res02 = mysqli_query($conn, $sql02);

#품번 당겨쓰기
$sql03 = "select * from m_item order by id";
$res03 = mysqli_query($conn, $sql03);
#품명 당겨쓰기
$sql04 = "select * from m_item order by id";
$res04 = mysqli_query($conn, $sql04);


?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bom_popTable.css" rel="stylesheet" type="text/css">
	<script src="js/bom_mod.js?ver.1"></script>
	<title>제품 BOM 등록 및 수정</title>
</head>

<body>
	<form method="POST" name="bomform_01">
	
		<!-- <form method="post" action="php/bom_update_insert.php" target="_blank"> -->
		<span class="new_title">제품 BOM 등록 및 수정</span>
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
					<input type="text" size="16" style="text-align: center;" name="_01_mk_mc" value="<?php echo $_01_mk_mc; ?>">
				</td>
			</tr>
			<tr>
				<th>비 고</th>
				<td colspan="3" width='150px;'>
					<input type="text" size="50" style="text-align:center;" name="_01_acc_01" value="<?php echo $_01_acc_01; ?>">
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<th colspan="9">신규 자 품목 입력</th>
			</tr>
			<tr>
				<th width="120px">*자품번</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_item_code_02" list="_01_item_code_02" oninvalid="this.setCustomValidity('품번을 입력하세요!')" oninput="setCustomValidity('')" required>
					<datalist id="_01_item_code_02">
						<?php //여기에서 품번을 찾아서 db에 기 입력한 자료를 반복해서 list up 하기
						for (; $row03 = mysqli_fetch_array($res03);) {
							echo "<option value = '" . $row03[1] . "'>" . $row03[1] . "</option>";
						} ?>
					</datalist>
				</td>
				<th width="120px">*자 품명</th>
				<td>
					<input type="text" size="30" style="text-align:center;" name="_01_item_name_02" list="_01_item_name_02" oninvalid="this.setCustomValidity('품명을 입력하세요!')" oninput="setCustomValidity('')" required>
					<datalist id="_01_item_name_02">
						<?php //여기에서 품명을 찾아서 db에 기 입력한 자료를 반복해서 list up 하기
						for (; $row04 = mysqli_fetch_array($res04);) {
							echo "<option value = '" . $row04[2] . "'>" . $row04[2] . "</option>";
						}
						?>
				</td>
				<th width="120px">*소요량</th>
				<td>
					<input type="text" size="16" style="text-align:center;" name="_01_useage" id="_01_useage" oninvalid="this.setCustomValidity('소요량을 입력하여주세요!')" oninput="setCustomValidity('')" required>
				</td>
				<th width="120px">비고</th>
				<td>
					<input type="text" size="34" style="text-align:center;" name="_01_acc" id="_01_acc">
				</td>
				<td>
				<input type="submit" value="등록" formaction="php/bom_update_insert.php" formtarget="_blank" style="width:100px; height:30px;">
				</td>
			</tr>
			<tr>
				</form>
				
				<th colspan="8">기존 자 품목</th>
				<th>관리</th>
			</tr>
			<?php

			for (;$row02 = mysqli_fetch_array($res02);) {
				if ($row02[0] != null) {
					$itemCode = $row02[4];
					$_01_id = $row02[0];
				} 
				else {
					$itemCode = "자품목을 추가 바랍니다!";
				}
				$itemName = $row02[5];
				$useage = $row02[6];
				$_01_acc = $row02[7];
				echo "<tr>
                    
                    <th>자품번</th>
                    <td>" . $itemCode . "</td>
                    <th width='100px'>자품명</th>
                    <td width='200px'>" . $itemName . "</td>
                    <th>소요량</th>
                    <td>" . $useage . "</td>
					<th> 비고 </th>
					<td width ='200px'>" . $_01_acc . "</td>
                    <td>
						<form method='POST' name='bomform' action = 'bom_mod.php' target = 'bom_mod'>
						<input type='hidden' name = '_01_bomValue' value = ".$_01_id.">
						<input type='submit' onclick='bom_mod()' style='width:100px; height:30px;' value='BOM 수정'></form>
					</td>
                </tr>";	
			}
			?>
		</table>
		<!-- <form method="post" action="php/bom_update_insert.php" target="_blank"> -->
		
		<input id="new_back" type="button" value="취소" onClick="self.close();" style="width:70px; height:30px;">

	</form>

</body>

</html>