<?php
/**
* J51_GridGallery
* Version		: 1.0
* Created by	: Joomla51
* Email			: info@joomla51.com
* URL			: www.joomla51.com
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$baseurl 		= JURI::base();
$j51_moduleid       = $module->id;
$animateIn = $params->get( 'animateIn' );
$animateOut = $params->get( 'animateOut' );

$j51slideimages = $params->get('j51slideimages');
$j51_slideimage = $params->get('j51_slideimage');
$j51_slidetitle = $params->get('j51_slidetitle');
$j51_slide_json = json_decode($j51slideimages,true);

// Load CSS/JS
$document = JFactory::getDocument();

$document->addStyleSheet (JURI::base() . 'modules/mod_j51navslideshow/css/owl.carousel.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51navslideshow/css/owl.theme.default.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51navslideshow/css/owl.transitions.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51navslideshow/css/owl.animate.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51navslideshow/css/style.css' );

$j51_slideimages = array($j51_slide_json['j51_slideimage']);
$j51_slidetitles = array($j51_slide_json['j51_slidetitle']);

	echo '<div class="navslideshow owl-carousel'.$j51_moduleid.'">';
	
    if(is_array($j51_slide_json['j51_slideimage'])) {
	    foreach($j51_slide_json['j51_slideimage'] as $index => $image )  {
	    echo '<div class="item" data-hash="'.$index.'">';
	    echo '<img src="'.$image.'" alt="'.$j51_slidetitles[0][$index].'">';
	    echo '</div>';
 		} 
 	} 
 	echo '</div>';

 	echo '<div class="navslideshow-nav"><ul>';
 	foreach($j51_slide_json['j51_slidetitle'] as $index=>$title )  {
 		echo '<li>';
	    echo '<a class="btn url" href="#'.$index.'">'.$title.'</a>';
	    echo '</li>';
 		} 
 	echo '</ul></div>';

?>

<script type="text/javascript" src="modules/mod_j51navslideshow/js/owl.carousel.min.js" ></script>
<script type="text/javascript">
jQuery(document).ready(function() {
     
    jQuery(".owl-carousel<?php echo $j51_moduleid; ?>").owlCarousel({
    items : 1,
    loop: false,
    center: true,
    margin: 10,
    callbacks: true,
    URLhashListener: true,
    autoplayHoverPause: true,
    startPosition: 'URLHash',
    <?php if ($animateOut != 'false') { ?>
    animateOut: '<?php echo $animateOut; ?>',
    <?php }
    if ($animateIn != 'false') { ?>
    animateIn: '<?php echo $animateIn; ?>',
    <?php } ?>
    pagination:false,
    navigation:false
    });
     
 });

</script>
