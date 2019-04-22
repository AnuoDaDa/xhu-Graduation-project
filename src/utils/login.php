<?php
//引用类
require_once("database.php");
//创建数据类对象
$databaseCon =new database();

$user_name = $_POST["user_name"];
$user_password= $_POST["user_password"];
//if($_POST["checknum"] != $_SESSION["checknum"]){
//    header("Location:topM.php?login_message=checknum_error");
//    return;
//}
//$sql = "select * from users where user_name='$user_name' and user_password ='$user_password'";
$sql = "insert into users values ('$user_name','$user_password')";
$databaseCon->getConnection();
$result_set = mysql_query($sql);
echo $result_set;
//if($identity="游客")
//{header("Location:youke.php");}
$databaseCon->closeConnection();