<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<?php $this->mode = 'main'; ?>
<?php $this->mobilePrefix = ($this->profile->mobile) ? 'mobile' : 'notmobile'; ?>

<?php if($this->type == 'category'): ?>
    <?php echo $this->loadTemplate('header'); ?>
<?php endif; ?>

<?php if($this->profile->show_search == 1): ?>
    <?php echo $this->loadTemplate('search'); ?>
<?php endif; ?>

<?php if($this->profile->gallery_des_position == 'above' && strlen($this->category->gallery_description) > 1 && $this->type == 'category'): ?>
    <?php echo $this->loadTemplate('category_description'); ?>
<?php endif; ?>

<?php if( count($this->categoryChildren) && JRequest::getInt('ighidemenu', 0) != 1 ): ?>
    <?php echo $this->loadTemplate('menu'); ?>
<?php endif; ?>

<?php if( !empty($this->photoList) ): ?>

    <?php $align = $this->profile->align == 'center' ? 'margin-left: auto; margin-right: auto;' : 'float: '.$this->profile->align; ?>
	<a name="gallery-<?php echo $this->uniqueid; ?>" style="height: 0px!important; visibility: hidden;"></a>
    <div id="main_images_wrapper<?php echo $this->uniqueid; ?>" class="main_images_wrapper main_images_wrapper_<?php echo $this->profile->style; ?> profile<?php echo $this->profile->id; ?>" style="max-width: <?php echo $this->dimensions['galleryWidth']; ?>px; <?php echo $align; ?>" >

    <?php if($this->profile->thumb_position == 'above' && $this->profile->show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->photo_des_position == 'above' && $this->profile->show_descriptions == 1 && $this->profile->show_large_image == 1 && $this->desVars->mainHasDescriptions == true) : ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->photo_des_position == 'left' && $this->profile->show_descriptions == 1  && $this->profile->show_large_image == 1 && $this->desVars->mainHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->thumb_position == 'left' && $this->profile->show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->show_large_image == 1): ?>

        <?php $slideshow_width_percent = round( ($this->dimensions['mainSlideShowDivWidth']/$this->dimensions['galleryWidth']) * 100, 2); ?>

	    <div id="main_image_slideshow_wrapper<?php echo $this->uniqueid; ?>" class="main_image_slideshow_wrapper" style="width: <?php echo $slideshow_width_percent; ?>%;">

        <div id="main_large_image<?php echo $this->uniqueid; ?>" class="main_large_image" style="visibility: hidden; width: <?php echo round( ($this->dimensions['mainImageDivWidth']/$this->dimensions['mainSlideShowDivWidth']) * 100, 2); ?>%;" >

			<?php if($this->profile->show_slideshow_controls == 1 && $this->profile->slideshow_position == 'left-right'): ?>
				<span id="slideshow_rewind<?php echo $this->uniqueid; ?>" style="margin-top:<?php echo round( ((($this->dimensions['largestHeight']/2)-($this->dimensions['mainSlideShowLeftRightWidth']/2))/$this->dimensions['galleryWidth']) * 100, 2) - 2; ?>%;" class="ig_slideshow_img left_overlay_slideshow left_overlay_slideshow_<?php echo $this->mobilePrefix; ?>"></span>
			<?php endif; ?>

            <img src="<?php echo IG_IMAGE_HTML_RESIZE; ?><?php echo $this->mainFiles[$this->activeImage]['folderName']; ?>/<?php echo $this->mainFiles[$this->activeImage]['fullFileName']; ?>" title="<?php echo $this->photoList[$this->activeImage]->alt_text; ?>" alt="<?php echo $this->photoList[$this->activeImage]->alt_text; ?>" class="large_img"/>

            <?php if($this->profile->show_slideshow_controls == 1 && $this->profile->slideshow_position == 'left-right'): ?>
				<span id="slideshow_forward<?php echo $this->uniqueid; ?>" style="margin-top:<?php echo round( ((($this->dimensions['largestHeight']/2)-($this->dimensions['mainSlideShowLeftRightWidth']/2))/$this->dimensions['galleryWidth']) * 100, 2) - 2; ?>%;" class="ig_slideshow_img right_overlay_slideshow right_overlay_slideshow_<?php echo $this->mobilePrefix; ?>"></span>
			<?php endif; ?>

        </div>




		<div class="igallery_clear"></div>


		<?php if($this->profile->show_slideshow_controls == 1 && $this->profile->slideshow_position == 'below'): ?>
			<div id="main_slideshow_buttons<?php echo $this->uniqueid; ?>" class="main_slideshow_buttons" >
				<div id="slideshow_rewind<?php echo $this->uniqueid; ?>"  class="ig_slideshow_img ig_slideshow_rewind" ></div>
				<div id="slideshow_play<?php echo $this->uniqueid; ?>"  class="ig_slideshow_img ig_slideshow_play" ></div>
				<div id="slideshow_forward<?php echo $this->uniqueid; ?>"  class="ig_slideshow_img ig_slideshow_forward" ></div>
			</div>
		<?php endif; ?>

		<?php if($this->profile->show_numbering == 1): ?>
			<div id="main_img_numbering<?php echo $this->uniqueid; ?>" class="main_img_numbering">
				<span id="main_image_number<?php echo $this->uniqueid; ?>"></span>&#47;<?php echo count($this->photoList); ?>
			</div>
		<?php endif; ?>

		<?php if($this->profile->allow_rating == 2): ?>
			<?php echo $this->loadTemplate('ratings'); ?>
		<?php endif; ?>

		<?php if($this->profile->download_image != 'none'): ?>
		   <div id="main_download_button<?php echo $this->uniqueid; ?>" class="main_download_button" >
			   <a href="#">

			   </a>
		   </div>
		<?php endif; ?>

		<?php if($this->profile->share_facebook == 1): ?>
			<div id="main_facebook_share<?php echo $this->uniqueid; ?>" class="main_facebook_share" style="width: <?php echo $this->params->get('fb_like_width', 80); ?>px;"></div>
			<div id="main_facebook_share_temp<?php echo $this->uniqueid; ?>" class="main_facebook_share_temp" style="display: none;"></div>
		<?php endif; ?>

		<?php if($this->profile->plus_one == 1): ?>
			<div id="main_plus_one_div<?php echo $this->uniqueid; ?>" class="main_plus_one_div"></div>
		<?php endif; ?>

		<?php if($this->profile->twitter_button == 1): ?>
			<div id="main_twitter_button<?php echo $this->uniqueid; ?>" class="main_twitter_button">

			</div>
		<?php endif; ?>

        <?php if($this->profile->pinterest_button == 1): ?>
            <div id="main_pinterest<?php echo $this->uniqueid; ?>" class="main_pinterest"></div>
            <div id="main_pinterest_temp<?php echo $this->uniqueid; ?>" class="main_pinterest_temp" style="display: none;"></div>
        <?php endif; ?>

        <?php if($this->profile->show_image_author == 1): ?>
            <div id="main_image_author<?php echo $this->uniqueid; ?>" class="main_image_author" >
                <?php echo JText::_( 'JAUTHOR' ) ?>: <span class="main_image_author_name" ></span>
            </div>
        <?php endif; ?>

        <?php if($this->profile->show_image_hits == 1): ?>
            <div id="main_image_hits<?php echo $this->uniqueid; ?>" class="main_image_hits" >
                <span class="main_image_hits_count" ></span> <?php echo JText::_('COM_IGALLERY_VIEWS'); ?>
            </div>
        <?php endif; ?>

		<?php if($this->profile->report_image == 1): ?>
			<div id="main_report<?php echo $this->uniqueid; ?>" class="main_report" >
			   <a href="#"><?php echo JText::_( 'REPORT_IMAGE' ) ?></a>
			   <form action="#" method="post" name="main_report_form" id="main_report_form" style="display: none;">
					<textarea name="report_textarea" id="main_report_textarea<?php echo $this->uniqueid; ?>" rows="4" style="width: 100%;"></textarea>
					<input name="Itemid" type="hidden" value="<?php echo JRequest::getInt('Itemid'); ?>" />
					<input type="submit" value="<?php echo JText::_( 'JSUBMIT' ) ?>" />
				</form>
			</div>
		<?php endif; ?>

		</div>
		<?php endif; ?>

		<?php if($this->profile->plus_one == 1 || $this->profile->lbox_plus_one == 1): ?>
			<script type="text/javascript">
				window.___gcfg = {
					parsetags: 'onload'
				};

				(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>
		<?php endif; ?>

		<?php if($this->profile->twitter_button == 1 || $this->profile->lbox_twitter_button == 1): ?>
			<script type="text/javascript">
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
			if(!d.getElementById(id)){js=d.createElement(s);
			js.id=id;js.src="//platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);
			}}(document,"script","twitter-wjs");
			</script>
		<?php endif; ?>

        <?php if($this->profile->pinterest_button == 1 || $this->profile->lbox_pinterest_button == 1): ?>
            <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js" data-pin-build="parsePins"></script>
        <?php endif; ?>


    <?php if($this->profile->thumb_position == 'right' && $this->profile->show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->photo_des_position == 'right' && $this->profile->show_descriptions == 1 && $this->profile->show_large_image == 1  && $this->desVars->mainHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <div class="igallery_clear"></div>
    <?php if($this->profile->photo_des_position == 'below' && $this->profile->show_descriptions == 1  && $this->profile->show_large_image == 1  && $this->desVars->mainHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->show_tags == 1): ?>
        <?php echo $this->loadTemplate('tags'); ?>
    <?php endif; ?>

    <?php if($this->profile->thumb_position == 'below' && $this->profile->show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->thumb_pagination == 1): ?>
        <div class="igallery_clear"></div>
        <form action="index.php?option=com_igallery&amp;view=igcategory&amp;id=<?php echo $this->category->id; ?>&amp;Itemid=<?php echo $this->Itemid; ?>" method="post" name="ig_thumb_pagination">
            <div class="pagination">
                <?php echo $this->thumbPagination->getPagesLinks(); ?>
            </div>
        </form>
    <?php endif; ?>

    <?php if($this->profile->allow_comments == 2): ?>
        <?php echo $this->loadTemplate('jcomments'); ?>
    <?php endif; ?>

    <?php if($this->profile->allow_comments == 4 || $this->profile->lbox_allow_comments == 4 || $this->profile->share_facebook == 1 || $this->profile->lbox_share_facebook == 1): ?>
        <div id="fb-root"></div>
        <script type="text/javascript">
        // <![CDATA[
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/<?php echo str_replace('-', '_', $this->languageTag); ?>/all.js#xfbml=1<?php if( strlen( $this->params->get('fb_comments_appid', '') ) > 1 ): ?>&appId=<?php echo $this->params->get('fb_comments_appid', ''); ?><?php endif; ?>";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        //]]>
        </script>
    <?php endif; ?>

    <?php if($this->profile->allow_comments == 4 && $this->profile->comments_position == 'below'): ?>
        <?php echo $this->loadTemplate('fbcomments'); ?>
    <?php endif; ?>

    </div>
<?php endif; ?>

<?php if($this->profile->gallery_des_position == 'below' && strlen($this->category->gallery_description) > 1 ): ?>
<div class="igallery_clear"></div>
	<?php echo $this->loadTemplate('category_description'); ?>
<?php endif; ?>

<?php if($this->profile->lightbox == 1 && !empty($this->photoList) ): ?>
    <?php echo $this->loadTemplate('lightbox'); ?>
<?php endif; ?>

<?php if( !empty($this->photoList) ): ?>
<div class="big_image_data" style="display: none;">

    <?php for($i=0; $i<count($this->photoList); $i++): ?>

        <?php $linkText = empty($this->photoList[$i]->alt_text) ? $this->photoList[$i]->filename : $this->photoList[$i]->alt_text; ?>

        <?php if($this->profile->lightbox == 1): ?>
            <a href="<?php echo IG_IMAGE_HTML_RESIZE.$this->lboxFiles[$i]['folderName'].'/'.$this->lboxFiles[$i]['fullFileName']; ?>"><?php echo $linkText; ?></a>
        <?php else: ?>
            <a href="<?php echo IG_IMAGE_HTML_RESIZE.$this->mainFiles[$i]['folderName'].'/'.$this->mainFiles[$i]['fullFileName']; ?>"><?php echo $linkText; ?></a>
        <?php endif; ?>

    <?php endfor; ?>
</div>
<?php endif; ?>

<div class="igallery_clear"></div>


