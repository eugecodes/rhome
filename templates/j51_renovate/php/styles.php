<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );?>   

<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/typo.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/nexus.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/font-awesome.css" type="text/css" />

<?php if($responsive_sw == "1") : ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/responsive-nav.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/responsive.css" type="text/css" />

<style type="text/css">
@media only screen and (min-width: 960px) and (max-width: <?php echo ($wrapper_width); ?>px) {
.wrapper960, #header_items, #header, #logo, .hornavmenu {width:960px !important;}
#logo {width:960px !important;}
/* Hide default hornav menu */
#hornav, .hornavmenu {display:none !important;}
/* Show mobile hornav menu */
.hornavmenumobile {display:inline; z-index: 99; }
}
</style>
<?php endif; ?>

<?php if($responsive_sw == "0") : ?>
<style type="text/css">
/* Mobile Width Fix */
#body_bg {min-width: <?php echo ($wrapper_width); ?>px ;}
}
</style>
<?php endif; ?>

<?php /*?>Set Google font choices to body, articleheads, moduleheads and hornav menu<?php */?>
<?php if(($body_fontstyle == "Arial, Helvetica, sans-serif") || ($body_fontstyle == "Courier, monospace") || ($body_fontstyle == "Tahoma, Geneva, sans-serif") || ($body_fontstyle == "Garamond, serif") || ($body_fontstyle == "Georgia, serif") || ($body_fontstyle == "Impact, Charcoal, sans-serif") || ($body_fontstyle == "Lucida Console, Monaco, monospace") || ($body_fontstyle == "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($body_fontstyle == "MS Sans Serif, Geneva, sans-serif") || ($body_fontstyle == "MS Serif, New York, sans-serif") || ($body_fontstyle == "Palatino Linotype, Book Antiqua, Palatino, serif") || ($body_fontstyle == "Times New Roman, Times, serif") || ($body_fontstyle == "Trebuchet MS, Helvetica, sans-serif") || ($body_fontstyle == "Verdana, Geneva, sans-serif")) : ?>
<style type="text/css">body{font-family:<?php echo ($body_fontstyle); ?> }</style>

<?php elseif(($body_fontstyle != "Arial, Helvetica, sans-serif") || ($body_fontstyle != "Courier, monospace") || ($body_fontstyle != "Tahoma, Geneva, sans-serif") || ($body_fontstyle != "Garamond, serif") || ($body_fontstyle != "Georgia, serif") || ($body_fontstyle != "Impact, Charcoal, sans-serif") || ($body_fontstyle != "Lucida Console, Monaco, monospace") || ($body_fontstyle != "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($body_fontstyle != "MS Sans Serif, Geneva, sans-serif") || ($body_fontstyle != "MS Serif, New York, sans-serif") || ($body_fontstyle != "Palatino Linotype, Book Antiqua, Palatino, serif") || ($body_fontstyle != "Times New Roman, Times, serif") || ($body_fontstyle != "Trebuchet MS, Helvetica, sans-serif") || ($body_fontstyle != "Verdana, Geneva, sans-serif")) : ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$body_fontstyle) ?>" />
<style type="text/css">body{font-family:<?php echo ($body_fontstyle); ?> }</style>
<?php endif; ?>

<?php if(($articlehead_fontstyle == "Arial, Helvetica, sans-serif") || ($articlehead_fontstyle == "Courier, monospace") || ($articlehead_fontstyle == "Tahoma, Geneva, sans-serif") || ($articlehead_fontstyle == "Garamond, serif") || ($articlehead_fontstyle == "Georgia, serif") || ($articlehead_fontstyle == "Impact, Charcoal, sans-serif") || ($articlehead_fontstyle == "Lucida Console, Monaco, monospace") || ($articlehead_fontstyle == "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($articlehead_fontstyle == "MS Sans Serif, Geneva, sans-serif") || ($articlehead_fontstyle == "MS Serif, New York, sans-serif") || ($articlehead_fontstyle == "Palatino Linotype, Book Antiqua, Palatino, serif") || ($articlehead_fontstyle == "Times New Roman, Times, serif") || ($articlehead_fontstyle == "Trebuchet MS, Helvetica, sans-serif") || ($articlehead_fontstyle == "Verdana, Geneva, sans-serif")) : ?>
<style type="text/css">h2{font-family:<?php echo ($articlehead_fontstyle); ?> }</style>

<?php elseif(($articlehead_fontstyle != "Arial, Helvetica, sans-serif") || ($articlehead_fontstyle != "Courier, monospace") || ($articlehead_fontstyle != "Tahoma, Geneva, sans-serif") || ($articlehead_fontstyle != "Garamond, serif") || ($articlehead_fontstyle != "Georgia, serif") || ($articlehead_fontstyle != "Impact, Charcoal, sans-serif") || ($articlehead_fontstyle != "Lucida Console, Monaco, monospace") || ($articlehead_fontstyle != "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($articlehead_fontstyle != "MS Sans Serif, Geneva, sans-serif") || ($articlehead_fontstyle != "MS Serif, New York, sans-serif") || ($articlehead_fontstyle != "Palatino Linotype, Book Antiqua, Palatino, serif") || ($articlehead_fontstyle != "Times New Roman, Times, serif") || ($articlehead_fontstyle != "Trebuchet MS, Helvetica, sans-serif") || ($articlehead_fontstyle != "Verdana, Geneva, sans-serif")) : ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$articlehead_fontstyle) ?>:300,400" />
<style type="text/css">h2{font-family:<?php echo ($articlehead_fontstyle); ?>; }</style>
<?php endif; ?>

<?php if(($modulehead_fontstyle == "Arial, Helvetica, sans-serif") || ($modulehead_fontstyle == "Courier, monospace") || ($modulehead_fontstyle == "Tahoma, Geneva, sans-serif") || ($modulehead_fontstyle == "Garamond, serif") || ($modulehead_fontstyle == "Georgia, serif") || ($modulehead_fontstyle == "Impact, Charcoal, sans-serif") || ($modulehead_fontstyle == "Lucida Console, Monaco, monospace") || ($modulehead_fontstyle == "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($modulehead_fontstyle == "MS Sans Serif, Geneva, sans-serif") || ($modulehead_fontstyle == "MS Serif, New York, sans-serif") || ($modulehead_fontstyle == "Palatino Linotype, Book Antiqua, Palatino, serif") || ($modulehead_fontstyle == "Times New Roman, Times, serif") || ($modulehead_fontstyle == "Trebuchet MS, Helvetica, sans-serif") || ($modulehead_fontstyle == "Verdana, Geneva, sans-serif")) : ?>
<style type="text/css">.module h3, .module_menu h3{font-family:<?php echo ($modulehead_fontstyle); ?>; }</style>

<?php elseif(($modulehead_fontstyle != "Arial, Helvetica, sans-serif") || ($modulehead_fontstyle != "Courier, monospace") || ($modulehead_fontstyle != "Tahoma, Geneva, sans-serif") || ($modulehead_fontstyle != "Garamond, serif") || ($modulehead_fontstyle != "Georgia, serif") || ($modulehead_fontstyle != "Impact, Charcoal, sans-serif") || ($modulehead_fontstyle != "Lucida Console, Monaco, monospace") || ($modulehead_fontstyle != "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($modulehead_fontstyle != "MS Sans Serif, Geneva, sans-serif") || ($modulehead_fontstyle != "MS Serif, New York, sans-serif") || ($modulehead_fontstyle != "Palatino Linotype, Book Antiqua, Palatino, serif") || ($modulehead_fontstyle != "Times New Roman, Times, serif") || ($modulehead_fontstyle != "Trebuchet MS, Helvetica, sans-serif") || ($modulehead_fontstyle != "Verdana, Geneva, sans-serif")) : ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$modulehead_fontstyle) ?>:300,400" />
<style type="text/css">.module h3, .module_menu h3{font-family:<?php echo ($modulehead_fontstyle); ?> }</style>
<?php endif; ?>

<?php if(($hornav_fontstyle == "Arial, Helvetica, sans-serif") || ($hornav_fontstyle == "Courier, monospace") || ($hornav_fontstyle == "Tahoma, Geneva, sans-serif") || ($hornav_fontstyle == "Garamond, serif") || ($hornav_fontstyle == "Georgia, serif") || ($hornav_fontstyle == "Impact, Charcoal, sans-serif") || ($hornav_fontstyle == "Lucida Console, Monaco, monospace") || ($hornav_fontstyle == "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($hornav_fontstyle == "MS Sans Serif, Geneva, sans-serif") || ($hornav_fontstyle == "MS Serif, New York, sans-serif") || ($hornav_fontstyle == "Palatino Linotype, Book Antiqua, Palatino, serif") || ($hornav_fontstyle == "Times New Roman, Times, serif") || ($hornav_fontstyle == "Trebuchet MS, Helvetica, sans-serif") || ($hornav_fontstyle == "Verdana, Geneva, sans-serif")) : ?>
<style type="text/css">#hornav{font-family:<?php echo ($hornav_fontstyle); ?> }</style>

<?php elseif(($hornav_fontstyle != "Arial, Helvetica, sans-serif") || ($hornav_fontstyle != "Courier, monospace") || ($hornav_fontstyle != "Tahoma, Geneva, sans-serif") || ($hornav_fontstyle != "Garamond, serif") || ($hornav_fontstyle != "Georgia, serif") || ($hornav_fontstyle != "Impact, Charcoal, sans-serif") || ($hornav_fontstyle != "Lucida Console, Monaco, monospace") || ($hornav_fontstyle != "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($hornav_fontstyle != "MS Sans Serif, Geneva, sans-serif") || ($hornav_fontstyle != "MS Serif, New York, sans-serif") || ($hornav_fontstyle != "Palatino Linotype, Book Antiqua, Palatino, serif") || ($hornav_fontstyle != "Times New Roman, Times, serif") || ($hornav_fontstyle != "Trebuchet MS, Helvetica, sans-serif") || ($hornav_fontstyle != "Verdana, Geneva, sans-serif")) : ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$hornav_fontstyle) ?>" />
<style type="text/css">#hornav{font-family:<?php echo ($hornav_fontstyle); ?> }</style>
<?php endif; ?>

<?php if(($logo_fontstyle == "Arial, Helvetica, sans-serif") || ($logo_fontstyle == "Courier, monospace") || ($logo_fontstyle == "Tahoma, Geneva, sans-serif") || ($logo_fontstyle == "Garamond, serif") || ($logo_fontstyle == "Georgia, serif") || ($logo_fontstyle == "Impact, Charcoal, sans-serif") || ($logo_fontstyle == "Lucida Console, Monaco, monospace") || ($logo_fontstyle == "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($logo_fontstyle == "MS Sans Serif, Geneva, sans-serif") || ($logo_fontstyle == "MS Serif, New York, sans-serif") || ($logo_fontstyle == "Palatino Linotype, Book Antiqua, Palatino, serif") || ($logo_fontstyle == "Times New Roman, Times, serif") || ($logo_fontstyle == "Trebuchet MS, Helvetica, sans-serif") || ($logo_fontstyle == "Verdana, Geneva, sans-serif")) : ?>
<style type="text/css">h1.logo-text a{font-family:<?php echo ($logo_fontstyle); ?> }</style>

<?php elseif(($logo_fontstyle != "Arial, Helvetica, sans-serif") || ($logo_fontstyle != "Courier, monospace") || ($logo_fontstyle != "Tahoma, Geneva, sans-serif") || ($logo_fontstyle != "Garamond, serif") || ($logo_fontstyle != "Georgia, serif") || ($logo_fontstyle != "Impact, Charcoal, sans-serif") || ($logo_fontstyle != "Lucida Console, Monaco, monospace") || ($logo_fontstyle != "Lucida Sans Unicode, Lucida Grande, sans-serif") || ($logo_fontstyle != "MS Sans Serif, Geneva, sans-serif") || ($logo_fontstyle != "MS Serif, New York, sans-serif") || ($logo_fontstyle != "Palatino Linotype, Book Antiqua, Palatino, serif") || ($logo_fontstyle != "Times New Roman, Times, serif") || ($logo_fontstyle != "Trebuchet MS, Helvetica, sans-serif") || ($logo_fontstyle != "Verdana, Geneva, sans-serif")) : ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$logo_fontstyle) ?>" />
<style type="text/css">h1.logo-text a{font-family:<?php echo ($logo_fontstyle); ?> }</style>
<?php endif; ?>
<?php /*?>End Set Google font choices to body, articleheads, moduleheads and hornav menu<?php */?>

<?php if($this->direction == 'rtl') : ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/template_rtl.css" type="text/css" />
<?php endif; ?>

<style type="text/css">
/*--Set Logo Image position and locate logo image file--*/ 
.logo a {left:<?php echo ($logo_x); ?>px}
.logo a {top:<?php echo ($logo_y); ?>px}
/*--End Set Logo Image position and locate logo image file--*/ 

/*--Body font size--*/
body{font-size: <?php echo ($body_fontsize); ?>}

/*--Text Colors for Module Heads and Article titles--*/ 
body {color:<?php echo ($body_font_color); ?>;}
h2, h2 a:link, h2 a:visited {color: <?php echo ($articletitle_font_color); ?> ; }
.module h3, .module_menu h3, h3 {color: <?php echo ($modulehead_font_color); ?> }
a {color: <?php echo ($content_link_color); ?> }

/*--Text Colors for Logo and Slogan--*/ 
h1.logo-text a {
	color: <?php echo ($logo_font_color) ?>;
}
p.site-slogan {color: <?php echo ($slogan_font_color); ?> }

/*--Hornav Ul text color and dropdown background color--*/
#hornav ul li a  {color: <?php echo ($hornav_font_color); ?> }
#subMenusContainer ul, #subMenusContainer ol{background-color: <?php echo ($hornav_ddbackground_color); ?> }

/*--Start Style Side Column and Content Layout Divs--*/
/*--Get Side Column widths from Parameters--*/
.sidecol_a {width: <?php echo ($sidecola_width); ?>% }
.sidecol_b {width: <?php echo ($sidecolb_width); ?>% }

.maincontent {padding: 0 26px 0 0;}
<?php if ($this->countModules( 'sidecol-a' )) : ?>
.maincontent {padding: 0 26px;}
<?php endif; ?>

/*--Check and see what modules are toggled on/off then take away columns width, margin and border values from overall width*/
<?php if($this->countModules( 'sidecol-a') >= 1 && $this->countModules('sidecol-b') >= 1) : ?>
#content_remainder {width:<?php echo 99.9 - ($sidecola_width + $sidecolb_width) ?>% }

<?php elseif($this->countModules('sidecol-a') >= 1 && $this->countModules('sidecol-b') == 0) : ?>
#content_remainder {width:<?php echo 100 - ($sidecola_width) ?>% }

<?php elseif($this->countModules('sidecol-a') == 0 && $this->countModules('sidecol-b') >= 1) : ?>
#content_remainder {width:<?php echo 100 - ($sidecolb_width) ?>% }

<?php endif; ?>

/* Top margin adjustment */
<?php if ($this->countModules('showcase') || $this->countModules('top-1a') || $this->countModules('top-1b') || $this->countModules('top-1c') || $this->countModules('top-1d') || $this->countModules('top-1e') || $this->countModules('top-1f') || $this->countModules('top-2a') || $this->countModules('top-2b') || $this->countModules('top-2c') || $this->countModules('top-2d') || $this->countModules('top-2e') || $this->countModules('top-2f')) : ?>
#body_bg {padding-top:0px;}
<?php endif; ?>

/*Style Side Column A, Side Column B and Content Divs layout*/
<?php if($this->params->get('column_layout') == 'SCOLA-SCOLB-COM') : ?>
	.sidecol_a {float:left;}
	.sidecol_b {float:left;}
	#content_remainder {float:left;}
    .sidecol_b .sidecol_block {padding: 0 26px 0 0;}
    .sidecol_a .sidecol_block {padding: 0 26px 0 0;}
    .maincontent {padding-left: 26px;}

/*Style Content, Side Column A, Side Column B Divs layout*/	
<?php elseif($this->params->get('column_layout') == 'COM-SCOLA-SCOLB') : ?>
	#content_remainder {float:left;}
	.sidecol_a {float:right;}
	.sidecol_b {float:right;}
	.sidecol_b .sidecol_block {padding: 0 0 0 26px;}
	.sidecol_a .sidecol_block {padding: 0 0 0 26px;}
	.maincontent {padding-left: 26px;}

/*Style Side Column A, Content, Side Column B Divs layout*/
<?php elseif($this->params->get('column_layout') == 'SCOLA-COM-SCOLB') : ?>  
	.sidecol_a {float:left;}
	.sidecol_b {float:right;}
	#content_remainder {float:left;}

<?php endif; ?>
/*--End Style Side Column and Content Layout Divs--*/

/*--Load Custom Css Styling--*/
<?php echo ($custom_css); ?>

/* Wrapper Width */
.wrapper960, #header {width: <?php echo ($wrapper_width); ?>px ;}

/* Social Icons Colour */
<?php if($this->params->get('social_style') == 'social_style_dark') : ?>
#socialmedia ul li a{background-position: 0px 0px;}
<?php else : ?>
#socialmedia ul li a{background-position: 0px -40px;}
<?php endif; ?>

/* Background Color */
body, #body_bg, #container_top_modules {
background-color: <?php echo $bgcolor; ?>;
}

/* Button Colour */
.readmore a, input.button, ul.pagination li, li.pagenav-prev, li.pagenav-next, button, .j51-button a, .module .j51imagelinkhover .j51button a, 
.module_style-box .j51imagelinkhover .j51button a, .pagination li a, .pagination li span {
	background-color: <?php echo $button_color ?>;
}
.btn, .btn:hover, .btn-group.open .btn.dropdown-toggle, .input-append .add-on, .input-prepend .add-on, .pager.pagenav a, .btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {
	background-color: <?php echo $button_color ?>;
}

/* Top-1# Module Background */
#container_slideshow_modules  {
	background-color: <?php echo $elementcolor6; ?>;
}

/* Header Color */
.js .selectnav {
	background-color: <?php echo $elementcolor8; ?> !important;
}

/* Hornav/Social Icons Background Color */
#container_header_bg, .slicknav_menu {
	background-color:<?php echo $elementcolor2; ?>;
}

/* Mobile Tag Background */
#nav-toggle {background-color:<?php echo $elementcolor7; ?>;}

/* Top Menu Border Colour */
#container_header_bg {
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.32), inset 0 4px 0 <?php echo $elementcolor7; ?>; /* drop shadow and inner shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.32), inset 0 4px 0 <?php echo $elementcolor7; ?>; /* drop shadow and inner shadow */
	box-shadow: 0 1px 3px rgba(0,0,0,.32), inset 0 4px 0 <?php echo $elementcolor7; ?>; /* drop shadow and inner shadow */
}
#hornav li > a:hover, #hornav li.active > a, a.mainMenuParentBtnFocused {
	-moz-box-shadow:  inset 0 -10px 0 <?php echo $elementcolor7; ?>; /* drop shadow and inner shadow */
	-webkit-box-shadow: inset 0 -10px 0 <?php echo $elementcolor7; ?>; /* drop shadow and inner shadow */
	box-shadow: inset 0 -10px 0 <?php echo $elementcolor7; ?>; /* drop shadow and inner shadow */
}
#container_header, #container_slideshow, #container_slideshow_modules {
    border-bottom: 5px solid <?php echo $elementcolor7; ?>;
}

/* Showcase Position Height */
#container_spacer1 {
	min-height: <?php echo $elementcolor7; ?>px;
}

/* Responsive Options */
<?php if($responsive_sw == "1") : ?>

	<?php if($res_top1_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	#container_slideshow_modules {display:none;}
	}
	<?php endif; ?>

	<?php if($res_top2_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	#container_top_modules {display:none;}
	}
	<?php endif; ?>

	<?php if($res_top3_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	#container_top3_modules {display:none;}
	}
	<?php endif; ?>

	<?php if($res_sidecola_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	.sidecol_a {display:none;}
	}
	<?php endif; ?>

	<?php if($res_sidecolb_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	.sidecol_b {display:none;}
	}
	<?php endif; ?>

	<?php if($res_bottom_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	#container_bottom_modules {display:none;}
	}
	<?php endif; ?>

	<?php if($res_base_sw != "1") : ?>
	@media only screen and ( max-width: 767px ) {
	#container_base #base.block_holder {display:none;}
	}
	<?php endif; ?>
	
	<?php if($mobile_showcase_sw == '1') : ?>
	@media only screen and ( max-width: 767px ) {
	.showcase {display:none;}
	.mobile_showcase {display:inline;}
	}
	<?php else : ?>
	@media only screen and ( max-width: 767px ) {
	.showcase {display:inline;}
	.mobile_showcase {display:none;}
	}
	<?php endif; ?>
	
<?php endif; ?>

/* Custom Reponsive CSS */
<?php if($tabport_css != "") : ?>
@media only screen and (min-width: 768px) and (max-width: 959px) {
<?php echo ($tabport_css); ?>
}
<?php endif; ?>   
<?php if($mobland_css != "") : ?>
@media only screen and ( max-width: 767px ) {
<?php echo ($mobland_css); ?>
}
<?php endif; ?>   
<?php if($mobport_css != "") : ?>
@media only screen and (max-width: 440px) {
<?php echo ($mobport_css); ?>
}
<?php endif; ?>  

/*-- Background Image --*/ 
<?php if($this->params->get('bgimagefile') != '') : ?>
#body_bg {
	background: url(<?php echo $this->baseurl ?>/<?php echo $bgimagefile; ?>) 50% 0% no-repeat fixed;
}
<?php endif; ?>

<?php if ($this->countModules('showcase')) { ?>
@media only screen and ( max-width: 767px ) {
#container_slideshow {
    position:relative !important;
	padding:25px 0px;
}
#container_header {
	position:relative !important;
}}
@media only screen and (max-width: 440px) {
#container_slideshow {padding:25px 0px;}}
<?php }?>


</style>

 <!-- Content Background Colour -->
<?php 
include ("convert_rgb.php");
$bgcolorRGB             = hex2RGB($elementcolor1);
$HRed                   = $bgcolorRGB['red'];
$HGreen                 = $bgcolorRGB['green'];
$HBlue                  = $bgcolorRGB['blue'];
 ?>

 <style type="text/css"> 
#container_main, 
#container_hornav_mobile, #container_top3_modules {
	background-color: <?php echo $elementcolor1; ?>;
	background-color: rgba(<?php echo $HRed;?>,<?php echo $HGreen;?>,<?php echo $HBlue;?>, 1 );
}

 </style>

 <!-- Top Menu Hover/Active Colour -->
<?php 
$bgcolorRGB             = hex2RGB($elementcolor4);
$HRed                   = $bgcolorRGB['red'];
$HGreen                 = $bgcolorRGB['green'];
$HBlue                  = $bgcolorRGB['blue'];
 ?>
 <style type="text/css">
#hornav a:after {
	background: rgba(<?php echo $HRed;?>,<?php echo $HGreen;?>,<?php echo $HBlue;?>, 1 );
}
 </style>

<!-- Base Modules -->
<?php 
$bgcolorRGB             = hex2RGB($elementcolor9);
$HRed                   = $bgcolorRGB['red'];
$HGreen                 = $bgcolorRGB['green'];
$HBlue                  = $bgcolorRGB['blue'];
 ?>
 <style type="text/css">
#container_base, #container_copyright  {
	background-color: rgba(<?php echo $HRed;?>,<?php echo $HGreen;?>,<?php echo $HBlue;?>, <?php echo $elementcolor10; ?> );
}

 </style>

 <!-- #container_header background colour -->
<?php 
$bgcolorRGB             = hex2RGB($elementcolor8);
$HRed                   = $bgcolorRGB['red'];
$HGreen                 = $bgcolorRGB['green'];
$HBlue                  = $bgcolorRGB['blue'];
 ?>
 <style type="text/css">
#container_header {
	background-color: rgba(<?php echo $HRed;?>,<?php echo $HGreen;?>,<?php echo $HBlue;?>, <?php echo $elementcolor5; ?> );
}
 </style>


<?php if($customcss_sw == "1") : ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template?>/css/custom.css" type="text/css" />
<?php endif; ?>