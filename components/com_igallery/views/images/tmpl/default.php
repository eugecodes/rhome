<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php $itemId = '&Itemid='.JRequest::getInt('Itemid', 0); ?>
<?php $formToken = '&formtoken='.JSession::getFormToken(); ?>
<?php $catid = '&catid='.$this->category->id; ?>

<style type="text/css">
.table_thumb_image{
    max-width: 200px;
    height: auto;
}
</style>


<h2 style="margin-top: 5px;"><?php echo $this->category->name; ?></h2>

<div class="ig_toolbar">
	<div class="ig_button button_back"><a id="ig_toolbar_image_back" href="<?php echo JRoute::_('index.php?option=com_igallery&view=categories'.$itemId); ?>"><?php echo JText::_('BACK'); ?></a></div>
	<?php if( JRequest::getInt('igImgStateUsed', 0) == 1): ?>
		<div class="ig_button button_pub"><a id="ig_toolbar_image_pub" href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.publish'.$catid.$itemId.$formToken, false); ?>" id=""><?php echo JText::_('PUBLISH'); ?></a></div>
		<div class="ig_button button_unpub"><a id="ig_toolbar_image_unpub" href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.unpublish'.$catid.$itemId.$formToken, false); ?>"><?php echo JText::_('UNPUBLISH'); ?></a></div>
	<?php endif; ?>

	<?php if( JRequest::getInt('igImgDeleteUsed', 0) == 1): ?>
		<div class="ig_button button_delete"><a id="ig_toolbar_image_delete" href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.delete'.$catid.$itemId.$formToken, false); ?>"><?php echo JText::_('DELETE'); ?></a></div>
	<?php endif; ?>
</div>

<div style="clear: both"></div>


<form action="<?php echo JRoute::_('index.php?option=com_igallery&view=images&catid='.$this->category->id.$itemId); ?>" method="post" name="adminForm" id="adminForm">

<table id="ig_admin_table">
<thead>
	<tr>

		<th>
			<input type="checkbox" name="ig_check_all" id="ig_check_all" />
		</th>

		<th width="20">
			<?php echo JText::_( 'MENU_IMAGE' )?>
		</th>

		<th>
			<?php echo JText::_( 'THUMBNAIL' )?>
		</th>

		<th>
			<?php echo JText::_( 'JGLOBAL_DESCRIPTION' ); ?>
		</th>
		
		<th width="60">
			<?php echo JText::_( 'ROTATE' )?>
		</th>

		<th width="5%">
			<?php echo JText::_('JPUBLISHED'); ?>
		</th>
		
		<?php if( !empty($this->moderate) ): ?>
		<th width="5%">
			<?php echo JText::_( 'APPROVED' ); ?>
		</th>
		<?php endif; ?>
		
		<th style="width:120px;">
			<?php echo JText::_('JFIELD_ORDERING_LABEL'); ?>
			<?php if(igGeneralHelper::authorise('core.igalleryfront.editimage.state')) :?>
				<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.saveorder'.$catid.$itemId.$formToken); ?>" id="ig_saveorder"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/filesave.png" alt="Save Order" /></a>
			<?php else: ?>
				<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/filesave-disabled.png" alt="Save Order" />
			<?php endif; ?>
		</th>

	</tr>
</thead>

<tfoot>
<?php $columns = empty($this->moderate) ? 7 : 8; ?>
	<tr>
		<td colspan="<?php echo $columns; ?>">
            <div class="pagination">
			<?php echo $this->pagination->getListFooter(); ?>
            </div>
		</td>
	</tr>
</tfoot>

