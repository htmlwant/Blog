<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" href="submit.css">
</head>
<body>
    <div class="box_shadow">
    <div class="submit">
        <form action="submit_db.php" method="get">
            <div class="id">
                <input type="text" placeholder="아이디를 입력해주세요" name="user_id" class="user_id" required>
                <p>아이디는 6~20자 이내로 적으셔야 합니다</p> 
            </div>
            <div class="password">
                <input type="password" placeholder=" 비밀번호를 입력해주세요" name="user_pw" class="user_pw" required>
                <p>비밀번호는 영어 소,대문자를 이용하여 8~20자 이내로 적으셔야 합니다</p>
            </div>
            <div class="password_repeat">
                <input type="password" placeholder="비밀번호를 다시 입력해주세요" name="user_pw_repeat" class="user_pw_repeat" required>
            </div>
            <div class="name">
                <input type="text" placeholder="사용할 이름을 입력해주세요" name="user_name" class="user_name">
            </div>
            <div class="phone_number">
                <input type="number" placeholder="전화번호를 입력해주세요" name="phonenumber" class="phonenumber" required>
            </div>
            <div class="submit_button">
                <input type="submit" class="user_submit" name="user_submit" value="회원가입"></button>
                <div class="user_login"><a href="../login.php">이미 회원이신가요?</a></div>
            </div>
        </form>
</div>
    </div>
</body>
</html>