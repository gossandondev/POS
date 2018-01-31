<?php

class UsersController{

	static public function ctrUserIngress(){
		if (isset($_POST["user"])) {
			if (preg_match('/[a-zA-Z0-9]+$/', $_POST["user"]) &&
				preg_match('/[a-zA-Z0-9]+$/', $_POST["password"])) {
				
				$table = "users";
				$item = "userName";
				$value = $_POST["user"];
				$response = UsersModel::mdlGetUsers($table, $item, $value); 

				if ($response["UserName"] == $_POST["user"] && $response["Password"] == $_POST["password"]){
					$_SESSION["login"] = "ok"; 
					echo '<script>window.location = "home"</script>';
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
				
				$table = "users";
				$data = array("Name" => $_POST["name"],
							  "UserName" => $_POST["userName"],
							  "Password" => $_POST["pass"],
							  "Profile" => $_POST["profile"]);
				$response = UsersModel::mdlInsertUser($table, $data);

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
	}
}