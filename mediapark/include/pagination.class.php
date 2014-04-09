<?php
class Pagination extends Db {
	
    public	$pages_count;
    public $page;

	public function __construct(){
		parent::__construct();
	}

	public function pagination() {

		if(!isset($_GET['page'])) $this->page = 1;
		else $this->page = $_GET['page'];

		if (is_numeric($this->page)){
		
		$records_at_page = 12;
		$row = $this->count("id_article","articles"," id_article > 0 ");
		$records_count = $row->rowCount();
		$this->pages_count = (int) ceil($records_count / $records_at_page);
		$start = ($this->page - 1 ) * $records_at_page;
		$end = $records_at_page;
		if($records_count != 0 ){
			$rows = $this->query("*","articles ORDER BY id_article DESC  LIMIT $start,$end  ");
			return $rows;
		}
		}else{
			return false;
		}

	}

	public function pages(){
		 for ($i = 1; $i <= $this->pages_count ; $i++){
            if($i == $this->page)
                echo "<span class='paginationdis' > $i </span>";
          	else 
                echo "<a class='pagination' href=' ?page=". $i ."'>". $i . "</a>";
         }
	} 

}
?>