$(document).ready(function(){

	var data = new FormData();
	data.append("getCategory", true);

	$.ajax({
		url: "Ajax/categories.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			$.each(response, function(key, value){
				$('#nameCategory').append('<option value="'+ value[0] +'">'+ value[1] +'</option>')
			})
		},
		error: function(response){
			console.log(response);
		}
	})
});

$(".newPhotoProduct").change(function(){
	var image = this.files[0];
	
	if (image["type"] != "image/jpeg" && image["type"] != "image/png") {
		$(".newPhotoProduct").val("");
		swal({
			title: "Error al subir imagen",
			text: "La imagen debe estar en formato JPG o PNG.",
			type: "error",
			confirmButtonText: "Cerrar"
		})
	}else if (image["size"] > 2000000){
		$(".newPhotoProduct").val("");
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


$("#productPurchasePrice").change(function(){

	if ($(".percent").prop("checked")) {
		var porcentage = $(".newPercent").val();
		var productSalePrice = Number($("#productPurchasePrice").val()*porcentage/100)+Number($("#productPurchasePrice").val());

		$("#productSalePrice").val(productSalePrice);
		$("#productSalePrice").prop("readonly", true);
	}	
})

$(".newPercent").change(function(){

	if ($(".percent").prop("checked")) {
		var porcentage = $(".newPercent").val();
		var productSalePrice = Number($("#productPurchasePrice").val()*porcentage/100)+Number($("#productPurchasePrice").val());

		$("#productSalePrice").val(productSalePrice);
		$("#productSalePrice").prop("readonly", true);
	}
})

$(".percent").on("ifUnchecked", function(){
	$("#productSalePrice").prop("readonly", false);
	$(".newPercent").prop("readonly", true);
})

$(".percent").on("ifChecked", function(){
	$("#productSalePrice").prop("readonly", true);
	$(".newPercent").prop("readonly", false);
})

var table = $(".tablesProducts").DataTable({
	"ajax" : "ajax/products.ajax.php",
	"columnDefs" : [
		{
			"targets" : -1,
			"data" : null,
			"defaultContent" : '<div class="btn-group"><button class="btn btn-warning btnEditProduct" idProduct data-toggle="modal" data-target="modalEditProduct"><i class="fa fa-pencil"></i></button><button class="btn btn-danger btnDeleteProduct" idProduct><i class="fa fa-times"></i></button></div>'
		},
		{
			"targets" : -9,
			"data" : null,
			"defaultContent" : '<img class="img-thumbnail imgTable" width="40px">'
		}
	],
	"language" : {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
})

$('.tablesProducts tbody').on('click', 'button', function(){

	var data = table.row($(this).parents('tr')).data();

	$(this).attr("idProduct", data[9]);
})

function loadImages(){
	var imgTable = $('.imgTable');

	for (var i = 0; i < imgTable.length; i++) {
		var data = table.row($(imgTable[i]).parents("tr")).data();
		$(imgTable[i]).attr("src", data[1]);
	}
}

setTimeout(function(){
	loadImages();
},300)

$(".dataTables_paginate").click(function(){
	loadImages();
})

$("input[aria-controls='DataTables_Table_0']").focus(function(){
	$(document).keyup(function(event){
		event.preventDefault();
		loadImages();
	})
})

$("select[name='DataTables_Table_0_length']").change(function(){
	loadImages();
})

$(".sorting").click(function(){
	loadImages();
})