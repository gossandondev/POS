<?php

require_once "message.controller.php";

class UsersController{

	static public function ctrUserIngress(){
		if (isset($_POST["user"])) {
			if (preg_match('/[a-zA-Z0-9]+$/', $_POST["user"]) &&
				preg_match('/[a-zA-Z0-9]+$/', $_POST["password"])) {
				
				$table = "users";
				$item = "userName";
				$value = $_POST["user"];
				$cryptPass = crypt($_POST["password"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$response = UsersModel::mdlGetUsers($table, $item, $value); 

				if ($response["UserName"] == $_POST["user"] && $response["Password"] == $cryptPass){
					if ($response["Status"] == 1) {
						$_SESSION["login"] = "ok";
						$_SESSION["Id"] = $response["Id"];
						$_SESSION["Name"] = $response["Name"]; 
						$_SESSION["UserName"] = $response["UserName"];
						$_SESSION["Profile"] = $response["Profile"];
						$_SESSION["Photo"] = $response["Photo"];
						$_SESSION["Status"] = $response["Status"];

						echo '<script>window.location = "home"</script>';
					}else{
						echo '<br><div class="alert alert-danger">El usuario no se encuentra activado.</div>'; 
					}
					
				}else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelva a intentarlo</div>'; 
				}
			}
		}
	}

	static public function ctrCreateUser(){
		if (isset($_POST["name"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["userName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"])) {

				$url = self::ctrSavePhoto("newPhoto", "userName");

				$table = "users";
				$cryptPass = crypt($_POST["pass"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$data = array("Name" => $_POST["name"],
							  "UserName" => $_POST["userName"],
							  "Password" => $cryptPass,
							  "Profile" => $_POST["profile"],
							  "Photo" => $url);

				$response = UsersModel::mdlCreateUser($table, $data);

				if ($response == "OK") {
					MessageController::ctrSwalMessage("success",
													  "El usuario ha sido ingresado correctamente.",
													  "Cerrar",
													  "users");
				}else{
					MessageController::ctrSwalMessage("error",
													  "El usuario NO ha sido ingresado correctamente.",
													  "Cerrar",
													  "users");
				}
			}
			else{
				MessageController::ctrSwalMessage("error",
													  "El usuario no puede ir vacio o con caracteres especiales.",
													  "Cerrar",
													  "users");
			}
		}
	}

	static public function ctrGetUsers($item = null, $value = null){
		$table = "users";
		$response = UsersModel::mdlGetUsers($table, $item, $value);
	
		return $response;
	}

	static public function ctrUpdateUsers(){
		if (isset($_POST["editUserName"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editName"])) {

				$url = self::ctrSavePhoto("editPhoto", "editUserName");

				$table = "users";
				
				if ($_POST["editPass"] != "") {
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPass"])) {
						$pass = crypt($_POST["editPass"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					}else{
						MessageController::ctrSwalMessage("error",
													      "La contraseña no puede llevar caracteres especiales.",
													      "Cerrar",
													      "users");
					}
				}else{
					$pass = $_POST["currentPass"];
				}
				
				$data = array("Name" => $_POST["editName"],
							  "UserName" => $_POST["editUserName"],
							  "Password" => $pass,
							  "Profile" => $_POST["editProfile"],
							  "Photo" => $url);

				$response = UsersModel::mdlUpdateUsers($table, $data);

				if ($response == "OK") {
					MessageController::ctrSwalMessage("success",
													  "El usuario ha sido actualizado correctamente.",
													  "Cerrar",
													  "users");
				}else{
					MessageController::ctrSwalMessage("error",
													  "El usuario NO ha podido ser actualizado correctamente.",
													  "Cerrar",
													  "users");
				}
			}
		}
	}

	static public function ctrSavePhoto($attrPhoto, $attrUserName){

		$url = $_POST["currentPhoto"];

		if (isset($_FILES[$attrPhoto]["tmp_name"]) && (!empty($_FILES[$attrPhoto]["tmp_name"]))) {

			list($width, $height) = getimagesize($_FILES[$attrPhoto]["tmp_name"]);

			$newWidth = 500;
			$newheight = 500;

			$directory = "Views/img/user/".$_POST[$attrUserName];

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