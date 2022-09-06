<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/client.css?ver=121">
    <title>East Company | 거래처관리</title>
</head>

<body>
    <form method="post" target="view_frame" action="client_view.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    거래처관리
                </div>
                <button type="button" class="btn" onclick="popup_new()">등록</button>
            </div>
            <div class="search-section">
                <div class="item">거래처코드</div>
                <div class="input"><input type="text" name="cop_code"></div>
                <div class="item">거래처명</div>
                <div class="input"><input type="text" name="cop_name"></div>
                <div class="item">거래처구분</div>
                <div class="input">
                    <select class="select" name="type">
                        <option value='0' selected="selected">===선택===</option>
                        <option value='1'>고객사</option>
                        <option value="2">외주처</option>
                        <option value="3">부자재</option>
                        <option value="4">원재료</option>
                        <option value="5">협력사</option>
                    </select>
                </div>
                <button type="submit" class="btn">검색</button>
                <button type="reset" class="btn">초기화</button>

            </div>
            <div class="table-section">
                <div class="table-header">
                    <div class="th1">번호</div>
                    <div class="th2">거래처코드</div>
                    <div class="th3">거래처명</div>
                    <div class="th4">거래처구분</div>
                    <div class="th5">사업자등록번호</div>
                    <div class="th6">주소</div>
                    <div class="th7">비고</div>
                    <div class="th8">관리</div>
                </div>
                <div class="table-content">
                    <iframe frameborder="0" name="view_frame" src="client_view.php"></iframe>
                </div>
            </div>
        </div>
    </form>
    <!-- 팝업 스크립트 적용 -->
    <script type="text/javascript">
        function popup_new() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("client_new.php", "client_new", "width=800, height=300, top=200, left=100");

        }
    </script>
</body>

</html>