<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/log.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" target="view_frame" action="log_view.php">
        <div class="container">
            <div class="title-section">
                <div class="title-section__text">
                    로그관리
                </div>
            </div>
            <div class="search-section">
                <div class="item">날짜</div>
                <div class="input"><input type="date" name="date" value="<?= date('Y-m-d') ?>"></div>
                <div class="item">시간</div>
                <div class="input"><input type="time" name="time1" value="<?= date('00:00') ?>"></div>
                <div>~</div>
                <div class="input"><input type="time" name="time2" value="<?= date('23:59') ?>"></div>
                <div class="item">작업구분</div>
                <div class="input">
                    <select name="work">
                        <option value="">==선택==</option>
                        <option value="INSERT">INSERT</option>
                        <option value="UPDATE">UPDATE</option>
                        <option value="VIEW">VIEW</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </div>

                <button type="reset" class="btn">초기화</button>
                <button type="submit" class="btn">검색</button>
            </div>
            <div class="table-section">
                <div class="table-header">
                    <div class="th1">번호</div>
                    <div class="th2">날짜</div>
                    <div class="th3">시간</div>
                    <div class="th4">페이지</div>
                    <div class="th5">설명</div>
                </div>

                <iframe frameborder="0" name="view_frame" src="log_view.php"></iframe>

            </div>
        </div>
    </form>
</body>

</html>