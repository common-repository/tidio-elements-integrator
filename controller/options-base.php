<?php

if(!empty($_GET['tidioLogout'])){
	
	$tidioIntegratorOptions->logout();
	
	location_redirect(admin_url('admin.php?page=tidio-integrator'));
	
}