    
    <ul class="tab-nav clearfix">
        <li class="active"><a href="#tab-register">Create an account</a></li>
        <li class=""><a href="#tab-login">Login</a></li>
    </ul>
    
    <div id="tab-register" class="tab-content active">
    	
        <p>You don't have a Tidio Elements account yet? Set it up in less than 20 seconds!</p>
        
        <form method="post" action="" class="form-default form-without-label" autocomplete="0">
        	
            <?php if(!empty($view['registerFormError'])): ?>
            <div class="alert alert-danger"><?php echo $view['registerFormError'] ?></div>
            <?php endif; ?>
        
            <div class="e">
                <input type="text" placeholder="Enter your email address here..." name="register-email">
            </div>
            <div class="e">
                <input type="password" placeholder="Enter your password here..." name="register-password">
            </div>
            <div class="e-submit">
                <button class="btn" type="submit" name="register-submit" value="1">Create an account</button>
            </div>
        </form>  
        
        <br />

        <p><strong>You need more information to make your decision?</strong> See how Tidio Elements works</p>
         
         <iframe width="640" height="360" src="//www.youtube-nocookie.com/embed/KK6ptPwbgLE?rel=0" frameborder="0" class="youtube-iframe" allowfullscreen></iframe>
                
    </div>
    
    <div id="tab-login" class="tab-content">
    	
        <p>You already have an account? Log in to connect your site to Tidio Elements!</p>
        
        <form method="post" action="" class="form-default form-without-label" autocomplete="off">
            <?php if(!empty($view['loginFormError'])): ?>
            <div class="alert alert-danger"><?php echo $view['loginFormError'] ?></div>
            <?php endif; ?>        
        
            <div class="e">
                <input type="text" placeholder="Enter your email address here..." name="login-email">
            </div>
            <div class="e">
                <input type="password" placeholder="Enter your password here..." name="login-password">
            </div>
            <div class="e-submit">
                <button class="btn" type="submit" name="login-submit" value="1">Log in</button>
            </div>
        </form>  
                        
    </div>                   
<script src="<?php echo $view['extensionUrl'] ?>media/js/tidio-integrator-options.js"></script>

<script>

var $ = jQuery;

tidioIntegratorOptions.create({
	extension_url: '<?php echo $view['extensionUrl'] ?>'
});

</script>
