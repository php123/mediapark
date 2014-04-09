<?php
		
		class Article {
		private $DB;
			public function __construct($db){
				$this->DB = $db;
			}
			public function searchArticle($search){
				$row = $this->DB->query(" * "," articles ", " title LIKE :search ", array("search" => "%".$search."%")); 
				if(empty($row)){
					return false;
				}else{
					return $row;
				}
			}
		}
		
?>