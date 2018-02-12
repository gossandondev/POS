<?php

require_once "message.controller.php";

/**
* 
*/
class CategoriesController{
	
	/**
	* 
	*/
	static public function ctrCreateCategory()	{
		if (isset($_POST["nameCategory"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]/', $_POST["nameCategory"])) {
				
				$response = CategoriesModel::mdlCreateCategory("Categories", $_POST["nameCategory"]);

				if ($response == "OK") {
					MessageController::ctrSwalMessage("success",
													  "La categoria ha sido ingresada correctamente.",
													  "Cerrar",
													  "categories");
				}else{
					MessageController::ctrSwalMessage("error",
													  "La categoria NO ha sido ingresada correctamente.",
													  "Cerrar",
													  "categories");
				}
			}else{
				//Si ingresaron caracteres raros en los campos del nombre, usuario o contraseña le manda un mensaje.
				MessageController::ctrSwalMessage("error",
												  "La categoria no puede ir vacia o con caracteres especiales.",
												  "Cerrar",
												  "categories");
			}
		}
	}

	static public function ctrGetCategories($item = null, $value = null){

		return $response = CategoriesModel::mdlGetCategories("Categories", $item, $value);
	}

	static public function ctrUpdateCategory(){
		if (isset($_POST["editCategory"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]/', $_POST["editCategory"])) {
				
				$data = array("idCategory" => $_POST["idCategory"],
							  "nameCategory" => $_POST["editCategory"]);

				$response = CategoriesModel::mdlUpdateCategory("categories", $data);

				if ($response == "OK") {
					MessageController::ctrSwalMessage("success",
													  "La categoria ha sido editada correctamente.",
													  "Cerrar",
													  "categories");
				}else{
					MessageController::ctrSwalMessage("error",
													  "La categoria NO ha sido editada correctamente.",
													  "Cerrar",
													  "categories");
				}

			}else{
				//Si ingresaron caracteres raros en los campos del nombre, usuario o contraseña le manda un mensaje.
				MessageController::ctrSwalMessage("error",
												  "La categoria no puede ir vacia o con caracteres especiales.",
												  "Cerrar",
												  "categories");
			}
		}
	}

	static public function ctrDeleteCategory(){
		if (isset($_GET["idCategory"])) {

			$data = $_GET["idCategory"];
			$response = CategoriesModel::mdlDeleteCategory("categories", $data);

			if ($response == "OK") {
				MessageController::ctrSwalMessage("success",
												  "La categoria ha sido eliminada correctamente.",
												  "Cerrar",
												  "categories");
			}else{
				MessageController::ctrSwalMessage("error",
												  "La categoria NO ha sido eliminada correctamente.",
												  "Cerrar",
												  "categories");
			}
		}
	}
}