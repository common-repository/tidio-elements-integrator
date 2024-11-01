<?php

$userProjects = $tidioIntegratorOptions->getUserProjects();

// when user dosen' add any project

if(empty($userProjects)){

	// add new project
	
	/*

	$projectData = $tidioIntegratorOptions->addUserProject( get_option('siteurl') );
					
	$tidioIntegratorOptions->setUserProject($projectData['private_key']);
		
	location_reload();
	
	*/
}

if(!empty($_GET['selectProject']) && $_GET['selectProject']=='new'){
	
	// add new project
	
	$projectData = $tidioIntegratorOptions->addUserProject( get_option('siteurl') );
		
	$tidioIntegratorOptions->setUserProject($projectData['private_key']);
	
	//
	
	location_reload();
	
} else if(!empty($_GET['selectProject']) && strlen($_GET['selectProject'])==32){
	
	// connect site with extisting project
	
	$tidioIntegratorOptions->setUserProject($_GET['selectProject']);
	
	location_reload();
	
}

//

$view['projects'] = $userProjects;

$view['page'] = 'options-projects';