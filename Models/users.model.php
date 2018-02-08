<?php

require_once "connection.php";

class UsersModel{
	static public function mdlGetUsers($table, $item = null, $value = null){
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
	}

	static public function mdlCreateUser($table, $data){
		
		$stmt = connection::connect()->prepare("INSERT INTO $table(Name, UserName, Password, Profile, Photo) VALUES (:Name, :UserName, :Password, :Profile, :Photo)");

		$stmt->bindParam(":Name", $data["Name"], PDO::PARAM_STR);
		$stmt->bindParam(":UserName", $data["UserName"], PDO::PARAM_STR);
		$stmt->bindParam(":Password", $data["Password"], PDO::PARAM_STR);
		$stmt->bindParam(":Profile", $data["Profile"], PDO::PARAM_STR);
		$stmt->bindParam(":Photo", $data["Photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "OK";
		}
		else{
			return "ERROR";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlUpdateUsers($table, $data){
	
		$stmt = connection::connect()->prepare("UPDATE $table SET Name = :Name, Password = :Password, Profile = :Profile, Photo = :Photo WHERE UserName = :UserName");

		$stmt->bindParam(":Name", $data["Name"], PDO::PARAM_STR);
		$stmt->bindParam(":UserName", $data["UserName"], PDO::PARAM_STR);
		$stmt->bindParam(":Password", $data["Password"], PDO::PARAM_STR);
		$stmt->bindParam(":Profile", $data["Profile"], PDO::PARAM_STR);
		$stmt->bindParam(":Photo", $data["Photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "OK";
		}
		else{
			return "ERROR";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlUpdateUsersWithParameters($table, $setItem, $setValue, $whereItem, $whereValue){

		$stmt = connection::connect()->prepare("UPDATE $table SET $setItem = :$setItem WHERE $whereItem = :$whereItem");

		$stmt -> bindParam(":".$setItem, $setValue, PDO::PARAM_STR);
		$stmt -> bindParam(":".$whereItem, $whereValue, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "OK";
		}
		else{
			return "ERROR";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlDeleteUser($table, $data){

		$stmt = connection::connect()->prepare("DELETE FROM $table WHERE Id = :Id");

		$stmt -> bindParam(":Id", $data, PDO::PARAM_STR);

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