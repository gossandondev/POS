<?php

require_once "connection.php";

/**
* 
*/
class CategoriesModel{

	/**
	* 
	*/
	static public function mdlCreateCategory($table, $data)	{

		$stmt = Connection::connect()->prepare("INSERT INTO $table(category) VALUES (:category)");
		$stmt->bindParam(":category", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "OK";
		}else{
			return "ERROR";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlGetCategories($table, $item = null, $value = null){

		if ($item != null) {
			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Connection::connect()->prepare("SELECT * FROM $table");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlUpdateCategory($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET Category = :category WHERE Id = :id");
		$stmt->bindParam(":category", $data["nameCategory"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $data["idCategory"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "OK";
		}else{
			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlDeleteCategory($table, $data){

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE Id = :id");
		$stmt->bindParam(":id", $data, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "OK";
		}else{
			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;
	}
}