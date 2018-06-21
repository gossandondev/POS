<?php

require_once "connection.php";

/**
* 
*/
class ProductsModel{
	
	static public function mdlGetProducts($table, $item = null, $value = null){

		if ($item != null) {
			$stmt = Connection::connect()->prepare("SELECT * FROM $table t1
													INNER JOIN Categories t2
														ON t1.IdCategory = t2.Id
													WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Connection::connect()->prepare("SELECT t1.*,t2.Category FROM $table t1
													INNER JOIN Categories t2
														ON t1.IdCategory = t2.Id");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlCreateProduct($table, $data){
		
		$stmt = connection::connect()->prepare("INSERT INTO $table(IdCategory, Code, Description, Image, Stock, PurchasePrice, SalePrice, Sales) VALUES (:IdCategory, :Code, :Description, :Image, :Stock, :PurchasePrice, :SalePrice, 0)");

		$stmt->bindParam(":IdCategory", $data["nameCategory"], PDO::PARAM_INT);
		$stmt->bindParam(":Code", $data["productName"], PDO::PARAM_STR);
		$stmt->bindParam(":Description", $data["productDesc"], PDO::PARAM_STR);
		$stmt->bindParam(":Image", $data["newPhotoProduct"], PDO::PARAM_STR);
		$stmt->bindParam(":Stock", $data["productStock"], PDO::PARAM_INT);
		$stmt->bindParam(":PurchasePrice", $data["productPurchasePrice"], PDO::PARAM_INT);
		$stmt->bindParam(":SalePrice", $data["productSalePrice"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "OK";
		}
		else{
			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;
	}
}