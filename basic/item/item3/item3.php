<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/item3.css">
    <title>East Company | 원재료관리</title>
</head>

<body>
    <form method="post" target="view_frame" action="item3_view.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    원재료관리
                </div>
                <button type="button" class="btn" onclick="popupNew()">등록</button>
            </div>
            <div class="search-section">
                <div class="item">제품코드</div>
                <div class="input"><input type="text" name="item_code"></div>
                <div class="item">제품명</div>
                <div class="input"><input type="text" name="item_name"></div>
                <div class="item">사용여부</div>
                <div class="input">
                    <select class="select" name="useable">
                        <option value='0' selected="selected">===선택===</option>
                        <option value='1'>사용</option>
                        <option value="2">미사용</option>
                    </select>
                </div>
                <button type="reset" class="btn">초기화</button>
                <button type="submit" class="btn">검색</button>
            </div>
            <div class="table-section">
                <div class="table-header">
                    <div class="th1">번호</div>
                    <div class="th2">제품코드</div>
                    <div class="th3">제품명</div>
                    <div class="th4">단가</div>                    
                    <div class="th5">Color</div>
                    <div class="th6">Maker</div>
                    <div class="th7">Grade</div>
                    <div class="th8">외부업체</div>
                    <div class="th9">사급구분</div>
                    <div class="th10">안전재고</div>
                    <div class="th11">사용여부</div>
                    <div class="th12">비고</div>
                    <div class="th_btn">관리</div>
                </div>

                <iframe frameborder="0" name="view_frame" src="item3_view.php"></iframe>

            </div>
        </div>
    </form>
    <!-- 팝업 스크립트 적용 -->
    <script type="text/javascript">
        function popupNew() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("item3_new.php", "item3_new", "width=1110, height=320, top=200, left=100");

        }
    </script>
</body>

</html>