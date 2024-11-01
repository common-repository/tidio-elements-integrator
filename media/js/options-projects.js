var optionsProjects = {
	
	projects: null,
	
	create: function(data){
		
		this.projects = data.projects;
		
		//
				
        this.initEvents();
        
		this.autoSelectProject();
		
	},
	
	autoSelectProject: function(){
		
		var this_host = location.host,
			project_data = null;
		
		for(i in this.projects){
			
			var e = this.projects[i];
			
			if(e.url_host==this_host){
				
				project_data = e;
				
			}
			
		}
		
		if(!project_data){
			
			var q = confirm('No project was found, would you like to add a new one?');

			if(q){
				
				optionsProjects.selectProject('new');
				
			}
			
		} else {
			
			var q = confirm('Project "' + project_data['name'] + '" was found, do you wish to connect it with your site?');

			if(q){
				
				optionsProjects.selectProject(project_data['private_key']);
				
			}
			
		}
		
	},
	
	//
    
    initEvents: function(){
    
    		$(".projects .e").on('click', function(){
			
			var private_key = this.getAttribute('data-private-key');
			
			if(private_key=='new'){
				
				optionsProjects.selectProject(private_key);
				
				return false;
				
			} else {
			
				var q = confirm('Are you sure you want to integrate this project?');
				
				if(q){
									
					optionsProjects.selectProject(private_key);
					
				}
			
			}
			
		});

	},
	
	selectProject: function(private_key){

		var url = location.origin + location.pathname + location.search;
				
		if(location.search && location.search.indexOf('?') > -1){
					
			url += '&selectProject=' + private_key;
					
		} else {
					
			url += '?selectProject=' + private_key;
		}
				
		location.href = url;

	}
	
}