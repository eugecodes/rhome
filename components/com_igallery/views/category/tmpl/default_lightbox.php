<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<?php
$this->mode = 'lbox';

if($this->profile->lbox_back_color == 'white')
{
    $backColor = '#ffffff';
}
else if($this->profile->lbox_back_color == 'custom')
{
    $backColor = $this->profile->lbox_back_custom;
}
else if($this->profile->lbox_back_color == 'none')
{
    $backColor = '';
}
else
{
    $backColor = '#000000';
}

if($this->profile->lbox_front_color == 'black')
{
    $frontColor = '#000000';
}
else if($this->profile->lbox_front_color == 'custom')
{
    $frontColor = $this->profile->lbox_front_custom;
}
else if($this->profile->lbox_front_color == 'none')
{
    $frontColor = '';
}
else
{
    $frontColor = '#ffffff';
}

?>

<div id="lbox_dark<?php echo $this->uniqueid; ?>" class="lbox_dark" style="display: none; <?php if( !empty($backColor) ): ?>background-color: <?php echo $backColor; ?> <?php endif; ?>" ></div>

<div id="lbox_white<?php echo $this->uniqueid; ?>" class="lbox_white lbox_white_<?php echo $this->profile->style; ?> profile<?php echo $this->profile->id; ?>" style="max-width:<?php echo $this->dimensions['galleryLboxWidth']; ?>px; display: none; <?php if( !empty($frontColor) ): ?>background-color: <?php echo $frontColor; ?> <?php endif; ?>" >

    <a id="closeImage<?php echo $this->uniqueid; ?>" class="closeImage"></a>

    <?php if($this->profile->lbox_thumb_position == 'above' && $this->profile->lbox_show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_photo_des_position == 'above' && $this->profile->lbox_show_descriptions == 1 && $this->desVars->lboxHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_photo_des_position == 'left' && $this->profile->lbox_show_descriptions == 1 && $this->desVars->lboxHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_thumb_position == 'left' && $this->profile->lbox_show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php $slideshow_width_percent = round( ($this->dimensions['lboxSlideShowDivWidth']/$this->dimensions['galleryLboxWidth']) * 100, 2); ?>

    <div id="lbox_image_slideshow_wrapper<?php echo $this->uniqueid; ?>" class="lbox_image_slideshow_wrapper" style="width: <?php echo $slideshow_width_percent; ?>%;">



        <div id="lbox_large_image<?php echo $this->uniqueid; ?>" class="lbox_large_image" style="width: <?php echo round( ($this->dimensions['lboxImageDivWidth']/$this->dimensions['lboxSlideShowDivWidth']) * 100, 2); ?>%;">

            <?php if($this->profile->lbox_show_slideshow_controls == 1 && $this->profile->lbox_slideshow_position == 'left-right'): ?>
		    	<span id="lbox_slideshow_rewind<?php echo $this->uniqueid; ?>" style="margin-top:<?php echo round( ((($this->dimensions['largestLboxHeight']/2)-($this->dimensions['lboxSlideShowLeftRightWidth']/2))/$this->dimensions['galleryLboxWidth']) * 100, 2) - 2; ?>%;" class="ig_slideshow_img left_overlay_slideshow left_overlay_slideshow_<?php echo $this->mobilePrefix; ?>"></span>
        	<?php endif; ?>

            <img src="<?php echo IG_IMAGE_HTML_RESIZE; ?><?php echo $this->lboxFiles[$this->activeImage]['folderName']; ?>/<?php echo $this->lboxFiles[$this->activeImage]['fullFileName']; ?>" title="<?php echo $this->photoList[$this->activeImage]->alt_text; ?>" alt="<?php echo $this->photoList[$this->activeImage]->alt_text; ?>" class="large_img"/>

        	<?php if($this->profile->lbox_show_slideshow_controls == 1 && $this->profile->lbox_slideshow_position == 'left-right'): ?>
		   	 	<span id="lbox_slideshow_forward<?php echo $this->uniqueid; ?>" style="margin-top:<?php echo round( ((($this->dimensions['largestLboxHeight']/2)-($this->dimensions['lboxSlideShowLeftRightWidth']/2))/$this->dimensions['galleryLboxWidth']) * 100, 2) - 2; ?>%;" class="ig_slideshow_img right_overlay_slideshow right_overlay_slideshow_<?php echo $this->mobilePrefix; ?>"></span>
        	<?php endif; ?>
        </div>
		

		
		<div class="igallery_clear"></div>

        <?php if($this->profile->lbox_show_slideshow_controls == 1 && $this->profile->lbox_slideshow_position == 'below'): ?>
			<div id="lbox_slideshow_buttons<?php echo $this->uniqueid; ?>" class="lbox_slideshow_buttons" >
				<div id="lbox_slideshow_rewind<?php echo $this->uniqueid; ?>"  class="ig_slideshow_img ig_slideshow_rewind" /></div>
				<div id="lbox_slideshow_play<?php echo $this->uniqueid; ?>"  class="ig_slideshow_img ig_slideshow_play"/></div>
				<div id="lbox_slideshow_forward<?php echo $this->uniqueid; ?>"  class="ig_slideshow_img ig_slideshow_forward" /></div>
			</div>
        <?php endif; ?>
		
		<?php if($this->profile->lbox_show_numbering == 1): ?>
			<div id="lbox_img_numbering<?php echo $this->uniqueid; ?>" class="lbox_img_numbering">
				<span id="lbox_image_number<?php echo $this->uniqueid; ?>"></span>&#47;<?php echo count($this->photoList); ?>
			</div>
        <?php endif; ?>

        <?php if($this->profile->lbox_allow_rating == 2): ?>
            <?php echo $this->loadTemplate('ratings'); ?>
        <?php endif; ?>

		<?php if($this->profile->lbox_download_image != 'none'): ?>
            <div id="lbox_download_button<?php echo $this->uniqueid; ?>" class="lbox_download_button" >
    	       <a href="#">

    	       </a>
    	   </div>
        <?php endif; ?>
    	
    	<?php if($this->profile->lbox_share_facebook == 1): ?>
			<div id="lbox_facebook_share<?php echo $this->uniqueid; ?>" class="lbox_facebook_share" style="width: <?php echo $this->params->get('fb_like_width', 80); ?>px;"></div>
            <div id="lbox_facebook_share_temp<?php echo $this->uniqueid; ?>" class="lbox_facebook_share_temp" style="display: none;"></div>
        <?php endif; ?>

        <?php if($this->profile->lbox_plus_one == 1): ?>
            <div id="lbox_plus_one_div<?php echo $this->uniqueid; ?>" class="lbox_plus_one_div">
            </div>
        <?php endif; ?>

        <?php if($this->profile->lbox_twitter_button == 1): ?>
            <div id="lbox_twitter_button<?php echo $this->uniqueid; ?>" class="lbox_twitter_button">

            </div>
        <?php endif; ?>

        <?php if($this->profile->lbox_pinterest_button == 1): ?>
            <div id="lbox_pinterest<?php echo $this->uniqueid; ?>" class="lbox_pinterest"></div>
            <div id="lbox_pinterest_temp<?php echo $this->uniqueid; ?>" class="lbox_pinterest_temp" style="display: none;"></div>
        <?php endif; ?>

        <?php if($this->profile->lbox_show_image_author == 1): ?>
            <div id="lbox_image_author<?php echo $this->uniqueid; ?>" class="lbox_image_author" >
                <?php echo JText::_( 'JAUTHOR' ) ?>: <span class="lbox_image_author_name" ></span>
            </div>
        <?php endif; ?>

        <?php if($this->profile->lbox_show_image_hits == 1): ?>
            <div id="lbox_image_hits<?php echo $this->uniqueid; ?>" class="lbox_image_hits" >
                <span class="lbox_image_hits_count" ></span> <?php echo JText::_('COM_IGALLERY_VIEWS'); ?>
            </div>
        <?php endif; ?>
		
		<?php if($this->profile->lbox_report_image == 1): ?>
			<div id="lbox_report<?php echo $this->uniqueid; ?>" class="lbox_report" >
		       <a href="#" id="lbox_report_link"><?php echo JText::_( 'REPORT_IMAGE' ) ?></a>
		       <form action="index.php?option=com_igallery&amp;task=image.reportImage&id='<?php echo $this->photoList[0]->id; ?>&catid=<?php echo $this->category->id; ?>" method="post" name="lbox_report_form" id="lbox_report_form" style="display: none;">
					<textarea name="report_textarea" id="lbox_report_textarea<?php echo $this->uniqueid; ?>" rows="4" style="width: 100%;"></textarea>
					<input name="Itemid" type="hidden" value="<?php echo JRequest::getInt('Itemid'); ?>" />
					<input type="submit" value="<?php echo JText::_( 'JSUBMIT' ) ?>" />
				</form>
		    </div>
        <?php endif; ?>
		
    </div>

    <?php if($this->profile->lbox_thumb_position == 'right' && $this->profile->lbox_show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_photo_des_position == 'right' && $this->profile->lbox_show_descriptions == 1  && $this->desVars->lboxHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_photo_des_position == 'below' && $this->profile->lbox_show_descriptions == 1  && $this->desVars->lboxHasDescriptions == true): ?>
        <?php echo $this->loadTemplate('descriptions'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_show_tags == 1): ?>
        <?php echo $this->loadTemplate('tags'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_thumb_position == 'below' && $this->profile->lbox_show_thumbs == 1): ?>
        <?php echo $this->loadTemplate('thumbs'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_allow_comments == 2): ?>
        <?php echo $this->loadTemplate('jcomments'); ?>
    <?php endif; ?>

    <?php if($this->profile->lbox_allow_comments == 4 && $this->profile->lbox_comments_position == 'below'): ?>
        <?php echo $this->loadTemplate('fbcomments'); ?>
    <?php endif; ?>

</div>