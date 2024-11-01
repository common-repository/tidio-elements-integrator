<div class="projects">
	
    <?php if(empty($view['projects'])){ ?>
    
   	<div class="alert alert-info">No project was chosen, click here to add a project</div>
    
    <?php } else { ?>
    
    <div class="projects clearfix">
    
    <div class="alert alert-info">Choose a project to integrate</div>

	<?php foreach($view['projects'] as $e) { ?>
        
    <div class="e" data-private-key="<?php echo $e['private_key'] ?>">
    	<div class="photo"><img src="//free.pagepeeker.com/v2/thumbs.php?size=m&url=<?php echo urlencode($e['url']) ?>" /></div>
        <div class="name"><?php echo $e['name'] ?></div>
    </div>	
    
    <?php } ?>
    
    <div class="e" data-private-key="new">
    	<div class="photo blank"></div>
        <div class="name">Add new project</div>
    </div>	
    
    </div>
    
    <?php } ?>
    
    <script src="<?php echo $view['extensionUrl'] ?>media/js/options-projects.js"></script>
    
    <script>
	
	$(document).ready(function(){
	
		optionsProjects.create({
			projects: <?php echo json_encode($view['projects']) ?>
		});
	
	});
	
	</script>
    
</div>