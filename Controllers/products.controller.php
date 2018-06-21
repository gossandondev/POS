<?php

require_once "message.controller.php";

/**
* 
*/
class ProductsController{
	
	static public function ctrGetProducts($item = null, $value = null){
		
		return $response = ProductsModel::mdlGetProducts("Products", $item, $value);
	}

	static public function ctrCreateProduct(){
		if (isset($_POST["productName"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["productName"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["productDesc"])) {

				$url = self::ctrSavePhoto("newPhotoProduct", "productName");

				$data = array("productName" => $_POST["productName"],
						      "productDesc" => $_POST["productDesc"],
						  	  "nameCategory" => $_POST["nameCategory"],
						  	  "productStock" => $_POST["productStock"],
						  	  "productPurchasePrice" => $_POST["productPurchasePrice"],
						  	  "productSalePrice" => $_POST["productSalePrice"],
						  	  "newPhotoProduct" => $url);

				$response = ProductsModel::mdlCreateProduct("Products", $data);

				if ($response == "OK") {
					MessageController::ctrSwalMessage("success",
												  "El producto ha sido ingresado correctamente.",
												  "Cerrar",
												  "products");
				}else{
					MessageController::ctrSwalMessage("error",
												  "El producto NO ha sido ingresado correctamente. ",
												  "Cerrar",
												  "products");
				}
			}else{
				MessageController::ctrSwalMessage("error",
												  "El codigo o el nombre del producto no pueden ir con caracteres raros.",
												  "Cerrar",
												  "products");
			}
		}
	}

	static public function ctrSavePhoto($attrPhoto, $attrUserName){

		$url = isset($_POST["currentPhoto"]) ? $_POST["currentPhoto"] : "";

		if (isset($_FILES[$attrPhoto]["tmp_name"]) && (!empty($_FILES[$attrPhoto]["tmp_name"]))) {

			list($width, $height) = getimagesize($_FILES[$attrPhoto]["tmp_name"]);

			$newWidth = 500;
			$newheight = 500;

			$directory = "Views/img/products/".$_POST[$attrUserName];

			if (!empty($_POST["currentPhoto"])) {
				unlink($_POST["currentPhoto"]);
			}else{
				mkdir($directory, 0755, true);
			}

			if ($_FILES[$attrPhoto]["type"] == "image/jpeg") {
				$rand = mt_rand(100,999);
				$url = $directory."/".$rand.".jpg";
				$fileOrigin = imagecreatefromjpeg($_FILES[$attrPhoto]["tmp_name"]);
				$newSizes = imagecreatetruecolor($newWidth, $newheight);

				imagecopyresized($newSizes, $fileOrigin, 0, 0, 0, 0, $newWidth, $newheight, $width, $height);
				imagejpeg($newSizes, $url);
			}

			if ($_FILES[$attrPhoto]["type"] == "image/png") {
				$rand = mt_rand(100,999);
				$url = $directory."/".$rand.".png";
				$fileOrigin = imagecreatefrompng($_FILES[$attrPhoto]["tmp_name"]);
				$newSizes = imagecreatetruecolor($newWidth, $newheight);

				imagecopyresized($newSizes, $fileOrigin, 0, 0, 0, 0, $newWidth, $newheight, $width, $height);
				imagepng($newSizes, $url);
			}
		}

		return $url;
	}

}