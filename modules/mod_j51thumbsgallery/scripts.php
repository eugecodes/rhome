
<script type="text/javascript"> 
// j51thumbs animations
jQuery(function () {

	jQuery('.fancybox').fancybox();
	
	jQuery(".j51thumbs i").animate({
			 opacity: 0
	
		  }, {
			 duration: 300,
			 queue: false
		  });      

   jQuery(".j51thumbs").parent().hover(
	   function () {},
	   function () {
		  jQuery(".j51thumbs i").animate({
			 opacity: 0
		  }, {
			 duration: 300,
			 queue: false
		  });
   });
 
   jQuery(".j51thumbs i").hover(
      function () {
		  jQuery(this).animate({
			 opacity: 0
	
		  }, {
			 duration: 300,
			 queue: false
		  });      

		  jQuery(".j51thumbs i").not( jQuery(this) ).animate({
			 opacity: <?php echo $fade_opacity ?>
		  }, {
			 duration: 300,
			 queue: false
		  });
      }, function () {
      }
   );

});

</script> 