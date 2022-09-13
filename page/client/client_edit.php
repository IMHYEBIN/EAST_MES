<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>

<?php
$id = $_POST['id'];

$sql = "select * from client where id = '".$id."'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 다음 주소 서비스 코드 -->
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="js/adress.js"></script>
    <link rel="stylesheet" href="css/client_new.css">
    <title>East Company | 거래처관리 :: EDIT</title>
</head>

<body>
    <form method="post" action="php/client_update.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    거래처수정
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>거래처코드</th>
                        <td><input name="cop_code" type="text" required value="<?= $row['cop_code'];?>"></td>
                        <th>거래처명</th>
                        <td><input name="cop_name" type="text" required value="<?= $row['cop_name'];?>"></td>
                    </tr>
                    <tr>
                        <th>거래처구분</th>
                        <td>
                            <select name="type" value="<?= $row['type'];?>">
                                <option value="1">고객사</option>
                                <option value="2">외주처</option>
                                <option value="3">부자재</option>
                                <option value="4">원재료</option>
                                <option value="5">협력사</option>
                            </select>
                        </td>
                        <th>사업자등록번호</th>
                        <td><input name="cop_num" type="text" value="<?= $row['cop_num'];?>"></td>
                    </tr>
                    <tr>
                        <th rowspan="2">주소</th>
                        <td colspan="2"><input class="center" name="address1" type="text" id="postcode" placeholder="우편번호" value="<?= $row['address1'];?>"></td>
                        <td><input class="btn address_btn" name="address_btn" type="button" onclick="execDaumPostcode()" value="우편번호 찾기"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="center" name="address2" id="roadAddress" type="text" placeholder="도로명주소" value="<?= $row['address2'];?>"></td>
                        <td><input class="center" name="address3" id="detailAddress" type="text" placeholder="상세주소" value="<?= $row['address3'];?>"></td>
                        <!-- <td><input type="text" name="c_extraAddress_1" id="extraAddress" placeholder="(읍/면/동)"></td> -->
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" type="text" value="<?= $row['acc'];?>"></td>
                    </tr>
                </table>
            </div>
            <div class="btn_section">
                <input type="hidden" name="id" value="<?= $id;?>">
                <button type="submit" class="btn add_btn">수정</button>
                <button type="button" class="btn back_btn" onclick="self.close();">취소</button>
            </div>
        </div>
    </form>
</body>

</html>