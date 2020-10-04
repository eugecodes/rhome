<?php
/**
* @title	    J51 Thumbs Gallery
* @version		1.0
* @website		http://www.joomla51.com
* @copyright	Copyright (C) 2012 Joomla51.com. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$document 			= JFactory::getDocument();

$baseurl    		= JURI::base();
$fade_opacity		= $params->get('fade_opacity');
$bordersize			= $params->get('bordersize');		
$bordercolor		= $params->get('bordercolor');
$outlinecolor		= $params->get('outlinecolor');
$width				= $params->get('thumbwidth');
$height				= $params->get('thumbheight');
$margin				= $params->get('margin');
$show_jquery	    = $params->get('show_jquery');

$document->addCustomTag("<script src='".$baseurl."modules/mod_j51thumbsgallery/js/jquery.noconflict.js' type='text/javascript'></script>");
$document->addCustomTag("<script src='".$baseurl."modules/mod_j51thumbsgallery/js/sacript.js' type='text/javascript'></script>");
$document->addCustomTag("<script src='".$baseurl."modules/mod_j51thumbsgallery/js/jquery.fancybox.js' type='text/javascript'></script>");

$document->addStyleSheet('modules/mod_j51thumbsgallery/css/thumbs_style.css');
$document->addStyleSheet('modules/mod_j51thumbsgallery/css/slimbox.css');


require_once ('helper.php');

$list = GalleryHelper::getimgList($params);
$j51_moduleid       = $module->id

?>

<div class="j51thumbs<?php echo $j51_moduleid; ?>" style="margin-left:-<?php echo $margin;?>px;">

<div class="j51thumbs">
<div class="gallery">
<?php 
		foreach($list as $item) { ?>
		
		<a class="j51Box fancybox" style="margin:<?php echo $margin;?>px;" data-fancybox-group="gallery" href="<?php echo $item['image'] ?>">
			<img src="<?php echo $item['thumb'] ?>" 
			style="padding:<?php echo $bordersize;?>px;
			background-color:<?php echo $bordercolor;?>;
			border:1px solid <?php echo $outlinecolor;?>;"
			alt="<?php echo $item['image'] ?>" />
			<i style="left: <?php echo ($bordersize + 1);?>px;
	top: <?php echo  ($bordersize + 1);?>px;
	height: <?php echo $height;?>px;
	width: <?php echo $width;?>px;"></i></a>
		
<?php } ?>

</div></div></div> 

<div class="clear"></div> 

<?php require_once ('scripts.php'); ?>