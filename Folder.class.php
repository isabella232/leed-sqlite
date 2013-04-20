<?php

/*
 @nom: Folder
 @auteur: Idleman (idleman@idleman.fr)
 @description: Classe de gestion des dossiers/catégories contenant les flux
 */

class Folder extends SQLiteEntity{

	protected $id,$name,$parent,$isopen;
	protected $TABLE_NAME = 'folder';
	protected $CLASS_NAME = 'Folder';
	protected $object_fields = 
	array(
		'id'=>'key',
		'name'=>'string',
		'parent'=>'integer',
		'isopen'=>'integer'
	);

	function unreadCount(){

	}


	function getEvents($start=0,$limit=10000,$order,$columns='*'){
		$eventManager = new Event();
		$objects = array();
		$results = $this->customQuery('SELECT '.$columns.' FROM event INNER JOIN feed ON (event.feed = feed.id) WHERE event.unread=1 AND feed.folder = '.$this->getId().' ORDER BY '.$order.' LIMIT '.$start.','.$limit);
		
		while($item = $results->fetchArray()){
			$object = new Event();
				foreach($object->getObject_fields() as $field=>$type){
					if(isset($item[$field])) eval('$object->set'.ucFirst($field) .'(html_entity_decode(\''. addslashes($item[$field]).'\'),false);');
				}
				$objects[] = $object;
				unset($object);
		}

		
		return $objects;
	}

	function __construct(){
		parent::__construct();
	}

	function setId($id){
		$this->id = $id;
	}

	function getFeeds(){
		$feedManager = new Feed();
		return $feedManager->loadAll(array('folder'=>$this->getId()),'name');
	}

	function getFolders(){
		$folderManager = new Folder();
		return $folderManager->loadAll(array('parent'=>$this->getId()));
	}


	function getId(){
		return $this->id;
	}

	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
	}

	function getParent(){
		return $this->parent;
	}

	function setParent($parent){
		$this->parent = $parent;
	}

	function getIsopen(){
		return $this->isopen;
	}

	function setIsopen($isopen){
		$this->isopen = $isopen;
	}



}

?>