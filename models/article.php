<?php

require_once("active_record.php");
require_once("user.php");
require_once("comment.php");

class Article extends ActiveRecord{

	public $id;
	public $title;
	public $about;
	public $content;
	public $user_id;
	public $created_at;
	public $updated_at;

	public function __construct($id, $title, $about, $content, $user_id, $created_at, $updated_at){
		$this->id = $id;
		$this->title = $title;
		$this->about = $about;
		$this->content = $content;
		$this->user_id = $user_id;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
	}

	public function save(){

		$this->created_at = date("Y/m/d");
		$this->updated_at = date("Y/m/d");

		$this->id = Mysql::execute("insert into articles (title, about, content, user_id, created_at, updated_at) values(?,?,?,?,?,?)", 
			array($this->title, $this->about, $this->content, $this->user_id, $this->created_at, $this->updated_at));

		return true;
	}

	public static function all(){
		$list = array();
		$result = Mysql::resultAll("select * from articles order by id desc;");
		foreach ($result as $key => $value) {
			$article = new Article($value['id'], $value['title'], $value['about'], $value['content'], $value['user_id'],
				$value['created_at'], $value['updated_at']);
			array_push($list, $article);
		}
		return $list;
	}

	public static function all_by_user($id){
		$list = array();
		$result = Mysql::resultAll("select * from articles where user_id=".$id);
		foreach ($result as $key => $value) {
			$article = new Article($value['id'], $value['title'], $value['about'], $value['content'], $value['user_id'],
				$value['created_at'], $value['updated_at']);
			array_push($list, $article);
		}
		return $list;	
	}

	public static function find($id){
		$obj = Mysql::result("select * from articles where id = ".$id." limit 1;");
		$article = new Article($obj->id, $obj->title, $obj->about, $obj->content, $obj->user_id, $obj->created_at, $obj->updated_at);
		return $article;
	}

	public static function find_by($field, $value){
		$obj = Mysql::result("select * from articles where ".$field."='".$value."'");
		
		if($obj){
			$article = new Article($obj->id, $obj->title, $obj->about, $obj->content, $obj->user_id, $obj->created_at, $obj->updated_at);
			return $article;
		}

		return null;
	}

	public function update($field, $value){
		return Mysql::execute_raw_sql("update articles set ".$field."='".$value."' where id =".$this->id.";");
	}

	public static function destroy($id){
		return Mysql::execute_raw_sql("DELETE FROM articles WHERE id = ".$id.";");
	}

	public function user() {
		return User::find($this->user_id);
	}

	public function comments(){
		return Comment::all_by_article($this->id);
	}
}