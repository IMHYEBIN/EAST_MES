<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/page/basic/bom/css/bom.css">
    <title>East Company</title>
</head>

<body>
    <div class="container">
        <div class="title_section">
            <div class="title">
                BOM등록
            </div>
        </div>

        <form method="post" action="/page/basic/bom/main_view.php" target="iframe__main_view">
            <div class="main_section">
                <div class="main_section__tree_section">BOM트리</div>
                <div class="main_section__search_section">
                    <div class="main_section__search_box">
                        <div class="th">제품코드</div>
                        <div class="td"><input name="item_code" type="text"></div>
                        <div class="th">제품명</div>
                        <div class="td"><input name="item_name" type="text"></div>
                        <div class="btn"><button type="reset" class="btn reset_btn">초기화</button></div>
                        <div class="btn"><button type="submit" class="btn search_btn">검색</button></div>
                    </div>
                    <div class="main_section__search_th">
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <div>번호</div>
                        <div>구분</div>
                        <div>제품코드</div>
                        <div>제품명</div>
                        <div>단가</div>
                        <div>거래처</div>
                        <div>사급</div>
                        <div>현재고</div>
                        <div style="width: 100px;">비고</div>
                        <div style="width: 100px;">사용여부</div>
                        <div style="width: 60px;">관리</div>
                    </div>
                </div>
            </div>
        </form>
        <iframe frameborder="0" name="iframe__main_view" src="/page/basic/bom/main_view.php"></iframe>
    </div>
</body>

</html>