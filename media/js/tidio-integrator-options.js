var tidioIntegratorOptions = {
	
	extension_url: null,
			
	//
		
	create: function(data){
		
		var default_data = {
			extension_url: null,
			public_key: null,
			private_key: null,
		};
		
		data = $.extend(default_data, data);
		
		//
		
		this.extension_url = data.extension_url;
		
		//
		
		this.initTab();
				
	},
		
	// INIT TAB
	
	initTab: function(){
		
		$(document).delegate('.tab-nav > li > a', 'click', function(){
			
			var $this = $(this);
			
			tidioIntegratorOptions.showTab($this);
			
			return false;
			
		});
		
		//
		
		if(location.hash.length > 1){
			
			this.showTab('#' + location.hash.substr(2));
			
		}
		
	},
	
	showTab: function($this){
		
		if(typeof $this=='string'){
			
			$this = $('.tab-nav a[href=' + $this + ']');
			
		}
		
		this_link = $this.attr('href');
							
		$this.parent().parent().children().removeClass('active');
			
		$this.parent().addClass('active');
			
		//
			
		$(this_link).parent().find('.tab-content.active').removeClass('active');
			
		$(this_link).addClass('active');
		
		//
		
		location.hash = '!' + this_link.substr(1);
		
		return true;
	}
	
};