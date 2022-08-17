<?php session_start();
/*
 # 작업자 : 김범수
 # 생성일자 : 2021-12-28
 # 코멘트 : 해당 페이지는 bom_new 에서 post로 보내준 정보를 update 및 insert하는 페이지임
			post 값 session 선언 및 함수 선언 및 포스트 값 초기화 방지를 위한 우회 파일
*/

// post 값 session 선언 및 함수 선언

	$_SESSION["_01_item_code"] = $_POST["_01_item_code"];
	$_SESSION["_01_item_name"] = $_POST["_01_item_name"];
?>
<!-- 글자깨짐 방지 -->
<meta charset="UTF-8">

<!-- 선언 후 해당 파일 이동 -->
<meta http-equiv="refresh" content="0; URL=../bom_new.php">