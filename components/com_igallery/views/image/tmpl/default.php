<?php defined('_JEXEC') or die(); ?>

<?php if(IG_J30): ?>
    <style type="text/css">
        #jform_description_ifr{
            height: 200px !important;
        }

        .CodeMirror {
            height: 300px !important;
        }
    </style>
<?php endif; ?>

<?php $itemId = '&Itemid='.JRequest::getInt('Itemid', 0); ?>
<div class="ig_toolbar">
	<div class="ig_button button_apply"><a id="ig_toolbar_image_apply" href="#" id=""><?php echo JText::_('APPLY'); ?></a></div>
	<div class="ig_button button_save"><a id="ig_toolbar_image_save" href="#"><?php echo JText::_('JSAVE'); ?></a></div>
	<div class="ig_button button_next"><a id="ig_toolbar_image_savenext" href="#"><?php echo JText::_('SAVE_AND_NEXT'); ?></a></div>
	<div class="ig_button button_cancel"><a id="ig_toolbar_image_cancel" href="<?php echo JRoute::_('index.php?option=com_igallery&view=images&catid='.$this->category->id.$itemId); ?>"><?php echo JText::_('JCANCEL'); ?></a></div>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_igallery'); ?>" method="post" name="adminForm"  id="ig_image_form">
	<table class="ig_form_table">

            <tr>
			<td class="ig_left_col"><?php echo $this->form->getLabel('description'); ?></td>
			<td><?php echo $this->form->getInput('description'); ?></td>
            </tr>
			
            <?php if($this->params->get('allow_frontend_photo_tags', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('tags'); ?></td>
                <td><?php echo $this->form->getInput('tags'); ?></td>
                </tr>
			<?php endif; ?>

            <tr>
			<td class="ig_left_col"><img src="<?php echo IG_IMAGE_HTML_RESIZE; ?><?php echo $this->thumbFile['folderName']; ?>/<?php echo $this->thumbFile['fullFileName']; ?>"
			width="<?php echo $this->thumbFile['width']; ?>" height="<?php echo $this->thumbFile['height'] ?>" alt="<?php echo $this->item->alt_text; ?>"/></td>
            </tr>
			
			<?php if($this->params->get('allow_frontend_photo_alt', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('alt_text'); ?></td>
				<td><?php echo $this->form->getInput('alt_text'); ?></td>
                </tr>
			<?php endif; ?>
			
			<?php if($this->params->get('allow_frontend_photo_link', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('link'); ?></td>
				<td><?php echo $this->form->getInput('link'); ?></td>
				</tr>
			<?php endif; ?>
			
			<?php if($this->params->get('allow_frontend_photo_window', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('target_blank'); ?></td>
				<td><?php echo $this->form->getInput('target_blank'); ?></td>
				</tr>
			<?php endif; ?>
			
			<?php if($this->params->get('allow_frontend_photo_access', 0) == 1): ?>
            <tr>
            <td class="ig_left_col"><?php echo $this->form->getLabel('access'); ?></td>
			<td><?php echo $this->form->getInput('access'); ?></td>
			</tr>
			<?php endif; ?>

            <tr>
			<td class="ig_left_col"><?php echo $this->form->getLabel('hits'); ?></td>
			<td><?php echo $this->form->getInput('hits'); ?></td>
			</tr>

            <tr>
            <td class="ig_left_col"><?php echo $this->form->getLabel('filename'); ?></td>
            <td><?php echo $this->form->getInput('filename'); ?></td>
            </tr>

            <tr>
			<td class="ig_left_col"><?php echo $this->form->getLabel('published'); ?></td>
			<td><?php echo $this->form->getInput('published'); ?></td>
			</tr>

			<?php echo $this->form->getInput('id'); ?>
		</table>

	<input type="hidden" name="task" value="" id="ig_task"/>
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0); ?>" />
	<input type="hidden" name="catid" value="<?php echo $this->category->id; ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>