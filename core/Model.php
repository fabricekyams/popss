<?php
abstract class Model {
	
	static $connection = array();
	
	private $conf;
	private $db;
	
	/**
	 * 
	 * @param string $conf
	 */
	public function __construct($conf = 'default')
	{
		$this->conf = $conf;
		$this->connectToDB();
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function connectToDB(){

		/*if (isset(Model::$connection[$this->conf])){
			$this->db=Model::$connection[$this->conf];
			return true;
		}
		
		$conf = Conf::$database[$this->conf];
		try {
			$pdo = new PDO(
					'mysql:host='.$conf['host'].';dbname='.$conf['database'].'',
					$conf['user'],
					$conf['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			Model::$connection[$this->conf]= $pdo;
			$this->db= $pdo;
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}catch (PDOException $e){
			echo 'impossble de se connecter à la db';
			//echo $e->getMessage();
			die();
		}*/
	}
	
	/**
	 * 
	 * @param unknown $k
	 * @param unknown $v
	 * @param string $field
	 * @return mixed
	 */
	
	public function findOneById($k, $v,$field = '*'){
		$field = $this->implodeField($field);
		$v = $this->db->quote($v);
		$query = 'SELECT '.$field.' FROM '.$this->getTable().' WHERE '.$k.'='.$v;
		$select=$this->db->query($query)->fetch();
		return $select;
	}
	
	/**
	 * 
	 * @param string $field
	 * @return multitype:
	 */
	public function findAll($field = '*'){
		$field = $this->implodeField($field);
		$query = 'SELECT '.$field.' FROM '.$this->getTable();
		return $this->db->query($query)->fetchAll();
	}
	
	/**
	 * 
	 * @param unknown $query
	 * @return multitype:
	 */
	
	public function find($query){
		return $this->db->query($query)->fetchAll();
	}
	
	public function findOne($query){
		$res = $this->db->query($query);
		if($res){
			$result = $res->fetch();
		}
		return $result;
		
	}
	
	/**
	 * 
	 * @param unknown $cond
	 * @param string $field
	 * @return multitype:
	 */
	public function findCond($cond, $field='*'){
		$field = $this->implodeField($field);
		$cond = $this->implodeCond($cond);
		$query = 'SELECT '.$field.' FROM '.$this->getTable().' WHERE '.$cond;
		return $this->db->query($query)->fetchAll();
		
	}
	
	public function Auth($user, $pass){
		$query = 'SELECT * FROM '.$this->getTable().' WHERE username="'.$user.'" AND password ="'.$pass.'"';
			$res = $this->db->query($query);
			if ($res->rowCount()>0){
				return $res->fetch();
			}
			return false;
	}
	
	public function deleteById($id){
		$query = "DELETE FROM ".$this->getTable().' WHERE id='.$id;
		$this->db->query($query);
	}	

	public function insert($field, $values){
		$field = $this->implodeField($field);
		$values = $this->implodeValues($values);
		$query = 'INSERT INTO message ('.$field.')Values('.$values.')';
		$this->query($query);
			
		
	}
	
	public function query($query){
		return $this->db->query($query);
	}
	/*
	 * 
	 */
	public function lastInsertId(){
		return $this->db->lastInsertId();
	}
	
	private function implodeField($field){
		if (is_array($field)){
			$field =  implode(', ',$field);
		}
		return $field;
	}
	private function implodeValues($values){
		for ($i=0;$i<count($values);$i++){
			$values[$i]= $this->db->quote($values[$i]);
		}
		if (is_array($values)){
			$values =  implode(', ',$values);
		}
		return $values;
	}
	
	/*
	 * 
	 */
	
	private function implodeCond($cond){
		if (is_array($cond)){
			$cond =  implode(' AND ',$cond);
		}
		return $cond;
	}
	
	/**
	 * 
	 */
	public function getdB() {
		return $this->bd;
	}
	
	/**
	 * 
	 * @param unknown $db
	 * @return Model
	 */
	public function setdB($db) {
		$this->db = $db;
		return $this;
	}
	
	
	
}