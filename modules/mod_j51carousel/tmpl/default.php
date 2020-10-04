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
$j51_num_blocks	= $params->get( 'j51_num_blocks' ); 
$j51_randomize	= $params->get( 'j51_randomize' );
$j51_blocks_per_slide	= $params->get( 'j51_blocks_per_slide' );
$j51_transition_interval	= $params->get( 'j51_transition_interval' );
$j51_transition_duration	= $params->get( 'j51_transition_duration' );
$j51_transition_style	= $params->get( 'j51_transition_style' );
$j51_pagination	= $params->get( 'j51_pagination' );
$j51_navigation = $params->get( 'j51_navigation' );
$j51_image_width_tabl	= $params->get( 'j51_image_width_tabl' );
$j51_image_width_tabp	= $params->get( 'j51_image_width_tabp' );
$j51_image_width_mobl	= $params->get( 'j51_image_width_mobl' );
$j51_image_width_mobp	= $params->get( 'j51_image_width_mobp' );
$j51_text_prev	= $params->get( 'j51_text_prev');
$j51_text_next	= $params->get( 'j51_text_next');
$j51_horiz_padding	= $params->get( 'j51_horiz_padding' );
$j51_vert_padding	= $params->get( 'j51_vert_padding' );
$j51_boxed	= $params->get( 'j51_boxed' );

$image_ref = array();
$j51_image = array();
$j51_image_alt = array();
$image_url = array();
$j51_title = array();
$j51_text = array();
$j51_disablecaption = array();
$j51_disableurl = array();
$target_url= array();
$j51_animate_class= array();

$max_images = 15;

for ($i = 1; $i <= $max_images; $i++) {
	if ($params->get( 'j51_image'.$i )) {
		$image_ref[]	= $i;
		$j51_image[$i] 	= trim($params->get( 'j51_image'.$i ));
		$j51_image_alt[$i] 	= $params->get( 'j51_image_alt'.$i );
		$j51_title[$i] 	= $params->get( 'j51_title'.$i );
		$j51_text[$i] 	= $params->get( 'j51_text'.$i );
		$image_url[$i] 		= $params->get( 'image_url'.$i );
		$j51_disablecaption[$i] 	= $params->get( 'j51_disablecaption'.$i );
		$j51_disableurl[$i] 	= $params->get( 'j51_disableurl'.$i );
		$target_url[$i] 	= $params->get( 'target_url'.$i );
		$j51_animate_class[$i] 	= $params->get( 'j51_animate_class'.$i );
	}
}

// Toggle Shuffle Images
$image_cnt = count ($image_ref);
if ($j51_randomize ) {
		shuffle ($image_ref);
}

// Load CSS/JS
$document = JFactory::getDocument();

$document->addStyleSheet (JURI::base() . 'modules/mod_j51carousel/css/owl.carousel.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51carousel/css/owl.theme.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51carousel/css/owl.transitions.css' );
$document->addStyleSheet (JURI::base() . 'modules/mod_j51carousel/css/style.css' );

/* Boxed  */
if($j51_boxed == "1") : 
	$style = '
		#owl-carousel'.$j51_moduleid.' .item {
			background: rgba(0,0,0,0.1);
			border: 1px solid rgba(0,0,0,0.15);
			padding:20px;
		}
	';
$document->addStyleDeclaration( $style );
endif;



?>

<div id="owl-carousel<?php echo $j51_moduleid; ?>" class="owl-carousel" style="margin-top: <?php echo $j51_vert_padding ?>px; margin-bottom: <?php echo $j51_vert_padding ?>px;">

<?php
$imagenr = 0;
for ($i= 1; $i <= $j51_num_blocks; $i++) {
	$cur_img = $image_ref[$imagenr] ;
	?>
	<div class="item">
			<?php echo $j51_image[$cur_img]; ?>
	</div>
<?php 
	$imagenr++;
  } ?>
</div>


<script type="text/javascript" src="modules/mod_j51carousel/js/owl.carousel.min.js" ></script>
<script type="text/javascript">
jQuery(document).ready(function() {
     
    jQuery("#owl-carousel<?php echo $j51_moduleid; ?>").owlCarousel({
    items: <?php echo $j51_blocks_per_slide; ?>,
    slideSpeed : 300,
    loop:true,
    autoplay: true, 
    autoplayTimeout : <?php echo $j51_transition_interval ?>,
    smartSpeed : <?php echo $j51_transition_duration ?>,
    autoHeight : true,
    margin: <?php echo $j51_horiz_padding ?>,
    nav: <?php echo $j51_navigation ?>,
    dots: <?php echo $j51_pagination ?>,
    navText: ["<?php echo $j51_text_prev ?>","<?php echo $j51_text_next ?>"],
    itemsDesktopSmall: false,
    itemsTablet: false,
    itemsTabletSmall: false,
    itemsTabletSmall: false,
    itemsMobile: false,
    itemsCustom: [[0, <?php echo $j51_image_width_mobp ?>], [440, <?php echo $j51_image_width_mobl ?>], [767, <?php echo $j51_image_width_tabp ?>], [959, <?php echo $j51_image_width_tabl ?>], [1024, <?php echo $j51_blocks_per_slide ?>]],
    responsive : {
	    0 : {
	        items: <?php echo $j51_image_width_mobp ?>,
	    },
	    480 : {
	        items: <?php echo $j51_image_width_mobl ?>,
	    },
	    768 : {
	        items: <?php echo $j51_image_width_tabp ?>
	    },
	    959 : {
	    	items: <?php echo $j51_image_width_tabl ?>,
	    },
	    1024 : {
	    	items: <?php echo $j51_blocks_per_slide ?>,
	    },
	}
    });
     
 });

</script>
