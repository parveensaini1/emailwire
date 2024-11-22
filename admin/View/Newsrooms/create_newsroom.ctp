<style>
    .ew-account-sub-head h4 {
        color: #000;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        margin-top: 25px;
    }

    #submit-btn {
        background: #fa7d07;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        width: auto;
        text-align: center;
        height: 36px !important;
        border: none;
        padding: 0px 30px;
    }
</style>
<?php
echo $this->Html->css(array('cropper.min'));
echo $this->Html->script(array('jquery.validate.min', 'additional-methods.min', 'cropper.min'));
//custom_newsroom
echo $this->element('popup_company_alert');
echo $this->element('image_crop_banner');
echo $this->element('image_crop_logo');
echo $this->element('image_crop_profile');
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <!-- /.card-heading -->
            <div class="card-body">
                <div class="full ew-account-page margin-bottom20">
                    <div class="row">
                        <div class="col-sm-12 ew-account-form-fields">
                            <?php if (!$this->Session->read('Auth.User.id')) { ?>
                                <p>Create an account to submit press releases. The information required here should be legitimate business or personal information, contact persons and media assets necessary to distribute your news and to create your company or individual newsroom.</p>
                                <p>Note: If you want to subscribe to news, or if you are a journalist, blogger or other media professional please register to receive the news you want here:</p>
                                <p>Each press release you submit will be published under a newsroom that belongs to a company, organization, an individual entity or a domain name. There is a one-time cost $49 cost approve to verify and approve each application. </p>
                            <?php } ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Session->flash();
                                    ?>
                                </div>
                            </div>
                            <div id="form-sec" class="">
                                <?php
                                $userData = (!empty($this->data['StaffUser'][0])) ? $this->data['StaffUser'][0] : [];
                                if (empty($userData) && !empty($this->data['StaffUser'])) {
                                    $userData = $this->data['StaffUser'];
                                }
                                $userFieldReadOnly = false;
                                if (!empty($userData['id'])) {
                                    $userFieldReadOnly = true;
                                }

                                echo $this->Form->create('StaffUser', array('type' => 'file', 'inputDefaults' => array('class' => 'form-control', 'label' => false, 'div' => false,), "id" => "register_from", 'validate'));
                                echo $this->Form->input("pr_amount", array("type" => "hidden", "value" => Configure::read('Site.newsroom.amount')));
                                echo $this->Form->input("StaffUser.staff_role_id", array("type" => "hidden", "value" => 3));
                                echo $this->Form->input("StaffUser.id", array("type" => "hidden", "value" => (!empty($userData['id'])) ? $userData['id'] : null, "id" => "staff-user-id"));
                                echo $this->Form->input("pr_currency", array("type" => "hidden", "value" => Configure::read('Site.currency')));
                                echo $this->Form->input("total_amount", array("type" => "hidden", "value" => Configure::read('Site.newsroom.amount')));
                                echo $this->Form->input("$model.id", array("type" => "hidden"));

                                ?>
                                <div id="clientinfo" class="row">

                                    <div class="col-lg-12 ew-account-sub-head">
                                        <h4>Client Detail</h4>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>E-mail *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill email here"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input('email', array("type" => 'email', 'maxlength' => "50", 'onchange' => "search_user_by_email(this.value)", 'class' => 'form-control', "required" => "required", "value" => (!empty($userData['email'])) ? $userData['email'] : null, 'data-msg' => "Please enter email.", "autocomplete" => false, "readonly" => $userFieldReadOnly));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Confirm E-mail *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill confirm email here"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input('confirm_email', array("type" => 'email', 'maxlength' => "50", 'class' => 'form-control', "required" => "required", "value" => (!empty($userData['email'])) ? $userData['email'] : null, "equalTo" => "#StaffUserEmail", 'data-msg' => "Please enter same email.", "readonly" => $userFieldReadOnly));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>First Name *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill first name here"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input('first_name', array("type" => 'text', 'maxlength' => "50", 'class' => 'form-control', "required" => "required", "value" => (!empty($userData['first_name'])) ? $userData['first_name'] : null, 'data-msg' => "Please enter first name.", "readonly" => $userFieldReadOnly));
                                        ?>

                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Last Name *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill last name here"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php

                                        echo $this->Form->input('last_name', array("type" => 'text', 'maxlength' => "50", 'class' => 'form-control', "required" => "required", "value" => (!empty($userData['last_name'])) ? $userData['last_name'] : null, 'data-msg' => "Please enter last name.", "readonly" => $userFieldReadOnly));
                                        ?>
                                    </div>

                                    <?php if (empty($userData['id'])) { ?>
                                        <div class="col-lg-12 ew-account-sub-head newsroom-password-box">
                                            <h4>Password</h4>
                                        </div>
                                        <div class="col-sm-6 form-group newsroom-password-box">
                                            <label>Password *</label>
                                            <a href="#" data-toggle="tooltip" title="Fill password here"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                            <?php
                                            echo $this->Form->input('password', array("type" => 'password', 'minlength' => "8", 'maxlength' => "50", 'class' => 'form-control ', "required" => "required", 'id' => "password", 'data-msg' => "Please enter password.", "autocomplete" => "off"));
                                            ?>
                                        </div>
                                        <div class="col-sm-6 form-group newsroom-password-box">
                                            <label>Confirm Password *</label>
                                            <a href="#" data-toggle="tooltip" title="Fill confirm password here"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                            <?php
                                            echo $this->Form->input('verify_password', array("type" => 'password', 'minlength' => "8", 'maxlength' => "50", 'class' => 'form-control ', "required" => "required", "equalTo" => "#password", 'id' => "verify_password", 'data-msg' => "Please enter same passowrd."));
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <div class="col-sm-6 form-group ew-personal-picture">
                                        <label>Personal Picture </label>
                                        <a href="#" data-toggle="tooltip" title="Choose Image"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <br />
                                        <!-- <p>* Personal Photo should be greate than 200 X 200</p>     -->
                                        <p></p>
                                        <label class="custom-file-upload">
                                            <?php
                                          
                                            $requiredprofile = (!empty($userData['profile_image'])) ? "false" : "required";
                                            echo $this->Form->input('StaffUser.profile_image', array("type" => 'file', 'class' => 'form-control ', "required" => false, 'id' => 'profile_image', 'accept' => 'image/*', 'onchange' => "imagevalidation('profile_image',1,1,'greater')"));
                                            echo $this->Form->input("StaffUser.encodedprofile", array("type" => "hidden", "id" => "encodedprofile", "required" => false));
                                            echo $this->Form->input("StaffUser.profile_path", array("type" => "hidden", "id" => "encodedprofilepath"));
                                            echo $this->Form->input("StaffUser.temp_profile_image", array("type" => "hidden", "id" => "encodedprofileimage", "value" => (!empty($userData['profile_image']) ? $userData['profile_image'] : "")));
                                            ?>
                                            <label style="display: none; width: 150px;" id="profile_image-error"></label>
                                            Browse Picture
                                        </label>
                                        <div class="row dynamic_proimage">

                                            <?php
                                            if (!empty($userData['profile_image']) && $userData['profile_image'] != '') {
                                                echo $this->Html->image(SITEURL . '/files/profile_image/' . $userData['profile_image'], array('width' => "150px", 'class' => 'user-image', "id" => "croped_profile_image"));
                                            } else {
                                                echo '<img style="width: 150px; display: none;" id="croped_profile_image" src="">';
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- media detail -->
                                    <div class="col-lg-12 ew-account-sub-head">
                                        <h4>Media Contact</h4>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Name</label>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Fill media contact name here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php echo $this->Form->input("$model.media_contact_name", array("type" => 'text', 'maxlength' => "50", 'class' => 'form-control ', "required" => false, 'data-msg' => "Please enter media contact name.")); ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Job Title </label>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Fill job title here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.media_job_title", array("type" => 'text', 'maxlength' => "100", 'class' => 'form-control ', "required" => false));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Email</label>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Fill organization type here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.media_email", array("type" => 'email', 'maxlength' => "50", 'class' => 'form-control', "required" => false, 'data-msg' => "Please enter email.", "autocomplete" => "off"));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Telephone</label>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Fill telephone number here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.media_phone_number", array("type" => 'text', 'minlength' => "10", 'maxlength' => "15", 'class' => 'form-control', 'onkeypress' => "return isNumber(event)", "required" => false));
                                        ?>
                                    </div>
                                    <!-- media detail -->

                                    <div class="col-lg-12 ew-account-sub-head">
                                        <h4>Company Information</h4>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Company Name *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill company name here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.name", array("type" => 'text', 'maxlength' => "100", 'class' => 'form-control ', "required" => "required", "id" => "company_name", 'onchange' => "search_company();", 'data-msg' => "Please enter company name.")); //"onkeypress"=>"search_company();",
                                        ?>
                                        <div style="display: none;" id="check_company_message"></div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Contact Name *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill contact name here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.contact_name", array("type" => 'text', 'maxlength' => "50", 'class' => 'form-control ', "required" => true, 'data-msg' => "Please enter contact name."));
                                        ?>

                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Telephone *</label>
                                        <a href="#" data-toggle="tooltip" title="Fill telephone number here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.phone_number", array("type" => 'text', 'minlength' => "10", 'maxlength' => "15", 'class' => 'form-control', 'onkeypress' => "return isNumber(event)",));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Job Title</label>
                                        <a href="#" data-toggle="tooltip" title="Fill job title here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.job_title", array("type" => 'text', 'maxlength' => "100", 'class' => 'form-control ', "required" => false, 'data-msg' => "Please enter job title."));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Organization Type</label>
                                        <a href="#" data-toggle="tooltip" title="Fill organization type here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.organization_type_id", array('empty' => '-Select-', "options" => $organization_list, 'class' => 'form-control ', "required" => false,));
                                        ?>
                                    </div>
                                    <!-- <div class="col-sm-6 form-group">
                                        <label>Fax Number </label>
                                        <a href="#" data-toggle="tooltip" title="Fill fax number here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        //  echo $this->Form->input("$model.fax_number", array("type" => 'text', 'maxlength' => "15", 'onkeypress' => "return isNumber(event)",));
                                        ?>
                                    </div> -->
                                    <div class="col-sm-6 form-group">
                                        <label>Street Address</label>
                                        <a href="#" data-toggle="tooltip" title="Fill street address here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.address", array("type" => 'text', 'maxlength' => "255", 'class' => 'form-control ', "required" => false,));
                                        ?>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>City</label>
                                        <a href="#" data-toggle="tooltip" title="Fill city here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.city", array("type" => 'text', 'maxlength' => "100", 'class' => 'form-control ', "required" => false));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>State / Province </label>
                                        <a href="#" data-toggle="tooltip" title="Fill state/province here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.state", array("type" => 'text', 'maxlength' => "100", 'class' => 'form-control ', "required" => false));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Country </label>
                                        <a href="#" data-toggle="tooltip" title="Fill country here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.country_id", array('empty' => '-Select-', "options" => $country_list, 'class' => 'form-control ', "required" => false,));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Zip Code </label>
                                        <a href="#" data-toggle="tooltip" title="Fill zipcode here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.zip_code", array("type" => 'text', 'maxlength' => "6", 'minlength' => "5", 'class' => 'form-control ', 'minlength' => "5", 'maxlength' => "6", 'onkeypress' => "return isNumber(event)", "required" => false));
                                        ?>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Website URL</label>
                                        <a href="#" data-toggle="tooltip" title="Fill website url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.web_site", array("type" => 'text', 'class' => 'form-control', "required" => false));
                                        ?>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Blog URL </label>
                                        <a href="#" data-toggle="tooltip" title="Fill blog url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.blog_url", array("type" => 'text', 'class' => 'form-control',));
                                        ?>
                                    </div>
                                    <div class="col-lg-12 ew-account-sub-head">
                                        <h4>Company Social Media links</h4>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>LinkedIn</label>
                                        <a href="#" data-toggle="tooltip" title="Fill linked url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.linkedin", array("type" => 'text', 'class' => 'form-control',));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Twitter</label>
                                        <a href="#" data-toggle="tooltip" title="Fill twitter url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.twitter_link", array("type" => 'text', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Facebook</label>
                                        <a href="#" data-toggle="tooltip" title="Fill facbook url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.fb_link", array("type" => 'text', 'class' => 'form-control',));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Pinterest</label>
                                        <a href="#" data-toggle="tooltip" title="Fill pinterest url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.pinterest", array("type" => 'text', 'class' => 'form-control',));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Instagram </label>
                                        <a href="#" data-toggle="tooltip" title="Fill instagram url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.instagram", array("type" => 'text', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Tumblr </label>
                                        <a href="#" data-toggle="tooltip" title="Fill tumbler url here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.tumblr", array("type" => 'text', 'class' => 'form-control ',));
                                        ?>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Company description* </label>
                                        <a href="#" data-toggle="tooltip" title="Fill company description here "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php
                                        echo $this->Form->input("$model.description", array("type" => 'textarea', 'class' => 'editor form-control ', "required" => false, "col" => "30", "row" => "30",));
                                        ?>
                                    </div>

                                    <div class="col-sm-6 form-group ew-company-logo">
                                        <label>Company Logo </label>
                                        <a href="#" data-toggle="tooltip" title="choose image"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <!-- <p>* Company logo should be greater than 255 X 255</p>     -->
                                        <p></p>
                                        <label class="custom-file-upload">
                                            <?php
                                            $requiredlogo = (!empty($this->data[$model]['logo'])) ? "false" : "required";
                                            echo $this->Form->input($model . '.logo', array("type" => 'file', 'class' => 'form-control ', "required" => $requiredlogo, 'id' => 'logo_image', 'accept' => 'image/*', 'onchange' => "imagevalidation('logo_image',1,1,'greater')"));
                                            echo $this->Form->input("$model.encodedlogo", array("type" => "hidden", "id" => "encodedlogo"));
                                            echo $this->Form->input("$model.logo_path", array("type" => "hidden", "id" => "encodedlogopath"));
                                            echo $this->Form->input("$model.temp_logo", array("type" => "hidden", "id" => "encodedlogoimage", "value" => (!empty($this->data[$model]['logo']) ? $this->data[$model]['logo'] : "")));
                                            ?>
                                            <label style="display: none;" id="logo_image-error"></label>
                                            Browse Logo
                                        </label>
                                        <div id="image_err"></div>


                                        <?php
                                        if (isset($this->data[$model]['logo']) && $this->data[$model]['logo'] != '') {

                                            echo "<div id='croped-logo-img-bx' class='row croped-logo-img-section'>" . $this->Html->image(SITEFRONTURL . 'files/company/logo/' . $this->data[$model]['logo_path'] . '/' . $this->data[$model]['logo'], array('width' => "100%", 'id' => 'croped_logo_image')) . "</div>";
                                        } else {
                                            echo "<div id='croped-logo-img-bx' style='display: none;' class='row croped-logo-img-section'><div class='ewlogobx'>" . '<img width="100%" id="croped_logo_image" src=""></div></div>';
                                        }
                                        ?>


                                    </div>
                                    <div class="col-sm-6 form-group ew-personal-picture">
                                        <label>Banner Image</label>
                                        <a href="#" data-toggle="tooltip" title="Choose image"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <!-- <p>* Banner Photo should be greater than 1280 X 320</p>     -->
                                        <p></p>
                                        <label class="custom-file-upload">
                                            <?php
                                            $requiredb = (!empty($this->data[$model]['banner_image'])) ? "false" : "required";
                                            echo $this->Form->input($model . '.banner_image', array("type" => 'file', 'class' => 'form-control ', 'id' => 'banner_image', "required" => $requiredb, 'accept' => 'image/*', 'onchange' => "imagevalidation('banner_image',1,1,'greater')"));

                                            echo $this->Form->input("$model.encodedbanner", array("type" => "hidden", "id" => "encodedbanner"));
                                            echo $this->Form->input("$model.banner_path", array("type" => "hidden", "id" => "encodedbannerpath"));
                                            echo $this->Form->input("$model.temp_banner_image", array("type" => "hidden", "id" => "encodedbannerimage", "value" => (!empty($this->data[$model]['banner_image'])) ? $this->data[$model]['banner_image'] : "",));

                                            ?>
                                            <label style="display: none;" id="banner_image-error"></label>Browse Picture</label>
                                        <div class="row croped-banner-img-section">
                                            <?php
                                            if (isset($this->data[$model]['banner_image']) && $this->data[$model]['banner_image'] != '') {
                                                echo $this->Html->image(SITEFRONTURL . 'files/company/banner/' . $this->data[$model]['banner_path'] . '/' . $this->data[$model]['banner_image'], array('id' => "croped_banner_image"));
                                            } else {
                                                echo '<img width="100%" style="display: none;" id="croped_banner_image" src="">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ew-account-sub-head">
                                        <h4>Media Assets</h4>
                                    </div>

                                    <div class="col-sm-12 ew-account-sub-head">
                                        <h5 class="float-left mr-2">Media Files</h5>
                                        <a href="#" z data-toggle="tooltip" title="File should not be larger than 2MB. PDF and Images are allowed."> <i class="fa fa-question-circle" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <!-- <small class="col-sm-12 mb-4">NOTE:  Each file cannot be larger than 2MB. PDF and Images are allowed.</small>  -->
                                    <div class="ew-extra-file  col-sm-12  col-md-12">
                                        <?php
                                        $countk = (!empty($this->data['CompanyDocument'])) ? count($this->data['CompanyDocument']) : 1;
                                        if ($countk > 5)
                                            $countk = 5;

                                        for ($i = 0; $i < 5; $i++) {
                                            $label = $i + 1;
                                            if ($i < $countk) {
                                                $stylekey = "display:block;";
                                            } else {
                                                $stylekey = "display:none;";
                                            }
                                            $saved = '';
                                            if (!empty($this->data['CompanyDocument'][$i]['id'])) {
                                                $saved = 'saved';
                                                echo $this->Form->input("CompanyDocument.$i.id", array("type" => 'hidden', "value" => $this->data['CompanyDocument'][$i]['id']));
                                            }    ?>
                                            <div id="<?php echo "pimage-" . $i; ?>" style="<?php echo $stylekey; ?>" class="mt-2 row">
                                                <div class="col-sm-5 float-left">
                                                    <?php
                                                    if (!empty($this->data['CompanyDocument'][$i]['file_path']) && !empty($this->data['CompanyDocument'][$i]['file_name'])) {
                                                        $imgname = (!empty($this->data['CompanyDocument'][$i]['file_path'])) ? $this->data['CompanyDocument'][$i]['file_path'] : "";

                                                        echo $this->Form->input("CompanyDocument.$i.company_id", array("type" => 'hidden', 'class' => 'docfileCompanyId', 'value' => (!empty($this->data['CompanyDocument'][$i]['company_id'])) ? $this->data['CompanyDocument'][$i]['company_id'] : '', 'id' => 'docfileCompanyId' . $label, 'required' => false));
                                                        echo $this->Form->input("CompanyDocument.$i.id", array("type" => 'hidden', 'class' => 'docfileid', 'value' => (!empty($this->data['CompanyDocument'][$i]['id'])) ? $this->data['CompanyDocument'][$i]['id'] : '', 'id' => 'docfileCompanyId' . $label, 'required' => false));
                                                    }

                                                    $fileType = (!(empty($this->data['CompanyDocument'][$i]['file_name']))) ? "hidden" : "file";
                                                    $fieldId = "CompanyDocumentName$i";
                                                    ?>
                                                    <label style="display: block;"> Media File <a href="#" data-toggle="tooltip" title="Choose image">
                                                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                        </a></label>

                                                    <label class="custom-file-upload">Browser File

                                                        <?php echo $this->Form->input("CompanyDocument.$i.file_name", array('label' => false, 'class' => "form-control", 'type' => $fileType, 'id' => $fieldId, "onchange" => "loadFile(event,$i)")); ?>
                                                    </label>
                                                    <?php
                                                    echo $this->Form->input("CompanyDocument.$i.file_path", array('label' => false, 'type' => 'hidden', 'id' => $fieldId . '-file_path')); ?>
                                                </div>

                                                <div class="<?php echo "col-sm-4"; ?> float-left caption-pimage-<?php echo $i; ?>" style="display:block;">
                                                    <label>Caption <?php // echo $label; 
                                                                    ?></label>
                                                    <a href="#" data-toggle="tooltip" title="Fill caption here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyDocument.$i.doc_caption", array('label' => false, 'type' => 'text', 'id' => "CompanyDocumentDesc$i")); ?>
                                                </div>
                                                <div id="pimage-preview-<?php echo $i; ?>" class="<?php echo "col-sm-3"; ?> float-left">
                                                    <?php
                                                    if (!empty($this->data['CompanyDocument'][$i]['file_name'])) {
                                                        echo $this->Html->image(SITEURL . 'files/company/docfile/' . $this->data['CompanyDocument'][$i]['file_path'] . '/' . $this->data['CompanyDocument'][$i]['file_name'], array('id' => "extrafileview-$i", 'width' => '100%'));
                                                    } else {
                                                        $imageShowClass = (!empty($this->data['CompanyDocument'][$i]['file_name'])) ? "show" : "hide";
                                                        echo '<img class="' . $imageShowClass . '" id="extrafileview-' . $i . '" width="100%" src="">';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-12 primages-btns mt-2">
                                        <a class='btn btn-info mb-4' id='pimagebtn' href="javascript:void(0)" fnum='<?php echo $countk; ?>' onclick="addmoref('pimage-','pimagebtn','rimgbtn','CompanyDocumentName');">Add More Images</a>
                                        <a class='btn btn-info btn-danger mb-4' id='rimgbtn' href="javascript:void(0)" onclick="removefield('pimage-','pimagebtn','rimgbtn','CompanyDocumentName','CompanyDocumentDesc');">Remove</a>
                                    </div>
                                    <!--  Presentations and PowerPoint -->
                                    <div class="col-lg-12">
                                        <div class="col-sm-12">
                                            <label>Presentations</label>
                                            <a href="#" data-toggle="tooltip" title="Presentation Embed code  "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        </div>
                                        <?php
                                        $countk = (!empty($this->data['CompanyPresentation'])) ? count($this->data['CompanyPresentation']) : 1;
                                        if ($countk > 5)
                                            $countk = 5;

                                        for ($preloop = 0; $preloop < 5; $preloop++) {
                                            $label = $preloop + 1;
                                            if ($preloop < $countk) {
                                                $stylekey = "display:block;";
                                            } else {
                                                $stylekey = "display:none;";
                                            }
                                            if (isset($this->data['CompanyPresentation'][$preloop]['id']) && !empty($this->data['CompanyPresentation'][$preloop]['id'])) {
                                                echo $this->Form->input("CompanyPresentation.$preloop.id", array("type" => 'hidden', "value" => $this->data['CompanyPresentation'][$preloop]['id']));
                                            }
                                        ?>
                                            <div id="<?php echo "prelink-" . $preloop; ?>" style="<?php echo $stylekey; ?>" class="col-sm-12">
                                                <div class="col-sm-7 float-left">
                                                    <label>Presentation Embed code <?php echo $label; ?></label>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="fill presentation embed code here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyPresentation.$preloop.url", array('label' => false, 'type' => 'textarea', 'id' => "presentationUrl$preloop")); ?>
                                                </div>
                                                <div class="col-sm-5  float-left">
                                                    <label>Describe Presentation <?php echo $label; ?></label>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="fill describe precast here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyPresentation.$preloop.description", array('label' => false, 'type' => 'text', 'id' => "presentationDesc$preloop")); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row mt-2 ylink-btns">
                                        <div class="col-sm-12 mt-2">
                                            <a class='btn btn-info' id='prelinkbtn' href="javascript:void(0)" fnum='<?php echo $countk; ?>' onclick="addmoref('prelink-','prelinkbtn','rprelinkbtn','presentationUrl');">Add More Presentation</a>
                                            <a class='btn btn-info btn-danger' id='rprelinkbtn' href="javascript:void(0)" onclick="removefield('prelink-','prelinkbtn','rprelinkbtn','presentationUrl','presentationDesc');">Remove</a>
                                        </div>
                                    </div>

                                    <!--  E-book-->
                                    <div class="col-lg-12 mt-4">
                                        <div class="col-sm-12">
                                            <label>E-Books</label>

                                            <a href="#" data-toggle="tooltip" title="E-Book Embedded code  "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        </div>
                                        <?php
                                        $eCountk = (!empty($this->data['CompanyEbook'])) ? count($this->data['CompanyEbook']) : 1;
                                        if ($eCountk > 5)
                                            $eCountk = 5;

                                        for ($ebookLoop = 0; $ebookLoop < 5; $ebookLoop++) {
                                            $label = $ebookLoop + 1;
                                            if ($ebookLoop < $eCountk) {
                                                $stylekey = "display:block;";
                                            } else {
                                                $stylekey = "display:none;";
                                            }
                                            if (isset($this->data['CompanyEbook'][$ebookLoop]['id']) && !empty($this->data['CompanyEbook'][$ebookLoop]['id'])) {
                                                echo $this->Form->input("CompanyEbook.$ebookLoop.id", array("type" => 'hidden', "value" => $this->data['CompanyEbook'][$ebookLoop]['id']));
                                            }
                                        ?>
                                            <div id="<?php echo "ebooklink-" . $ebookLoop; ?>" style="<?php echo $stylekey; ?>" class="col-sm-12">
                                                <div class="col-sm-7 float-left">
                                                    <label>E-Book Embedded code <?php // echo $label; 
                                                                                ?></label>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="fill E-Book Embedded code here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyEbook.$ebookLoop.embedded", array('label' => false, 'type' => 'textarea', 'id' => "ebookEmbedded$ebookLoop")); ?>
                                                </div>
                                                <div class="col-sm-5  float-left">
                                                    <label>Describe E-Book <?php // echo $label; 
                                                                            ?></label>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Describe E-Book here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyEbook.$ebookLoop.description", array('label' => false, 'type' => 'text', 'id' => "ebookDesc$ebookLoop")); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row mt-2 ebooklink-btns">
                                        <div class="col-sm-12 mt-2">
                                            <a class='btn btn-info' id='ebooklinkbtn' href="javascript:void(0)" fnum='<?php echo $eCountk; ?>' onclick="addmoref('ebooklink-','ebooklinkbtn','rebooklinkbtn','ebookEmbedded');">Add More E-book</a>
                                            <a class='btn btn-info btn-danger' id='rebooklinkbtn' href="javascript:void(0)" onclick="removefield('ebooklink-','ebooklinkbtn','rebooklinkbtn','ebookEmbedded','ebookDesc');">Remove</a>
                                        </div>
                                    </div>


                                    <!--  Podcasts-->
                                    <div class="col-lg-12 mt-4">
                                        <div class="col-sm-12">
                                            <label>Podcasts</label>

                                            <a href="#" data-toggle="tooltip" title="Podcast Embed code  "><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        </div>
                                        <?php
                                        $podCount = (!empty($this->data['CompanyPodcast'])) ? count($this->data['CompanyPodcast']) : 1;
                                        if ($podCount > 5)
                                            $podCount = 5;

                                        for ($podcastLoop = 0; $podcastLoop < 5; $podcastLoop++) {
                                            $label = $podcastLoop + 1;
                                            if ($podcastLoop < $podCount) {
                                                $stylekey = "display:block;";
                                            } else {
                                                $stylekey = "display:none;";
                                            }
                                            if (isset($this->data['CompanyPodcast'][$podcastLoop]['id']) && !empty($this->data['CompanyPodcast'][$podcastLoop]['id'])) {
                                                echo $this->Form->input("CompanyPodcast.$podcastLoop.id", array("type" => 'hidden', "value" => $this->data['CompanyPodcast'][$podcastLoop]['id']));
                                            }
                                        ?>
                                            <div id="<?php echo "podcastlink-" . $podcastLoop; ?>" style="<?php echo $stylekey; ?>" class="col-sm-12">
                                                <div class="col-sm-7 float-left">
                                                    <label>Podcast Embed code <?php //echo $label; 
                                                                                ?></label>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="fill podcast Embed code here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyPodcast.$podcastLoop.embedded", array('label' => false, 'type' => 'textarea', 'id' => "podcastEmbedded$podcastLoop")); ?>
                                                </div>
                                                <div class="col-sm-5  float-left">
                                                    <label>Describe podcast <?php // echo $label; 
                                                                            ?></label>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="fill describe podcastcast here">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </a>
                                                    <?php echo $this->Form->input("CompanyPodcast.$podcastLoop.description", array('label' => false, 'type' => 'text', 'id' => "podcastDesc$podcastLoop")); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row mt-2 podlink-btns">
                                        <div class="col-sm-12 mt-2">
                                            <a class='btn btn-info' id='podcastlinkbtn' href="javascript:void(0)" fnum='<?php echo $podCount; ?>' onclick="addmoref('podcastlink-','podcastlinkbtn','rpodcastlinkbtn','podcastEmbedded');">Add More Podcast</a>
                                            <a class='btn btn-info btn-danger' id='rpodcastlinkbtn' href="javascript:void(0)" onclick="removefield('podcastlink-','podcastlinkbtn','rpodcastlinkbtn','podcastEmbedded','podcastDesc');">Remove</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 form-group mt-2">
                                        <label>How Did You Hear About Us? * </label>
                                        <a href="#" data-toggle="tooltip" title="Fill detail  how did you hear about us"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                        <?php echo $this->Form->input("$model.hear_about_us", array('label' => false, 'type' => 'textarea', "required" => false, "col" => "30", 'class' => "editor form-control", "row" => "30"));
                                        ?>
                                    </div>

                                    <div class="col-lg-12 form-group ew-captch-div mt-4">
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                        <div class="g-recaptcha" data-sitekey="6LeyCh0qAAAAANoeteLgqRIU7o98GcW2Y3lFw18v"></div>
                                        <div id="g-recaptcha-error" style="display: none;"></div>
                                    </div>


                                    <div class="col-lg-12 form-group">
                                        <input id="submit-btn" type="button" value="Preview" class="create-newsroom-btn">
                                        <p style="display: none;" id="create-preview">It will take short while we are creating newsroom preview. </p>

                                    </div>

                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>


                        <!-- End sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .doc-filename {
        margin: 10px 0px;
        border: 1px solid #ccc;
        width: fit-content;
        padding: 5px 10px;
        background: #ddd;
    }
</style>
<script type="text/javascript">
    function addmoref(fieldId, keybtn, rbtnId, inputFieldId) {
        var fnum = $("#" + keybtn).attr('fnum');
        if (fnum >= 0 && fnum < 5) {
            var next = eval(fnum) + 1;
            var previous = eval(fnum) - 1;
            var previousField = $("#" + inputFieldId + previous);
            var genratePreviousfieldErrId = "err-" + inputFieldId + previous;
            var previousVal = previousField.val();
            $("#" + genratePreviousfieldErrId).remove();
            if (previousVal != '') {
                $("#" + keybtn).attr('fnum', next);
                $("#" + fieldId + fnum).show();
                $("#" + rbtnId).show();
                if (inputFieldId == "PressImageName") {
                    $("#" + inputFieldId + fnum).attr('type', "file");
                }
            } else {
                previousField.after("<span id='" + genratePreviousfieldErrId + "' class='text-danger '>Please enter value.</p>");
            }
            if (fnum == 4) {
                $('#keybtn').hide();
            }
        } else {
            $('#keybtn').hide();
        }
    }

    function removefield(fieldId, atagbtn, rbtnId, inputFieldId1 = '', inputFieldId2 = '', inputFieldId3 = '', inputFieldId4 = '') {
        var fnum = $("#" + atagbtn).attr('fnum');
        if (fnum >= 0 && fnum <= 5) {
            var prev = eval(fnum) - 1;
            if (prev <= 0) {
                $("#" + rbtnId).hide();
            }
            if (inputFieldId1 != '') {
                $("#" + inputFieldId1 + prev).val('');
            }
            if (inputFieldId2 != '') {
                $("#" + inputFieldId2 + prev).val('');
            }
            if (inputFieldId3 != '') {
                $("#" + inputFieldId3 + prev).val('');
            }
            if (inputFieldId4 != '') {
                $("#" + inputFieldId4 + prev).val('');
            }
            $("#" + atagbtn).attr('fnum', prev);
            $("#" + fieldId + prev).hide();
            if (inputFieldId1 == "CompanyDocumentName") {
                $("#" + inputFieldId1 + prev).attr('type', "file");
                $("#" + inputFieldId2 + prev).val('');
                $('#pimage-preview-' + prev);
                $('#extrafileview-' + prev).attr('src', '').addClass('hide').removeClass('show');

            }
            $('#keybtn').show();
        }
    }


    var editor = CKEDITOR.replace('TempCompanyDescription', {});
    editor.on('change', function() {
        // var getData = CKEDITOR.instances['TempCompanyDescription'].getData();
        // setCookie('CakeCookie[nr_description]', escape(getData));
    });

    $('body').on('click', '#abtn', function() {
        var count = parseInt($(this).attr('fnum'));
        var file_exist = $("#docfile" + count).val();
        if (file_exist) {
            plus_count = (count + 1);
            $('.docfile-btn').before('<input type="file" name="data[CompanyDocument][' + count + ']" class="form-control " class="docfile" id="docfile' + plus_count + '" file_count="' + plus_count + '" required="required"><div id="filename' + plus_count + '" class="doc-filename" style="display: none;"></div>');
            $('#abtn').attr('fnum', plus_count);
            $('#rbtn').attr('fnum', plus_count);
            if (plus_count == 5) {
                $('#abtn').hide();
            }
        } else {
            $('#docfile' + count).after('<label id="docfile-error' + count + '">Please select file. </label>');
            setTimeout(function() {
                $('#docfile-error' + count).remove();
            }, 2000);
        }
    });
    $('body').on('change', 'input[type="file"]', function() {
        var filename = $(this).val();
        var count = $(this).attr('file_count');
        $(this).hide();
        $('#filename' + count).html(filename);
        $('#filename' + count).show();
        $('#rbtn').show();
    });
    $('body').on('click', '#rbtn', function() {
        console.log('removefile');
        $('#abtn').show();
        var fnum = $(this).attr('fnum');
        minus_fnum = (fnum - 1);
        $('#docfile' + fnum).remove();
        $('#docfile-error' + fnum).remove();
        $('#filename' + fnum).remove();
        if (minus_fnum > 0) {
            $(this).attr('fnum', minus_fnum);
            $('#abtn').attr('fnum', minus_fnum);
        }
        if (fnum == 1) {
            $('#rbtn').hide();
            $('.docfile-btn').before('<input type="file" name="data[CompanyDocument][0]" class="form-control " class="docfile" id="docfile' + fnum + '" file_count="' + fnum + '"><div id="filename' + fnum + '" class="doc-filename" style="display: none;"></div>');
        }
    });


    $(document).ready(function() {
        // search_company();
        $('#submit-btn').on('click', function() {
            var checkvalid = $("#register_from").valid({
                debug: false,
                rules: {
                    "data[TempCompany][phone_number]": {
                        required: true,
                        Number: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    "data[StaffUser][logo]": {
                        required: true,
                        accept: "jpg|jpeg|png",
                    },
                    "data[StaffUser][banner_image]": {
                        required: true,
                        accept: "jpg|jpeg|png",
                    },
                },
                messages: {
                    "data[TempCompany][logo]": {
                        required: "Please upload file.",
                        filesize: "File size must be less than 2000 KB.",
                        accept: "Please upload .jpg or .png or .jpeg file.",
                    },
                    "data[TempCompany][banner_image]": {
                        required: "Please upload file.",
                        filesize: "File size must be less than 2000 KB.",
                        accept: "Please upload .jpg or .png or .jpeg file.",
                    },
                    "data[StaffUser][phone_number]": {
                        required: "Please Enter phone Number.",
                        Number: "Please Enter valid phone Number.",
                        minlength: "Phone Number Enter valid 10 digit phone Number.",
                        maxlength: "Phone Number Enter valid 10 digit phone Number.",
                    },
                    "data[TempCompany][zip_code]": {
                        required: "Please Enter zipcode.",
                        Number: "Please Enter valid zipcode.",
                        minlength: "Phone Number Enter valid 5 zipcode.",
                        maxlength: "Phone Number Enter valid 6 zipcode.",
                    },
                }
            });
            if (checkvalid) {
                var checkCaptchavalid = validationrecaptcha();
                if (checkCaptchavalid != "true") {
                    $("#g-recaptcha-error").html('<label style="color:red;">This field is required.</label>').show();
                } else {
                    $('#AjaxLoading').show();
                    $("#register_from").submit();
                    $("#submit-btn").attr('disabled', 'disabled');
                    $("#create-preview").show();
                }
            } else {
                $('html, body').animate({
                    scrollTop: 520
                }, 'slow');
                $("#submit-btn").removeAttr('disabled');
                $("#create-preview").hide();
            }
        });
    });

    $('#TempCompanyOrganizationTypeId').on('change', function() {
        var selectedText = this.selectedOptions[0].text;
        $("#prev_org").text(selectedText);
        setCookie('CakeCookie[nr_org_name]', selectedText);
    });

    $('#TempCompanyCountryId').on('change', function() {
        var selectedText = this.selectedOptions[0].text;
        $("#prev_country").text(selectedText);
        setCookie('CakeCookie[nr_country_name]', selectedText);
    });


    window.URL = window.URL || window.webkitURL;

    function imagevalidation(imageSelector, getImgwidth = '', getImgheight = '', condtion = 'equal', maxthenImgwidth = '',
        maxthenImghight = '') {
        var getImgwidth = (getImgwidth != '') ? getImgwidth : 200;
        var getImgheight = (getImgheight != '') ? getImgheight : 200;
        var form = $("#register_from");
        var image_err = $("#" + imageSelector + "-error");
        var selector = "#" + imageSelector;
        var flag = 0;
        var fileInput = $("#register_from").find(selector)[0],
            file = fileInput.files && fileInput.files[0];
        if (file) {
            if (file.size <= (1048576 * 2)) {
                var img = new Image();
                img.src = window.URL.createObjectURL(file);
                img.onload = function() {
                    var width = img.naturalWidth,
                        height = img.naturalHeight;
                    window.URL.revokeObjectURL(img.src);
                    if (condtion == "equal" && width == getImgwidth && height == getImgheight) {
                        flag = 1;
                    } else if (condtion == "less" && width <= getImgwidth && height <= getImgheight) {
                        flag = 1;
                    } else if (condtion == "greater" && width >= getImgwidth && height >= getImgheight) {
                        flag = 1;
                    } else if (condtion == "both_less_greater" && (width >= getImgwidth && height >= getImgheight) && (width <= maxthenImgwidth && height <= maxthenImghight)) {
                        flag = 1;
                    }
                    if (flag == 0) {
                        $("#submit-btn").attr('disabled', 'disabled');
                        $con_text = (condtion != "equal") ? condtion + ' Or equal' : condtion;
                        if (condtion != "both_less_greater") {
                            image_err.replaceWith("<label id='" + imageSelector + "-error' class='error' for='StaffUserProfileImage'>The Image Size should be " + $con_text + " " + getImgwidth + " X " + getImgheight + " (width X height).</label>");

                        } else {
                            image_err.replaceWith("<label id='" + imageSelector + "-error' class='error' for='StaffUserProfileImage'>The Image width should be " + getImgwidth + "px to " + maxthenImgwidth + " and height should be " + getImgheight + " to " + maxthenImghight + "px.</label>");
                        }
                        return false;
                    } else {
                        image_err.hide();
                        $("#submit-btn").removeAttr('disabled');
                        image_preview(fileInput, imageSelector);
                        return true;
                    }
                };
            } else {
                $("#submit-btn").attr('disabled', 'disabled');
                image_err.replaceWith("<label id='" + imageSelector + "-error' class='error' for='StaffUserProfileImage'>The Image Size should be less than 2Mb.</label>");
            }
        }
    }


    function image_preview(fileInput, imageSelector) {
        var $modal = $('#modal_' + imageSelector);
        if (imageSelector == "logo_image") {
            var cropimage = document.getElementById('cropimagelogo');
        } else if (imageSelector == "banner_image") {
            var cropimage = document.getElementById('cropimagebanner');
        } else {
            var cropimage = document.getElementById('cropimageprofile');
        }
        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            cropimage.value = '';
            cropimage.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(cropimage);
            reader.readAsDataURL(file);
        }
        $modal.modal({
            backdrop: 'static',
            keyboard: false
        });
    }



    window.addEventListener('DOMContentLoaded', function() {
        var bannerimage_selector = document.getElementById('croped_banner_image');
        var bannercropimage = document.getElementById('cropimagebanner');
        var minCroppedWidth = 1280;
        var minCroppedHeight = 320;
        var maxCroppedWidth = 1900;
        var maxCroppedHeight = 320;
        var $alert = $('.alert');
        var $modal = $('#modal_banner_image');
        var cropbtn = document.getElementById('cropbanner');
        var skipcropbtn = document.getElementById('skipcropbanner');
        var $prevImageSelector = $('#prev_banner_image');

        var cropper;
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(bannercropimage, {
                viewMode: 3,
                data: {
                    width: (minCroppedWidth + maxCroppedWidth) / 2,
                    height: (minCroppedHeight + maxCroppedHeight) / 2,
                },
                crop: function(event) {
                    var width = event.detail.width;
                    var height = event.detail.height;
                    if (
                        width < minCroppedWidth ||
                        height < minCroppedHeight ||
                        width > maxCroppedWidth ||
                        height > maxCroppedHeight
                    ) {
                        cropper.setData({
                            width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                            height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                        });
                    }
                },
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        cropbtn.addEventListener('click', function() {
            var initialAvatarURL;
            var canvas;
            $modal.modal('hide');
            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 1200,
                    height: 320,
                });


                var oldimage = $("#encodedbanner").val();
                uploadImage(oldimage, canvas.toDataURL(), "banner", "encodedbanner", "croped_banner_image", "nr_banner_image", "nr_banner_path", "banner_image-error");
                jQuery('#croped_banner_image').show();
                // var obj = JSON.parse(resultData);
                // var img_url=obj.img_url;
                // $("#encodedbanner").val(img_url);
                // setCookie('CakeCookie[encodedbanner]',img_url); 
                // setCookie('CakeCookie[nr_banner_path]',obj.image_path);
                // setCookie('CakeCookie[nr_banner_image]',obj.image_name);
                // initialAvatarURL = bannerimage_selector.src;
                // bannerimage_selector.src = img_url; 
                // $prevImageSelector.attr("src",img_url.src);  
                // bannerimage_selector.style.display = "block";
                // $alert.removeClass('alert-success alert-warning');
                /*canvas.toBlob(function (blob) {
                  console.log(blob);
                // var formData = new FormData();
                // formData.append('avatar', blob, 'avatar.jpg');

                });*/
            }
        });

        skipcropbtn.addEventListener('click', function() {
            $("#banner_image").val('').show();
        });
    });



    window.addEventListener('DOMContentLoaded', function() {
        var pimage_selector = document.getElementById('croped_profile_image');
        var pcropimage = document.getElementById('cropimageprofile');
        var minCroppedWidth = 10;
        var minCroppedHeight = 10;
        var maxCroppedWidth = 1024;
        var maxCroppedHeight = 1024;
        var $alert = $('.alert');
        var $modal = $('#modal_profile_image');
        var cropbtn = document.getElementById('cropprofile');
        var skipcropbtn = document.getElementById('skipcropprofile');
        var $prevImageSelector = $('#prev_profile_image');
        var cropper;
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(pcropimage, {
                viewMode: 2,
                data: {
                    width: (minCroppedWidth + maxCroppedWidth) / 2,
                    height: (minCroppedHeight + maxCroppedHeight) / 2,
                },
                crop: function(event) {
                    var width = event.detail.width;
                    var height = event.detail.height;
                    if (
                        width < minCroppedWidth ||
                        height < minCroppedHeight ||
                        width > maxCroppedWidth ||
                        height > maxCroppedHeight
                    ) {
                        cropper.setData({
                            width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                            height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                        });
                    }
                },
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        cropbtn.addEventListener('click', function() {
            var initialAvatarURL;
            var canvas;
            $modal.modal('hide');
            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 200,
                    height: 200,
                });


                var oldimage = $("#encodedprofile").val();
                uploadImage(oldimage, canvas.toDataURL(), "profile", "encodedprofile", "croped_profile_image", "nr_profile_image", "", "profile_image-error");

            }
        });

        skipcropbtn.addEventListener('click', function() {
            $("#profile_image").val('').show();
            // $pimage_selector
            pimage_selector.src = '';
            $("#encodedprofile").val('');
            $prevImageSelector.attr("src", SITEFRONTURL + 'img/no_image.jpeg');
            // imagevalidation('profile_image',200,200,'equal');
        });
    });



    window.addEventListener('DOMContentLoaded', function() {
        var logo_image_selector = document.getElementById('croped_logo_image');
        var logocropimage = document.getElementById('cropimagelogo');
        var minCroppedWidth = 10;
        var minCroppedHeight = 10;
        var maxCroppedWidth = 1900;
        var maxCroppedHeight = 1900;
        var $alert = $('.alert');
        var $modal = $('#modal_logo_image');
        var $prevImageSelector = $('#prev_logo_image');
        var cropbtn = document.getElementById('croplogo');
        var skipcropbtn = document.getElementById('skipcroplogo');
        var cropper;
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(logocropimage, {
                viewMode: 1,
                data: {
                    width: (minCroppedWidth + maxCroppedWidth) / 2,
                    height: (minCroppedHeight + maxCroppedHeight) / 2,
                },
                crop: function(event) {
                    var width = event.detail.width;
                    var height = event.detail.height;
                    if (
                        width < minCroppedWidth ||
                        height < minCroppedHeight ||
                        width > maxCroppedWidth ||
                        height > maxCroppedHeight
                    ) {
                        cropper.setData({
                            width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                            height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                        });
                    }
                },
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        cropbtn.addEventListener('click', function() {
            var initialAvatarURL;
            var canvas;
            $modal.modal('hide');
            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 255,
                    height: 255,
                });

                var oldimage = $("#encodedlogo").val();
                uploadImage(oldimage, canvas.toDataURL(), "logo", "encodedlogo", "croped_logo_image", "nr_logo", "nr_logo_path", "logo_image-error");
                jQuery('#croped-logo-img-bx').show();
                /*canvas.toBlob(function (blob) {
                //console.log(blob);
                // var formData = new FormData();
                // formData.append('avatar', blob, 'avatar.jpg');

                });*/
            }
        }); 
        skipcropbtn.addEventListener('click', function() {
            $("#logo_image").val('').show();
        });
    });

    

    function uploadImage(oldimage = "", image, image_type, inputId, image_selector, cookie_f_name, cookie_path_name, errId) {
        $("#" + inputId).before('<div id="imagespiner"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>');
        $("#submit-btn").attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: SITEFRONTURL + 'ajax/uploadimage',
            data: {
                oldimage: oldimage,
                base64: image,
                image_type: image_type
            },
            // async: false,
            success: function(data) {
                $("#submit-btn").removeAttr('disabled');
                $("#imagespiner").remove();
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    var img_url = obj.img_url;
                    $("#" + inputId).val(img_url);
                    $("#" + inputId + "image").val(obj.image_name);
                    $("#" + inputId + "path").val(obj.image_path);

                    // setCookie('CakeCookie[' + inputId + ']', img_url);
                    // setCookie('CakeCookie[' + cookie_path_name + ']', obj.image_path);
                    // setCookie('CakeCookie[' + cookie_f_name + ']', obj.image_name);
                    $("#" + image_selector).attr("src", img_url).show();
                } else {
                    $("#" + errId).before('<p>' + obj.message + '</p>').show();
                }
            }
        });
    }


    function removeDocument(documentId = '') {
        if (documentId != "") {
            $("#filename" + documentId).before('<div id="imagespiner"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>');
            $("#docdeletebtn" + documentId).attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: SITEFRONTURL + 'ajax/removeNewsroomExtraDocument',
                data: {
                    imgId: documentId,
                },
                // async: false,
                success: function(data) {
                    var obj = JSON.parse(data);
                    if (obj.status == 'success') {
                        $("#filename" + documentId).remove();
                    } else {
                        if ($("#filename" + documentId).length) {
                            $("#filename" + documentId).remove();
                        } else {
                            messgae_box1('Error!', obj.message, 'error');
                        }
                    }

                    $("#imagespiner").remove();
                }
            });
        }
    }

    function messgae_box1(text, heading, icon) {
        $.toast({
            heading: heading,
            text: text,
            position: 'top-right',
            stack: false,
            icon: icon
        });
    }


    let validFileExtensions = ["jpg", "jpeg", "bmp", "gif", "png", "pdf"];
    var loadFile = function(event, id) {
        var output = document.getElementById("extrafileview-" + id);
        let file = event.target.files[0];
        let filename = file.name;
        if (file.size <= (1048576 * 2)) {
            let ext = filename.split('.').pop();
            if (validFileExtensions.indexOf(ext) > -1) {
                output.src = URL.createObjectURL(file);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
                $("#extrafileview-" + id).removeClass("hide");
            } else {
                messgae_box1('Error!', "Image and PDF file allowed only.", 'error');
            }
        } else {
            messgae_box1('Error!', "File should be less then 2 MB!", 'error');
        }
    };
</script>
