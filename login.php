<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <form action="login_db.php" method="post">
            <div class="login">
                <div class="box_shadow">
                <h1><a href="login.php">Login</a></h1>
                <?php if(isset($_GET['error'])) { ?>
                    <p class="error"> <?php echo $_GET['error']; ?> </p>
                <?php } ?>
                <div class="login_box">
                    <div class="username"><input type="text" name="user_id" class="username" placeholder="아이디를 입력하세요">
                    <div class="password"><input type="password" name="user_pw" class="password" placeholder="패스워드를 입력하세요">
                </div>
                <div class="register_help">
                    <button type="submit" class="login_button">로그인</button>
                    <span class="submit"><a href="submit/submit.php"><p>회원가입</p></span>  
                </div>     
                </div> 
            </div>
        </form>    
    </body>
</html> 