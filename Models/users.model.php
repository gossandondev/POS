<?php

require_once "connection.php";

class UsersModel{
	static public function mdlGetUsers($table, $item, $value){
		$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();
	}

	static public function mdlCreateUser($table, $data){
		try {
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
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}

		$stmt->close();
		$stmt = null;
	}
}