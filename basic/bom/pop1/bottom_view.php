<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/basic/bom/css/bottom_view.css">
    <title>East Company | BOM등록 :: BOTTOM_VIEW</title>
</head>

<body style="background-color: #f0f4f5;">


    <div class="result">
        <iframe frameborder="0" class="result_frame" name="result_frame" src="pop2/bottom_view_result.php"></iframe>
    </div>


    <?php mysqli_close($conn); ?>
</body>

</html>