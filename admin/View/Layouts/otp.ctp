<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title_for_layout; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <?php
        echo $this->Html->css(
                array(
                    '/plugins/bootstrap/css/bootstrap.min',
                    '/plugins/dist/css/adminlte.min.css',
                    '/plugins/iCheck/square/blue',
                    '/plugins/toastr/toastr.min', 
                )
        );
       echo $this->Html->script(
            array(
                'jquery.min.js', 
            )
        );
        ?>
        <script>
            var appUrl = '<?php echo SITEURL; ?>';
            var SITEFRONTURL = '<?php echo SITEFRONTURL; ?>';
            var CONTROLLER = '<?php echo $this->params->controller; ?>';
        </script> 
 

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITEFRONTURL.'img/favicon';?>/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo SITEFRONTURL.'img/favicon';?>/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITEFRONTURL.'img/favicon';?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo SITEFRONTURL.'img/favicon';?>/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITEFRONTURL.'img/favicon';?>/favicon-16x16.png">
<link rel="manifest" href="<?php echo SITEFRONTURL.'img/favicon';?>/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo SITEFRONTURL.'img/favicon';?>/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    </head>
    <body class="login-page" ng-controller="AppCtrl">
    <div id="AjaxLoading" style="display:none;" class="spinner-container"><div class="loader-main"><div class="cssload-loader"><div class="cssload-inner cssload-one"></div><div class="cssload-inner cssload-two"></div><div class="cssload-inner cssload-three"></div></div><p>Please wait ...</p></div></div>
        <div class="login-card">
            <section class="content" style="min-height:auto;padding: 0px 0px 25px 0px;">
                <div class="row">
                    <div class="col-md-12">

                        <?php
                        echo $this->Session->flash();
                        ?>
                    </div><!-- /.col --> 
                </div>
            </section>
            <div class="login-logo">
                <div><a href="<?php echo SITEFRONTURL; ?>"><img src="<?php echo SITEURL; ?>img/emailwire_logo_final.png" /></a></div>
<!--                <b><a href="<?php echo SITEFRONTURL; ?>">Emailwire CMS</a></b>-->
            </div><!-- /.login-logo -->
            <div class="login-card-body">                      
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<p class="login-box-msg">Enter your username and password</p>
<?php echo $this->Form->create('StaffUser', array('inputDefaults' => array('div' => false, 'class' => 'form-control', 'label' => false, 'required' => false))); ?>            
<div class="form-group has-feedback">
    <?php echo $this->Form->input('email', array('placeholder' => "Email")); ?>
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
    <?php echo $this->Form->input('password', array('placeholder' => "Password")); ?>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="form-group has-feedback" id="otp-container">
    <?php echo $this->Form->input('otp', ['placeholder' => "Enter OTP"]); ?>
    <span class="glyphicon glyphicon-send form-control-feedback"></span>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8">
        <input type="checkbox"> Remember Me 
    </div><!-- /.col -->
    <?php if($env == 'production'){ ?>
    <div style="padding-top: 15px;" class="col-lg-12 form-group ew-captch-div has-feedback">
         <script src='https://www.google.com/recaptcha/api.js'></script>
         <div class="g-recaptcha" data-sitekey="<?php echo Configure::read('recaptcha_key');?>"></div>
         <div id="g-recaptcha-error"></div>                       
    </div> 
    <?php } ?>
    <div class="col-xs-4 col-sm-4">
        <button type="submit" <?php if($env == 'production'){ ?> onclick="validationrecaptcha(event);" <?php } ?> class="btn btn-info  float-right">Sign In</button>
    </div><!-- /.col -->
</div>
<?php echo $this->Form->end(); ?>

<div class="social-auth-links text-center">
    <p>- OR -</p>

</div><!-- /.social-auth-links -->
<?php echo $this->Html->link('I forgot my password', array('controller' => 'staffUsers', 'action' => 'forgot', 'admin' => false)); ?>

<script type="text/javascript">
   function validationrecaptcha(event) { 
        event.preventDefault();
        var response = grecaptcha.getResponse();
        console.log(response);
        document.getElementById('g-recaptcha-error').innerHTML='';
        if(response.length == 0) {
            document.getElementById('g-recaptcha-error').innerHTML = '<label style="color:red;">This field is required.</label>';
            return false;
        }
        $("#StaffUserLoginForm").submit();
        ShowLoadingIndicator();

    }
    
</script>
            </div><!-- /.login-card-body -->
        </div><!-- /.login-card -->
        <?php
        echo $this->Html->script(
                array(  
                    '/plugins/bootstrap/js/bootstrap.min',
                    '/plugins/iCheck/icheck.min',
                    '/plugins/toastr/toastr.min'
                )
        );
        ?>

        <script>

                    $(function () {

                        $('input').iCheck({
                            checkcardClass: 'icheckcard_square-blue',
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%' // optional
                        });
                    });
        </script>
        <?php //echo $this->element('message'); ?>
    </body>
</html>
