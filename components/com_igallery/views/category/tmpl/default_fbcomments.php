<?php defined('_JEXEC') or die('Restricted access');
//the facebook comments code is added by javascript (media/com_igallery/js/category_mt13.js)
?>

<?php
$this->fbCommentsVars = new stdClass();
if($this->mode == 'main')
{
    $this->fbCommentsVars->position = $this->profile->comments_position == 'match_descriptions' ? $this->profile->photo_des_position : 'below';
}
else
{
    $this->fbCommentsVars->position = $this->profile->lbox_comments_position == 'match_descriptions' ? $this->profile->lbox_photo_des_position : 'below';
}
?>


<div id="<?php echo $this->mode; ?>_fbcomments<?php echo $this->uniqueid; ?>" class="<?php echo $this->mode; ?>_fbcomments <?php echo $this->mode; ?>_fbcomments_<?php echo $this->fbCommentsVars->position; ?>" >
	
</div>

<div id="<?php echo $this->mode; ?>_fbcomments<?php echo $this->uniqueid; ?>_temp" class="<?php echo $this->mode; ?>_fbcomments_temp" style="display: none;"></div>

