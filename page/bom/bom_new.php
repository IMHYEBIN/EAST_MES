<?php session_start(); ?>
<?php
if ($_POST['item_code'] != null) {
    $item_code = $_POST['item_code'];
    $_SESSION['item_code'] = $item_code;
} else {
    $item_code = "선택된 제품 없음";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bom_new.css">
    <title>East Company</title>
</head>

<body>
    <!-- ////////////////////////////////////////////상단 섹션/////////////////////////////////////////////// -->
    <div class="container">
        <form method="post" action="/page/bom/pop1/top_view.php" target="top_frame">
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
                <iframe frameborder="0" class="top_frame" name="top_frame" src="/page/bom/pop1/top_view.php"></iframe>
            </div>
        </form>

        <div class="bottom_section">
            <div class="table_section2">
                <!-- ////////////////////////////////////////////하단 섹션/////////////////////////////////////////////// -->
                <form method="post" action="/page/bom/pop1/bottom_view.php" target="bottom_frame">
                    <div class="header2_1">
                        <div class="th">제품 BOM</div>
                    </div>
                    <div class="header2_2">
                        <div class="root"><?= $item_code ?></div>
                    </div>
                    <!-- 하단 VIEW -->
                    <iframe frameborder="0" class="bottom_frame" name="bottom_frame" src="/page/bom/pop1/bottom_view.php"></iframe>
                </form>
            </div>


            <div class="add_section">
                <div class="add_title">추가할 제품</div>
                <form action='/page/bom/pop1/php/bottom_view_insert.php' method='post' target='bottom_view'>
                    <div class="insert_section">
                        <input type="text" name="child" required>
                        <input type='submit' class='btn' value='추가'>
                    </div>
                </form>
            </div>
        </div>
        <!-- ////////////////////////////////////////////버튼 섹션/////////////////////////////////////////////// -->
        <div class="btn_section">
            <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
        </div>
    </div>
</body>

</html>