$(".newPhoto").change(function(){
	var image = this.files[0];
	
	if (image["type"] != "image/jpeg" && image["type"] != "image/png") {
		$(".newPhoto").val("");
		swal({
			title: "Error al subir imagen",
			text: "La imagen debe estar en formato JPG o PNG.",
			type: "error",
			confirmButtonText: "Cerrar"
		})
	}else if (image["size"] > 2000000){
		$(".newPhoto").val("");
		swal({
			title: "Error al subir imagen",
			text: "La imagen no debe pesar mas de 2MB.",
			type: "error",
			confirmButtonText: "Cerrar"
		})
	}else{
		var imageData = new FileReader;
		imageData.readAsDataURL(image);

		$(imageData).on("load", function(event){
			var imageUrl = event.target.result;
			
			$(".preView").attr("src", imageUrl);
		})
	}
})

$(".btnEditUser").click(function(){

	var idUser = $(this).attr("idUser");
	var data = new FormData();
	
	data.append("idUser", idUser);

	$.ajax({
		url: "Ajax/users.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			$("#editName").val(response["Name"]);
			$("#editUserName").val(response["UserName"]);
			$("#editProfile").html(response["Profile"]);
			$("#editProfile").val(response["Profile"]);
			$("#currentPass").val(response["Password"]);
			$("#currentPhoto").val(response["Photo"]);
			
			if (response["Photo"] != "") {
				$(".preView").attr("src", response["Photo"]);
			}else{
				$(".preView").attr("src", "Views/img/user/default/anonymous.png");
			}
		},
		error: function(result){
			console.log("error", result);
		}
	});
})

$(".btnActive").click(function(){
	var idUser = $(this).attr("idUser");
	var userStatus = $(this).attr("userStatus");

	var data = new FormData();
	data.append("activateUserId", idUser);
	data.append("activateUserStatus", userStatus);

	$.ajax({
		url: "Ajax/users.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){

		}
	})

	if (userStatus == 0) {
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Desactivado");
		$(this).attr("userStatus", 1);
	}else{
		$(this).removeClass("btn-danger");
		$(this).addClass("btn-success");
		$(this).html("Activado");
		$(this).attr("userStatus", 0);
	}
})

$("#userName").change(function(){
	var userName = $(this).val();

	var data = new FormData();
	data.append("userName", userName)

	$(".alert").remove();

	$.ajax({
		url: "Ajax/users.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			if (response) {
				$("#userName").parent().after('<div class="alert alert-warning">Este usuario ya existe.</div>');
				$("#userName").val("");
			}
		}
	})
})

$(".btnDeleteUser").click(function(){

	var userId = $(this).attr("userId");
	var userPhoto = $(this).attr("userPhoto");

	swal({
		title: "Eliminar Usuario",
		text: "Esta seguro de borrar el usuario?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Eliminar"
	}).then((result)=>{
		if (result.value) {
			window.location = "index.php?index=users&userId="+ userId + "&userPhoto=" + userPhoto;
		}
	})
})