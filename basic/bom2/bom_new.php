<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bom_new.css?ver=1">
    <title>East Company | BOM관리 :: NEW</title>
</head>

<body>
    <!-- ////////////////////////////////////////////상단 섹션/////////////////////////////////////////////// -->
    <div class="container">
        <form method="post" action="/basic/bom/popup/pop_top_view.php" target="top_frame">
            <div class="title_section">
                <div class="title">
                    BOM등록
                </div>
            </div>

            <div class="table_section1">
                <div class="header1_1">
                    <div class="th">제품코드</div>
                    <div class="td"><input name="item_code" type="text"></div>
                    <div class="th">제품명</div>
                    <div class="td"><input name="item_name" type="text"></div>
                    <div class="btn"><button type="reset" class="btn reset_btn">초기화</button></div>
                    <div class="btn"><button type="submit" class="btn search_btn">검색</button></div>
                </div>

                <div class="header1_2">
                    <div class="td1">번호</div>
                    <div class="td2">구분</div>
                    <div class="td3">제품코드</div>
                    <div class="td4">제품명</div>
                    <div class="td5">단가</div>
                    <div class="td6">생산구분</div>
                    <div class="td7">사급구분</div>
                    <div class="td8">안전재고</div>
                    <div class="td9">비고</div>
                    <div class="td10">상태</div>
                    <div class="td11">관리</div>
                </div>

                <!-- 상단 VIEW -->
                <iframe frameborder="0" class="top_frame" name="top_frame" src="popup/pop_top_view.php"></iframe>
            </div>
        </form>


        <!-- ////////////////////////////////////////////버튼 섹션/////////////////////////////////////////////// -->
        <div class="btn_section">
            <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
        </div>
    </div>
</body>

</html>