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
            database: 'food_delights'          //数据库里面的数据
        });

        //2,连接
        connection.connect();
    }
//遍历食材分类
    this.queryFoodType = function (call) {

        var sql = "select * from food_material";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });

        connection.end();
    }
//遍历三餐
    this.querythreeMeals = function (call) {

        var sql = "select * from three_meals";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }
//遍历面包甜点
    this.querybreadDessert = function (call) {

        var sql = "select * from bread_dessert";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }

    this.queryallFood = function (call) {

        var sql = "select all_food.*,likes.* from all_food,likes where all_food.ch_id=likes.dish_id  ";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }

    this.queryStep = function (call) {

        var sql = "select all_food.ch_id," +
            "all_food.ch_name," +
            "all_food.ch_long_intro," +
            "step.step1," +
            "step.step2," +
            "step.step3," +
            "step.step4," +
            "step.step5," +
            "step.imageKey from all_food,step where all_food.ch_id=step.url_id";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }

    this.querynewFood = function (call) {
        var sql = "select all_food.ch_id," +
            "all_food.ch_name," +
            "all_food.ch_short_intro," +
            "step.imageKey from all_food,step where all_food.ch_id=step.url_id";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }

    this.queryhomeDish = function (call) {
        // select a.* from a inner join b on a.id=b.aid where b.tagname='中国'
        var sql = "select all_food.*,step.* from all_food inner join step on all_food.ch_id=step.url_id where all_food.type='猪牛羊肉'";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }

    this.querybreakFast = function (call) {
        // select a.* from a inner join b on a.id=b.aid where b.tagname='中国'
        var sql = "select all_food.*,step.* from all_food inner join step on all_food.ch_id=step.url_id where all_food.type='早餐'";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }
    //插入用户信息
    this.insertUser = function (nickName,gender,avatarUrl, call) {
        //1,编写sql语句
        var userAddSql = 'INSERT INTO users(user_name,user_gender,user_pic) VALUES(?,?,?)';
        var userAddSql_Params = [nickName,gender,avatarUrl];
        //2,进行插入操作
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
    //遍历食物的类别
    this.queryfoodType = function (call) {
        // select a.* from a inner join b on a.id=b.aid where b.tagname='中国'
        var sql = "select three_meals.type_name from three_meals union " +
            "select food_material.type_name from food_material union select bread_dessert.type_name from bread_dessert";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }
   //插入食物信息
    this.insertFood = function (food_name,food_short_intro,food_long_intro,food_type,imageKey, call) {
        //1,编写sql语句
        var userAddSql = 'INSERT INTO all_food(ch_name,ch_short_intro,ch_long_intro,type,ch_url) VALUES(?,?,?,?,?)';
        var userAddSql_Params = [food_name,food_short_intro,food_long_intro,food_type,imageKey];
        //2,进行插入操作
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
//插入步骤信息
    this.insertFoodStep = function (step1,step2,step3,step4,step5,imageKey, call) {
        //1,编写sql语句
        var userAddSql = 'INSERT INTO step(step1,step2,step3,step4,step5,imageKey) VALUES(?,?,?,?,?,?)';
        var userAddSql_Params = [step1,step2,step3,step4,step5,imageKey];
        //2,进行插入操作
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


    this.queryLikes = function (call) {
        // select a.* from a inner join b on a.id=b.aid where b.tagname='中国'
        var sql = "select all_food.*,likes.* from all_food inner join likes on all_food.ch_id=likes.dish_id";
        connection.query(sql, function (err, result) {
            if (err) {
                console.log('[INSERT ERROR] - ', err.message);
                return;
            }
            call(result);
        });
        connection.end();
    }
//插入喜欢的食物
    this.addLikes = function (user_id,food_id, call) {
        //1,编写sql语句
        var userAddSql = 'INSERT INTO likes(user_id,dish_id) VALUES(?,?)';
        var userAddSql_Params = [user_id,food_id];
        //2,进行插入操作
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

//取消掉自己喜欢的食物
    this.DeleteLikes = function (deleteid, call) {

        // db.execSQL("delete from tb_diary2 where _id in ("+ sb + ")",
        //     (Object[]) ids);
        //更新id，使id大于要删除的id的往前移动一位。
        // db.execSQL("update tb_diary2 set _id=_id-1 where _id > ?",(Object[] )ids);
        //1,编写sql语句
        var userGetSql = "delete from likes where likes.id=" + deleteid;
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

//修改喜欢的食物
    this.UpdateLikes = function (num,id,user, call) {
        //1,编写sql语句UPDATE TableName SET c = 新值 WHERE (a=1 AND b=2)
        var userModSql = "UPDATE likes SET isLike =? WHERE (user_id='" + user +"' AND dish_id="+id+")";
        var userModSql_Params = [num];
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

//取消喜欢的食物
    this.UpdateCancelLikes = function (num,user, call) {
        //1,编写sql语句UPDATE TableName SET c = 新值 WHERE (a=1 AND b=2)
        var userModSql = "UPDATE likes SET isLike =? WHERE (user_id='" + user +"' AND dish_id="+id+")";
        var userModSql_Params = [num];
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