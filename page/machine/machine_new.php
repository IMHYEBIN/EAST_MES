<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/machine_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/machine_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    설비등록
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>설비코드</th>
                        <td><input name="machine_code" type="text" required></td>
                        <th>설비명</th>
                        <td><input name="machine_name" type="text" required></td>
                    </tr>
                    <tr>
                        <th>TON</th>
                        <td><input name="ton" type="text"></td>
                        <th>비고</th>
                        <td><input name="acc" type="text"></td>
                    </tr>
                </table>
            </div>
            <div class="btn_section">
                <button type="submit" class="btn add_btn">등록</button>
                <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
            </div>
        </div>
    </form>
</body>

</html>