<?php
foreach ($this->items as $i => $item) :
	
	$editOk = igGeneralHelper::authorise('core.igalleryfront.editimage', null, $item->id, $item->id_of_profile, $item->user);
	$editStateOk = igGeneralHelper::authorise('core.igalleryfront.editimage.state', $item->gallery_id, null, $item->id_of_profile, $item->user);
	$deleteOk = igGeneralHelper::authorise('core.igalleryfront.deleteimage', $item->gallery_id, null, $item->id_of_profile, $item->user);
	
	$editLink 	= JRoute::_('index.php?option=com_igallery&view=image&id='.$item->id.$itemId, false);
	?>
	<tr class="row<?php echo $i % 2; ?>">
		
		<td>
			<input type="checkbox" name="ig_check_<?php echo $item->id; ?>" class="ig_checkbox" autocomplete="off"/>
		</td>

		<td>
		<?php if($item->menu_image == 1): ?>
			<?php if($editStateOk): ?>
				<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.assignMenuImage&catid='.$item->gallery_id.'&id='.$item->id.'&cvalue=0'.$itemId, false) ?>">
			<?php endif; ?>
				<img src="<?php echo IG_HOST; ?>media/com_igallery/images/admin/icon-16-default.png" />
			<?php if($editStateOk): ?>
				</a>
			<?php endif; ?>
		<?php else: ?>
			<?php if($editStateOk): ?>
				<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.assignMenuImage&catid='.$item->gallery_id.'&id='.$item->id.'&cvalue=1'.$itemId, false) ?>">
			<?php endif; ?>
				<img src="<?php echo IG_HOST; ?>media/com_igallery/images/admin/icon-16-notdefault.png" />
			<?php if($editStateOk): ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
		</td>

		<td>
			<img src="<?php echo IG_IMAGE_HTML_RESIZE; ?><?php echo $this->thumbFiles[$i]['folderName']; ?>/<?php echo $this->thumbFiles[$i]['fullFileName']; ?>"
			width="<?php echo $this->thumbFiles[$i]['width']; ?>" height="<?php echo $this->thumbFiles[$i]['height'] ?>" alt="<?php echo $item->alt_text; ?>" class="table_thumb_image"/>
		</td>

		<td align="center">
            <?php echo mb_strimwidth($item->description, 0, 100, '...'); ?>
			
			<?php if($editOk): ?>
				<a href="<?php echo $editLink;?>"><?php echo JText::_( 'JACTION_EDIT' ); ?></a>
			<?php endif; ?>
		</td>
		
		<td style="text-align: center;">
		<?php if($editStateOk): ?>
			<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.rotate&catid='.$item->gallery_id.'&id='.$item->id.'&rvalue=0', false); ?>">
				<img src="<?php echo IG_HOST; ?>media/com_igallery/images/admin/rotate-left.png" style="float: none;" />
			</a>
		
			<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.rotate&catid='.$item->gallery_id.'&id='.$item->id.'&rvalue=1', false); ?>">
				<img src="<?php echo IG_HOST; ?>media/com_igallery/images/admin/rotate-right.png" style="float: none;" />
			</a>
		<?php endif; ?>
		</td>

		<td class="center">
			<?php if($item->published == 1): ?>
				<?php if($editStateOk): ?>
					<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.unpublish&cid[]='.$item->id.$catid.$itemId.$formToken); ?>">
				<?php endif; ?>
				<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/tick.png" alt="Publish" />
				<?php if($editStateOk): ?>
					</a>
				<?php endif; ?>
			<?php else: ?>
				<?php if($editStateOk): ?>
					<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.publish&cid[]='.$item->id.$catid.$itemId.$formToken); ?>">
				<?php endif; ?>
				<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/publish.png" alt="Publish" />
				<?php if($editStateOk): ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
		</td>
		
		<?php if( !empty($this->moderate) ): ?>
		<td align="center">
			<?php echo igHtmlHelper::moderateImage($item, $i, 'images', true); ?>
		</td>	
		<?php endif; ?>

		<td class="ig_order">
			<div class="ig_order_arrow">

			<?php if($i != 0): ?>
				<?php if($editStateOk): ?>
					<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.orderup&cid[]='.$item->id.$catid.$itemId.$formToken); ?>"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/uparrow.png" alt="Order Up" /></a>
				<?php else: ?>
					<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/uparrow-disabled.png" alt="" />
				<?php endif; ?>
			<?php endif; ?>


				<?php if($i < (count($this->items) -1) ): ?>
					<?php if($editStateOk): ?>
						<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=images.orderdown&cid[]='.$item->id.$catid.$itemId.$formToken); ?>"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/downarrow.png" alt="Order Down" /></a>
					<?php else: ?>
						<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/downarrow-disabled.png" alt="" />
					<?php endif; ?>
				<?php endif; ?>
				</div>

				<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="ig_order_box" <?php if(!$editStateOk):?>disabled<?php endif; ?>/>
		</td>

	</tr>
	<?php endforeach; ?>

</table>


<input type="hidden" name="task" value="" />

<?php echo JHtml::_('form.token'); ?>
</form>

