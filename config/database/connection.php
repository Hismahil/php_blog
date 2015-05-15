<?php

class Connection {

	private $db;

	public function connect($str_connection, $user, $passwd){
		try{
			$this->db = new ConnectionFatory($str_connection, $user, $passwd, array(PDO::ATTR_PERSISTENT => true);
		} catch(PDOException $e){
			print "Error: ".$e.getMessage()."<br/>";
			return false;
		}
		return true;
	}

	public function close(){
		try{
			$this->db = null;	
		} catch(Exception $e){
			print "Error!: ".$e->getMessage()."<br/>";
			return false;
		}
		return true;
	}

	public function execute($sql, $values){
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($values);
		} catch (Exception $e) {
  			echo "Failed: " . $e->getMessage();
  			return false;
		}
		return true;
	}
	
	public function result($sql){
		try{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();	
		} catch(Exception $e){
			print "Error: ".$e.getMessage()."<br/>";
			return false;
		}
	}
}