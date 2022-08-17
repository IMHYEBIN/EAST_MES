function bom_new() {

	//window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
	window.open("bom_new.php", "bom_new", "width=1400, height=730, top=20, left=10");
	bomform.target = "bom_new";         //해당 폼의 타겟 별칭(★★★위의 별칭과 동일하게 설정!!)
	bomform.action = "bom_new.php";     //해당 폼 데이터를 받을 위치
	bomform.submit();                 //해당 폼의 행위(형식)
}