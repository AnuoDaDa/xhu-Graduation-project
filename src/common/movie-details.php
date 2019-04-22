<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15 0015
 * Time: 20:28
 */


class movie_details
{
    //页面链接地址
    private $url 	 = '';
    //页面获取内容
    private $content ='';
    //热门电影数据
    private $movieData=[];
    //基础链接
    private $baseurl = 'https://movie.douban.com';
    /*页面匹配正则*/
    private static $regArr = array(
        'title'          => '/<span\s+property="v:itemreviewed">(.*?)<\/span>/i',
        'poster'         => '/<img\s+src=\s*"(.*?)"\s+title=".*?"\s+alt=".*?"/i',
        'director'       => '/rel="v:directedBy">(.*?)<\/a>/i',
        'release'        => '/<span\s+class="pl">上映日期:<\/span>(.*?)<\/span><br\/>/i',
        'movie_info'     => '/<span\s+property="v:summary"\s+class="">(.*?)<\/span>/is',
        'score'          =>'/<strong\s+class=".*?"\s+property="v:average">(.*?)<\/strong>/i',
        'hot_movies'     =>'/<liclass="title"><aonclick=".*?"href="(.*?)"class="">.*?<\/a><\/li>/i',
        'runtime'        =>'/<span\s+property="v:runtime"\s+content="100">(.*?)<\/span>/i',

    );

    //构造函数
    public function __construct($url){
        $this->url     = $url;
        //获取文本内容
        $this->content = $this->fileGetContent();
        //进行正则匹配
        $this->runRegAnalysis();
//        print_r($this->movieData);
    }

    //输出数据
    public function output(){
        return $this->movieData;
    }


    /*运行正则进行分析*/
    private function runRegAnalysis(){
        /*电影名*/
        $data['title']   = $this->getTagContent(self::$regArr['title']);
        /*电影logo*/
        $data['poster']  = $this->getTagContent(self::$regArr['poster']);
        /*导演*/
        $data['director']= $this->getTagContent(self::$regArr['director']);
        /*编剧*/
        $data['runtime']= $this->getTagContent(self::$regArr['runtime']);
        /*上映时间*/
        $data['release'] = strip_tags($this->getTagContent(self::$regArr['release']));
        /*简介*/
        $data['movie_info'] = $this->getAllTagContent(self::$regArr['movie_info']);
        /*评分*/
        $data['score'] = $this->getTagContent(self::$regArr['score']);
        /*电影链接*/
        $data['url'] = $this->url;

        $this->movieData[] = $data;
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