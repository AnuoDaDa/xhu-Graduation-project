function ImageUtil() {
    var connection;
    this.init = function () {
        var mysql = require('mysql');  //调用MySQL模块

        //1，创建一个connection
        connection = mysql.createConnection({
            host: 'localhost',       //主机 ip
            user: 'root',            //MySQL认证用户名
            password: 'root',                //MySQL认证用户密码
            port: '3306',                 //端口号
            database: 'qq_music'          //数据库里面的数据
        });

        //2,连接
        connection.connect();
    }

    //1 遍历电子产品
    this.queryMusic = function (call) {

        var sql = "select song_list.song_id," +
            "song_list.song_name," +
            "song_list.song_singer," +
            "song_list.song_album," +
            "song_list.song_time," +
            "song_list.song_mp3," +
            "song_list.song_image," +
            "song_type.type_image from song_list,song_type where song_list.song_image=song_type.type_id";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        // 5,连接结束
        connection.end();
    }
    //插入音乐

    this.insertMusic = function (QQsongname, QQsongsinger, QQsongalbum, QQsongtime, QQsongimage, QQsongmp3, call) {
        //1,编写sql语句
        var userAddSql = 'INSERT INTO song_list(song_name,song_singer,song_album,song_time,song_image,song_mp3,song_like) VALUES(?,?,?,?,?,?,?)';
        var userAddSql_Params = [QQsongname, QQsongsinger, QQsongalbum, QQsongtime, QQsongimage, QQsongmp3,"play_like"];
        //2,进行插入操作
        /**
         *query，mysql语句执行的方法
         * 1，userAddSql编写的sql语句
         * 2，userAddSql_Params，sql语句中的值
         * 3，function (err, result)，回调函数，err当执行错误时，回传一个err值，当执行成功时，传回result
         */
        connection.query(userAddSql, userAddSql_Params, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call();
        });
        //5,连接结束
        connection.end();
    }

    //删除音乐
    this.deleteMusic = function (deleteid, call) {

        // db.execSQL("delete from tb_diary2 where _id in ("+ sb + ")",
        //     (Object[]) ids);
        //更新id，使id大于要删除的id的往前移动一位。
        // db.execSQL("update tb_diary2 set _id=_id-1 where _id > ?",(Object[] )ids);
        //1,编写sql语句
        var userGetSql = "delete from song_list where song_list.song_id=" + deleteid;
        //2,进行删除操作
        connection.query(userGetSql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call();
        });
        //5,连接结束
        connection.end();
    }


    //修改电子产品
    this.updateMusic = function (id, QQsong_name, QQsong_singer, QQsong_album, QQsong_time, QQsong_image, call) {
        //1,编写sql语句
        var userModSql = 'UPDATE song_list SET song_name = ?,song_singer = ?,song_album = ?,song_time = ?,song_image = ? WHERE song_id=' + id;
        var userModSql_Params = [QQsong_name, QQsong_singer, QQsong_album, QQsong_time, QQsong_image];
        // console.log(id);
//5，更新操作
        connection.query(userModSql, userModSql_Params, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call();
        });
        //5,连接结束
        connection.end();
    }
}
  module.exports = ImageUtil;