<?php

class TidioIntegratorOptions {
	
	private $apiHost = 'http://www.tidioelements.com/';
		
	public function getUserData(){
		
		$userData = get_option('tidio-elements-user-data');
		
		if(!$userData)
		
			return null;
			
		return json_decode($userData, true);
		
	}
	
	public function seoMode(){
		
		$seoMode = get_option('tidio-elements-seo-mode');
		
		if(!$seoMode){
			return false;
		} 
		
		return true;
		
	}
	
	public function seoModeUpdate($status){
		
		if(!$status){
			delete_option('tidio-elements-seo-mode');
		} else {
			update_option('tidio-elements-seo-mode', '1');
		}
		
	}
	
	public function setUserData($userData){
		
		update_option('tidio-elements-user-data', json_encode($userData));
		
	}
	
	//
	
	public function setUserProject($privateKey){

		$userProjects = $this->getUserProjects(false);
		
		if(!$userProjects)
			
			return false;
			
		$projectData = null;
		
		foreach($userProjects as $e){
			
			if($e['private_key']==$privateKey)
				
				$projectData = $e;
			
		}
		
		if(!$projectData)
			
			return false;
			
		//
		
		update_option('tidio-elements-project-data', json_encode($projectData));

	}
	
	public function getUserProject(){
		
		$userProject = get_option('tidio-elements-project-data');
		
		if(!$userProject)
			
			return false;
			
		return json_decode($userProject, true);
		
	}
	
	public function getUserProjects($noCache = false){

		$userData = $this->getUserData();
		
		if(!$userData)
			
			return false;
			
		//
				
		$apiData = $this->getApiData('/apiUser/userProjects', array(
			'userAccessKey' => $userData['access_key']
		));
		
		if(!$apiData[0])
			
			return false;
			
		return $apiData[1];

	}
	
	//
	
	public function doRegisterUser($email, $password){

		$apiData = $this->getApiData('/apiUser/userRegister', array(
			'userEmail' => $email,
			'userPassword' => $password
		));
		
		if(!$apiData)
			
			return false;
		
		return $apiData;

	}
	
	public function doLoginUser($email, $password){
						
		$apiData = $this->getApiData('/apiUser/userLogin', array(
			'userEmail' => $email,
			'userPassword' => $password
		));
		
		return $apiData;
		
	}
		
	public function addUserProject($projectUrl){
		
		$userData = $this->getUserData();
		
		if(!$userData)
			
			return false;
			
		//
				
		$apiData = $this->getApiData('/apiUser/addProject', array(
			'userAccessKey' => $userData['access_key'],
			'projectUrl' => $projectUrl
		));
		
		return $apiData[1];
		
	}
	
	//
	
	public function logout(){
		
		delete_option('tidio-elements-project-data');

		delete_option('tidio-elements-user-data');
		
	}
	
	//
	
	private function getApiData($url, $attr = array()){
		
		$attr['platform'] = 'wordpress';
		
		$attr['platformType'] = 'integrator';
		
		$attr['_ip'] = $_SERVER['REMOTE_ADDR'];
		
		//
		
		$apiUrl = $this->apiHost.$url.'?'.http_build_query($attr);
		
		$apiData = $this->getUrlData($apiUrl);
		
		$apiData = json_decode($apiData, true);
		
		if(!$apiData['status'])
			
			return array(false, $apiData['value']);
			
		return array(true, $apiData['value']);
		
	}
	
	private function getUrlData($url){
		
		try {
		
			$ch = curl_init();
		
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
		
			$data = curl_exec($ch);
			curl_close($ch);
		
		} catch(Exception $e){
			
			@$data = file_get_contents($url);
						
		}
		
		if(!$data){
			$data = null;
		}
		
		return $data;
		
	}
		
}