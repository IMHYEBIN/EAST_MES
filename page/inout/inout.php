<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/inout.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" target="view_frame" action="inout_view.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    입출고관리
                </div>
                <button type="button" class="btn" onclick="popupNew()">등록</button>
            </div>
            <div class="search-section">
                <div class="item">제품코드</div>
                <div class="input"><input type="text" name="item_code"></div>
                <div class="item">제품명</div>
                <div class="input"><input type="text" name="item_name"></div>
                <div class="item">제품구분</div>
                <div class="input">
                    <select class="select" name="index1">
                        <option value='0' selected="selected">===선택===</option>
                        <option value='1'>아쎄이</option>
                        <option value="2">부자재</option>
                        <option value="3">원재료</option>
                    </select>
                </div>
                <div class="item">입출고구분</div>
                <div class="input">
                    <select class="select" name="type">
                        <option value='0' selected="selected">===선택===</option>
                        <option value='1'>입고</option>
                        <option value="2">출고</option>
                    </select>
                </div>
                <button type="reset" class="btn">초기화</button>
                <button type="submit" class="btn">검색</button>
            </div>
            <div class="table-section">
                <div class="table-header">
                    <table>
                        <tr>
                            <th class="id">번호</th>
                            <th class="date">날짜</th>
                            <th class="item_code">제품코드</th>
                            <th class="item_name">제품명</th>
                            <th class="type">입출고구분</th>
                            <th class="unit">단가</th>
                            <th class="inout_q">입출고수량</th>
                            <th class="inout_a">금액</th>
                            <th class="safe_stock">안전재고</th>
                            <th class="acc">비고</th>
                        </tr>
                    </table>
                </div>

                <iframe frameborder="0" name="view_frame" src="inout_view.php"></iframe>

            </div>
        </div>
    </form>
    <!-- 팝업 스크립트 적용 -->
    <script type="text/javascript">
        function popupNew() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("inout_new.php", "inout_new", "width=1110, height=320, top=200, left=100");

        }
    </script>
</body>

</html>