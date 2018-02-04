<?php 

require_once "../Controllers/users.controller.php";
require_once "../Models/users.model.php";

class AjaxUsers{

	public $idUser;

	public function ajaxGetEditUser(){

		$item = "Id";
		$value = $this->idUser;

		$response = UsersController::ctrGetUsers($item, $value);

		echo json_encode($response);
	}
}

if (isset($_POST["idUser"])) {
	$edit = new AjaxUsers();
	$edit -> idUser = $_POST["idUser"];
	$edit -> ajaxGetEditUser();
}