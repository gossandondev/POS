<?php

class UsersController{

	public function ctrUserIngress(){
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
}