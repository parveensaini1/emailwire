<?php if(!empty($featured_arr)){ ?>
<div class="full ew-featured-news-st ew-latest-news-st">
    <div class="row">    
        <div class="col-sm-12"><div class="ew-title full">Featured News</div></div>
        <?php
            $countfeaturedpr=count($featured_arr); 
            foreach($featured_arr as $index => $featurepr){ 
                
                if($index<$nofeaturePr){ 
                    if($countfeaturedpr!=1){ ?>
                        <div class="col-sm-6 ew-featured-news">
                            <div class="ew-featured-news-bl full 1" itemscope itemtype="http://schema.org/NewsArticle">
                                <?php if(!empty($featurepr['PressImage'])){ ?>
                                <div class="orange-border full ew-featured-img">
                                <a href="<?php echo SITEURL."release/".$featurepr['PressRelease']['slug'];?>">
                                    <?php  echo $this->Post->getPrSingleImage($featurepr['PressImage'],'crop','545','304');?>
                                </a>
                                </div>
                                <?php }else{
                                    ?>
                                    <div class="orange-border full ew-featured-img">
                                        <a href="<?php echo SITEURL."release/".$featurepr['PressRelease']['slug'];?>">
											<meta itemprop="url" content="image-url-yeha-aayega">
                                            <?php 
                                            echo $this->Html->image('no-banner.png', array('class' => 'user-image',"id"=>"prev_logo_image", "width"=>"100%"));?>
                                        </a>
                                    </div>
                                    <?php
                                } ?>
                                <div class="1 full ew-featured-news-content class_newsroom <?php echo $this->Post->classAccordingToLanguage($featurepr['PressRelease']['language']);?>">
                                    <div class="company_logo_name">
                                        <?php if($featurepr['Company']['logo']){?>
                                            <div class="company_logo" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
												<meta itemprop="url" content="logo-url-yeha-aayega">
                                                <?php echo $this->Post->getNewsroomLogo($featurepr['Company']['logo_path'],$featurepr['Company']['logo'],$featurepr['Company']['slug'],$featurepr['Company']['status']);?>
                                            </div>
                                        <?php } ?>
                                        <div id="prev_company_name" class="ew-compnay float-left">
                                       <span itemprop="author"><?php echo $this->Post->get_company($featurepr['Company']['name'],$featurepr['Company']['slug'],$featurepr['Company']['status']); ?></span>
                                            - <date itemprop="datePublished" content="2020-06-19"><?php echo date($dateformate,strtotime($featurepr['PressRelease']['release_date'])) ?></date>
                                        </div>  
                                    </div>
                                    <h2 class="post-title" itemprop="headline"><?php echo $this->Post->get_title($featurepr['PressRelease']['title'],$featurepr['PressRelease']['slug']); ?></h2>
                                </div>
                            </div>
                        </div>
                <?php }else{?>
                        <div class="col-sm-6 ew-featured-news" itemscope itemtype="http://schema.org/NewsArticle">
                            <div class="ew-featured-news-bl full 2">
                            <?php if(!empty($featurepr['PressImage'])){ ?>
                            <div class="orange-border full ew-featured-img">
                                <a href="<?php echo SITEURL."release/".$featurepr['PressRelease']['slug'];?>">
                                    <?php  echo $this->Post->getPrSingleImage($featurepr['PressImage'],'crop','333','215','0','0','0'); ?>
                                </a>
                            </div>
                            <?php } ?>
							<div class="2 full ew-featured-news-content class_newsroom <?php echo $this->Post->classAccordingToLanguage($featurepr['PressRelease']['language']);?>" itemscope itemtype="http://schema.org/NewsArticle">
                               <a href="<?php echo SITEURL."release/".$featurepr['PressRelease']['id'];?>"><h2 class="post-title"><?php echo $this->Post->get_title($featurepr['PressRelease']['title'],$featurepr['PressRelease']['slug']); ?></h2></a>
                                <div class="company_logo_name">
                                    <?php if($featurepr['Company']['logo']){?>
                                        <div class="ew-comany-logo">
                                            <div class="newsroom_inner" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                                                <?php echo $this->Post->getNewsroomLogo($featurepr['Company']['logo_path'],$featurepr['Company']['logo'],$featurepr['Company']['slug'],$featurepr['Company']['status']);?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div id="prev_company_name" class="ew-compnay float-left">
                                        <span itemprop="author"><?php echo $this->Post->get_company($featurepr['Company']['name'],$featurepr['Company']['slug'],$featurepr['Company']['status']); ?></span>
                                        - <date itemprop="datePublished" content="<?php echo date($dateformate,strtotime($featurepr['PressRelease']['release_date'])) ?>"><?php echo date($dateformate,strtotime($featurepr['PressRelease']['release_date'])) ?></date>
                                    </div>  
                                </div>                     
                                <div class="prsummary"><?php echo $this->Post->wordLimit($featurepr['PressRelease']['summary'],$featurepr['PressRelease']['slug'],35,'homepage');?></div>
                            </div>   
                        </div> 
                <?php } ?>
    <?php       } 
            }  ?>  
        <?php if(!empty($featured_arr)&&count($featured_arr)>$nofeaturePr){ ?>
            <div class="col-sm-6 ew-featured-news-slide">
            <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <?php $sliderLimt=count($featured_arr)-$nofeaturePr; ?>
                    <ol class="carousel-indicators">
                        <?php for ($loop=0; $loop < $sliderLimt ; $loop++) {  ?>
                        <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $loop;?>" class="<?php if($loop==0){ echo 'active';} ?>"></li>
                        <?php } ?>
                    </ol>
                    <div class="carousel-inner orange-border">
                        <?php foreach ($featured_arr as $index => $featurepr){ 
                            if($index>=$nofeaturePr){ ?>
                        <div class="carousel-item  <?php if($index==($nofeaturePr+1)){ echo "active";} ?>">
                          <?php if(!empty($featurepr['PressImage'])){ ?>
                                <a href="<?php echo SITEURL."release/".$featurepr['PressRelease']['slug'];?>">  
                                <?php echo $this->Post->getPrSingleImage($featurepr['PressImage'],'crop','544','474'); ?>
                                </a>
                            <?php }?>

                            <div class="carousel-caption d-none d-md-block trans-bg class_newsroom">
                                <div class="company_logo_name">
                                    <?php if($featurepr['Company']['logo']){?>
                                        <div class="ew-comany-logo">
                                            <div class="newsroom_inner">
                                                <?php echo $this->Post->getNewsroomLogo($featurepr['Company']['logo_path'],$featurepr['Company']['logo'],$featurepr['Company']['slug'],$featurepr['Company']['status']);?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div id="prev_company_name" class="ew-compnay float-left">
                                     <?php echo $this->Post->get_company($featurepr['Company']['name'],$featurepr['Company']['slug'],$featurepr['Company']['status']); ?>
                                        - <?php echo date($dateformate,strtotime($featurepr['PressRelease']['release_date'])) ?> 
                                    </div>  
                                </div> 
                                <h2 class="post-title"><?php echo $this->Post->get_title($featurepr['PressRelease']['title'],$featurepr['PressRelease']['slug']); ?></h2>       
                            </div>
                        </div> 
                        <?php 
                            } 
                         }
                    ?>
                    </div>
                </div>
            </div>
            </div>
        <?php } ?>
    </div>
    <div class="newsrooms-btns col-sm-12">
        <div class="row">
            <div class="col-sm-6"></div>
           <div class="browse-btn col-sm-6 text-right"><a href="<?php echo SITEURL.'featured-press-release'; ?>">View all</a></div>
       </div>
    </div>
</div>

<?php }else{ $latestMore=4;?>
<!--
<div class="easystep-pressreleases">
    <h3>Four easy steps to publish and distribute your news releases.</h3>
    <div class="row">
    <div class="col-md-3 col-sm-6">
    <img src="<?php echo SITEURL.'website/img';?>/banner-one.png" alt="Activate Newsroom">
    <div class="easystep-press">
    <strong>Activate Newsroom</strong>
    <p>Email Wire News your shortcut to a stylish and elegent 'showroom' for your content. Smarter, better, faster and... Free of charge!</p>
    </div></div>
    <div class="col-md-3 col-sm-6">
    <img src="<?php echo SITEURL.'website/img';?>/banner-two.png" alt="Publish news">
    <div class="easystep-press">
    <strong>Publish Press releases</strong>
    <p>News contains all the relevant files for your influencers to distribute. And it is automatically optimized For the best possible Google ranking</p>
    </div></div>	
    <div class="col-md-3 col-sm-6">
    <img src="<?php echo SITEURL.'website/img';?>/banner-three.png" alt="Be discovered">
    <div class="easystep-press">
    <strong>Be Discovered</strong>
    <p>It is easy and convenient for journalists, bloggers, freelancers and other influencers to find your press material and subscribe to your future news.</p>
    </div></div>	
    <div class="col-md-3 col-sm-6">
    <img src="<?php echo SITEURL.'website/img';?>/banner-four.png" alt="Get all the facts">
    <div class="easystep-press">
    <strong>Get Results</strong>
    <p>Email Wire News include a convenient analytics dashboard that gives you all the facts on your content.</p>
    </div></div>
    </div>	
    <a class="orange-btn" href="<?php echo SITEURL;?>users/create-newsroom">Create Newsroom</a>
    </div>-->

<div class="full ew-featured-news-st ew-latest-news-st">
    <div class="row">    
        <div class="col-sm-12"><div class="ew-title full">Latest News</div></div>
        <?php foreach($latestPr as $index => $post){ 
            // echo "<pre>";
            // print_r($post);exit;
            if($index<4){
                if($post['PressRelease']['release_date'] <= date('Y-m-d')){
                ?>
        <div class="col-sm-6 ew-featured-news">
            <div class="ew-featured-news-bl full 3" itemscope itemtype="http://schema.org/NewsArticle">
                <?php if(!empty($post['PressImage'])){ ?>
                <div class="orange-border full ew-featured-img">
                    <a href="<?php echo SITEURL."release/".$post['PressRelease']['id'];?>">
                        <?php  echo $this->Post->getPrSingleImage($post['PressImage'],'crop','545','304');?>
                    </a>
                </div>
                <?php }else{
                ?>
                <div class="orange-border full ew-featured-img">
                    <a href="<?php echo SITEURL."release/".$post['PressRelease']['id'];?>">
                        <?php echo $this->Html->image('no-banner.png', array('class' => 'user-image',"id"=>"prev_logo_image", "width"=>"100%"));?>
                    </a>
                </div>
                <?php } ?>
                <div class="3 full ew-featured-news-content class_newsroom <?php echo $this->Post->classAccordingToLanguage($post['PressRelease']['language']);?>">
                    <div class="company_logo_name">
                        <?php if($post['Company']['logo']){  ?>
                            <div class="company_logo">
                                <?php echo $this->Post->getNewsroomLogo($post['Company']['logo_path'],$post['Company']['logo'],$post['Company']['slug'],$post['Company']['status']);?>
                            </div>
                         <?php } ?>
                        <div id="prev_company_name" class="ew-compnay float-left">
							<span itemprop="author" ><?php echo $this->Post->get_company($post['Company']['name'],$post['Company']['slug'],$post['Company']['status'],$post['Company']['status']); ?></span>
                            - <date itemprop="datePublished" content="<?php echo date($dateformate,strtotime($post['PressRelease']['release_date'])) ?>"><?php echo date($dateformate,strtotime($post['PressRelease']['release_date'])) ?></date>
                        </div>  
                    </div>
                    <h2 class="post-title"  itemprop="headline">
                   <a style="color:black" href="<?php echo SITEURL."release/".$post['PressRelease']['id'];?>"><?php echo $this->Post->get_title($post['PressRelease']['title'],$post['PressRelease']['slug']); ?></a>                   
                    </h2>
                </div>
            </div>
        </div>
    <?php       } }
        }  ?>
    </div>
    <div class="newsrooms-btns col-sm-12">
        <div class="row">
            <div class="col-sm-6"></div>
           <div class="browse-btn col-sm-6 text-right"><a href="<?php echo SITEURL.'featured-press-release'; ?>">View all</a></div>
       </div>
    </div>
</div>
<?php } ?>



<div class="full ew-latest-news-st" id="newsroom_list">
<div class="row">
    <div class="col-sm-12"><div class="ew-title full">Latest Newsrooms</div></div>
    <?php foreach ($newsrooms as $index => $newsroom) {?>
        <div class="col-sm-3 ew-latest-news-post">
            <div class="full ew-latest-news-inner"> 
                <div class="orange-border ew-lastest-news-img-single full">
                    <div class="newsroom_inner">
                    <?php 
                        if ($newsroom['Company']['logo']!= '') {
                            
                          echo $this->Post->getLazyloadImage(SITEURL.'files/company/logo/'.$newsroom['Company']['logo_path'].'/'.$newsroom['Company']['logo'],['width'=>"100%", 'id'=>'prev_logo_image','class'=>'newsroomlogo'],SITEURL.'newsroom/'.$newsroom['Company']['slug']);

                        } else {
                           echo $this->Html->image('no_image.jpeg', array('class' => 'user-image',"id"=>"prev_logo_image", "width"=>"100%"));
                        }
                        ?>
                    </div>
                </div>
                <div class="full ew-lastest-news-single-content">
                    <?php echo $this->Post->get_company($newsroom['Company']['name'],$newsroom['Company']['slug'],$newsroom['Company']['status']); ?> 
                      <div class="full">
                            <?php
                                $description = strip_tags($this->Post->wordLimit($newsroom['Company']['description'],'',8));                                
                            ?>
                            <div class="prsummary"><p><?php echo $description ;?></p></div>
                        </div>
                </div>
            </div>  
        </div> 
    <?php } ?>

	<div class="col-sm-12">
		<div class="row">
			<div class="browse-btn col-sm-6 text-left"><a href="<?php echo SITEURL.'users/create-newsroom/'; ?>">Create your own company newsroom</a></div>
			<div class="browse-btn col-sm-6 text-right"><a href="<?php echo SITEURL.'newsrooms/'; ?>">Browse Newsrooms</a></div>
		</div>
	</div>		
</div>
</div>



<div class="full ew-latest-news-st dm-latest_news" id="latest_news">
      <?php if(!empty($latestPr)){?>
    <div class="row">
        <div class="col-sm-12"><div class="ew-title full">More Latest News</div></div>
         <div class="col-sm-12 ew-lcn-right-news">
        <?php 
        if(isset($latestMore)){
        foreach ($latestPr as $loop1=> $latest) { 
            if($latestMore<=$loop1){ ?>
            <div class="full ew-lcn-right-single">
                <?php if(!empty($latest['PressImage'])){ ?>
                <div class="orange-border ew-lcn-img-single float-left">
                     <a href="<?php echo SITEURL."release/".$latest['PressRelease']['slug'];?>">
                        <?php  echo $this->Post->getPrSingleImage($latest['PressImage'],'crop','333','215','0','0','0'); ?>
                    </a>
                </div>
            <?php } ?>
                <div class="ew-lcn-right-single-content class_newsroom <?php echo $this->Post->classAccordingToLanguage($latest['PressRelease']['language']);?>">
                   <h2 class="post-title"><?php echo $this->Post->get_title($latest['PressRelease']['title'],$latest['PressRelease']['slug']); ?></h2>
                    <div class="company_logo_name">
                        <?php if($latest['Company']['logo']){?>
                                <div class="ew-comany-logo">
                                    <div class="newsroom_inner">
                                        <?php echo $this->Post->getNewsroomLogo($latest['Company']['logo_path'],$latest['Company']['logo'],$latest['Company']['slug'],$latest['Company']['status']);?>
                                    </div>
                                </div>
                        <?php } ?>
                        <div id="prev_company_name" class="ew-compnay float-left">
                            <?php echo $this->Post->get_company($latest['Company']['name'],$latest['Company']['slug'],$latest['Company']['status']); ?>
                            - <?php echo date($dateformate,strtotime($latest['PressRelease']['release_date'])) ?>
                        </div>  
                    </div>                     
                    <div class="prsummary"><?php echo $this->Post->wordLimit($latest['PressRelease']['summary'],$latest['PressRelease']['slug'],35,'homepage');?></div>
                </div>   
            </div> 
        <?php  }
            }
        }else{ 
            foreach ($latestPr as $loop1=> $latest) { ?>
            <div class="full ew-lcn-right-single">
                <?php if(!empty($latest['PressImage'])){ ?>
                    <div class="orange-border ew-lcn-img-single float-left">
                         <a href="<?php echo SITEURL."release/".$latest['PressRelease']['slug'];?>">
                        <?php  echo $this->Post->getPrSingleImage($latest['PressImage'],'crop','333','215','0','0','0'); ?>
                        </a>
                    </div>
                <?php } ?>
                <div class="ew-lcn-right-single-content class_newsroom <?php echo $this->Post->classAccordingToLanguage($latest['PressRelease']['language']);?>">
                   <h2 class="post-title"><?php echo $this->Post->get_title($latest['PressRelease']['title'],$latest['PressRelease']['slug']); ?></h2>
                    <div class="company_logo_name">
                        <?php if($latest['Company']['logo']){?>
                            <div class="ew-comany-logo">
                                <div class="newsroom_inner">
                                    <?php echo $this->Post->getNewsroomLogo($latest['Company']['logo_path'],$latest['Company']['logo'],$latest['Company']['slug'],$latest['Company']['status']);?>
                                </div>
                            </div>
                        <?php } ?>
                        <div id="prev_company_name" class="ew-compnay float-left">
                            <?php echo $this->Post->get_company($latest['Company']['name'],$latest['Company']['slug'],$latest['Company']['status']); ?>
                            - <?php echo date($dateformate,strtotime($latest['PressRelease']['release_date'])) ?>
                        </div>  
                    </div>                     
                    <div class="prsummary"><?php echo $this->Post->wordLimit($latest['PressRelease']['summary'],$latest['PressRelease']['slug'],35,'homepage');?></div>
                </div>   
            </div>
        <?php  } 
        } ?>
        
        </div>  
        </div>
    <?php } // end if $latestPr condition   ?>
   
	<div class="row">
		<div class="browse-btn col-sm-6 text-left"><a href="<?php echo SITEURL; ?>latest-news">View all Latest News</a></div>
		<div class="browse-btn col-sm-6 text-right">
			<?php if(isset($role_id)&&$role_id==3){?> 
				<a class="browse-btn" href="<?php echo SITEURL; ?>users/add-press-release">Submit a Press Release</a>
			<?php }else{?>
				<a class="browse-btn" href="<?php echo SITEURL; ?>users/create-newsroom">Submit a Press Release</a>
			<?php }?>
		 </div>
	</div>
	
</div>