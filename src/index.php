<?php
include_once("common/index.php");
header('Content-type:text/html;charset=utf8;');
// 调用类
$douban = new index('https://movie.douban.com');
//输出结果
$hotMovies= $douban->output();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>电影推荐</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

    <?php include_once("./header.html"); ?>
	<!--首页主体-->
	<div id="body" class="home">
		<!--电影推荐 banner start-->
		<div>
			<div>
				<a href='movie-details.php?url=<?php echo $hotMovies[0]['url']; ?>' class="indexImg"><img  src="<?php echo $hotMovies[0]['poster']; ?>" alt=""></a>
				<h2><a href="movies.php"><?php echo $hotMovies[0]['title']; ?></a></h2>
				<p>
                    评分：<?php echo $hotMovies[0]['score']; ?>
				</p>
				<a href="movies.php">电影连接</a>
			</div>
			<ul>
                <?php
                array_shift($hotMovies);
                foreach ($hotMovies as $value) {
                ?>
				<li class="bannerImg">
					<h3 class="bannerTitle"><?php echo $value['title']; ?></h3>
					<span>评分：<?php echo $value['score']; ?></span>
                    <a class="sample" href='movie_detials.php?url=<?php echo $value['url']; ?>' >
                        <img class="sampleImg" height="486px" src="<?php echo $value['poster']; ?>" alt="">
                    </a>
				</li>
                <?php } ?>
			</ul>
		</div>
		<!--电影推荐 banner end-->
		<div>
			<!--猜你喜欢 start-->
			<div>
				<h3><a href="rentals.php">猜你喜欢</a></h3>
				<ul>
					<li>
						<a href="rentals.php"><img src="images/conference.jpg" alt=""></a>
						<h4>电影名称</h4>
						<p>
							简介
						</p>
					</li>
					<li>
						<a href="rentals.php"><img src="images/cinema.jpg" alt=""></a>
						<h4>电影名称</h4>
						<p>
                            简介
						</p>
					</li>
				</ul>
			</div>
			<!--猜你喜欢 end-->
			<!--电影评论 start-->
			<div>
				<h3><a href="logs.php">精彩评论</a></h3>
				<ul>
					<li>
						<a href="logs.php"><img src="images/trainor.jpg" alt=""></a>
						<div>
<!--							<span>Posted on August 8, 2023 by Admin</span>-->
							<h4>影名</h4>
							<p>
								评论 <a href="logs.php" class="more">详情</a>
							</p>
						</div>
					</li>
					<li>
						<a href="logs.php"><img src="images/lava.jpg" alt=""></a>
						<div>
<!--							<span>Posted on August 8, 2023 by Admin</span>-->
							<h4>影名</h4>
							<p>
                                评论 <a href="logs.php" class="more">详情</a>
							</p>
						</div>
					</li>
					<li>
						<a href="logs.php"><img src="images/castle.jpg" alt=""></a>
						<div>
<!--							<span>Posted on August 8, 2023 by Admin</span>-->
							<h4>影名</h4>
							<p>
                                评论. <a href="logs.php" class="more">详情</a>
							</p>
						</div>
					</li>
				</ul>
			</div>
			<!--电影评论 end-->
		</div>
	</div>
    <?php include_once("./footer.html"); ?>
</body>
</html>