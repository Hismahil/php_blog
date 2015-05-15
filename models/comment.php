<?php

require_once("active_record.php");
require_once("article.php");
require_once("user.php");

class Comment extends ActiveRecord {

	public $id;
	public $user_name;
	public $comment;
	public $article_id;
	public $comment_id;
	public $created_at;
	public $updated_at;

	public function __construct($id, $user_name, $comment, $article_id, $comment_id, $created_at, $updated_at){
		$this->id = $id;
		$this->user_name = $user_name;
		$this->comment = $comment;
		$this->article_id = $article_id;
		$this->comment_id = $comment_id;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
	}

	public function save(){
		$this->created_at = date("Y/m/d");
		$this->updated_at = date("Y/m/d");

		$this->id = Mysql::execute("insert into comments (user_name, comment, article_id, created_at, updated_at) values(?,?,?,?,?)", 
			array($this->user_name, $this->comment, $this->article_id, $this->created_at, $this->updated_at));

		return true;
	}

	public static function all(){
		$list = array();
		$result = Mysql::resultAll("select * from comments;");
		foreach ($result as $key => $value) {
			$comment = new Comment($value['id'], $value['comment'], $value['user_id'], $value['article_id'],
				$value['created_at'], $value['updated_at']);
			array_push($list, $comment);
		}
		return $list;
	}

	public static function all_sub_commment(){
		$list = array();
		$result = Mysql::resultAll("select * from comments where comment_id=".$this->id);
		foreach ($result as $key => $value) {
			$comment = new Comment($value['id'], $value['user_name'], $value['comment'], $value['article_id'],
				$value['comment_id'], $value['created_at'], $value['updated_at']);
			array_push($list, $comment);
		}
		return $list;
	}

	public static function all_by_article($id){
		$list = array();
		$result = Mysql::resultAll("select * from comments where article_id=".$id);
		foreach ($result as $key => $value) {
			$comment = new Comment($value['id'], $value['user_name'], $value['comment'], $value['article_id'],
				$value['comment_id'], $value['created_at'], $value['updated_at']);
			array_push($list, $comment);
		}
		return $list;
	}

	public static function find($id){
		$obj = Mysql::result("select * from comments where id = ".$id." limit 1;");
		$comment = new Comment($obj->id, 
			$obj->user_name, 
			$obj->comment, 
			$obj->article_id, 
			$obj->comment_id,
			$obj->created_at, 
			$obj->updated_at);
		return $comment;
	}

	public static function find_by($field, $value){
		$obj = Mysql::result("select * from comments where ".$field."='".$value."'");
		
		if($obj){
			$comment = new Comment($obj->id, 
				$obj->user_name, 
				$obj->comment, 
				$obj->article_id, 
				$obj->comment_id,
				$obj->created_at, 
				$obj->updated_at);
			return $comment;
		}

		return null;
	}

	public function update($field, $value){
		return Mysql::execute_raw_sql("update comments set ".$field."='".$value."' where id =".$this->id.";");
	}

	public static function destroy($id){
		return Mysql::execute("DELETE FROM comments WHERE id = ".$this->id.";");
	}

	public function article() {
		return Article::find($this->article_id);
	}
}