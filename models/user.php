<?php

require_once("./config/database/mysql.php");
require_once("active_record.php");
require_once("article.php");
require_once("comment.php");

class User extends ActiveRecord {

	public $id;
	public $name;
	public $email;
	public $password;
	public $active;
	public $role_id;
	public $created_at;
	public $updated_at;

	function __construct($id, $name, $email, $password, $active, $role_id, $created_at, $updated_at){
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->active = $active;
		$this->role_id = $role_id;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
	}

	public function save(){
		$user = User::find_by('name', $this->name);

		if($user) return false;

		$this->created_at = date("Y/m/d");
		$this->updated_at = date("Y/m/d");

		$this->id = Mysql::execute("insert into users (name, email, password, role_id, active, created_at, updated_at) values(?,?,?,?,?,?,?)", 
			array($this->name, $this->email, $this->password, $this->role_id, $this->active, $this->created_at, $this->updated_at));

		return true;
	}

	public static function all(){
		$list = array();
		$result = Mysql::resultAll("select * from users;");
		foreach ($result as $key => $value) {
			$user = new User($value['id'], $value['name'], $value['email'], $value['password'], $value['active'],
				$value['role_id'], $value['created_at'], $value['updated_at']);
			array_push($list, $user);
		}
		return $list;
	}

	public static function find($id){
		$obj = Mysql::result("select * from users where id = ".$id." limit 1;");
		$user = new User($obj->id, $obj->name, $obj->email, $obj->password, $obj->active, $obj->role_id, $obj->created_at, $obj->updated_at);
		return $user;
	}

	public static function find_by($field, $value){
		$obj = Mysql::result("select * from users where ".$field."='".$value."'");
		
		if($obj){
			$user = new User($obj->id, $obj->name, $obj->email, $obj->password, 
				$obj->active, $obj->role_id, $obj->created_at, $obj->updated_at);
			return $user;
		}

		return null;
	}

	public function update($field, $value) {
		if(gettype($value) === "boolean")
			return Mysql::execute_raw_sql("update users set ".$field."=".$value." where name ='".$this->name."';");

		if(gettype($value) === "integer")
			return Mysql::execute_raw_sql("update users set ".$field."=".$value." where name ='".$this->name."';");
		
		if(gettype($value) === "string")
			return Mysql::execute_raw_sql("update users set ".$field."='".$value."' where name ='".$this->name."';");
	}

	public static function destroy($id) {
		return Mysql::execute_raw_sql("DELETE FROM users WHERE id = ".$id.";");
	}

	public function auth($pwd){
		return ($this->password == md5($pwd, false));
	}

	public function articles() {
		return Article::all_by_user($this->id);
	}

	public function comments() {
		return Comment::all_by_user($this->id);
	}
}