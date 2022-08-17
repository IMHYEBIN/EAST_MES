<?php session_start();  // 세션 선언 필수

/*
 # 작업자 : 김범수
 # 생성일자 : 2021-12-17
 # 코멘트 :
 - 제품 BOM 정보에 대한 기초정보 등록 페이지

 - 주요 변수선언 및 용도 (구체적으로)
m_item

1) item_code	    varchar(60)     품번 
2) item_name	    varchar(60)     품명
3) item_type	    int(11)         품목 구분(select) - 원재료, 반제품, 재공품, 부재료, 제품
4) model_type	    varchar(60)     차종or 모델 타입 (공용 : all)
5) perUnit	        varchar(60)     단위
6) itemGrade	    varchar(60)     아이템 등급(안전재고 관리) - A/S, 양산, 단종
7) cycleTime	    varchar(60)     사이클 타임(C/T)
8) m_type	        varchar(60)     생산방식(method) - 사내생산, 외주생산
9) itemSpec	        varchar(60)     품목 규격(item specification)
10) p_class	        varchar(60)     생산 구분(생산 분류-Production classification) - 가공품, 조립품, 성형품
11) p_process	    varchar(60)     생산공정(생산하는 라인명) line data 연계
12) u_class	        varchar(60)     용도분류(LH/RH/공용)
13) c_code	        varchar(60)     고객 품번(내부와 다른 품번 사용시)
14) HS_code	        varchar(60)     FTA 사용 코드
15) i_location	    varchar(60)     보관위치
16) safetyStock	    int(11)         재고
17)	dwgCode	        varchar(60)     도번
18)	dwgpath	        varchar(60)     경로
19)	dwgRevision	    varchar(60)     도번 리비전 넘버
20)	cvt	            varchar(60)     캐비티 정보
21)	weight	        varchar(60)     중량 정보
22)	line_container	varchar(60)     공정 적재 정보
23)	line_quantity	varchar(60)     공정 적재 수량 정보
24)	sell_container	varchar(60)     영업 적재 정보
25)	sell_quantity	varchar(60)     영업 적재 수량 정보
26)	spool_weight	varchar(60)     스풀 중량 정보
27)	workPrice	    varchar(60)     임률 단가
28)	electricityUsed	varchar(60)     전력 사용량
29)	acc	            varchar(60)     기타
30)	acc0	        varchar(60)     기타0
31)	acc1	        varchar(60)     기타1

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


		$conn = new mysqli("localhost", "server", "00000000", "dataset");
		$sql = "select * from m_item order by id desc";
		$res = mysqli_query($conn, $sql);

		$row = mysqli_fetch_array($res);

		$_02_item_code		= $row[1];
		$_02_item_name		= $row[2];
		$_02_item_type		= $row[3];
		$_02_model_type		= $row[4];
		$_02_perUnit		= $row[5];
		$_02_itemGrade		= $row[6];
		$_02_cycleTime		= $row[7];
		$_02_m_type			= $row[8];
		$_02_itemSpec		= $row[9];
		$_02_p_class		= $row[10];
		$_02_p_process		= $row[11];
		$_02_u_class		= $row[12];
		$_02_c_code			= $row[13];
		$_02_HS_code		= $row[14];
		$_02_i_location		= $row[15];
		$_02_safetyStock	= $row[16];
		$_01_dwgCode		= $row[17];
		$_01_dwgpath		= $row[18];
		$_01_dwgRevision	= $row[19];
		$_01_cvt			= $row[20];
		$_01_weight			= $row[21];
		$_01_line_container = $row[22];
		$_01_line_quantity	= $row[23];
		$_01_sell_container = $row[24];
		$_01_sell_quantity	= $row[25];
		$_01_spool_weight	= $row[26];
		$_01_workPrice		= $row[27];
		$_01_electricityUsed= $row[28];
		$_01_mk_mc			= $row[29];
		$_01_acc			= $row[30];
		$_01_acc0			= $row[31];
		$_01_acc1			= $row[32];


// 여기서 부터 db에 있는 정보 당겨쓰기
#품번 당겨쓰기
$sql00 = "select * from m_item order by id";
$res00 = mysqli_query($conn, $sql00);
#품명 당겨쓰기
$sql01 = "select * from m_item order by id";
$res01 = mysqli_query($conn, $sql01);

?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS파일 적용 -->
	<link rel="stylesheet" href="css/bom.css">

	<!-- 팝업 스크립트 적용 -->
	<script src="js/bom_new.js?ver.1"></script>

	<title>제품 BOM 정보</title>
</head>

<body>
	<!-- 제목 -->
	<div id="title" style="color:white; background-color:#686868; padding: 10px; display:block;">
		<span style="width: 100%; font-size: 23px; font-weight: bold; margin-left:15px;"> ▣ 검색</span>
	</div>
	<!-- 검색창 안에 들어가는 표-->
	<div id="container">
		<table id="topTable">
			<form method="post" name="bomform">
				<!-- 1번째 행 -->
				<tr>
					<th>품번</th>
					<td><input type="text" name="_01_item_code" class="input_text" list="_01_item_code"></td>
					<datalist id="_01_item_code">
						<?php //여기에서 품번을 찾아서 db에 기 입력한 자료를 반복해서 list up 하기
						for (; $row00 = mysqli_fetch_array($res00);) {
							echo "<option value = '" . $row00[1] . "'>" . $row00[1] . "</option>";
						} ?>
					</datalist>
					<th>품명</th>
					<td><input type="text" name="_01_item_name" class="input_text" list="_01_item_name"></td>
					<datalist id="_01_item_name">
						<?php //여기에서 품번을 찾아서 db에 기 입력한 자료를 반복해서 list up 하기
						for (; $row01 = mysqli_fetch_array($res01);) {
							echo "<option value = '" . $row01[2] . "'>" . $row01[2] . "</option>";
						} ?>
					</datalist>
					<td><button type="reset" style="width:130px; height:30px;">초기화</button></td>
					<td><button type="submit" formaction="php/bom_view.php" formtarget="_01_i_002" style="width:130px; height:30px;">검색</button></td>
					<td><button type="submit" formaction="php/bomPostSession.php" formtarget="_blank" style="width:130px; height:30px;">BOM 등록 및 수정</button></td>
					<!-- <td><button type="submit" onclick='bom_new()' style="width:130px; height:30px;">BOM 등록 및 수정</button></td> -->
				</tr>
			</form>
		</table>
	</div>

	<br><br>
	<h2>제품 BOM 정보</h2>

	<iframe frameborder="0" src="php/bom_view.php" style="width : 100%; height :610px;" name="_01_i_002" id="_01_i_002"></iframe>

	<?php mysqli_close($conn); ?>

	</div>

</body>

</html>