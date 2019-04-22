<!DOCTYPE html>
<!-- Website template form http://www.cssmoban.com/ -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Movies - 电影分类</title>
    <link rel="stylesheet" href="css/movies.css" type="text/css">
</head>
<body>
<?php include_once("./header.html"); ?>
<div id="body" class="movies">
    <!--标签展示 start-->
    <h2>分类</h2>
    <ul class="tags">
        <li class="parentTags">
            <p>父标签1</p>
            <ul class="childrenTags">
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
            </ul>
        </li>
        <li class="parentTags">
            <p>父标签1</p>
            <ul class="childrenTags">
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
            </ul>
        </li>
        <li class="parentTags">
            <p>父标签1</p>
            <ul class="childrenTags">
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
                <li><a>子标签1</a></li>
            </ul>
        </li>
    </ul>
    <!--标签展示 end-->
    <!--电影展示 start-->
    <h2>Movies</h2>
    <ul class="moviesShow">
        <li>
            <a href="movie-details.html"><img src="images/baby-with-dog2.jpg" alt=""></a>
            <h3>Movie Title</h3>
            <p>
                简介简介简介简介简介
            </p>
            <a href="movie-details.html">Read More</a>
        </li>
        <li>
            <a href="movie-details.html"><img src="images/surfers.jpg" alt=""></a>
            <h3>Movie Title</h3>
            <p>
                简介简介简介简介简介
            </p>
            <a href="movie-details.html">Read More</a>
        </li>
        <li>
            <a href="movie-details.html"><img src="images/soldiers2.jpg" alt=""></a>
            <h3>Movie Title</h3>
            <p>
                简介简介简介简介简介
            </p>
            <a href="movie-details.html">Read More</a>
        </li>
        <li>
            <a href="movie-details.html"><img src="images/ballet-dancer2.jpg" alt=""></a>
            <h3>Movie Title</h3>
            <p>
                简介简介简介简介简介
            </p>
            <a href="movie-details.html">Read More</a>
        </li>
    </ul>

    <!--分页 start-->
    <!--分页 end-->
    <!--电影展示 end-->
</div>
<?php include_once("./footer.html"); ?>
</body>
</html>