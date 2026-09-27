<?php
    session_start();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="write.css">
</head>
<body>
    <form method="post" action="write_db.php">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <table style="padding-top:50px" align="center" width="auto" border="0" cellpadding="2">
            <tr>
                <td style="height:40; float:center; background-color:#3C3C3C">
                    <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>게시글 작성하기</b></p>
                </td>
            </tr>
            <tr>
                <td bgcolor="white">
                    <table class="table2">
                        <tr>
                            <td>작성자</td>
                            <td><input type="text" name="name" size="30" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>제목</td>
                            <td><input type="text" name="title" size="70"></td>
                        </tr>
                        <tr>
                            <td>내용</td>
                            <td><textarea name="content" cols="75" rows="15"></textarea></td>
                        </tr>
                    </table>
                    <center>
                        <input style="font-size:12px;" type="submit" value="작성">
                    </center>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
