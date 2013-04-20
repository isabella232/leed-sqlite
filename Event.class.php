<?php

/*
 @nom: Event
 @auteur: Idleman (idleman@idleman.fr)
 @description: Classe de gestion des évenements/news liés a chaques flux RSS/ATOM
 */

class Event extends SQLiteEntity{

	protected $id,$title,$guid,$content,$description,$pudate,$link,$feed,$category,$creator,$unread,$favorite;
	protected $TABLE_NAME = 'event';
	protected $CLASS_NAME = 'Event';
	protected $object_fields = 
	array(
		'id'=>'key',
		'guid'=>'longstring',
		'title'=>'string',
		'creator'=>'string',
		'content'=>'longstring',
		'description'=>'longstring',
		'link'=>'longstring',
		'unread'=>'integer',
		'feed'=>'integer',
		'unread'=>'integer',
		'favorite'=>'integer',
		'pubdate'=>'integer'
	);

	function __construct($guid=null,$title=null,$description=null,$content=null,$pubdate=null,$link=null,$category=null,$creator=null){
		
		$this->guid = $guid;
		$this->title = $title;
		$this->creator = $creator;
		$this->content = $content;
		$this->description = $description;
		$this->pubdate = $pubdate;
		$this->link = $link;
		$this->category = $category;
		parent::__construct();
	}


	function getEventCountPerFolder(){
		$events = array();
		$results = $this->customQuery('SELECT COUNT('.$this->TABLE_NAME.'.id),folder.id FROM '.$this->TABLE_NAME.' INNER JOIN feed ON (event.feed = feed.id) INNER JOIN folder ON (folder.id = feed.folder) WHERE '.$this->TABLE_NAME.'.unread=1 GROUP BY folder.id');
		
		while($item = $results->fetchArray()){
			$events[$item[1]] = $item[0];
		}
		
		return $events;
	}

	function setId($id){
		$this->id = $id;
	}

	function getCreator(){
		return $this->creator;
	}

	function setCreator($creator){
		$this->creator = $creator;
	}

	function getCategory(){
		return $this->category;
	}

	function setCategory($category){
		$this->category = $category;
	}

	function getDescription(){
		// return utf8_encode($this->description);
		return $this->description;
	}

	function setDescription($description,$encoding = true){
		$this->description =  str_replace('’','\'',$description);
		if($encoding)$this->description = utf8_decode($this->description);
	}

	function getPubdate($format=false){
		if($this->pubdate!=0){
		return ($format!=false?date($format,$this->pubdate):$this->pubdate);
		}else{
			return '';
		}
	}

	function getPubdateWithInstant($instant){
		$alpha = $instant - $this->pubdate;
		if ($alpha < 86400 ){
			$hour = floor($alpha/3600);
			$alpha = ($hour!=0?$alpha-($hour*3600):$alpha);
			$minuts = floor($alpha/60);
			return 'il y a '.($hour!=0?$hour.'h et':'').' '.$minuts.'min';
		}else{
			return 'le '.$this->getPubdate('d/m/Y à H:i:s');
		}
	}

	function setPubdate($pubdate){
		$this->pubdate = strtotime($pubdate);
	}

	function getLink(){
		return $this->link;
	}

	function setLink($link){
		$this->link = $link;
	}

	function getId(){
		return $this->id;
	}

	function getTitle(){
		return $this->title;
	}

	function setTitle($title){
		$this->title = $title;
	}

	function getContent(){
		//return utf8_encode($this->content);
		return $this->content;
	}

	function setContent($content,$encoding=true){
		$this->content = str_replace('’','\'',$content);
		if($encoding)$this->content = utf8_decode($this->content);
	}


	function getGuid(){
		return $this->guid;
	}

	function setGuid($guid){
		$this->guid = $guid;
	}

	function getUnread(){
		return $this->unread;
	}

	function setUnread($unread){
		$this->unread = $unread;
	}
	function setFeed($feed){
		$this->feed = $feed;
	}
	function getFeed(){
		return $this->feed;
	}
	function setFavorite($favorite){
		$this->favorite = $favorite;
	}
	function getFavorite(){
		return $this->favorite;
	}

}

?>