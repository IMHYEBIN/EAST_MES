<?php session_start(); ?>
<?php $conn = new mysqli("localhost", "server", "00000000", "dataset"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/color_new.css">
    <title>East Company</title>
</head>

<body>
    <form method="post" action="php/color_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    COLOR등록
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>COLOR명</th>
                        <td><input name="color" type="text" required></td>
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