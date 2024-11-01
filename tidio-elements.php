<?php

/**
 * Plugin Name: Tidio Elements Integrator
 * Plugin URI: http://www.tidioelements.com
 * Description: Meet Tidio Elements Integrator, a solution, which allows you to develop your site with tens of plugins including a Newsletter, Chat and many others!
 * Version: 1.3.5
 * Author: Tidio Ltd.
 * Author URI: http://www.tidioelements.com
 * License: GPL2
 */
 
 
if(!class_exists('TidioPluginsScheme')){
	 
	 require 'classes/TidioPluginsScheme.php';
	 
}
 
class TidioIntegrator {
	
	private $scriptUrl = '//tidioelements.com/uploads/redirect/';
	
	private $pageId = '';
	
	private $seoMode = false;
	
	private $tidioProjectData = null;
		
	public function __construct() {
				
		add_action('admin_menu', array($this, 'addAdminMenuLink'));
				
		//
		
		$this->tidioProjectData = $this->getProjectData();
						
		if(!is_admin()){				
						
			if($this->tidioProjectData){
				
				if(!class_exists('TidioElementsParser'))
					require 'classes/TidioElementsParser.php';
				
				TidioElementsParser::start($this->tidioProjectData['public_key']);
				
			} else {
				
				add_action('wp_enqueue_scripts', array($this, 'enqueueScript'));
				
			}
		
		}
			
		//
		
		add_action('deactivate_'.plugin_basename(__FILE__), array($this, 'uninstall'));	
			 			 
	}
	
	public function __destruct(){
		
		if($this->tidioProjectData && !is_admin()){
		
			TidioElementsParser::end();
		
		}
		
	}
	
	// Uninstall
	
	public function uninstall(){
		delete_option('tidio-elements-user-data');
		delete_option('tidio-elements-project-data');
		TidioPluginsScheme::removePlugin('integrator');
	}
	
	// Menu Positions
	
	public function addAdminMenuLink(){
		
        $optionPage = add_menu_page(
			'Tidio Elements', 'Tidio Elements', 'manage_options', 'tidio-integrator', array($this, 'addAdminPage'), plugins_url(basename(__DIR__) . '/media/img/icon.png')
        );
        $this->pageId = $optionPage;
		
	}
	
    public function addAdminPage() {
        // Set class property
        $dir = plugin_dir_path(__FILE__);
        include $dir . 'options.php';
    }

	
	// Enqueue Script
	
	public function enqueueScript(){
		
		if(!$this->tidioProjectData){
			return false;
		}
		
		//		
		
		$iCanUseThisPlugin = TidioPluginsScheme::usePlugin('integrator');
		
		if(!$iCanUseThisPlugin){
			
			return false;
			
		}
				
		wp_enqueue_script('tidio-integrator', $this->scriptUrl.$this->tidioProjectData['public_key'].'.js', array(), '1.0', false);
				
	}
	
	// Project Data
	
	private function getProjectData(){
		
		$tidioProjectData = get_option('tidio-elements-project-data');
		
		if(!$tidioProjectData){
			
			return false;
			
		}
		
		return json_decode($tidioProjectData, true);
		
	}
	
	// Ajax Response
	
	public function ajaxResponse($status = true, $value = null){
		
		echo json_encode(array(
			'status' => $status,
			'value' => $value
		));	
		
		exit;
			
	}
}

$TidioIntegrator = new TidioIntegrator();



