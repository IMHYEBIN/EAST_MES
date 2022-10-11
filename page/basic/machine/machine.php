<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/machine.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" target="view_frame" action="machine_view.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    설비관리
                </div>
                <button type="button" class="btn" onclick="popupNew()">등록</button>
            </div>
            <div class="search-section">
                <div class="item">설비코드</div>
                <div class="input"><input type="text" name="machine_code"></div>
                <div class="item">설비명</div>
                <div class="input"><input type="text" name="machine_name"></div>
                <button type="reset" class="btn">초기화</button>
                <button type="submit" class="btn">검색</button>
            </div>
            <div class="table-section">
                <div class="table-header">
                    <div class="th1">번호</div>
                    <div class="th2">설비코드</div>
                    <div class="th3">설비명</div>
                    <div class="th4">TON</div>                    
                    <div class="th5">설치위치</div>                    
                    <div class="th6">비고</div>
                    <div class="th_btn">관리</div>
                </div>

                <iframe frameborder="0" name="view_frame" src="machine_view.php"></iframe>

            </div>
        </div>
    </form>
    <!-- 팝업 스크립트 적용 -->
    <script type="text/javascript">
        function popupNew() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("machine_new.php", "machine_new", "width=1110, height=300, top=200, left=100");

        }
    </script>
</body>

</html>