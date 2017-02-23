<?php

/**
 * Created by PhpStorm.
 * User: Sebastian Erb
 * Date: 22.02.17
 * Time: 19:06
 */

class AjaxInstagram {

    private $baseUrl = 'https://www.instagram.com/explore/tags/###HASHTAG###/?__a=1';
    private $hashtags = array();

    private $images = array();
    private $json;
	private $template;

    public $jsonFile;
	

    function __construct() {
        $this->jsonFile = $_SERVER['DOCUMENT_ROOT'] . "/cron/hashtaglist.json";
		$this->template = $_SERVER['DOCUMENT_ROOT'] . "/templates/InstaBox.php";
    }

    public function addHashtag(Hashtag $__hashtag) {

        array_push($this->hashtags, $__hashtag);

    }

    public function getData() {

        foreach($this->hashtags as $hashtag){
            $this->getHastag($hashtag);
        }

        $this->json = json_encode($this->images);

    }

    public function saveFile() {
        file_put_contents($this->jsonFile, $this->json);
    }
	
	public function showImages($__showImages) {
		
		if($__showImages==0)
			return;
		
		if(file_exists($this->jsonFile)){

		    $jsonString = file_get_contents($this->jsonFile);
		    $json = json_decode($jsonString);

		    $sortedArray = array();

		    foreach($json AS $image){
		        $sortedArray[$image->date] = $image;
		    }

		    $i = 0;

		    foreach($sortedArray as $currentImg){

		        if($i++ >= $showImages)
		            break;

		        include($this->template);

		    }
		}
		
		echo "<script async defer src=\"//platform.instagram.com/en_US/embeds.js\"></script>";
		
	}

    private function getHastag(Hashtag $__tag) {

        $url = str_replace("###HASHTAG###", $__tag->hashtag, $this->baseUrl);

        $json = json_decode(file_get_contents($url));

        $nodeList = $json->tag->media->nodes;

        $j = 0;

        for($i=0; $i<$__tag->count; $j++){

            $node = $nodeList[$j];

            if($node->is_video == 1)
                continue;

            #echo "<pre>".print_r($node,true)."</pre>";
            $image = new Image();
            $image->code = $node->code;
            $image->thumbnail = $node->thumbnail_src;
            $image->image = $node->display_src;
            $image->likes = $node->likes->count;
            $image->comments = $node->comments->count;
            $image->id = $node->id;
            $image->caption = $node->caption;
            $image->date = $node->date;
            $image->date = $node->date;
            $image->hashtag = $__tag->hashtag;

            array_push($this->images, $image);

            $i++;

        }

    }

}

class Image
{
    public $code;

    public $thumbnail;
    public $image;
    public $likes;
    public $comments;
    public $id;

    public $caption;
    public $date;
    public $hashtag;

}

class Hashtag
{
    public $hashtag;
    public $count;

    public $jsonNode;

    function __construct($__hashtag, $__count) {

        $this->hashtag = $__hashtag;
        $this->count = $__count;

    }
}