<?php

require_once "message.controller.php";

class UsersController{

	/**
	* Verifica si el conjunto usuario/contraseña igresados, exista en la base de datos.
	* Si encuentra registro en la base de datos, lo deja ingresar al sistema.
	*/
	static public function ctrUserIngress(){
		//Se verifica si viene la variable POST.
		if (isset($_POST["user"])) {
			//Se valida que las variables user y contraseña no tenga caracteres raros.
			if (preg_match('/[a-zA-Z0-9]+$/', $_POST["user"]) &&
				preg_match('/[a-zA-Z0-9]+$/', $_POST["password"])) {
				
				//Se encripta la contraseña con Blowfish.
				$cryptPass = crypt($_POST["password"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				//Se consulta la existencia de usuario/contraseña en la base de datos.
				$response = UsersModel::mdlGetUsers("users", "userName", $_POST["user"]); 

				//Se valida si lo ingresado coincide con lo que trae de la base de datos.
				if ($response["UserName"] == $_POST["user"] && $response["Password"] == $cryptPass){
					//Se valida si el usuario esta activado en el sistema.
					if ($response["Status"] == 1) {
						//Se crean las variables de sesiones.
						$_SESSION["login"] = "ok";
						$_SESSION["Id"] = $response["Id"];
						$_SESSION["Name"] = $response["Name"]; 
						$_SESSION["UserName"] = $response["UserName"];
						$_SESSION["Profile"] = $response["Profile"];
						$_SESSION["Photo"] = $response["Photo"];
						$_SESSION["Status"] = $response["Status"];

						//Se asigna la zona horaria del sistema.
						date_default_timezone_set("America/Santiago");
						//Se rescata la fecha y hora actual.
						$currentDateTime = date("Y-m-d H:i:s");

						//Se actualiza la fecha del ultimo login.
						$response = UsersModel::mdlUpdateUsersWithParameters("users",
																			 "LastLogin",
																			 $currentDateTime,
																			 "Id",
																			 $response["Id"]);

						//Si la actualizacion de la fecha del ultimo login sale bien, lo deja pasar al sistema.
						if ($response == "OK") {
							echo '<script>window.location = "home"</script>';
						}

					}else{
						//Si el usuario no esta activado manda una alerta en el formulario.
						echo '<br><div class="alert alert-danger">El usuario no se encuentra activado.</div>'; 
					}
					
				}else{
					//Si no encuentra coincidencias en la base de datos manda alerta en el formulario.
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelva a intentarlo</div>'; 
				}
			}
		}
	}

	/**
	* Crea un usuario nuevo en el sistema.
	*/
	static public function ctrCreateUser(){
		//Se verifica si viene la variable POST.
		if (isset($_POST["name"])) {
			//Se valida que las variables nombre, user y contraseña no tenga caracteres raros.
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["userName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"])) {

				//Se rescata la ruta de la foto que se adjunto en el formulario.
				$url = self::ctrSavePhoto("newPhoto", "userName");

				//Se encripta la contraseña con Blowfish.
				$cryptPass = crypt($_POST["pass"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				//Se crea una variable array que almacena toda la informacion del formmulario.
				$data = array("Name" => $_POST["name"],
							  "UserName" => $_POST["userName"],
							  "Password" => $cryptPass,
							  "Profile" => $_POST["profile"],
							  "Photo" => $url);

				//Se crea el usuario en la base de datos.
				$response = UsersModel::mdlCreateUser("users", $data);

				//Si se creo el usuario, se envia un mensaje al usuario informando que se creo correctamente.
				if ($response == "OK") {
					MessageController::ctrSwalMessage("success",
													  "El usuario ha sido ingresado correctamente.",
													  "Cerrar",
													  "users");
				}else{
					//Si no se cargo correctamente le informa al usuario que hubo un problema con la creacion.
					MessageController::ctrSwalMessage("error",
													  "El usuario NO ha sido ingresado correctamente.".$response[2],
													  "Cerrar",
													  "users");
				}
			}else{
				//Si ingresaron caracteres raros en los campos del nombre, usuario o contraseña le manda un mensaje.
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

		$url = isset($_POST["currentPhoto"]) ? $_POST["currentPhoto"] : "";

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

	static public function ctrDeleteUser(){
		if (isset($_GET["userId"])) {
			if ($_GET["userPhoto"] != "") {
				unlink($_GET["userPhoto"]);
				rmdir(pathinfo($_GET["userPhoto"])["dirname"]);
			}

			$response = UsersModel::mdlDeleteUser("users", $_GET["userId"]);

			if ($response == "OK") {
				MessageController::ctrSwalMessage("success",
												  "El usuario ha sido eliminado correctamente.",
												  "Cerrar",
												  "users");
			}
		}
	}
}