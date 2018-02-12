$(".btnEditCategory").click(function(){

	var idCategory = $(this).attr("idCategory");
	var data = new FormData();
	
	data.append("idCategory", idCategory);

	$.ajax({
		url: "Ajax/categories.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			$("#editCategory").val(response["Category"]);
			$("#idCategory").val(response["Id"]);
		},
		error: function(response){
			console.log("error", response);
		}
	});
})

$(".btnDeleteCategory").click(function(){

	var idCategory = $(this).attr("idCategory");

	swal({
		title: "Eliminar Categoria",
		text: "Esta seguro de borrar la categoria?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Eliminar"
	}).then((result)=>{
		if (result.value) {
			window.location = "index.php?index=categories&idCategory="+ idCategory;
		}
	})
})