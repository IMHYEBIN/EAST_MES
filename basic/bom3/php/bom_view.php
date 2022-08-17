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


		// ven 처리 일시 정지
		$conn = new mysqli("localhost", "server", "00000000", "dataset");

		# 세션 사용 및 변수 선언
		$_SESSION["_01_item_code"] = $_POST["_01_item_code"];
		$_SESSION["_01_item_name"] = $_POST["_01_item_name"];

		$_01_item_code = $_SESSION["_01_item_code"];
		$_01_item_name = $_SESSION["_01_item_name"];

		//2개 조건 중 하나라도 입력이 되었으면 WHERE 추가
		if ($_01_item_code != null || $_01_item_name != null) {
			$temp0 = "where";
		} else {
			$temp0 = "";
		}

		//검색조건 1
		if ($_01_item_code != null) {
			$temp1 = " mo_itemCode like '" . $_01_item_code . "'";
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
				$temp2 = " and mo_itemName like '" . $_01_item_name . "'";
			}
			//앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
			else
				$temp2 = " mo_itemName like '" . $_01_item_name . "'";
			//플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
			$flag1 = 1;
		} else {
			$temp2 = "";
		}


//SQL 결과값
$sql = "select * from m_bom
" . $temp0 . "  
" . $temp1 . "  
" . $temp2 . " 
 order by id desc";

		$res = mysqli_query($conn, $sql);

		$row = mysqli_fetch_array($res);

		$_01_id 			= $row[0];
		$_01_mo_itemCode	= $row[1];
		$_01_mo_itemName	= $row[2];
		$_01_inTurn			= $row[3];
		$_01_so_itemCode 	= $row[4];
		$_01_so_itemName 	= $row[5];
		$_01_useage		 	= $row[6];
		$_01_acc			= $row[7];
		$_01_acc0			= $row[8];
		$_01_acc0			= $row[9];


// ven 처리 완료


// 여기서 부터 db에 있는 정보 당겨쓰기

// 첫 아이템 item정보에 있는 data 불러 오기
//검색조건 1 (모품번으로 찾기)
if ($_01_item_code != null) {
	$temp01 = " item_code like '" . $_01_item_code . "'";
	//검색O = 플래그1
	$flag0 = 1;
} else {
	$temp01 = "";
	//검색X = 플래그0
	$flag0 = 0;
}

//검색조건 2 (모품명으로 찾기)
if ($_01_item_name != null) {
	//앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
	if ($flag0 == 1) {
		$temp02 = " and item_Name like '" . $_01_item_name . "'";
	}
	//앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
	else
		$temp02 = " item_Name like '" . $_01_item_name . "'";
	//플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
	$flag0 = 1;
} else {
	$temp02 = "";
}
$sqlq = "SELECT * from m_item where ".$temp01." ".$temp02." order by id desc";
$resq = mysqli_query($conn, $sqlq);
$rowq = mysqli_fetch_array($resq);



// 모품목 검사시 자품목 유무 검사
$sql00 = "select * from m_bom where ".$temp1." ".$temp2." order by id desc";
$res00 = mysqli_query($conn, $sql00);
$row00 = mysqli_fetch_array($res00);
if ($row00[4] != null) {$tem0 = ", children:data";}
else {$tem0 = "";}
$tem00 = $row00[4];


if($rowq[8] == 1){$_01_m_type0 = "사내생산(자동)";}
elseif ($rowq[8] == 2) {$_01_m_type0 = "사내생산(수동)";}
elseif ($rowq[8] == 3) {$_01_m_type0 = "생산/외주";}
elseif ($rowq[8] == 4) {$_01_m_type0 = "구매/매입";}
else {$_01_m_type0 = "미입력";}

?>

<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>

    </title>
    <script src="../js/tree.min.js"></script>
</head>

<body>
    <div class="container">
    </div>
