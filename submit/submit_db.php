<?php
    $connect = mysqli_connect('localhost', 'root', 'asd7517162', 'submit');

    if (!$connect) {
        die("데이터베이스 연결 실패: " . mysqli_connect_error());
    }

    // 사용자 입력 값 처리
    $id = mysqli_real_escape_string($connect, $_GET['user_id']);
    $pw = mysqli_real_escape_string($connect, $_GET['user_pw']);
    $pw_repeat = mysqli_real_escape_string($connect, $_GET['user_pw_repeat']);
    $name = mysqli_real_escape_string($connect, $_GET['user_name']);
    $phonenumber = mysqli_real_escape_string($connect, $_GET['phonenumber']);

    // 비밀번호 일치 여부 확인
    if ($pw !== $pw_repeat) {
        echo "<script>
                alert('비밀번호가 일치하지 않습니다.');
                location.replace('submit.php');
              </script>";
        mysqli_close($connect);
        exit();
    }

    // ID 중복 확인 쿼리
    $check_query = "SELECT * FROM member WHERE user_id = '$id'";
    $check_result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // ID가 이미 존재하는 경우
        echo "<script>
                alert('이미 사용 중인 아이디입니다.');
                location.replace('submit.php');
              </script>";
        mysqli_close($connect);
        exit();
    }

    // ID 중복이 아닌 경우 회원가입 진행
    $query = "INSERT INTO member (user_id, pw, name, phone_number) VALUES ('$id', '$pw', '$name', '$phonenumber')";

    // 쿼리 실행
    $result = mysqli_query($connect, $query);

    // 쿼리 실행 결과에 따른 처리
    if ($result) {
        echo "<script>
                alert('가입 되었습니다');
                location.replace('../login.php');
              </script>";
    } else {
        echo "<script>
                alert('가입 실패');
                location.replace('submit.php');
              </script>";
    }

    // 데이터베이스 연결 종료
    mysqli_close($connect);
?>
