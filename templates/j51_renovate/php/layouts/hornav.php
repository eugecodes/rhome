<div id ="hornavmenu" class="block_holder"> 

        <div class="hornavmenu">
            <?php if($this->params->get('hornavPosition') == '1') : ?>
                <div id="hornav">
                    <jdoc:include type="modules" name="hornav" />
                </div>
            <?php else : ?>
                <div id="hornav">
                    <?php echo $hornav; ?>
                </div>
            <?php endif; ?>
        </div>
     
<div class="clear"></div>

</div>