</body>
<script>
    // prettier-ignore  //

    let data = [
				// 자품목 하위 BOM구성
				<?php 
				// 1단 콤보 시작
				$sql01 = "select * from m_bom where ".$temp1." ".$temp2." order by id desc";
				$res01 = mysqli_query($conn, $sql01);
				for($count01 = 0;$row01 = mysqli_fetch_array($res01);$count01++){
					$tempValue01 = $row01[4];
					// 하위 bom이 있을 시 children을 찍어야만 계단형으로 표현이 됨
					$flagValueStart = ", 'children':[";
					$flagValueEnd = "";

					// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
					$sql001 = "SELECT * from m_item where item_code like '".$tempValue01."' order by id desc";
					$res001 = mysqli_query($conn, $sql001);
					$row001 = mysqli_fetch_array($res001);
					if($row001[8] == 1){$_01_m_type1 = "사내생산(자동)";}
					elseif ($row001[8] == 2) {$_01_m_type1 = "사내생산(수동)";}
					elseif ($row001[8] == 3) {$_01_m_type1 = "생산/외주";}
					elseif ($row001[8] == 4) {$_01_m_type1 = "구매/매입";}
					else {$_01_m_type1 = "미입력";}
				// $count##은 계단식 bom의 체크박스(v또는 - 표시를 위한) 기능 표현임
				echo "{'id':'".$count01."',
					'text':'".$row01[4]." ".$row01[5]." [소요량 : ".$row01[6]."] [사이클 타임 : ".$row001[7]."] [캐비티 수량 : ".$row001[20]."] [전력량 : ".$row001[28]
					."] [중량 : ".$row001[21]."] [스풀 중량 : ".$row001[26]."] [임률 : ".$row001[27]."] [생산 방식 : ".$_01_m_type1."] [주 생산 기기 / 외주처 : ".$row001[29]
					."] [기타 특이사항 : ".$row001[30]."] '";

					//2단 콤보 시작 유무
					if ($tempValue01 != null){echo $flagValueStart;
					$sql02 = "SELECT * from m_bom where mo_itemCode like '".$tempValue01."' order by id desc";
					$res02 = mysqli_query($conn, $sql02);

					// 본격적인 2단 콤보
					for($count02 = 0;$row02 = mysqli_fetch_array($res02);$count02++){
						$tempValue02 = $row02[4];

						// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
						$sql002 = "SELECT * from m_item where item_code like '".$tempValue02."' order by id desc";
						$res002 = mysqli_query($conn, $sql002);
						$row002 = mysqli_fetch_array($res002);
						if($row002[8] == 1){$_01_m_type2 = "사내생산(자동)";}
						elseif ($row002[8] == 2) {$_01_m_type2 = "사내생산(수동)";}
						elseif ($row002[8] == 3) {$_01_m_type2 = "생산/외주";}
						elseif ($row002[8] == 4) {$_01_m_type2 = "구매/매입";}
						else {$_01_m_type2 = "미입력";}
							
					echo "{'id':'".$count01."-".$count02."',
						'text':'".$row02[4]." ".$row02[5]." [소요량 : ".$row02[6]."] [사이클 타임 : ".$row002[7]."] [캐비티 수량 : ".$row002[20]."] [전력량 : ".$row002[28]
						."] [중량 : ".$row002[21]."] [스풀 중량 : ".$row002[26]."] [임률 : ".$row002[27]."] [생산 방식 : ".$_01_m_type2."] [주 생산 기기 / 외주처 : ".$row002[29]
						."] [기타 특이사항 : ".$row002[30]."]'";

						//3단 콤보 시작 유무
						if($tempValue02 != null){echo $flagValueStart;
						$sql03 = "SELECT * from m_bom where mo_itemCode like '".$tempValue02."' order by id desc";
						$res03 = mysqli_query($conn, $sql03);

						// 본격적인 3단 콤보
						for($count03 = 0; $row03 = mysqli_fetch_array($res03); $count03++){
							$tempValue03 = $row03[4];

							// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
							$sql003 = "SELECT * from m_item where item_code like '".$tempValue03."' order by id desc";
							$res003 = mysqli_query($conn, $sql003);
							$row003 = mysqli_fetch_array($res003);
							if($row003[8] == 1){$_01_m_type3 = "사내생산(자동)";}
							elseif ($row003[8] == 2) {$_01_m_type3 = "사내생산(수동)";}
							elseif ($row003[8] == 3) {$_01_m_type3 = "생산/외주";}
							elseif ($row003[8] == 4) {$_01_m_type3 = "구매/매입";}
							else {$_01_m_type3 = "미입력";}

						echo "{'id':'".$count01."-".$count02."-".$count03."',
							'text':'".$row03[4]." ".$row03[5]." [소요량 : ".$row03[6]."] [사이클 타임 : ".$row003[7]."] [캐비티 수량 : ".$row003[20]."] [전력량 : ".$row003[28]
							."] [중량 : ".$row003[21]."] [스풀 중량 : ".$row003[26]."] [임률 : ".$row003[27]."] [생산 방식 : ".$_01_m_type3."] [주 생산 기기 / 외주처 : ".$row003[29]
							."] [기타 특이사항 : ".$row003[30]."]'";

							//4단 콤보 시작 유무
							if($tempValue03 != null){echo $flagValueStart;
							$sql04 = "SELECT * from m_bom where mo_itemCode like '".$tempValue03."' order by id desc";
							$res04 = mysqli_query($conn, $sql04);

							// 본격적인 4단 콤보
							for($count04 = 0; $row04 = mysqli_fetch_array($res04); $count04++){
								$tempValue04 = $row04[4];

								// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
								$sql004 = "SELECT * from m_item where item_code like '".$tempValue04."' order by id desc";
								$res004 = mysqli_query($conn, $sql004);
								$row004 = mysqli_fetch_array($res004);
								if($row004[8] == 1){$_01_m_type4 = "사내생산(자동)";}
								elseif ($row004[8] == 2) {$_01_m_type4 = "사내생산(수동)";}
								elseif ($row004[8] == 3) {$_01_m_type4 = "생산/외주";}
								elseif ($row004[8] == 4) {$_01_m_type4 = "구매/매입";}
								else {$_01_m_type4 = "미입력";}

							echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."',
								'text':'".$row04[4]." ".$row04[5]." [소요량 : ".$row04[6]."] [사이클 타임 : ".$row004[7]."] [캐비티 수량 : ".$row004[20]."] [전력량 : ".$row004[28]
								."] [중량 : ".$row004[21]."] [스풀 중량 : ".$row004[26]."] [임률 : ".$row004[27]."] [생산 방식 : ".$_01_m_type4."] [주 생산 기기 / 외주처 : ".$row004[29]
								."] [기타 특이사항 : ".$row004[30]."]'";
												
								// 5단 콤보 시작 유무
								if($tempValue04 != null){echo $flagValueStart;
								$sql05 = "SELECT * from m_bom where mo_itemCode like '".$tempValue04."' order by id desc";
								$res05 = mysqli_query($conn, $sql05);

								// 본격적인 5단 콤보
								for($count05 = 0; $row05 = mysqli_fetch_array($res05); $count05++){
									$tempValue05 = $row05[4];

									// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
									$sql005 = "SELECT * from m_item where item_code like '".$tempValue05."' order by id desc";
									$res005 = mysqli_query($conn, $sql005);
									$row005 = mysqli_fetch_array($res005);
									if($row005[8] == 1){$_01_m_type5 = "사내생산(자동)";}
									elseif ($row005[8] == 2) {$_01_m_type5 = "사내생산(수동)";}
									elseif ($row005[8] == 3) {$_01_m_type5 = "생산/외주";}
									elseif ($row005[8] == 4) {$_01_m_type5 = "구매/매입";}
									else {$_01_m_type5 = "미입력";}
									
								echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."',
									'text':'".$row05[4]." ".$row05[5]." [소요량 : ".$row05[6]."] [사이클 타임 : ".$row005[7]."] [캐비티 수량 : ".$row005[20]."] [전력량 : ".$row005[28]
									."] [중량 : ".$row005[21]."] [스풀 중량 : ".$row005[26]."] [임률 : ".$row005[27]."] [생산 방식 : ".$_01_m_type5."] [주 생산 기기 / 외주처 : ".$row005[29]
									."] [기타 특이사항 : ".$row005[30]."]'";

									// 6단 콤보 시작 유무
									if($tempValue05 != null){echo $flagValueStart;
									$sql06 = "SELECT * from m_bom where mo_itemCode like '".$tempValue05."' order by id desc";
									$res06 = mysqli_query($conn, $sql06);

									// 본격적인 6단 콤보
									for($count06 = 0; $row06 = mysqli_fetch_array($res06); $count06++){
										$tempValue06 = $row06[4];

										// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
										$sql006 = "SELECT * from m_item where item_code like '".$tempValue06."' order by id desc";
										$res006 = mysqli_query($conn, $sql006);
										$row006 = mysqli_fetch_array($res006);
										if($row006[8] == 1){$_01_m_type6 = "사내생산(자동)";}
										elseif ($row006[8] == 2) {$_01_m_type6 = "사내생산(수동)";}
										elseif ($row006[8] == 3) {$_01_m_type6 = "생산/외주";}
										elseif ($row006[8] == 4) {$_01_m_type6 = "구매/매입";}
										else {$_01_m_type6 = "미입력";}

									echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."',
										'text':'".$row06[4]." ".$row06[5]." [소요량 : ".$row06[6]."] [사이클 타임 : ".$row006[7]."] [캐비티 수량 : ".$row006[20]."] [전력량 : ".$row006[28]
										."] [중량 : ".$row006[21]."] [스풀 중량 : ".$row006[26]."] [임률 : ".$row006[27]."] [생산 방식 : ".$_01_m_type6."] [주 생산 기기 / 외주처 : ".$row006[29]
										."] [기타 특이사항 : ".$row006[30]."]'";

										// 7단 콤보 시작 유무
										if($tempValue06 != null){echo $flagValueStart;
										$sql07 = "SELECT * from m_bom where mo_itemCode like '".$tempValue06."' order by id desc";
										$res07 = mysqli_query($conn, $sql07);

										// 본격적인 7단 콤보
										for($count07 = 0; $row07 = mysqli_fetch_array($res07); $count07++){
											$tempValue07 = $row07[4];

											// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
											$sql007 = "SELECT * from m_item where item_code like '".$tempValue07."' order by id desc";
											$res007 = mysqli_query($conn, $sql007);
											$row007 = mysqli_fetch_array($res007);
											if($row007[8] == 1){$_01_m_type7 = "사내생산(자동)";}
											elseif ($row007[8] == 2) {$_01_m_type7 = "사내생산(수동)";}
											elseif ($row007[8] == 3) {$_01_m_type7 = "생산/외주";}
											elseif ($row007[8] == 4) {$_01_m_type7 = "구매/매입";}
											else {$_01_m_type7 = "미입력";}

										echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."-".$count07."',
											'text':'".$row07[4]." ".$row07[5]." [소요량 : ".$row07[6]."] [사이클 타임 : ".$row007[7]."] [캐비티 수량 : ".$row007[20]."] [전력량 : ".$row007[28]
										."] [중량 : ".$row007[21]."] [스풀 중량 : ".$row007[26]."] [임률 : ".$row007[27]."] [생산 방식 : ".$_01_m_type7."] [주 생산 기기 / 외주처 : ".$row007[29]
										."] [기타 특이사항 : ".$row007[30]."]'";

											// 8단 콤보 시작 유무
											if($tempValue07 != null){echo $flagValueStart;
											$sql08 = "SELECT * from m_bom where mo_itemCode like '".$tempValue07."' order by id desc";
											$res08 = mysqli_query($conn, $sql08);

											// 본격적인 8단 콤보
											for($count08 = 0; $row08 = mysqli_fetch_array($res08); $count08++){
												$tempValue08 = $row08[4];

												// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
												$sql008 = "SELECT * from m_item where item_code like '".$tempValue08."' order by id desc";
												$res008 = mysqli_query($conn, $sql008);
												$row008 = mysqli_fetch_array($res008);
												if($row008[8] == 1){$_01_m_type8 = "사내생산(자동)";}
												elseif ($row008[8] == 2) {$_01_m_type8 = "사내생산(수동)";}
												elseif ($row008[8] == 3) {$_01_m_type8 = "생산/외주";}
												elseif ($row008[8] == 4) {$_01_m_type8 = "구매/매입";}
												else {$_01_m_type8 = "미입력";}

											echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."-".$count07."-".$count08."',
												'text':'".$row08[4]." ".$row08[5]." [소요량 : ".$row08[6]."] [사이클 타임 : ".$row008[7]."] [캐비티 수량 : ".$row008[20]."] [전력량 : ".$row008[28]
												."] [중량 : ".$row008[21]."] [스풀 중량 : ".$row008[26]."] [임률 : ".$row008[27]."] [생산 방식 : ".$_01_m_type8."] [주 생산 기기 / 외주처 : ".$row008[29]
												."] [기타 특이사항 : ".$row008[30]."]'";
																	
												// 9단 콤보 시작 유무
												if($tempValue08 != null){echo $flagValueStart;
												$sql09 = "SELECT * from m_bom where mo_itemCode like '".$tempValue08."' order by id desc";
												$res09 = mysqli_query($conn, $sql09);

												// 본격적인 9단 콤보
												for ($count09 = 0; $row09 = mysqli_fetch_array($res09);$count09++){
												$tempValue09 = $row09[4];

												// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
												$sql009 = "SELECT * from m_item where item_code like '".$tempValue09."' order by id desc";
												$res009 = mysqli_query($conn, $sql009);
												$row009 = mysqli_fetch_array($res009);
												if($row009[8] == 1){$_01_m_type9 = "사내생산(자동)";}
												elseif ($row009[8] == 2) {$_01_m_type9 = "사내생산(수동)";}
												elseif ($row009[8] == 3) {$_01_m_type9 = "생산/외주";}
												elseif ($row009[8] == 4) {$_01_m_type9 = "구매/매입";}
												else {$_01_m_type9 = "미입력";}

												echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."-".$count07."-".$count08."-".$count09."',
													'text':'".$row09[4]." ".$row09[5]." [소요량 : ".$row09[6]."] [사이클 타임 : ".$row009[7]."] [캐비티 수량 : ".$row009[20]."] [전력량 : ".$row009[28]
													."] [중량 : ".$row009[21]."] [스풀 중량 : ".$row009[26]."] [임률 : ".$row009[27]."] [생산 방식 : ".$_01_m_type9."] [주 생산 기기 / 외주처 : ".$row009[29]
													."] [기타 특이사항 : ".$row009[30]."]'";

													// 10단 콤보 시작 유무
													if($tempValue09 != null){echo $flagValueStart;
													$sql10 = "SELECT * from m_bom where mo_itemCode like '".$tempValue09."' order by id desc";
													$res10 = mysqli_query($conn, $sql10);

													// 본격적인 10단 콤보
													for ($count10 = 0; $row10 = mysqli_fetch_array($res10);$count10++){
														$tempValue10 = $row10[4];

														// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
														$sql010 = "SELECT * from m_item where item_code like '".$tempValue10."' order by id desc";
														$res010 = mysqli_query($conn, $sql010);
														$row010 = mysqli_fetch_array($res010);
														if($row010[8] == 1){$_01_m_type10 = "사내생산(자동)";}
														elseif ($row010[8] == 2) {$_01_m_type10 = "사내생산(수동)";}
														elseif ($row010[8] == 3) {$_01_m_type10 = "생산/외주";}
														elseif ($row010[8] == 4) {$_01_m_type10 = "구매/매입";}
														else {$_01_m_type10 = "미입력";}

													echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."-".$count07."-".$count08."-".$count09."-".$count10."',
														'text':'".$row10[4]." ".$row10[5]." [소요량 : ".$row10[6]."] [사이클 타임 : ".$row010[7]."] [캐비티 수량 : ".$row010[20]."] [전력량 : ".$row010[28]
														."] [중량 : ".$row010[21]."] [스풀 중량 : ".$row010[26]."] [임률 : ".$row010[27]."] [생산 방식 : ".$_01_m_type10."] [주 생산 기기 / 외주처 : ".$row010[29]
														."] [기타 특이사항 : ".$row010[30]."]'";
														
														// 11단 콤보 시작 유무
														if($tempValue10 != null){echo $flagValueStart;
														$sql11 = "SELECT * from m_bom where mo_itemCode like '".$tempValue10."' order by id desc";
														$res11 = mysqli_query($conn, $sql11);
															
														// 본격적인 11단 콤보
														for($count11 = 0; $row11 = mysqli_fetch_array($res11);$count11++){
															$tempValue11 = $row11[4];

															// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
															$sql011 = "SELECT * from m_item where item_code like '".$tempValue11."' order by id desc";
															$res011 = mysqli_query($conn, $sql011);
															$row011 = mysqli_fetch_array($res011);
															if($row011[8] == 1){$_01_m_type11 = "사내생산(자동)";}
															elseif ($row011[8] == 2) {$_01_m_type11 = "사내생산(수동)";}
															elseif ($row011[8] == 3) {$_01_m_type11 = "생산/외주";}
															elseif ($row011[8] == 4) {$_01_m_type11 = "구매/매입";}
															else {$_01_m_type11 = "미입력";}

														echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."-".$count07."-".$count08."-".$count09."-".$count10."-".$count11."',
															'text':'".$row11[4]." ".$row11[5]." [소요량 : ".$row11[6]."] [사이클 타임 : ".$row011[7]."] [캐비티 수량 : ".$row011[20]."] [전력량 : ".$row011[28]
															."] [중량 : ".$row011[21]."] [스풀 중량 : ".$row011[26]."] [임률 : ".$row011[27]."] [생산 방식 : ".$_01_m_type11."] [주 생산 기기 / 외주처 : ".$row011[29]
															."] [기타 특이사항 : ".$row011[30]."]'";

															// 12단 콤보 시작 유무
															if($tempValue11 != null){echo $flagValueStart;
															$sql12 = "SELECT * from m_bom where mo_itemCode like '".$tempValue11."' order by id desc";
															$res12 = mysqli_query($conn, $sql12);

															// 본격적인 12단 콤보
															for($count12 = 0; $row12 = mysqli_fetch_array($res12); $count12++){
																$tempValue12 = $row12[4];

																// ITEM 정보 갖고 와서 개발시 참조 사항 뿌려주기
																$sql012 = "SELECT * from m_item where item_code like '".$tempValue12."' order by id desc";
																$res012 = mysqli_query($conn, $sql012);
																$row012 = mysqli_fetch_array($res012);
																if($row012[8] == 1){$_01_m_type12 = "사내생산(자동)";}
																elseif ($row012[8] == 2) {$_01_m_type12 = "사내생산(수동)";}
																elseif ($row012[8] == 3) {$_01_m_type12 = "생산/외주";}
																elseif ($row012[8] == 4) {$_01_m_type12 = "구매/매입";}
																else {$_01_m_type12 = "미입력";}

															echo "{'id':'".$count01."-".$count02."-".$count03."-".$count04."-".$count05."-".$count06."-".$count07."-".$count08."-".$count09."-".$count10."-".$count11."-".$count12."',
																'text':'".$row12[4]." ".$row12[5]." [소요량 : ".$row12[6]."] [사이클 타임 : ".$row012[7]."] [캐비티 수량 : ".$row012[20]."] [전력량 : ".$row012[28]
															."] [중량 : ".$row012[21]."] [스풀 중량 : ".$row012[26]."] [임률 : ".$row012[27]."] [생산 방식 : ".$_01_m_type12."] [주 생산 기기 / 외주처 : ".$row012[29]
															."] [기타 특이사항 : ".$row012[30]."]'";

																echo "},";
																}
																echo "]";
																}
															// 값이 없으면 11단 콤보에서 close
															else{$flagValueEnd;}

															echo "},";
															}
															echo "]";
															}
														// 값이 없으면 11단 콤보에서 close
														else{$flagValueEnd;}
														echo "},";
														}
														echo "]";
														}

													// 값이 없으면 10단 콤보에서 close
													else {$flagValueEnd;}
													echo "},";
													}
													echo "]";
													}
												//값이 없으면 9단 콤보에서 close
												else {$flagValueEnd;}
																	
												echo "},";
												}
												echo "]";
												}

											// 값이 없으면 8단 콤보에서 close
											else {$flagValueEnd;}

											echo "},";
											}
											echo "]";
											}

										// 값이 없으면 7단 콤보에서 close
										else {$flagValueEnd;}
							
										echo "},";
										}
										echo "]";
										}

									// 값이 없으면 6단 콤보에서 close
									else {$flagValueEnd;}

									echo "},";
									}
									echo "]";
									}

								// 값이 없으면 5단 콤보에서 close
								else {$flagValueEnd;}
								echo "},";
								}
								echo "]";
								}

							// 값이 없으면 4단 콤보에서 close
							else {$flagValueEnd;}

							echo "},";
							}
							echo "]";
							}

						// 값이 없으면 3단 콤보에서 close
						else {$flagValueEnd;}
					
						echo "},";
						}
						echo "]";
						}

					// 값이 없으면 2단 콤보에서 close
					else {$flagValueEnd;}

					echo "},";
					}
				//1단 콤보 close 유무는 -1 children 아래에서 이미 실행
				?>
            ]

    let tree = new Tree('.container', {
        
        // 가장 상단에 보여지는 단계
		// $tem0은 자품목이 있는지 확인 후 에코찍음
        data: [{ id: '-1', text: '<?php echo $row00[1]."  ".$row00[2]."[소요량 :1] [사이클 타임 : ".$rowq[7]."] [캐비티 수량 : ".$rowq[20]."] [전력량 : ".$rowq[28]."] [중량 : ".$rowq[21]."] [스풀 중량 : ".$rowq[26]."] [임률 : ".$rowq[27]."] [생산 방식 : ".$_01_m_type0."] [주 생산 기기 / 외주처 : ".$rowq[29]."] [기타 특이사항 : ".$rowq[30]."]"; ?>' <?php echo $tem0; ?> }],

        // 처음 오픈 되었을 시 보여주는 단계
        closeDepth: 13,

        loaded: function () {
            // 화면을 열었을때 이미 선택되어 있는 값을 보여주기 위한 체크

            this.values = ['-1', '-1'];
            console.log(this.selectedNodes);
            console.log(this.values);
            
            // 미사용시 해당 라인에 포함하면 비활성화 단계가 됨
            // this.disables = ['0-0-0', '0-0-1', '0-0-2'] 
        },
        onChange: function () {
            console.log(this.values);
        }
    })

</script>
</html>
