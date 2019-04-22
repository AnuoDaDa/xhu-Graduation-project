<?php
include_once("common/movie-details.php");
header('Content-type:text/html;charset=utf8;');
//获取传过来的地址
$url = $_GET["url"];
// 调用类
$douban = new movie_details($url);
//输出结果
$movieData= $douban->output();
?>
<!DOCTYPE html>
<!-- Website template form http://www.cssmoban.com/ -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Movie</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<?php include_once("./header.html"); ?>
	<div id="body" class="movies">
		<h2><?php echo $movieData[0]['title']; ?></h2>
		<img class="movieImage" src="<?php echo $movieData[0]['poster']; ?>" alt="">
		<div>
			<h3>简介</h3>
			<p>
                <?php echo $movieData[0]['movie_info'][0]; ?>
            </p>
		</div>
		<div class="section">
			<h3>详情</h3>
            <p>
                <span class="titles">影名:</span>
                <span><?php echo $movieData[0]['title']; ?></span></p>
			<p>
				<span class="titles">导演:</span>
				<span><?php echo $movieData[0]['director']; ?></span>
			</p>
			<p>
				<span class="titles">上映时间:</span>
				<span><?php echo $movieData[0]['release']; ?></span>
			</p>
			<p>
				<span class="titles">时长:</span>
				<span><?php echo $movieData[0]['runtime']; ?></span>
			</p>
			<p>
				<span class="titles">评分:</span>
				<span><?php echo $movieData[0]['score']; ?></span>
            </p>
		</div>
	</div>
    <?php include_once("./footer.html"); ?>
</body>
</html>