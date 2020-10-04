<?php
/**
* J51_Icons
* Version		: 1.0
* Created by	: Joomla51
* Email			: info@joomla51.com
* URL			: www.joomla51.com
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$baseurl 		= JURI::base();
$j51_icon_margin_x	= $params->get( 'j51_icon_margin_x' );
$j51_icon_margin_y	= $params->get( 'j51_icon_margin_y' );
$j51_icon_color		= $params->get( 'j51_icon_color' );
$j51_icon_size		= $params->get( 'j51_icon_size' );
$j51_icon_opacity	= $params->get( 'j51_icon_opacity' );
$j51_icon_layout	= $params->get( 'j51_icon_layout' );
$j51_icon_align		= $params->get( 'j51_icon_align' );
$j51_icon_columns	= $params->get( 'j51_icon_columns' );
$j51_icon_animate_class	= $params->get( 'j51_icon_animate_class' );
$j51_moduleid       = $module->id;

$j51_circle_size	= $j51_icon_size + $j51_icon_size;

$image_ref = array();
$j51_image = array();
$j51_text_alt = array();
$j51_icon = array();
$j51_iconurl = array();
$j51_icon_title = array();
$j51_icon_desc = array();
$j51_targeturl = array();
$j51_animate_class= array();

$max_icons = 15;

for ($i = 1; $i <= $max_icons; $i++) {
	if ($params->get( 'j51_icon'.$i )) {
		$image_ref[]	= $i;
		$j51_text_alt[$i] 	= $params->get( 'j51_text_alt'.$i );
		$j51_icon[$i] 		= $params->get( 'j51_icon'.$i );
		$j51_iconurl[$i] 	= $params->get( 'j51_iconurl'.$i );
		$j51_icon_title[$i] = $params->get( 'j51_icon_title'.$i );
		$j51_icon_desc[$i] 	= $params->get( 'j51_icon_desc'.$i );
		$j51_targeturl[$i] 	= $params->get( 'j51_targeturl'.$i );
		$j51_animate_class[$i] 	= $params->get( 'j51_animate_class'.$i );
	}
}

// Load CSS/JS
$document = JFactory::getDocument();
$document->addScript(JURI::base() . 'modules/mod_j51icons/js/modernizr.custom.js');
$document->addStyleSheet (JURI::base() . 'modules/mod_j51icons/css/style.css' );

// Styling from module parameters
$j51_css='';
$j51_css .='
.j51_icons'.$j51_moduleid.' .hi-icon:before {
	font-size: '.$j51_icon_size.'px;
}
.j51_icons'.$j51_moduleid.' .hi-icon {
	width: '.$j51_circle_size.'px;
	height: '.$j51_circle_size.'px;
}
.j51_icons'.$j51_moduleid.' .hi-icon:before {
	line-height: '.$j51_circle_size.'px;
}
.j51_icons'.$j51_moduleid.' .hi-icon {
	opacity: '.$j51_icon_opacity.';
}
.j51_icons'.$j51_moduleid.' .j51_icon {
	padding: '.$j51_icon_margin_y.'px '.$j51_icon_margin_x.'px;
	width: '.$j51_icon_columns.';
	min-height: '.$j51_circle_size.'px;
}
.j51_icons'.$j51_moduleid.' [class^="fa-"]:before, .j51_icons'.$j51_moduleid.' [class*=" fa-"]:before {
	color: '.$j51_icon_color.' !important;
}
.no-touch .hi-icon-effect-9b .j51_icon:hover span.hi-icon {
	background-color: '.$j51_icon_color.'
}
.hi-icon-wrap.j51_icons'.$j51_moduleid.'.hi-icon-effect-9 .hi-icon:after {
	box-shadow: 0 0 0 2px '.$j51_icon_color.';}
';

// Put styling in header
$document->addStyleDeclaration($j51_css);

?>

<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9b j51_icons<?php echo $j51_moduleid; ?>" >

<?php foreach ($j51_icon as $j51_item => $j51_value): ?>
	<?php if($j51_iconurl[$j51_item] != "") : ?>
	<a href="<?php echo $j51_iconurl[$j51_item]; ?>" target="<?php echo $j51_targeturl[$j51_item]; ?>">
		<figure class="j51_icon animate <?php echo $j51_animate_class[$j51_item]; ?>" style="float:left;">
			<span href="<?php echo $j51_iconurl[$j51_item]; ?>" target="<?php echo $j51_targeturl[$j51_item]; ?>" class="hi-icon <?php echo $j51_icon[$j51_item]; ?>">
				<?php echo $j51_text_alt[$j51_item]; ?>
			</span>
			<h3><?php echo $j51_icon_title[$j51_item]; ?></h3>
			<p><?php echo $j51_icon_desc[$j51_item]; ?></p>
		</figure>
	</a>
	<?php else : ?>
	<figure class="j51_icon animate <?php echo $j51_icon_animate_class;?>" style="float:left;">
		<span class="hi-icon <?php echo $j51_icon[$j51_item]; ?>">
			<?php echo $j51_text_alt[$j51_item]; ?>
		</span>
		<h3><?php echo $j51_icon_title[$j51_item]; ?></h3>
		<p><?php echo $j51_icon_desc[$j51_item]; ?></p>
	</figure>
	<?php endif; ?> 
<?php endforeach ?>

</div>

<div style= "clear:both;"></div>

