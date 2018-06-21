<?php

require_once "../Controllers/categories.controller.php";
require_once "../Models/categories.model.php";

class AjaxCategories{

	public $idCategory;

	public function ajaxGetEditCategory(){

		$item = "Id";
		$value = $this->idCategory;

		$response = CategoriesController::ctrGetCategories($item, $value);
		
		echo json_encode($response);
	}

	public function ajaxGetCategories(){

		$response = CategoriesController::ctrGetCategories();
		echo json_encode($response);
	}
}

if (isset($_POST["idCategory"])) {
	$edit = new AjaxCategories();
	$edit -> idCategory = $_POST["idCategory"];
	$edit -> ajaxGetEditCategory();
}

if (isset($_POST["getCategory"])) {
	$getCategory = new AjaxCategories();
	$getCategory -> ajaxGetCategories();
}