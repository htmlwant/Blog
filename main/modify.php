<?php
session_start();

// 데이터베이스 연결
$connect = mysqli_connect('localhost', 'root', 'asd7517162', 'submit');

// 게시글 번호 가져오기
$number = $_GET['number'];

// 로그인 확인 및 수정 권한 확인 (로그인한 사용자와 게시글 작성자가 동일할 경우에만 수정 가능)
if (isset($_SESSION['name'])) {
    // 게시글 정보 가져오기
    $query = "SELECT * FROM board WHERE number = $number";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);

    // 로그인한 사용자와 게시글 작성자가 동일한지 확인
    if ($_SESSION['name'] === $row['id']) {
        // 게시글 제목, 내용 가져오기
        $title = $row['title'];
        $content = $row['content'];
    } else {
        // 작성자가 아니면 수정 불가
        echo "<script>
                alert('수정 권한이 없습니다.');
                location.href = './read.php?number=$number';
              </script>";
        exit;
    }
} else {
    // 로그인하지 않은 사용자가 접근한 경우
    echo "<script>
            alert('로그인 후 수정 가능합니다.');
            location.href = '../login.php';
          </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];
    $update_query = "UPDATE board SET title = '$new_title', content = '$new_content' WHERE number = $number";
    $update_result = mysqli_query($connect, $update_query);

    if ($update_result) {
        echo "<script>
                alert('게시글이 수정되었습니다.');
                location.href = './read.php?number=$number';  // 수정된 페이지로 리다이렉트
              </script>";
    } else {
        echo "<script>
                alert('게시글 수정에 실패하였습니다.');
                history.back();  // 이전 페이지로 돌아가기
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
    <link rel="stylesheet" href="modify.css">
</head>
<body>
    <form method="POST" action="modify.php?number=<?php echo $number; ?>">
        <table class="modify_table">
            <tr>
                <th colspan="2">게시글 수정</th>
            </tr>
            <tr>
                <td>제목</td>
                <td><input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" size="70" required></td>
            </tr>
            <tr>
                <td>내용</td>
                <td><textarea name="content" rows="10" cols="70" required><?php echo htmlspecialchars($content); ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="modify_btns">
                        <button class="modify_btn1" type="submit">수정 완료</button>
                        <!-- 목록으로 돌아가기 버튼 -->
                        <button class="modify_btn1" type="button" onclick="location.href='./main.php'">목록으로 돌아가기</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
