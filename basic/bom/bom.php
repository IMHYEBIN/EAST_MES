<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bom.css">
    <title>East Company | BOM관리</title>
</head>

<body>
    <form method="post" target="tree_frame" action="bom_tree.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    BOM관리
                </div>
                <button type="button" class="btn" onclick="popupNew()">등록</button>
            </div>
            <div class="search-section">
                <div class="item">제품코드</div>
                <div class="input"><input type="text" name="item_code" placeholder="정확한 제품코드 입력해주세요"></div>
                <div class="item">제품명</div>
                <div class="input"><input type="text" name="item_name" placeholder="정확한 제품명 입력해주세요"></div>
                <button type="reset" class="btn">초기화</button>
                <button type="submit" class="btn">검색</button>
            </div>
            <div class="table-section">
                <div class="table-header">
                    <div class="table-header1">
                        <div class="th1">BOM 트리</div>
                    </div>
                    <div class="table-header2">
                        <div class="th1">번호</div>
                        <div class="th2">제품코드</div>
                        <div class="th3">제품명</div>
                        <div class="th4">단가</div>
                        <div class="th5">상태</div>
                        <div class="th6">외부업체</div>
                        <div class="th7">사급구분</div>
                        <div class="th8">안전재고</div>
                        <div class="th9">성형작업</div>
                        <div class="th10">공법</div>
                        <div class="th11">C/T</div>
                        <div class="th12">비고</div>
                        <div class="th_btn">관리</div>
                    </div>
                </div>
                <div class="frame-section">
                    <iframe frameborder="0" class="tree_frame" name="tree_frame" src="bom_tree.php"></iframe>
                    <iframe frameborder="0" class="view_frame" name="view_frame" src="bom_view.php" id='view_frame'></iframe>
                </div>
            </div>
        </div>

    </form>
    <!-- 팝업 스크립트 적용 -->
    <script type="text/javascript">
        function popupNew() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("bom_new.php", "bom_new", "width=1310, height=930, top=100, left=500");

        }
    </script>
</body>

</html>