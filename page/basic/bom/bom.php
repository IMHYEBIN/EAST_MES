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
                        <div class="th1">번호</div>
                        <div class="th2">구분</div>
                        <div class="th3">제품코드</div>
                        <div class="th4">제품명</div>
                        <div class="th5">단가</div>
                        <div class="th6">현재고</div>
                        <div class="th_btn">관리</div>
                    </div>
                </div>
            </div>
        </form>
        <iframe frameborder="0" name="iframe__main_view" src="/page/basic/bom/main_view.php" width="100%" height="100%"></iframe>
    </div>
</body>

</html>