<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );?>

<?php if($responsive_sw == "1") : ?>
<!-- Hornav Responsive Menu -->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/responsive-nav/responsive-nav.js" charset="utf-8"></script>
<script>
	jQuery(function(){
		jQuery('#hornav').slicknav();
	});
</script>
<?php endif; ?>

<!-- Hornav Dropdown -->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/dropdown.js" charset="utf-8"></script>
<script type="text/javascript" >
window.addEvent('domready', function() {
	var myMenu = new MenuMatic();
});
</script>

<!-- Load scripts.js -->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/scripts.js" charset="utf-8"></script>
