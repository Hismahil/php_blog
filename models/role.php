<?php

require_once("active_record.php");

class Role extends ActiveRecord {

	public $id;
	public $id_admin;
	public $created_at;
	public $updated_at;

	public function save() {}

	public static function all(){}

	public static function find($id){}

	public static function find_by($field, $value){}

	public function update($field, $value) {}

	public static function destroy($id) {}
}