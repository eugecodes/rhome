<div id ="header" class="block_holder"> 

        <div id="socialmedia">
                <ul id="navigation">
                        <?php if($social_rss != "") : ?>
                            <li class="social-rss"><a href="<?php echo $this->params->get('social_rss'); ?>" target="_blank" title="RSS">Twitter</a></li>
                        <?php endif; ?>   
                        <?php if($social_twitter != "") : ?>
                            <li class="social-twitter"><a href="<?php echo $this->params->get('social_twitter'); ?>" target="_blank" title="Twitter">Twitter</a></li>
                        <?php endif; ?> 
                        <?php if($social_facebook != "") : ?>
                            <li class="social-facebook"><a href="<?php echo $this->params->get('social_facebook'); ?>" target="_blank" title="Facebook">Facebook</a></li>
                        <?php endif; ?> 
                        <?php if($social_googleplus != "") : ?>
                            <li class="social-googleplus"><a href="<?php echo $this->params->get('social_googleplus'); ?>" target="_blank" title="GooglePlus">Google+</a></li>
                        <?php endif; ?> 
                        <?php if($social_youtube != "") : ?>
                            <li class="social-youtube"><a href="<?php echo $this->params->get('social_youtube'); ?>" target="_blank" title="Youtube">Youtube</a></li>
                        <?php endif; ?> 
                        <?php if($social_pininterest != "") : ?>
                            <li class="social-pinterest"><a href="<?php echo $this->params->get('social_pininterest'); ?>" target="_blank" title="Pinterest">Pinterest</a></li>
                        <?php endif; ?> 
                        <?php if($social_blogger != "") : ?>
                            <li class="social-blogger"><a href="<?php echo $this->params->get('social_blogger'); ?>" target="_blank" title="Blogger">Blogger</a></li>
                        <?php endif; ?> 
                        <?php if($social_dribbble != "") : ?>
                            <li class="social-dribbble"><a href="<?php echo $this->params->get('social_dribbble'); ?>" target="_blank" title="Dribbble">Dribbble</a></li>
                        <?php endif; ?> 
                        <?php if($social_flickr != "") : ?>
                            <li class="social-flickr"><a href="<?php echo $this->params->get('social_flickr'); ?>" target="_blank" title="Flickr">Flickr</a></li>
                        <?php endif; ?> 
                        <?php if($social_skype != "") : ?>
                            <li class="social-skype"><a href="<?php echo $this->params->get('social_facebook'); ?>" target="_blank" title="Skype">Skype</a></li>
                        <?php endif; ?> 
                        <?php if($social_linkedin != "") : ?>
                            <li class="social-linkedin"><a href="<?php echo $this->params->get('social_linkedin'); ?>" target="_blank" title="LinkedIn">LinkedIn</a></li>
                        <?php endif; ?> 
                        <?php if($social_vimeo != "") : ?>
                            <li class="social-vimeo"><a href="<?php echo $this->params->get('social_vimeo'); ?>" target="_blank" title="Vimeo">Vimeo</a></li>
                        <?php endif; ?> 
                        <?php if($social_yahoo != "") : ?>
                            <li class="social-yahoo"><a href="<?php echo $this->params->get('social_yahoo'); ?>" target="_blank" title="Yahoo">Yahoo</a></li>
                        <?php endif; ?> 
                        <?php if($social_tumblr != "") : ?>
                            <li class="social-tumblr"><a href="<?php echo $this->params->get('social_tumblr'); ?>" target="_blank" title="Tumblr">Tumblr</a></li>
                        <?php endif; ?> 
                        <?php if($social_deviantart != "") : ?>
                            <li class="social-deviantart"><a href="<?php echo $this->params->get('social_deviantart'); ?>" target="_blank" title="DeviantArt">DeviantArt</a></li>
                        <?php endif; ?> 
                        <?php if($social_delicious != "") : ?>
                            <li class="social-delicious"><a href="<?php echo $this->params->get('social_delicious'); ?>" target="_blank" title="Delicious">Delicious</a></li>
                        <?php endif; ?> 
                </ul>
        </div>	
        <?php if($search_onoff == "1") : ?>
            <div id="search">
                    <?php echo $search; ?>
            </div>
        <?php endif; ?>

        <div id="logo">
            <div class="logo_container">		
                <?php if($this->params->get('logoImage') == '1') : ?>
                <div class="logo"> <a href="index.php" title="<?php echo $siteName; ?>"><span>
                    <?php if($this->params->get('logoimagefile') == '') : ?>
                        <img style="display: block;" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/images/logo.png" alt="Logo" />
                    <?php elseif($this->params->get('logoimagefile') != '') : ?>
                        <img style="display: block;" src="<?php echo $this->baseurl ?>/<?php echo $logoimagefile; ?>" alt="Logo" />
                    <?php endif; ?>
                </span></a> </div>
                <?php else : ?>

                <h1 class="logo-text"> <a href="index.php" title="<?php echo $this->params->get('siteName'); ?>"><span>
                  <?php echo $this->params->get('logoText'); ?>
                  </span></a> </h1>
                    <p class="site-slogan"><?php echo $this->params->get('sloganText'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
<div class="clear"></div>

</div>