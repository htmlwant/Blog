<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="write">
        <div class="write_box">
            <?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'asd7517162', 'submit');
                if (!$connect) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                // 로그인 상태일 때 사용자 ID와 로그아웃 버튼 표시
                if (isset($_SESSION['name'])) {
                    echo "<div class='login-info'>";
                    echo "<strong>" . htmlspecialchars($_SESSION['name']). "</strong> ";
                    echo "<a href='logout.php' style='color: black;'>로그아웃</a>";
                    echo "</div>";
                }

                // 한 페이지에 보여줄 게시글 수 설정
                $posts_per_page = 10;

                // 현재 페이지 번호를 가져옴
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start_from = ($page - 1) * $posts_per_page;

                // 게시글 목록 가져오기 (LIMIT 추가)
                $query = "SELECT * FROM board ORDER BY number DESC LIMIT $start_from, $posts_per_page";
                $result = mysqli_query($connect, $query);

                // 총 게시글 수를 구함
                $total_query = "SELECT COUNT(*) FROM board";
                $total_result = mysqli_query($connect, $total_query);
                $total_row = mysqli_fetch_array($total_result);
                $total_posts = $total_row[0];

                // 총 페이지 수 계산
                $total_pages = ceil($total_posts / $posts_per_page);
            ?>

            <p style="font-size:25px; text-align:center"><b>게시판</b></p>
            <div class="write_content">
                <table align="center">
                    <thead align="center">
                    <tr>
                        <td width="50" align="center">번호</td>
                        <td width="500" align="center">제목</td>
                        <td width="100" align="center">작성자</td>
                        <td width="200" align="center">날짜</td>
                        <td width="50" align="center">조회수</td>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            // 게시글 출력
                            while ($rows = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td width='50' align='center'>" . $rows['number'] . "</td>";
                                echo "<td width='500' align='center'><a href='read.php?number=" . $rows['number'] . "'>" . $rows['title'] . "</a></td>";
                                echo "<td width='100' align='center'>" . $rows['id'] . "</td>";
                                echo "<td width='200' align='center'>" . $rows['date'] . "</td>";
                                echo "<td width='50' align='center'>" . $rows['hit'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- 페이지네이션 -->
            <div class="pagination">
                <?php
                    // 페이지 번호 출력
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='main.php?page=" . $i . "'>" . $i . "</a> ";
                    }
                ?>
            </div>

            <div class="text">
                <font style="cursor: hand" onClick="location.href='write/write.php'">글쓰기</font>
            </div>
        </div>
    </div>
</body>
</html>
