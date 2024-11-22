<?php echo $this->Html->script(array('jquery.validate.min','additional-methods.min'));?>
<div class="full ew-account-page margin-bottom20">
    <div class="row">    
        <!-- <div class="col-lg-12"><div class="ew-title full">Client Information</div></div> -->
        <div class="col-sm-12 ew-account-form-fields">           
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Session->flash(); ?>
                </div>
            </div>
            <?php
            echo $this->Form->create('StaffUser', array('url'   => array('controller' => 'users','action' => 'signup'), 'type' => 'file', 'inputDefaults' => array('class' => 'form-control', 'label' => false,'div' => false,),'id' => 'register_from','novalidate'));
            echo $this->Form->input("StaffUser.staff_role_id",array("type"=>"hidden","value"=>3));
            echo $this->Form->input("StaffUser.redirect",array("type"=>"hidden","value"=>'users/payment'));
            ?>
            <div class="row">
                <div class="col-lg-12 ew-account-sub-head"><h4>Fill information and checkout</h4></div>
                <div class="col-sm-12 form-group">
                    <?php echo $this->Form->input('first_name', array("type" => 'text','maxlength'=>"50",'class'=>'form-control',"required"=>"required",'placeholder'=>"Please enter first name")); ?>                        
                </div> 
                <div class="col-sm-12 form-group">
                    <?php echo $this->Form->input('last_name', array("type" => 'text','maxlength'=>"50",'class'=>'form-control',"required"=>"required",'placeholder'=>"Please enter last name")); ?>                        
                </div>                    
            </div> 
            <div class="row">
                <div class="col-sm-12 form-group">
                    <?php
                    echo $this->Form->input('email', array("type" => 'text','maxlength'=>"50",'class'=>'form-control',"required"=>"required",'placeholder'=>"Please enter email",'onchange'=>"check_user_email();",'autocomplete' => 'off'));
                    ?>                        
                </div>
                <div class="col-sm-12 form-group">
                    <?php
                    echo $this->Form->input('password', array("type" => 'password','minlength'=>"8",'maxlength'=>"50",'class'=>'form-control',"required"=>"required",'placeholder'=>"Please enter password",'autocomplete' => 'off'));
                    ?>                        
                </div>
                <!-- <div class="col-sm-12 form-group">
                    <label>Confirm E-mail *</label>  
                    <?php
                    echo $this->Form->input('confirm_email', array("type" => 'text','maxlength'=>"50",'class'=>'form-control',"required"=>"required"));
                    ?>                        
                </div>  -->
            </div>
             <!--  <div class="row">
                
              <div class="col-sm-12 form-group">
                    <label>Confirm Password *</label>                          
                    <?php
                    echo $this->Form->input('verify_password', array("type" => 'password','minlength'=>"8",'maxlength'=>"50",'class'=>'form-control',"required"=>"required"));
                    ?>
                </div>  
            </div> -->
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div style="padding-top: 15px;" class="col-lg-12 form-group ew-captch-div has-feedback">
                         <script src='https://www.google.com/recaptcha/api.js'></script>
                         <div class="g-recaptcha" data-sitekey="<?php echo Configure::read('recaptcha_key');?>"></div>
                         <div id="g-recaptcha-error"></div>                     
                    </div> 
                 </div>
            </div> -->
            <div class="row">
                <div class="col-lg-12 form-group">
                    <?php 
                    $disabled=false;
                    if($total_amount<=0){
                        $disabled="disabled";   
                    }

                    echo $this->Form->input('Signup and checkout', array("type" => 'submit','id'=>"submit-btn",'disabled'=>$disabled,'class'=>"buyplan-submitbtn")); ?>  
                </div>     
            </div>  
        </div>          
    </div>
</div> 
<script type="text/javascript">
     $(document).ready(function(){ 
        $("#register_from").validate({
            debug: false,
            rules: {
                "data[StaffUser][first_name]": "required",
                "data[StaffUser][last_name]": "required", 
                "data[StaffUser][password]": {
                    required: true,
                    minlength: 8
                },
                // "data[StaffUser][verify_password]": {
                //     required: true,
                //     minlength: 8,
                //     equalTo: "#StaffUserPassword"
                // },
                "data[StaffUser][email]": {
                    required: true,
                    email: true
                },
                // "data[StaffUser][confirm_email]": {
                //     required: true,
                //     email: true,
                //     equalTo: "#StaffUserEmail"
                // },   
            },
            messages: {
                "data[StaffUser][first_name]": "Please enter your first name",
                "data[StaffUser][last_name]": "Please enter your last name", 
                "data[StaffUser][password]": {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                }, 
                // "data[StaffUser][verify_password]": {
                //     required: "Please provide a password",
                //     minlength: "Your password must be at least 8 characters long",
                //     equalTo: "Please enter the same password."
                // },
                "data[StaffUser][email]": "Please enter a valid email address.",
                "data[StaffUser][confirm_email]":{
                    required: "Please enter email address",
                    equalTo: "Please enter the same email address"
                }
            },
            submitHandler: function(form) {
               ShowLoadingIndicator();
               form.submit();
            }
        });
    });
 </script>