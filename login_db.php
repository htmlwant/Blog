<?php
    session_start();  // 세션 시작

    // DB 연결
    $connect = mysqli_connect('localhost', 'root', 'asd7517162', 'submit');

    // 로그인 폼에서 POST로 넘어온 사용자 입력값 받기
    $user_id = $_POST['user_id'];
    $user_pw = $_POST['user_pw'];

    // 사용자 입력값 확인을 위한 쿼리
    $query = "SELECT * FROM member WHERE user_id = '$user_id' AND pw = '$user_pw'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        // 로그인 성공, 세션에 사용자 이름 저장
        $user = mysqli_fetch_assoc($result);  // 첫 번째 사용자 정보 가져오기
        $_SESSION['name'] = $user['name'];  // 세션에 이름 저장

        // 로그인 후 main.php로 리디렉션
        header("Location: main/main.php");
        exit();
    } else {
        echo "<script>
                alert('아이디 또는 비밀번호가 틀렸습니다.');
                location.replace('login.php');
              </script>";
    }
    // DB 연결 종료
    mysqli_close($connect);
?>
