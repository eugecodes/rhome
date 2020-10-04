<?php defined('_JEXEC') or die; ?>

<?php $itemId = '&Itemid='.JRequest::getInt('Itemid', 0); ?>
<?php $formToken = '&formtoken='.JSession::getFormToken(); ?>

<div class="ig_toolbar">
	<?php if(igGeneralHelper::authorise('core.igalleryfront.create')): ?>
		<div class="ig_button button_new"><a id="ig_toolbar_cat_new" href="<?php echo JRoute::_('index.php?option=com_igallery&view=icategory'.$itemId, false); ?>"><?php echo JText::_('NEW_CATEGORY'); ?></a></div>
	<?php endif; ?>
	<?php if( JRequest::getInt('igCatStateUsed', 0) == 1): ?>
		<div class="ig_button button_pub"><a id="ig_toolbar_cat_pub" href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.publish'.$itemId.$formToken, false); ?>"><?php echo JText::_('PUBLISH'); ?></a></div>
		<div class="ig_button button_unpub"><a id="ig_toolbar_cat_unpub" href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.unpublish'.$itemId.$formToken, false); ?>"><?php echo JText::_('UNPUBLISH'); ?></a></div>
	<?php endif; ?>
</div>

<div style="clear: both"></div>

<form action="<?php echo JRoute::_('index.php?option=com_igallery&view=categories'.$itemId); ?>" method="post" name="adminForm" id="adminForm">

<table id="ig_admin_table">
	<thead>
		<tr>
			
			<th>
				<input type="checkbox" name="ig_check_all" id="ig_check_all" autocomplete="off"/>
			</th>

			<th>
				<?php echo JText::_('JGLOBAL_TITLE'); ?>
			</th>
			
			<th>
				<?php echo JText::_( 'MANAGE_IMAGES' ); ?>
			</th>
			
			<th>
				<?php echo JText::_('JAUTHOR' ); ?>
			</th>

			<?php if( JRequest::getInt('igCatDeleteUsed', 0) == 1): ?>
			<th>
				<?php echo JText::_('DELETE'); ?>
			</th>
			<?php endif; ?>
			
			<th width="5%">
				<?php echo JText::_('JPUBLISHED'); ?>
			</th>
			
			<?php if( !empty($this->moderate) ): ?>
			<th width="5%">
				<?php echo JText::_( 'APPROVED' ); ?>
			</th>
			<?php endif; ?>
			
			<th>
				<?php echo JText::_('JFIELD_ORDERING_LABEL'); ?>
				<?php if( JRequest::getInt('igCatStateUsed', 0) == 1): ?>
					<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.saveorder'.$itemId.$formToken); ?>" id="ig_saveorder"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/filesave.png" alt="Save Order" /></a>
				<?php else: ?>
					<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/filesave-disabled.png" alt="Save Order" style="float: right;" />
				<?php endif; ?>
			</th>

			<th width="1%" class="nowrap">
					<?php echo JText::_('JGRID_HEADING_ID'); ?>
			</th>
		</tr>
	</thead>

