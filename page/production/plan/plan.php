<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/plan.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" target="view_frame" action="plan_view.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    생산계획관리
                </div>
                <button type="button" class="btn" onclick="popupNew()">등록</button>
            </div>
            <div class="search-section">
                <div class="item">날짜</div>
                <div class="input"><input type="date" name="date1" value="<?= date('Y-m-d') ?>"></div>
                <div>~</div>
                <div class="input"><input type="date" name="date2" value="<?= date('Y-m-d') ?>"></div>

                <button type="reset" class="btn">초기화</button>
                <button type="submit" class="btn">검색</button>
            </div>
            <div class="table-section">
                <div class="table-header">
                    <div class="th1">번호</div>
                    <div class="th2">제목</div>
                    <div class="th3">등록날짜</div>
                    <div class="th4">등록시간</div>
                    <div class="th5">비고</div>
                    <div class="th_btn">관리</div>
                </div>

                <iframe frameborder="0" name="view_frame" src="plan_view.php"></iframe>

            </div>
        </div>
    </form>
    <!-- 팝업 스크립트 적용 -->
    <script type="text/javascript">
        function popupNew() {

            //window.open("[팝업을 띄울 파일명 path]", "[별칭]", "[팝업 옵션]")
            window.open("plan_new.php", "plan_new", "width=1800, height=1000, top=200, left=100");

        }
    </script>
</body>

</html>