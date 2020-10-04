<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div class="igallery_clear"></div>
<form action="index.php?option=com_igallery&amp;view=category&amp;id=<?php echo $this->category->id; ?>&amp;Itemid=<?php echo $this->Itemid; ?>" method="post" name="ig_menu_pagination">

<?php $allCategories = igStaticHelper::getCategories(); ?>

<?php if(count($this->categoryChildren) != 0): ?>

	<div id="cat_child_wrapper<?php echo $this->uniqueid; ?>" class="cat_child_wrapper cat_child_wrapper_<?php echo $this->profile->style; ?> profile<?php echo $this->profile->id; ?>" >
	<?php $counter = 0; ?>
	
	<?php while( $counter < count($this->categoryChildren) ): ?>

        <?php if( isset($this->categoryChildren[$counter]) ):
            $row = $this->categoryChildren[$counter];
            $linkItemid = $this->source == 'component' ? $this->Itemid : igUtilityHelper::getItemid($row->id);
            $link = JRoute::_('index.php?option=com_igallery&amp;view=category&amp;igid='.$row->id.'&amp;Itemid='.$linkItemid);
            $divStyle = isset($row->fileArray) ? 'max-width:'.($row->fileArray['width'] + 6).'px;' : 'width:'.$this->profile->menu_max_width.'px;';
        ?>

            <div class="cat_child" style="<?php echo $divStyle; ?>" >

            <?php if( isset($row->fileArray)): ?>
                <a href="<?php echo $link; ?>">
                   <img src="<?php echo IG_IMAGE_HTML_RESIZE; ?><?php echo $row->fileArray['folderName']; ?>/<?php echo $row->fileArray['fullFileName']; ?>" alt="<?php echo $row->name; ?>" />
                </a>
            <?php endif; ?>

            <h3 class="cat_child_h3">
                <a href="<?php echo $link; ?>" class="cat_child_a"><?php echo $row->name; ?> </a>
            </h3>

            <div class="cat_child_des"><?php echo $row->menu_description; ?></div>

            <?php if($this->profile->show_cat_author == 1): ?>
                <?php $authorText = $this->params->get('show_name_username', 'name') == 'name' ? $row->displayname : $row->username; ?>
                <div class="menu_text_block menu_text_block_author"><?php echo JText::_('JAUTHOR'); ?>: <?php echo $authorText; ?></div>
            <?php endif; ?>

            <?php if($this->profile->show_image_count == 1 ): ?>
                <?php if($row->numimages > 0): ?>
                    <div class="menu_text_block menu_text_block_num"><?php echo $row->numimages; ?> <?php echo JText::_('IMAGES'); ?></div>
                <?php else: ?>
                    <?php $childCategories = igTreeHelper::getChildIds($allCategories, $row->id); ?>
                    <?php if( count($childCategories) > 0 ): ?>
                        <?php $categoryText = count($childCategories) > 1 ? JText::_('COM_IGALLERY_CATEGORIES') : JText::_('JCATEGORY'); ?>
                        <div class="menu_text_block menu_text_block_child"><?php echo count($childCategories); ?> <?php echo $categoryText; ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if($this->profile->show_category_hits == 1): ?>
            <div class="menu_text_block menu_text_block_hits"><?php echo $row->hits; ?> <?php echo JText::_('COM_IGALLERY_VIEWS'); ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php $counter++; ?>

    <?php endwhile; ?>
<div class="igallery_clear"></div>
</div>
<div class="igallery_clear"></div>
<script type="text/javascript">
window.addEvent('load', function()
{
    var adjustMenu = new AdjustMenuImages({id: 'cat_child_wrapper<?php echo $this->uniqueid; ?>'});
});

var AdjustMenuImages = new Class(
{
    Implements: Options,
    options: {},

    initialize: function(options)
    {
        this.setOptions(options);
        this.menuWrapper = document.id(this.options.id);

        this.menuWrapperParent = this.menuWrapper.getParent();
        this.menuWrapperParentWidth = this.menuWrapperParent.getSize().x;

        this.setHeight();
        this.setHeight.periodical(700, this);
    },

    setHeight: function()
    {
        var wrapperWidth = this.menuWrapper.getSize().x;
        var menuDivs = this.menuWrapper.getElements('div.cat_child');
        var widthSum = 0;
        var colsInRow = 0;
        var elHighest = 0;
        var rowWidths = new Array();

        menuDivs.each(function(el,index)
        {
            var elWidth = el.getSize().x + parseInt(el.getStyle('margin-left')) + parseInt(el.getStyle('margin-right'));
            var elHeight = el.getComputedSize().height;

            if(elWidth + widthSum < wrapperWidth)
            {
                widthSum = widthSum + elWidth;
                colsInRow++;
                elHighest = elHeight > elHighest ? elHeight : elHighest;

            }
            else
            {
                rowWidths.push(widthSum);

                lastIndex = index - 1;
                for(var i=0; i<colsInRow; i++)
                {
                    menuDivs[lastIndex].setStyle('height', elHighest);
                    lastIndex--;
                }

                widthSum = elWidth;
                colsInRow = 1;
                elHighest = elHeight;
            }
        });

        var menuWrapperParentWidthNow = this.menuWrapperParent.getSize().x;

        if(menuWrapperParentWidthNow > this.menuWrapperParentWidth)
        {
            //this.menuWrapper.setStyle('max-width', 'none');
        }
        else
        {
            var maxRowWidth = Math.max.apply(Math, rowWidths) + 5;
            //this.menuWrapper.setStyle('max-width', maxRowWidth);
        }

        this.menuWrapperParentWidth = menuWrapperParentWidthNow;
    }
});

</script>
<?php endif; ?>

<?php if($this->profile->menu_pagination == 1): ?>

    <?php if($this->menuPagination->total > $this->menuPagination->limit): ?>
        <div class="pagination">
            <?php echo $this->menuPagination->getPagesLinks(); ?>
        </div>

        <div class="pagination">
            <?php echo $this->menuPagination->getPagesCounter(); ?>
        </div>
    <?php endif; ?>

<?php endif; ?>

</form>
<div class="igallery_clear"></div>