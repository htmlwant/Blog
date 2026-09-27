<?php
// logout.php
session_start();
session_unset();
session_destroy();
header("Location: ../login.php"); // 로그인 페이지로 이동
exit();
