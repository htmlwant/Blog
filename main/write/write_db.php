<?php
session_start();

// CSRF 토큰 검증
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo "<script>alert('유효하지 않은 요청입니다.'); location.href='../main.php';</script>";
        exit;
    }
}

$connect = mysqli_connect("localhost", "root", "asd7517162", "submit") or die("Database connection failed");

// 폼에서 받은 값에 대해 보안 처리
$id = $_SESSION['name'];                            
$title = mysqli_real_escape_string($connect, $_POST['title']);
$content = mysqli_real_escape_string($connect, $_POST['content']);
$date = date('Y-m-d H:i:s');
$URL = '../main.php';

// 게시글 등록 쿼리
$query = "INSERT INTO board (number, title, content, id, date, hit) 
          VALUES (NULL, '$title', '$content', '$id', '$date', 0)";

$result = $connect->query($query);

if ($result) {
?>
    <script>
        alert("<?php echo '게시글이 등록되었습니다.'; ?>");
        location.replace("<?php echo $URL ?>");
    </script>
<?php
} else {
    echo "게시글 등록에 실패하였습니다. 오류: " . mysqli_error($connect);
}

mysqli_close($connect);
?>
