<?php
/*================================================================*\
|| # Copyright (C) 2011  Joomla51. All Rights Reserved.           ||
|| # license - PHP files are licensed under  GNU/GPL V2           ||
|| # license - CSS  - JS - IMAGE files are Copyrighted material   ||
|| # Website: http://www.joomla51.com                             ||
\*================================================================*/
defined('_JEXEC') or die;
JHtml::_('behavior.framework', true);
JHtml::_('bootstrap.framework');
define( 'nexus', dirname(__FILE__) );
require("php/config.php");
require("php/variables.php");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<?php include ("php/styles.php");?>
<?php include ("php/scripts.php");?>

<?php echo ($head_custom_code); ?>

</head>
<body> 
<div id="body_bg" data-type="background">
	<div id="container_header" class="container"><div class="wrapper960">
	<?php require("php/layouts/header.php"); ?>
	</div></div>

	<div id="container_hornav" class="container"><div class="wrapper960">
	<?php require("php/layouts/hornav.php"); ?>
	</div></div>

	<div id="container_slideshow" class="container"><div class="wrapper960">
	<?php require("php/layouts/slideshow.php"); ?>
	</div></div>

	<?php if ($this->countModules('top-1a') || $this->countModules('top-1b') || $this->countModules('top-1c') || $this->countModules('top-1d') || $this->countModules('top-1e') || $this->countModules('top-1f')) { ?>
	<div id="container_slideshow_modules" class="container"><div class="wrapper960">
	<?php require("php/layouts/slideshow_modules.php"); ?>
	</div></div>
	<?php }?>

	<?php if ($this->countModules('top-2a') || $this->countModules('top-2b') || $this->countModules('top-2c') || $this->countModules('top-2d') || $this->countModules('top-2e') || $this->countModules('top-2f')) { ?>
	<div id="container_top_modules" class="container"><div class="wrapper960">
	<?php require("php/layouts/top_modules.php"); ?>
	</div></div>
	<?php }?>

	<div id="container_main" class="container"><div class="wrapper960">
	<?php require("php/layouts/main.php"); ?>
	</div></div>


	<?php if ($this->countModules('bottom-1a') || $this->countModules('bottom-1b') || $this->countModules('bottom-1c') || $this->countModules('bottom-1d') || $this->countModules('bottom-1e') || $this->countModules('bottom-1f') || $this->countModules('bottom-2a') || $this->countModules('bottom-2b') || $this->countModules('bottom-2c') || $this->countModules('bottom-2d') || $this->countModules('bottom-2e') || $this->countModules('bottom-2f')) { ?>
	<div id="container_bottom_modules" class="container"><div class="wrapper960">
	<?php require("php/layouts/bottom_modules.php"); ?>
	</div></div>
	<?php }?>

	<?php require("php/layouts/base.php"); ?>

</div>

<?php echo ($body_custom_code); ?>
<jdoc:include type="modules" name="debug" />
</body> 
</html>