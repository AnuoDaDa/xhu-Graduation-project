<!DOCTYPE html>
<!-- Website template form http://www.cssmoban.com/ -->
<html>
<head>
    <meta charset="UTF-8">
    <title>用户注册-------register </title>
    <link rel="stylesheet" href="css/register.css" type="text/css">
</head>
<body>
<?php include_once("./header.html"); ?>
<div id="body" class="register">
    <div>
        <div>
            <h4>注册</h4>
        </div>
        <form action="index.html">
            <div>
                <label for="username">
                    <span>账号：</span>
                    <input type="text" id="username">
                </label>
                <label for="nickname">
                    <span>昵称：</span>
                    <input type="text" id="nickname">
                </label>
                <label for="password">
                    <span>密码：</span>
                    <input type="password" id="password">
                </label>
                <label for="repassword">
                    <span>确认密码：</span>
                    <input type="password" id="repassword">
                </label>
                <label for="email">
                    <span>邮箱：</span>
                    <input type="email" id="email">
                </label>
                <input type="reset" value="">
                <input type="submit" value="">
            </div>
        </form>
    </div>
</div>
<?php include_once("./footer.html"); ?>
</body>
</html>