<?php

?>

<div id="slideshow_modules" class="block_holder">

<!-- <div id="slideshow_modules_inner" class="border_outer"> -->
<!-- <div class="j51_border2"> -->

<?php if($this->params->get('top1_auto') != '1') : ?>
<?php if ($this->countModules('top-1a') || $this->countModules('top-1b') || $this->countModules('top-1c') || $this->countModules('top-1d') || $this->countModules('top-1e') || $this->countModules('top-1f')) { ?>
    <div id="wrapper_top-1" class="block_holder_margin">
        <?php if ($this->countModules('top-1a')) { ?> 
        <div class="top-1" style="width:<?php echo $top1_width ?>;"><div class="module_margin"><jdoc:include type="modules" name="top-1a"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1b')) { ?>
        <div class="top-1" style="width:<?php echo $top1_width ?>;"><div class="module_margin"><jdoc:include type="modules" name="top-1b"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1c')) { ?>
        <div class="top-1" style="width:<?php echo $top1_width ?>;"><div class="module_margin"><jdoc:include type="modules" name="top-1c"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1d')) { ?>
        <div class="top-1" style="width:<?php echo $top1_width ?>;"><div class="module_margin"><jdoc:include type="modules" name="top-1d"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1e')) { ?>
        <div class="top-1" style="width:<?php echo $top1_width ?>;"><div class="module_margin"><jdoc:include type="modules" name="top-1e"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1f')) { ?>
        <div class="top-1" style="width:<?php echo $top1_width ?>;"><div class="module_margin"><jdoc:include type="modules" name="top-1f"  style="mod_standard"/></div></div><?php } ?>
        <div class="clear"></div>
    </div>		
    <?php }?>
					
<?php else : ?>

<?php if ($this->countModules('top-1a') || $this->countModules('top-1b') || $this->countModules('top-1c') || $this->countModules('top-1d') || $this->countModules('top-1e') || $this->countModules('top-1f')) { ?>
    <div id="wrapper_top-1" class="block_holder_margin">
        <?php if ($this->countModules('top-1a')) { ?> 
        <div class="top-1" style="width:<?php echo $top_1a_manual ?>%;"><div class="module_margin"><jdoc:include type="modules" name="top-1a"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1b')) { ?>
        <div class="top-1" style="width:<?php echo $top_1b_manual ?>%;"><div class="module_margin"><jdoc:include type="modules" name="top-1b"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1c')) { ?>
        <div class="top-1" style="width:<?php echo $top_1c_manual ?>%;"><div class="module_margin"><jdoc:include type="modules" name="top-1c"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1d')) { ?>
        <div class="top-1" style="width:<?php echo $top_1d_manual ?>%;"><div class="module_margin"><jdoc:include type="modules" name="top-1d"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1e')) { ?>
        <div class="top-1" style="width:<?php echo $top_1e_manual ?>%;"><div class="module_margin"><jdoc:include type="modules" name="top-1e"  style="mod_standard"/></div></div><?php } ?>
        <?php if ($this->countModules('top-1f')) { ?>
        <div class="top-1" style="width:<?php echo $top_1f_manual ?>%;"><div class="module_margin"><jdoc:include type="modules" name="top-1f"  style="mod_standard"/></div></div><?php } ?>
        <div class="clear"></div>
    </div>
    <?php }?>
<?php endif; ?>

</div>