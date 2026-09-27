<?php
session_start();

$connect = mysqli_connect('localhost', 'root', 'asd7517162', 'submit');

$number = $_GET['number'];

if (isset($_SESSION['name'])) {
    $query = "SELECT * FROM board WHERE number = $number";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    if ($_SESSION['name'] === $row['id'] || $_SESSION['name'] === 'root') {
        $delete_query = "DELETE FROM board WHERE number = $number";
        if (mysqli_query($connect, $delete_query)) {
            $update_query = "SET @i := 0";
            mysqli_query($connect, $update_query);
            $reset_query = "UPDATE board SET number = (@i := @i + 1)";
            if (mysqli_query($connect, $reset_query)) {
                echo "<script>
                        alert('게시글이 삭제되었습니다.');
                        location.href = './main.php';
                      </script>";
            } else {
                echo "<script>
                        alert('번호 재조정에 실패하였습니다.');
                        history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('게시글 삭제에 실패하였습니다.');
                    history.back();
                  </script>";
        }
    } else {
        // 작성자와 로그인한 사용자가 다를 경우
        echo "<script>
                alert('삭제 권한이 없습니다.');
                location.href = './main.php';
              </script>";
    }
} else {
    // 로그인하지 않은 경우
    echo "<script>
            alert('로그인 후 삭제 가능합니다.');
            location.href = '../login.php';
          </script>";
    exit;
}
?>
