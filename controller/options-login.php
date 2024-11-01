<?php

// Register

if(!empty($_POST['register-submit'])){
	
	$registerEmail = $_POST['register-email'];

	$registerPassword = $_POST['register-password'];
	
	$formError = null;
	
	//
	
	if(empty($registerEmail) || empty($registerPassword)){
		
		$formError = 'You have left some fields empty';
		
	} else if(!filter_var($registerEmail, FILTER_VALIDATE_EMAIL)){
		
		$formError = 'Podany przez Ciebie email jest nieprawidłowy';
		
	}
	
	if(!$formError){
		
		$registerData = $tidioIntegratorOptions->doRegisterUser($registerEmail, $registerPassword);
		
		if(!$registerData[0] && $registerData[1]=='ERR_EMAIL'){
			
			$formError = 'The account already exists.';
			
		} else if(!$registerData[0]){
			
			$formError = 'When registering in an unknown error occurred.';
			
		} else {
			
			$tidioIntegratorOptions->setUserData($registerData[1]);
			
			echo '<script> location.reload(); </script>';
			
			exit;
						
		}
				
	}
	
	if($formError){
		
		$view['registerFormError'] = $formError;
		
	}
	
}

// Login

if(!empty($_POST['login-submit'])){
	
	$loginEmail = $_POST['login-email'];

	$loginPassword = $_POST['login-password'];
	
	$formError = null;
	
	//
	
	if(empty($loginEmail) || empty($loginPassword)){
		
		$formError = 'You have left some fields empty';
		
	} else if(!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)){
		
		$formError = 'Your email address is incorrect';
		
	}
	
	if(!$formError){
		
		$loginData = $tidioIntegratorOptions->doLoginUser($loginEmail, $loginPassword);
		
		if(!$loginData[0]){
			
			$formError = 'When logging in an unknown error occurred.';
			
		} else {
			
			$tidioIntegratorOptions->setUserData($loginData[1]);
			
			echo '<script> location.reload(); </script>';
			
			exit;
						
		}
				
	}
	
	if($formError){
		
		$view['loginFormError'] = $formError;
		
	}
	
}

$view['page'] = 'options-login';
