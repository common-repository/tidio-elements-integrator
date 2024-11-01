<?php

require "helpers.php";
require "classes/TidioIntegratorOptions.php";

if(!class_exists('TidioPluginsScheme')){
    require "classes/TidioPluginsScheme.php";
}

TidioPluginsScheme::registerPlugin('integrator');

$tidioIntegratorOptions = new TidioIntegratorOptions();

$view = array();

$view['extensionUrl'] = content_url().'/plugins/tidio-elements-integrator/';

//

wp_register_style('tidio-integrator-css', plugins_url('media/css/app-options.css', __FILE__) );

wp_enqueue_style('tidio-integrator-css' );

//

$userData = $tidioIntegratorOptions->getUserData();

$userProject = $tidioIntegratorOptions->getUserProject();

//

require 'controller/options-base.php';

if(!$userData){
	
	require 'controller/options-login.php';
		
} else if($userProject){
	
	require 'controller/options-project.php';
	
} else {

	require 'controller/options-projects.php';
	
}

//

if(isset($_GET['seoMode'])){
	
	$seoMode = false;
	
	if($_GET['seoMode']=='1'){
		$seoMode = true;
	}
	
	$tidioIntegratorOptions->seoModeUpdate($seoMode);
	
}


?>

<script> var $ = jQuery; </script>


<div class="wrap tidio-content">
	
    <a href="http://www.tidioelements.com/?utm_source=wordpress&utm_medium=cpc&utm_campaign=plugin_integrator" id="tidio-top-logo" target="_blank"></a>
    
    <h2>Tidio Elements Integrator 
    <?php if($userData){ ?>
    <a href="<?php echo admin_url('admin.php?page=tidio-integrator&tidioLogout=1') ?>" class="logout-link">logout</a>
    <?php } ?>
    </h2>

<?php

if(!empty($view['page'])){
	
	require 'views/'.$view['page'].'.php';
	
} 
?>

<?php /*

<hr style="width: 100%;" />

<?php if(!$tidioIntegratorOptions->seoMode()){ ?>

<p><a href="<?php echo admin_url('admin.php?page=tidio-integrator&seoMode=1') ?>"><strong>turn on</strong> seo compatibility mode</a></p>

<?php } else { ?>

<p><a href="<?php echo admin_url('admin.php?page=tidio-integrator&seoMode=0') ?>"><strong>turn off</strong> seo compatibility mode</a></p>

<?php } */ ?>

</div>



