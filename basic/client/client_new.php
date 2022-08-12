<?php session_start(); ?>
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
    <title>East Company | 거래처관리 :: NEW</title>
</head>

<body>
    <form method="post" action="php/client_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    거래처등록
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>거래처코드</th>
                        <td><input name="cop_code" type="text" required></td>
                        <th>거래처명</th>
                        <td><input name="cop_name" type="text" required></td>
                    </tr>
                    <tr>
                        <th>거래처구분</th>
                        <td>
                            <select name="type">
                                <option value="1">고객사</option>
                                <option value="2">외주처</option>
                                <option value="3">부자재</option>
                                <option value="4">원재료</option>
                                <option value="5">협력사</option>
                            </select>
                        </td>
                        <th>사업자등록번호</th>
                        <td><input name="cop_num" type="text"></td>
                    </tr>
                    <tr>
                        <th rowspan="2">주소</th>
                        <td colspan="2"><input class="center" name="address1" type="text" id="postcode" placeholder="우편번호"></td>
                        <td><input class="btn address_btn" name="address_btn" type="button" onclick="execDaumPostcode()" value="우편번호 찾기"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="center" name="address2" id="roadAddress" type="text" placeholder="도로명주소"></td>
                        <td><input class="center" name="address3" id="detailAddress" type="text" placeholder="상세주소"></td>
                        <!-- <td><input type="text" name="c_extraAddress_1" id="extraAddress" placeholder="(읍/면/동)"></td> -->
                    <tr>
                        <th>비고</th>
                        <td colspan="3"><input name="acc" type="text"></td>
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