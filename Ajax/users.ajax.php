<?php 

require_once "../Controllers/users.controller.php";
require_once "../Models/users.model.php";

class AjaxUsers{

	public $idUser;
	public $activateUserId;
	public $activateUserStatus;

	public function ajaxGetEditUser(){

		$item = "Id";
		$value = $this->idUser;

		$response = UsersController::ctrGetUsers($item, $value);
		
		echo json_encode($response);
	}

	public function ajaxUpdateActiveUser(){

		$table = "users";
		$setItem = "Status";
		$setValue = $this->activateUserStatus;
		$whereItem = "Id";
		$whereValue = $this->activateUserId;

		$response = UsersModel::mdlUpdateUsersWithParameters($table, $setItem, $setValue, $whereItem, $whereValue);
	}
}

if (isset($_POST["idUser"])) {
	$edit = new AjaxUsers();
	$edit -> idUser = $_POST["idUser"];
	$edit -> ajaxGetEditUser();
}

if (isset($_POST["activateUserId"])) {
	$activateUser = new AjaxUsers();
	$activateUser -> activateUserId = $_POST["activateUserId"];
	$activateUser -> activateUserStatus = $_POST["activateUserStatus"];
	$activateUser -> ajaxUpdateActiveUser();
}