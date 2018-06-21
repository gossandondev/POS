<?php

require_once "../Controllers/categories.controller.php";
require_once "../Models/categories.model.php";
require_once "../Controllers/products.controller.php";
require_once "../Models/products.model.php";

/**
* 
*/
class AjaxProducts{
	
	public function ajaxViewTableProducts(){

		$response = ProductsController::ctrGetProducts();
		echo '{ "data": [';

		for ($i=0; $i < count($response) - 1; $i++) { 

			echo '[
				"'.($i+1).'",
				"'.$response[$i]["Image"].'",
				"'.$response[$i]["Code"].'",
				"'.$response[$i]["Description"].'",
				"'.$response[$i]["Category"].'",
				"'.$response[$i]["Stock"].'",
				"'.$response[$i]["PurchasePrice"].'",
				"'.$response[$i]["SalePrice"].'",
				"'.$response[$i]["CreatedDateTime"].'",
				"'.$response[$i]["Id"].'"
				],';
		}

		echo '["'.count($response).'",
				"'.$response[$i]["Image"].'",
				"'.$response[$i]["Code"].'",
				"'.$response[$i]["Description"].'",
				"'.$response[$i]["Category"].'",
				"'.$response[$i]["Stock"].'",
				"'.$response[$i]["PurchasePrice"].'",
				"'.$response[$i]["SalePrice"].'",
				"'.$response[$i]["CreatedDateTime"].'",
				"'.$response[$i]["Id"].'"
				]
			]
		}';
						
	}
}

$viewTableProducts = new AjaxProducts();
$viewTableProducts -> ajaxViewTableProducts();

