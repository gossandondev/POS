<?php

require_once "connection.php";

class UsersModel{
	static public function mdlGetUsers($table, $item, $value){
		$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();
	}

	static public function mdlInsertUser($table, $data){
		$stmt = connection::connect()->prepare("INSERT INTO $table(Name,UserName,Password,Profile) VALUES (:Name, :UserName, :Password, :Profile)");

		$stmt->bindParam(":Name", $data["Name"], PDO::PARAM_STR);
		$stmt->bindParam(":UserName", $data["UserName"], PDO::PARAM_STR);
		$stmt->bindParam(":Password", $data["Password"], PDO::PARAM_STR);
		$stmt->bindParam(":Profile", $data["Profile"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "OK";
		}
		else{
			return "ERROR";
		}

		$stmt->close();
		$stmt = null;
	}
}