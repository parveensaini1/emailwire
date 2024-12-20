<?php include('includes/header.php');?>
<?php 
	// if(isset($_COOKIE['logged_in'])&&!empty($_COOKIE['logged_in'])){
	// 	echo '<script type="text/javascript">window.location = "'.addslashes($redirect_to).'";</script>';
	// 	exit;
	// }else{ 
	// 	echo '<script type="text/javascript">window.location = "'.addslashes(SITEURL."/users/login").'";</script>';
	// 	exit;
	// }

	//Redirection
	if(isset($_GET['redirect'])) 
	{
		$redirect_array = explode('redirect=', $_SERVER['REQUEST_URI']);
		$redirect = $redirect_array[1];
	}
	else $redirect = '';
	
	//Check error
	$error = isset($_GET['e']) ? $_GET['e'] : '';
	$info = isset($_GET['i']) ? $_GET['i'] : '';
	
	unlog_session();
?>
<style type="text/css">
	#wrapper 
	{		
		height: 70px;	
		margin: -150px 0 0 -130px;
		position: absolute;
		top: 50%;
		left: 50%;
	}
	h2
	{
		margin-top: -10px;
	}
	#forgot-form {
		width:262px;
		height: 158px;
		left:59%;
		overflow: hidden;
	}
	.session_error{
		width: 220px;
	}
</style>
<div>
    <div id="wrapper">
	    
    	<?php if($error==1):?><div class="alert alert-danger" id="e1">Please fill in both email and password.</div><?php endif;?>
    	<?php if($error==2):?><div class="alert alert-danger" id="e2" style="width: 208px;">Incorrect password or user does not exist.</div><?php endif;?>
    	<?php if($error==3):?><div class="alert alert-danger" id="e3" style="width: 208px;">Invalid password reset request.</div><?php endif;?>
    	<?php if($info==1):?><div class="alert alert-success" id="i1" style="width: 208px;">Your new password has been sent to you.</div><?php endif;?>
	    <form class="well form-inline" method="post" action="<?php echo get_app_info('path')?>/includes/login/main.php">
	      <h2><span class="icon icon-lock" style="margin: 7px 7px 0 0;"></span><?php echo _('Login');?></h2><br/>
		  <input type="text" class="input" placeholder="<?php echo _('Email');?>" name="email" id="email"><br/><br/>
		  <input type="password" class="input" placeholder="<?php echo _('Password');?>" name="password"><br/><br/>
		  <input type="hidden" name="redirect" value="<?php echo htmlentities($redirect, ENT_QUOTES);?>"/>
		  <button type="submit" class="btn"><i class="icon icon-signin"></i> <?php echo _('Sign in');?></button><br/><br/>
		  <p><a href="#forgot-form" title="" data-toggle="modal" class="recovery" id="forgot-btn"><?php echo _('Forgot password?');?></a></p>
		</form>
    </div>   
    
    <div id="forgot-form" class="modal hide fade" style="height: 175px;">
	    <form class="well form-inline" method="post" action="<?php echo get_app_info('path')?>/includes/login/forgot.php" id="forgot">
	      <h2><span class="icon icon-meh"></span> <?php echo _('Forgot password?');?></h2><br/>
		  <input type="text" class="input" placeholder="<?php echo _('Your email');?>" name="email" id="forgot-email"><br/><br/>
		  <button type="submit" class="btn" id="send-pass-btn"><i class="icon icon-key"></i> <?php echo _('Send password reset email');?></button>
		</form>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#email").focus();
				$("#forgot-btn").click(function(){
					$("#forgot-email").val($("#email").val());
				});
				$("#forgot").submit(function(e){
					e.preventDefault(); 
					
					$("#send-pass-btn").html("<i class=\"icon icon-envelope\"></i> <?php echo _('Sending');?>..");
					
					var $form = $(this),
					email = $form.find('input[name="email"]').val(),
					url = $form.attr('action');
					
					$.post(url, { email: email },
					  function(data) {
					      if(data)
					      {
					      	$("#send-pass-btn").html("<i class=\"icon icon-key\"></i> <?php echo _('Send password reset email');?>");
					      	
					      	if(data=='<?php echo _('Email does not exist.');?>')
					      		alert('<?php echo _('Email does not exist.');?>');
					      	else 
					      	{
						      	$('#forgot-form').modal('hide');
						      	$('#password-sent').modal('show');
						      	
						      	if(data=='main_user')
							      	$("#additional-line").show();
						      	else 
						      		$("#additional-line").hide();
					      	}
					      }else{
					      	alert("<?php echo _('Sorry, unable to reset password. Please try again later!');?>");
					      }
					  }
					);
				});
			});
		</script>
    </div>
    
    <div id="password-sent" class="modal hide fade">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h3><span class="icon icon-envelope"></span> <?php echo _('Password reset email has been sent to you');?></h3>
    </div>
    <div class="modal-body">
	    <p>A password reset email has been sent to you. Please check your inbox as well as your spam folder for the email. 
		    <br/><br/> 
		    <span id="additional-line">If you don't receive the password reset confirmation email, please <a href="https://sendy.co/troubleshooting#forgot-password" target="_blank" style="text-decoration: underline;">see this troubleshooting tip</a>.</span>
		</p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-inverse" data-dismiss="modal"><i class="icon icon-ok-sign" style="margin-top: 5px;"></i> <?php echo _('Close');?></a>
    </div>
    </div>
</div>

</body>
</html>