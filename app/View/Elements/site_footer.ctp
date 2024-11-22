<?php 
if($controller=="releases"&&$action=="release"){ ?> 
<script src="https://kit.fontawesome.com/09983b0619.js"></script>
 <div class="full ew-social-share-section" id="article_bottom_area">
    <div class="container">
       <h1 class="box-title"><?php echo ucfirst($data[$model]['title']); ?></h1>
            <div class="row">
                <div class="company-dtails col-sm-6">
                    <?php if($data['Company']['logo']){?>
                        <div class="ew-comany-logo float-left">
                            <div class="newsroom_inner">
                                <?php echo $this->Post->getNewsroomLogo($data['Company']['logo_path'],$data['Company']['logo'],$data['Company']['slug']);?> 
                            </div>
                        </div>
                    <?php } ?>
                    <div id="prev_company_name" class="ew-compnay float-left">
                        By <?php echo $this->Post->get_company($data['Company']['name'],$data['Company']['slug']); ?>  - <?php echo date($dateformate,strtotime($data['PressRelease']['release_date'])) ?>
                    </div>
                </div>
                <div class="ew-pr-social col-sm-6">
                   <?php
                   $singleImageUrl='';
                    if(!empty($data['PressImage'])){
                        $image_path=$data['PressImage'][0]['image_path'];
                        $image_name=$data['PressImage'][0]['image_name'];  
                        $singleImageUrl=SITEURL.'files/company/press_image/'.$image_path.'/'.$image_name;    
                    }
                    echo $this->Post->sharelinks($data[$model]['title'],$data[$model]['slug'],$data[$model]['summary'],$singleImageUrl);  ?>
                </div> 
            </div>
        <div class="row">
        <div class="col-sm-12 copyshareurl">
         <?php
         $slug=SITEURL.'release/'.$data[$model]['slug'];
         echo $this->Form->input('f', array('type'=>'text','readonly' => 'readonly','value'=>$slug,'label'=>false,'id'=>"code-footer-post-copy")); 
          ?>
          <div class="ewtooltip">   
              <button onclick="clipboardcode('footer-post-copy');"  data-toggle="tooltip" title="Copy to clipboard")">                
              </button>
          </div>
       </div>  
            </div>
   </div>
</div> 

