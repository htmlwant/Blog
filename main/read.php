<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="read.css">
</head>

<body>
    <?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'asd7517162', 'submit');
    $number = $_GET['number'];  // GET 방식 사용
    $hit_query = "UPDATE board SET hit = hit + 1 WHERE number = $number";
    mysqli_query($connect, $hit_query);
    $query = "SELECT title, content, date, hit, id FROM board WHERE number = $number";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <table class="read_table" align=center>
        <tr>
            <td colspan="4" class="read_title"><?php echo $rows['title']; ?></td>
        </tr>
        <tr>
            <td class="read_id">작성자</td>
            <td class="read_id2"><?php echo $rows['id']; ?></td>
            <td class="read_hit">조회수</td>
            <td class="read_hit2"><?php echo $rows['hit']; ?></td>
        </tr>

        <tr>
            <td colspan="4" class="read_content" valign="top">
                <?php echo nl2br($rows['content']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="read_btn_section">
                <button class="read_btn1" onclick="location.href='./main.php'">목록</button>&nbsp;&nbsp;

                <?php
                if (isset($_SESSION['name'])) {
                    if ($_SESSION['name'] === 'root' || $_SESSION['name'] === $rows['id']) {
                        echo "<button class='read_btn1' onclick=\"location.href='./modify.php?number=$number'\">수정</button>&nbsp;&nbsp;";
                        echo "<button class='read_btn1' onclick=\"location.href='./delete.php?number=$number'\">삭제</button>";
                    }
                }
                ?>
            </td>
        </tr>
    </table>
</body>

</html>
