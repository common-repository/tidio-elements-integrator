<?php

function location_reload(){
	
	echo '<script type="text/javascript"> location.reload(); </script>';
	
	exit;
	
}
function location_redirect($url){
	
	echo '<script type="text/javascript"> location.href = "'.$url.'"; </script>';
	
	exit;
	
}