<?php } ?>
<footer class="ew-footer full" id="footernewsroom">
    <div class="container">   
        <!-- logo and social icon -->
        <div class="full ew-footer-logo-social margin-bottom30">
            <div class="row">
                <!-- <div class="col-sm-6 ew-footer-logo">
                    <a href="#"><img src="<?php echo SITEURL; ?>website/img/group-web-media-logo.png" alt=""/></a>    
                </div> -->

                <div class="col-sm-6 ew-footer-logo">
                    <a href="#"><img src="<?php echo SITEURL; ?>website/img/emailwire-logo.jpg" alt=""/></a>    
                </div>   
            </div>        
        </div>

        <!-- End logo and social icon -->
        <div class="full ew-contact-map">
            <div class="row">       
                <!-- Contact Us -->
                <div class="col-sm-8 ew-contact-block">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ew-title full">About</div>
                            <ul class="footer-menu dropdown-inner"> 
                                    <li class="<?php if(str_replace('/',"",$requestUrl)=='why-use-us'){echo "active";}?>"><a href="<?php echo SITEURL.'why-use-us'; ?>">Why use <?php echo $siteName;?></a></li>
                                    <!-- <li class="<?php if($requestUrl=='press-release-tips'){echo "active";}?>"><a href="<?php echo SITEURL.'press-release-tips'; ?>">Press release tips</a></li> -->
                                    <li class="<?php if($requestUrl=='advertising'){echo "active";}?>"><a href="<?php echo SITEURL.'advertising'; ?>">Advertising</a></li>
                                    <li class="<?php if($requestUrl=='podcast'){echo "active";}?>"><a href="<?php echo SITEURL.'podcast'; ?>">Podcast</a></li>
                                    <li class="<?php if($requestUrl=='contact-us'){echo "active";}?>"><a href="<?php echo SITEURL.'contact-us'; ?>">Contact us</a></li>
                                     
                            </ul> 
                        </div>
                        <div class="col-sm-6">
                            <div class="ew-title full">RSS Feed</div>
                            <ul class="footer-menu dropdown-inner"> 
                                <li class="<?php if($requestUrl=='news-feeds-by-categories'){echo "active";}?>"><a href="<?php echo SITEURL.'news-feeds-by-categories'; ?>">Newsfeed by Categories</a></li>
                                <li class="<?php if($requestUrl=='news-feeds-by-newsroom'){echo "active";}?>"><a href="<?php echo SITEURL.'news-feeds-by-newsroom'; ?>">Newsfeed by Companies</a></li>
                                <li class="<?php if($requestUrl=='news-feeds-by-msa'){echo "active";}?>"><a href="<?php echo SITEURL.'news-feeds-by-msa'; ?>">Newsfeed by MSA</a></li>
                                <li class="<?php if($requestUrl=='news-feeds-by-countries'){echo "active";}?>"><a href="<?php echo SITEURL.'news-feeds-by-countries'; ?>">Newsfeed by Country</a></li>
                          
                            </ul> 
                        </div>
                    </div>

                    <div class="ew-title full">Contact Us</div>
                    <div class="full ew-phone-wh-skype">
                    <ul>
                        <li><i class="fa fa-phone"></i> <span><?php echo Configure::read('Site.phone'); ?></span></li>
                        <li><i class="fab fa-whatsapp"></i> <span><?php echo Configure::read('Site.phone'); ?></span></li>
                        <li><a href="skype:<?php echo Configure::read('Site.skype'); ?>?chat"><i class="fab fa-skype"></i> <span><?php echo Configure::read('Site.skype'); ?></span></a></li>    
                    </ul>
                    </div>
                </div>        
                <!-- End Contact Us -->   
                <!-- Address and map -->
                <div class="col-sm-4 ew-contact-address-map">
                    <!-- title -->  
                    <div class="ew-title full">Address & Location</div>  
                    <!-- End title --> 
                    <?php echo Configure::read('Site.address'); ?>

                     <div class="col-sm-12 ew-footer-social ">
                        <ul>
                            <li class="facebook"><a href="<?php echo  strip_tags(Configure::read('Social.link.facebook')); ?>"></a></li>
                            <li class="twitter"><a href="<?php echo  strip_tags(Configure::read('Social.link.twitter')); ?>"></a></li>
                            <li class="youtube"><a href="<?php echo  strip_tags(Configure::read('Social.link.youtube')); ?>"></a></li>
                            <li class="pintrest"><a href="<?php echo  strip_tags(Configure::read('Social.link.pintrest')); ?>"></a></li>    
                        </ul>
                    </div> 
                   <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d221152.3731887279!2d-95.54484898232744!3d29.99362880592412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640ca64d6c0a605%3A0xcf9db6e2c0030ddd!2sGroupWeb+Media+LLC+(EMAILWIRE.COM)+-+Press+Release+Distribution+Services!5e0!3m2!1sen!2sin!4v1550048677693" width="600" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>    --> 
                </div>    
                <!-- End Address and map --> 
            </div>        
        </div>     
    </div> 
    <!-- Footer bottom -->

    <div class="full text-center ew-footer-copyright">
        <div class="<?php echo (!empty($isFullwidth))?"container-fluid":"container"; ?>"> 
            <div class="row">
                <div id="newsroom_text">
                    <div class="col-sm-2"> 
                        <div id="buttons_footer1">
                            <a href="<?php echo SITEURL; ?>users/create-newsroom">Create News Room</a>
                        </div>
                    </div>
                    <div class="col-sm-8" > 
                    <?php  
                    if($action=='newsroom'&& $controller=='pages'){
                                echo str_replace(["##YEAR##","EmailWire is"],[date('Y'),"This newroom is provided by <a href='".SITEURL."'>".$siteName."</a> -- "],Configure::read('Site.Copyright'));
                            }else{
                                echo str_replace("##YEAR##",date('Y'),Configure::read('Site.Copyright'));        
                            }
                         ?>
                    </div> 
                    <div  class="col-sm-2" id="buttons_footer2">
                    <?php if(isset($role_id)&&$role_id==3){?> 
                        <a class="orange-back" href="<?php echo SITEURL; ?>users/add-press-release">Send a Release</a>
                    <?php }else{?>
                        <a class="orange-back" href="<?php echo SITEURL; ?>users/create-newsroom">Send a Release</a>
                    <?php }?>
                    </div>      

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="newsroom_text_nsr">  
                 <?php echo str_replace("##YEAR##",date('Y'),Configure::read('Site.Copyright')); ?> 
                </div>
            </div>
        </div>    
    </div>       

    <!-- End Footer bottom -->        
</footer>

