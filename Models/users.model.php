<?php

require_once "connection.php";

class UsersModel{
	static public function mdlGetUsers($table, $item, $value){
		$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();
	}
}