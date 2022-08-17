function bom_mod() {

	//window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
	window.open("bom_mod.php", "bom_mod", "width=1300, height=530, top=100, left=30");
	bomform.target="bom_mod";         //해당 폼의 타겟 별칭(★★★위의 별칭과 동일하게 설정!!)
    bomform.action="bom_mod.php";     //해당 폼 데이터를 받을 위치
    bomform.submit();                 //해당 폼의 행위(형식)
}