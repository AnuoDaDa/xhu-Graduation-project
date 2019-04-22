<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 20:48
 */

class database
{
    public $databaseConnection = null;
    public function getConnection(){
        $hostname = "localhost";
        $database = "recommendfilms";
        $userName = "root";
        $password = "";
        global $databaseConnection;
        $databaseConnection = @mysql_connect($hostname, $userName, $password) or die(mysql_error());
        if($databaseConnection){
            echo "数据源链接成功";
        }
        mysql_query("set names 'gbk'");
        mysql_select_db($database,$databaseConnection) or die(mysql_error());

    }
    public function closeConnection(){
        global $databaseConnection;
        if($databaseConnection){
            mysql_close($databaseConnection) or die(mysql_error());
        }
    }
}