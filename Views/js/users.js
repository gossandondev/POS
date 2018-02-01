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