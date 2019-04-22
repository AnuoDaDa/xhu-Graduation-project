<!DOCTYPE html>
<!-- Website template form http://www.cssmoban.com/ -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Blog - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<?php include_once("./header.html"); ?>
	<div id="body" class="log-single">
		<div>
			<!--日志内容 start-->
			<img src="images/trainor3.jpg" alt="">
			<div>
				<h4>日志1</h4>
				<span>时间：</span>
			</div>
			<p>
                内容
            </p>
			<p>
                内容
            </p>
			<!--日志内容 end-->
			<!--评论和恢复 start-->
			<div class="comment">
				<span>1 评论</span>
				<p>
					<img src="images/user.jpg" alt=""> <span>3.3, 2019  3:25 pm </span> 内容
				</p>
				<a href="#">回复</a>
			</div>
			<form action="index.html">
				<div>
					<label for="comment">回复</label>
					<textarea name="comment" id="comment" cols="30" rows="10"></textarea>
					<input type="submit" value="">
				</div>
			</form>
			<!--评论和恢复 end-->
		</div>
		<div>
			<div>
				<h4>日志列表</h4>
				<ul>
					<li>
						<h5>日志名称</h5>
						<p>
							简介
						</p>
						<a href="#">Read More</a>
					</li>
					<li>
						<h5>日志名称</h5>
						<p>
							简介
						</p>
						<a href="#">Read More</a>
					</li>
					<li>
						<h5>日志名称</h5>
						<p>
							简介
						</p>
						<a href="#">Read More</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php include_once("./footer.html"); ?>
</body>
</html>