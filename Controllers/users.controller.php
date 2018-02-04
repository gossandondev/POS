<?php

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

					$_SESSION["login"] = "ok";
					$_SESSION["Id"] = $response["Id"];
					$_SESSION["Name"] = $response["Name"]; 
					$_SESSION["UserName"] = $response["UserName"];
					$_SESSION["Profile"] = $response["Profile"];
					$_SESSION["Photo"] = $response["Photo"];
					$_SESSION["Status"] = $response["Status"];

					echo '<script>window.location = "home"</script>';
				}else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelva a intentarlo</div>'; 
				}
			}
		}
	}

	static public function ctrCreateUser(){
		try {
			if (isset($_POST["name"])) {
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["userName"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"])) {

					$url = "";

					if (isset($_FILES["newPhoto"]["tmp_name"])) {

						list($width, $height) = getimagesize($_FILES["newPhoto"]["tmp_name"]);

						$newWidth = 500;
						$newheight = 500;

						$directory = "Views/img/user/".$_POST["userName"];
						mkdir($directory, 0755, true);

						if ($_FILES["newPhoto"]["type"] == "image/jpeg") {
							$rand = mt_rand(100,999);
							$url = $directory."/".$rand.".jpg";
							$fileOrigin = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);
							$newSizes = imagecreatetruecolor($newWidth, $newheight);

							imagecopyresized($newSizes, $fileOrigin, 0, 0, 0, 0, $newWidth, $newheight, $width, $height);
							imagejpeg($newSizes, $url);
						}

						if ($_FILES["newPhoto"]["type"] == "image/png") {
							$rand = mt_rand(100,999);
							$url = $directory."/".$rand.".png";
							$fileOrigin = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);
							$newSizes = imagecreatetruecolor($newWidth, $newheight);

							imagecopyresized($newSizes, $fileOrigin, 0, 0, 0, 0, $newWidth, $newheight, $width, $height);
							imagepng($newSizes, $url);
						}
					}

					$table = "users";
					$cryptPass = crypt($_POST["pass"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					$data = array("Name" => $_POST["name"],
								  "UserName" => $_POST["userName"],
								  "Password" => $cryptPass,
								  "Profile" => $_POST["profile"],
								  "Photo" => $url);

					$response = UsersModel::mdlCreateUser($table, $data);

					if ($response == "OK") {
						echo '<script>
							swal({
								type: "success",
								title: "El usuario ha sido ingresado correctamente.",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
									window.location = "users";
								}
							})
						  </script>';
					}else{
						echo '<script>
							swal({
								type: "error",
								title: "El usuario NO ha sido ingresado correctamente.",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
									window.location = "users";
								}
							})
						  </script>';
					}
				}
				else{
					echo '<script>
							swal({
								type: "error",
								title: "El usuario no puede ir vacio o con caracteres especiales.",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
									window.location = "users";
								}
							})
						  </script>';
				}
			}
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}

	static public function ctrGetUsers($item = null, $value = null){
		$table = "users";
		$response = UsersModel::mdlGetUsers($table, $item, $value);

		return $response;
	}
}