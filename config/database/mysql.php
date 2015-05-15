<?php

require_once("connection_factory.php");

class Mysql {

	public static $db;

	public static function connect($str_connection, $user, $passwd){
		try{
			self::$db = new ConnectionFactory($str_connection, $user, $passwd, array(PDO::ATTR_PERSISTENT => true));
		} catch(PDOException $e){
			print "Error: ".$e.getMessage()."<br/>";
		}
		return true;
	}

	public static function close(){
		try{
			self::$db = null;	
		} catch(Exception $e){
			print "Error!: ".$e->getMessage()."<br/>";
			return false;
		}
		return true;
	}

	public static function execute($sql, $values){
		try {
			$stmt = self::$db->prepare($sql);
			self::$db->beginTransaction();
			$stmt->execute($values);
			self::$db->commit();
			return self::$db->lastInsertId();
		} catch (Exception $e) {
			self::$db->rollback();
  			echo "Failed: " . $e->getMessage();
		}
		return null;
	}

	public static function execute_raw_sql($sql){
		try {
			$stmt = self::$db->prepare($sql);
			self::$db->beginTransaction();
			$stmt->execute();
			self::$db->commit();
			return self::$db->lastInsertId();
		} catch (Exception $e) {
			self::$db->rollback();
  			echo "Failed: " . $e->getMessage();
		}
		return null;
	}

	public static function resultAll($sql){
		try{
			$stmt = self::$db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();	
		} catch(Exception $e){
			print "Error: ".$e.getMessage()."<br/>";
		}
		return null;
	}

	public static function result($sql){
		try{
			$stmt = self::$db->prepare($sql);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);	
		} catch(Exception $e){
			print "Error: fetch object <br/>";
		}
		return null;
	}	
}
