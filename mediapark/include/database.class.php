<?php
class Db {

	private $host = "127.0.0.1";
	private $username  = "root";
	private  $password = "";
	private $database = "mediapark";
	protected $_query;
	protected $db;

	public  function __construct ($host = null,$username = null ,$password = null ,$database = null ) {

		if ($host != null){
			$this->host     = $host;
			$this->username	= $username;
			$this->password	= $password;
			$this->database	= $database;
		}
		try{
			$this->db = new PDO("mysql:host=".$this->host .";dbname=".$this->database, $this->username, $this->password,
			array (
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
			)
			);
		}catch(PDOException $e){
			echo ($e->getMessage());
		}
	}


	/**
	*	The query Function , its used to query the database !
	*	@param string $select the colums that wil be selected.
	*	@param string $table the name of table to select from.
	*	@param string $where the condition to select with.
	*	@return object of data .
	*/

	public function query ($select,$table,$where=null,$data = array()){
		if ($where != null){
			$this->_query = "SELECT $select FROM $table WHERE $where";
		}else {
			$this->_query = "SELECT $select FROM $table ";
		}
		$stmt =  $this->db->prepare($this->_query);
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function __query($select,$query,$data = array()){
		$this->_query = "SELECT $select FROM $query ";
		$stmt =  $this->db->prepare($this->_query);
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	*	insert function , it can insert data on the database with two parameters !
	*	@param string $table The name of the database table to work with.
	*	@param string $value The Values To insert on the Database .
	*/

	public function insert ($table,$value){
		$this->_query = "INSERT INTO $table VALUE ".$value." ";
		$stmt =  $this->db->prepare($this->_query);
		$stmt->execute();
		$id = $this->db->lastInsertId();
		return $id;
	}

	/**
	*	The Count Function , it returns the number of rows that agree with the query !
	*	@param string $select the colums that wil be selected.
	*	@param string $table the name of table to select from.
	*	@param string $where the condition to select with.
	*	@return object.
	*/

	public function count($select,$table,$where=null){
		if ($where != null){
			$this->_query = "SELECT $select FROM $table WHERE $where";
	    }else{
	    	$this->_query = "SELECT $select FROM $table";
	    }
	    $stmt =  $this->db->prepare($this->_query);
		$stmt->execute();
		return $stmt;
	}

	/**
	*	The Delete Function , it used to delete rows from a table !
	*	@param string $table the table to delete from.
	*	@param string $where the condition to select with.
	*/

	public function delete($table,$where){
		$this->_query = "DELETE FROM $table WHERE $where ";
		$stmt =  $this->db->prepare($this->_query);
		$stmt->execute();
	}

	/**
	*	The Update Function , it updates rows of a table !
	*	@param string $table the table to delete from.
	*	@param string $set attributs to set.
	*	@param string $where the condition to select with.
	*/

	public function update($table,$set,$where,$data = array()){
		$this->_query = "UPDATE $table SET $set WHERE $where ";
		$stmt = $this->db->prepare($this->_query);
		$stmt->execute($data);
	}
}

?>