<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/7 0007
 * Time: 21:05
 */

class doubanData
{
    //页面链接地址
    private $url 	 = '';
    //页面获取内容
    private $content ='';
    //基础链接
    private $baseurl = 'https://movie.douban.com';
    /*页面匹配正则*/
    private static $regArr = array(
        /*电影详情页面匹配正则*/
        'title'          => '/<span\s+property="v:itemreviewed">(.*?)<\/span>/i',
        'poster'         => '/<img\s+src=\s*"(.*?)"\s+title=".*?"\s+alt=".*?"/i',
        'director'       => '/rel="v:directedBy">(.*?)<\/a>/i',
        'release'        => '/<span\s+class="pl">上映日期:<\/span>(.*?)<\/span><br\/>/i',
        'director_url'   => '/<a\s+href="(\S+)"\s+rel="v:directedBy">.*?<\/a>/i',
        'movie_info'     => '/<span\s+property="v:summary"\s+class="">(.*?)</span>/i',
        /*导演详情页面匹配正则*/
        'director_movie' => '/<divclass="info"><ahref="(.*?)"title=.*?class="">.*?<\/a><em>.*?<\/em><\/div>/i',
        'like_movie'     => '/<dt>[\w\W]*?<a\s+href="(.*?)">[\w\W]*?<img\s+class=""\s+alt=".*?"/i',
        /*首页匹配正则*/
        'hotMovies'      => '/<a\s+onclick="moreurl(this, {from:\'mv_a_tl\'})"\s+href="(.*?)"\s+class="">.*?</a>',
    );

    //构造函数
    public function __construct($url){
        $this->url     = $url;
        //获取文本内容
        $this->content = $this->fileGetContent();
        //运行正则进行标签匹配
        $this->runRegAnalysis();
        //获取正在热映的电影
//        $this->getHotMovies();

        $this->runRegAnalysis();
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
        /*简介*/
        $data['movie_info'] = strip_tags($this->getTagContent(self::$regArr['movie_info']));
        /*电影链接*/
        $data['url']     = $this->url;

        $this->objdata[] = $data;
    }

    /*选出热门电影*/
    private function getHotMovies(){
        //获取内容
        $this->content = $this->fileGetContent();
        //清除空格
        $movie = $this->getClearContent()->getAllTagContent(self::$regArr['movie']);

        $value1= $this->parseMovieUrl($this->url);
        foreach ($movie as $key=>$value) {

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