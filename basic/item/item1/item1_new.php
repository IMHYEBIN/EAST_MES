<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/item1_new.css">
    <title>East Company | 아쎄이관리 :: NEW</title>
</head>

<body>
    <form method="post" action="php/item1_insert.php" target="_blank">
        <div class="container">
            <div class="title_section">
                <div class="title">
                    아쎄이등록
                </div>
            </div>
            <div class="main_section">
                <table>
                    <tr>
                        <th>제품코드</th>
                        <td><input name="item_code" type="text" required></td>
                        <th>제품명</th>
                        <td><input name="item_name" type="text" required></td>
                    </tr>
                    <tr>
                        <th>단가</th>
                        <td><input name="unit" type="text"></td>
                        <th>상태</th>
                        <td>
                            <select name="status">
                                <option value="1">양산</option>
                                <option value="2">단종</option>
                                <option value="3">A/S</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>외부업체</th>
                        <td><input name="client_name" type="text" placeholder="외부업체가 없을경우 비워주세요."></td>
                        <th>사급구분</th>
                        <td>
                            <select name="supply">
                                <option value="1">유상</option>
                                <option value="2">무상</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>안전재고</th>
                        <td><input name="safe_stock" type="text"></td>
                        <th>비고</th>
                        <td><input name="acc" type="text"></td>
                    </tr>
                    <tr>
                        <th>사진</th>
                        <td>
                            <input class="short" name="photo" type="text" placeholder="보류">
                            <input class="btn" type="button" value="파일찾기">
                        </td>
                        <th>도면</th>
                        <td>
                            <input class="short" name="paper" type="text" placeholder="보류">
                            <input class="btn" type="button" value="파일찾기">
                        </td>
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