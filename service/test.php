<?php
	/*
		本示例只是根据导演选择的电影,拓展思路可根据编剧、根据豆瓣默认推荐、根据观看这部电影的用户进行类似爬虫采集。
	*/
	header('Content-type:text/html;charset=utf8;');
	class douban{
		//页面链接地址
		private $url 	 = '';
		//页面获取内容
		private $content ='';
		//基础链接
		private $baseurl = 'https://movie.douban.com';
		/*页面匹配正则*/
		private static $regArr = array(
			'title'          => '/<span\s+property="v:itemreviewed">(.*?)<\/span>/i',
			'poster'         => '/<img\s+src=\s*"(.*?)"\s+title=".*?"\s+alt=".*?"/i',
			'director'       => '/rel="v:directedBy">(.*?)<\/a>/i',
			'release'        => '/<span\s+class="pl">上映日期:<\/span>(.*?)<\/span><br\/>/i',
			'director_url'   => '/<a\s+href="(\S+)"\s+rel="v:directedBy">.*?<\/a>/i',
			'director_movie' => '/<divclass="info"><ahref="(.*?)"title=.*?class="">.*?<\/a><em>.*?<\/em><\/div>/i',
			'like_movie'     => '/<dt>[\w\W]*?<a\s+href="(.*?)">[\w\W]*?<img\s+class=""\s+alt=".*?"/i'
		);
		public function __construct($url){
			$this->url     = $url;
			//获取文本内容
			$this->content = $this->fileGetContent();
			//运行正则进行标签匹配
			$this->runRegAnalysis();
			//获取推荐的电影(根据导演)
			$this->getDirectorHotMovie();
			//根据编剧
			//根据豆瓣默认推荐
			//根据观看这部电影的用户
		}
		//输出数据
		public function output(){
			return $this->objdata;
		}
		/*运行正则进行分析*/
		private function runRegAnalysis(){
			/*电影名*/
			$data['title']   = $this->getTagContent(self::$regArr['title']);
			/*电影logo*/
			$data['poster']  = $this->getTagContent(self::$regArr['poster']);
			/*导演*/
			$data['director']= $this->getTagContent(self::$regArr['director']);
		 	/*上映时间*/
		 	$data['release'] = strip_tags($this->getTagContent(self::$regArr['release']));
		 	/*电影链接*/
		 	$data['url']     = $this->url;
		 	$this->objdata[] = $data;
		}
		/*选出关于导演的电影*/
		private function getDirectorHotMovie(){
			// 获取电影名
			$director_url  = $this->getTagContent(self::$regArr['director_url']);
			$oldUrl = $this->url;
			//拼接电影地址
			$this->url     = $this->baseurl.$director_url;
			//获取内容
			$this->content = $this->fileGetContent();
			//清除空格
			$movie = $this->getClearContent()->getAllTagContent(self::$regArr['director_movie']);
			$value1= $this->parseMovieUrl($oldUrl);
			foreach ($movie as $key=>$value) {
				//如果个数超过4个退出
				if(count($this->objdata)>3) break;
				/*验证导演里面电影和原链接是否相同*/
				$value2 = $this->parseMovieUrl($value);
				if($value1==$value2)
					continue;
				/*循环获取内容、匹配*/
				$this->url     = $value;
			 	$this->content = $this->fileGetContent();
			 	$this->runRegAnalysis();
			}
		}

		/*分析是否是当前url这部电影*/
		private function parseMovieUrl($value){
			$value = explode('/',rtrim($value,'/'));
			return  array_pop($value);
		}
		/*去除所有空格*/
		private function getClearContent(){
			$search = array(" ","　","\n","\r","\t");
			$this->content = str_replace($search, "", $this->content);
			return $this;
		}
		/*正则*/
		private function getTagContent($reg){
			preg_match($reg, $this->content,$data);
			return empty($data[1])?'':$data[1];
		}
		/*获取所有的标签*/
		private function getAllTagContent($reg){
			preg_match_all($reg, $this->content,$data);
			return $data[1];
		}
		/*获取豆瓣的指定内容*/
		private function fileGetContent(){
			$content  = file_get_contents($this->url);
			return $content;
		}
	}
	// 调用类
	$douban = new douban('https://movie.douban.com/subject/3642843/');
	//输出结果
	$objdata = $douban->output();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'/>
	<title></title>
	<style type="text/css">
		*{margin:0;padding:0;}
		table{
			width:850px;
			margin:40px auto;
			border-collapse: collapse;
			text-align: center;
		}
		table tr td{
			border:1px solid red;
			padding:8px 12px;
		}
		table tr:nth-of-type(2n){
			background:#eee;
		}
		#objdata{
			margin:40px auto;
			width:500px;
			height:150px;
		 	border:1px solid red;
		 	padding:10px;
		 	background:#eee;
		}
		#objdata img{
			width:100px;
			height:150px;
		}
		#objdata li {
			list-style-type: none;
			height:40px;
			line-height:40px;
			text-indent:20px;
		}
		#porter{
			float:left;
		}
		tr td img{
			width:60px;height:60px;
		}
	</style>
</head>
<body>

	<div id="objdata">
		<div id="porter">
			<img src="<?php echo $objdata[0]['poster'] ?>">
		</div>
		<ul>
			<li>电影名称: <?php echo $objdata[0]['title']; ?></li>
			<li>导演: <?php echo $objdata[0]['director']; ?> </li>
			<li>上映时间: <?php echo $objdata[0]['release']; ?></li>
		</ul>
	</div>

	<table>
		<tr>
			<td>电影名称</td>
			<td>海报</td>
			<td>导演</td>
			<td>上映时间</td>
			<td>链接</td>
		</tr>

		<?php
			array_shift($objdata);
			foreach ($objdata as $value) {
		?>
			<tr>
				<td><?php echo $value['title']; ?></td>
				<td><img src="<?php echo $value['poster']; ?>"></td>
				<td><?php echo $value['director']; ?></td>
				<td><?php echo $value['release']; ?></td>
				<td><a href="<?php echo $value['url']; ?>"><?php echo $value['title']; ?></a></td>
			</tr>
		<?php } ?>

	</table>


</body>
</html>