<?php $footerColumns = empty($this->moderate) ? 8 : 9; ?>
<?php $footerColumns = JRequest::getInt('igCatDeleteUsed', 0) == 1 ? $footerColumns : $footerColumns - 1; ?>
	<tfoot>
		<tr>
			<td colspan="<?php echo $footerColumns; ?>">
			<div class="pagination">
				<?php echo $this->pagination->getListFooter(); ?>
			</div>
			</td>
		</tr>
	</tfoot>
	
	<tbody>	
    <?php

	foreach($this->items as $i => $item):
		
		$editOk = igGeneralHelper::authorise('core.igalleryfront.edit', $item->id, null, $item->profile, $item->user);
		$editStateOk = igGeneralHelper::authorise('core.igalleryfront.edit.state', $item->id, null, $item->profile, $item->user);
		$deleteOk = igGeneralHelper::authorise('core.igalleryfront.delete', $item->id, null, $item->profile, $item->user);

		?>
		<tr class="row<?php echo $i % 2; ?>">

			<td>
				<input type="checkbox" name="ig_check_<?php echo $item->id; ?>" class="ig_checkbox" />
			</td>
			
			<td class="cat_title">
				<?php if($editOk): ?>
				<a href="<?php echo JRoute::_('index.php?option=com_igallery&view=icategory&id='.$item->id.$itemId, false); ?>">
				<?php endif; ?>
				
                <?php $item->name = strlen($item->name) < 1 ? '____' : $item->name ?>
                <?php for($k=0;$k<$item->level;$k++){echo '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}if($item->level>0){echo'<sup>|_</sup>&nbsp;';}echo $this->escape($item->name); ?>
				
				<?php if($editOk): ?>
				</a>
				<?php endif; ?>
			</td>
			
			<td class="center">
			<?php if($item->manage == true): ?>
				<a href="<?php echo JRoute::_('index.php?option=com_igallery&view=images&catid='.$item->id.$itemId, false); ?>">
			<?php endif; ?>
					<?php echo JText::_( 'MANAGE_IMAGES' ); ?> (<?php echo $item->numimages; ?>)
			<?php if($item->manage == true): ?>
				</a>
			<?php endif; ?>
			</td>
			
			<td class="center">
				<?php echo empty($item->name_of_user) ? 'Error: No User With Id: '.$item->user.' Found' : $item->name_of_user; ?>
			</td>

			<?php if( JRequest::getInt('igCatDeleteUsed', 0) == 1): ?>
			<td>
				<?php if($deleteOk) :?>
					<a onclick="return confirm('<?php echo JText::_('CONFIRM_DELETE_CATEGORY'); ?>')" href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.delete&cid[]='.$item->id.$itemId.$formToken); ?>"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/trash.png" alt="Delete" /></a>
				<?php endif; ?>
			</td>
			<?php endif; ?>
			
			<td class="center">
				<?php if($item->published == 1): ?>
					<?php if($editStateOk): ?>
						<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.unpublish&cid[]='.$item->id.$itemId.$formToken); ?>">
					<?php endif; ?>
					<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/tick.png" alt="Publish" />
					<?php if($editStateOk): ?>
						</a>
					<?php endif; ?>
				<?php else: ?>
					<?php if($editStateOk): ?>
						<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.publish&cid[]='.$item->id.$itemId.$formToken); ?>">
					<?php endif; ?>
					<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/publish.png" alt="Publish" />
					<?php if($editStateOk): ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>

			</td>
			
			<?php if( !empty($this->moderate) ): ?>
			<td align="center">
				<?php echo igHtmlHelper::moderateImage($item, $i, 'categories', true); ?>
			</td>	
			<?php endif; ?>
			
			<td class="ig_order">
			<?php
				$showOrderUp = false;
				$showOrderDown = false;
				foreach($this->items as $key =>$value)
				{
					if ($item->parent == $value->parent && $item->ordering > $value->ordering)
					{
						$showOrderUp = true;
					}
					
					if ($item->parent == $value->parent && $item->ordering < $value->ordering)
					{
						$showOrderDown = true;
					}
				}
    		?>
				<div class="ig_order_arrow">
				<?php if($showOrderUp): ?>
					<?php if($editStateOk): ?>
						<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.orderup&cid[]='.$item->id.$itemId.$formToken); ?>"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/uparrow.png" alt="Order Up" /></a>
					<?php else: ?>
						<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/uparrow-disabled.png" alt="" />
					<?php endif; ?>
				<?php endif; ?>

				<?php if($showOrderDown && $i < count($this->items) ): ?>
					<?php if($editStateOk): ?>
						<a href="<?php echo JRoute::_('index.php?option=com_igallery&task=categories.orderdown&cid[]='.$item->id.$itemId.$formToken); ?>"><img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/downarrow.png" alt="Order Down" /></a>
					<?php else: ?>
						<img src="<?php echo IG_IMAGE_ASSET_PATH; ?>admin/downarrow-disabled.png" alt="" />
					<?php endif; ?>
				<?php endif; ?>
				</div>

				<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="ig_order_box" <?php if(!$editStateOk):?>disabled<?php endif; ?>/>
			</td>
			

			<td class="center">
				<?php echo $item->id; ?>
			</td>
			
		</tr>
		<?php endforeach; ?>
</tbody>
</table>

<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>

