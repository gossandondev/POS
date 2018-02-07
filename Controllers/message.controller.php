<?php

class MessageController
{
	
	static public function ctrSwalMessage($type, $title, $buttonText, $location){
		echo '<script>
				swal({
					type: "'.$type.'",
					title: "'.$title.'",
					showConfirmButton: true,
					confirmButtonText: "'.$buttonText.'",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location = "'.$location.'";
					}
				})
			  </script>';
	}
}