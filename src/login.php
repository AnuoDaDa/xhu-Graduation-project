<?php

?>
<!DOCTYPE html>
<!-- Website template form http://www.cssmoban.com/ -->
<html>
<head>
    <meta charset="UTF-8">
    <title>login------请登录</title>
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="css/register.css" type="text/css">
</head>
<body>
<?php include_once("./header.html"); ?>
<div id="body" class="register">
    <div>
        <div>
            <h4>登录</h4>
        </div>
        <form action="index.html">
            <div>
                <label for="name">
                    <span>账号：</span>
                    <input type="text" id="name">
                </label>

                <label for="password">
                    <span>密码：</span>
                    <input type="password" id="password">
                </label>

                <label for="remember-psw" class="remember-psw">
                    <input type="checkbox" id="remember-psw">
                    <span>记住密码</span>
                </label>

                <input type="reset" value="">
                <input type="submit" value="">

                <a class="no-register">还没注册？</a>
                <a class="no-password">忘记密码？</a>
            </div>
        </form>
    </div>

</div>
<?php include_once("./footer.html"); ?>
</body>
</html>