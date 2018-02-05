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
			console.log("URL: ", imageUrl)
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
			$("#currenPass").val(response["Password"]);
			$("#currenPhoto").val(response["Photo"]);

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