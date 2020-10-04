<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php if(IG_J30): ?>
    <style type="text/css">
        #jform_menu_description_ifr{
            height: 200px !important;
        }

        #jform_gallery_description_ifr{
            height: 200px !important;
        }

        .CodeMirror {
            height: 300px !important;
        }
    </style>
<?php endif; ?>

<?php $itemId = '&Itemid='.JRequest::getInt('Itemid', 0); ?>
<div class="ig_toolbar">
	<?php if(!empty($this->item->id)): ?>
		<div class="ig_button button_apply"><a id="ig_toolbar_cat_apply" href="#" id=""><?php echo JText::_('APPLY'); ?></a></div>
	<?php endif; ?>
	<div class="ig_button button_save"><a id="ig_toolbar_cat_save" href="#"><?php echo JText::_('JSAVE'); ?></a></div>
	<div class="ig_button button_cancel"><a id="ig_toolbar_cat_cancel" href="<?php echo JRoute::_('index.php?option=com_igallery&view=categories'.$itemId); ?>"><?php echo JText::_('JCANCEL'); ?></a></div>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_igallery'); ?>" method="post" name="adminForm" id="ig_new_cat_form" enctype="multipart/form-data">

		<table class="ig_form_table">

            <tr>
			<td class="ig_left_col"><?php echo $this->form->getLabel('name'); ?></td>
            <td><?php echo $this->form->getInput('name'); ?></td>
            </tr>

			<?php if($this->params->get('allow_frontend_cat_alias', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('alias'); ?></td>
                <td><?php echo $this->form->getInput('alias'); ?></td>
                </tr>
			<?php endif; ?>

			<?php if($this->params->get('allow_frontend_cat_profile', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('profile'); ?></td>
                <td><?php echo $this->form->getInput('profile'); ?></td>
                </tr>
			<?php endif; ?>

			<?php if($this->params->get('allow_frontend_cat_parent', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('parent'); ?></td>
                <td><?php echo $this->form->getInput('parent'); ?></td>
                </tr>
			<?php endif; ?>

			<?php if($this->params->get('allow_frontend_cat_image', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('upload_image'); ?></td>

                <td>
				<?php if(!empty($this->item->menu_image_filename)): ?>
					    <img src="<?php echo IG_IMAGE_HTML_RESIZE; ?><?php echo $this->fileArray['folderName']; ?>/<?php echo $this->fileArray['fullFileName']; ?>" alt=""/>
				<?php endif; ?>
				
				<?php echo $this->form->getInput('upload_image'); ?>
				</td>
                </tr>
			<?php endif; ?>
				
			
			<?php if($this->params->get('allow_frontend_cat_remove', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('remove_menu_image'); ?></td>
                <td><?php echo $this->form->getInput('remove_menu_image'); ?></td>
                </tr>
			<?php endif; ?>

            <tr>
				<td class="ig_left_col"><?php echo $this->form->getLabel('published'); ?></td>
				<td><?php echo $this->form->getInput('published'); ?></td>
            </tr>
				
			<?php if($this->params->get('allow_frontend_cat_menu_des', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('menu_description'); ?></td>
				<div class="clr"></div>
                <td><?php echo $this->form->getInput('menu_description'); ?></td>
                </tr>
			<?php endif; ?>
			
			<?php if($this->params->get('allow_frontend_cat_gallery_des', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('gallery_description'); ?></td>
				<div class="clr"></div>
                <td><?php echo $this->form->getInput('gallery_description'); ?></td>
                </tr>
			<?php endif; ?>

			<?php if($this->params->get('allow_frontend_cat_page_title', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('page_title'); ?></td>
				<div class="clr"></div>
                <td><?php echo $this->form->getInput('page_title'); ?></td>
                </tr>
			<?php endif; ?>

			<?php if($this->params->get('allow_frontend_cat_metadesc', 0) == 1): ?>
                <tr>
                <td class="ig_left_col"><?php echo $this->form->getLabel('metadesc'); ?></td>
				<div class="clr"></div>
                <td><?php echo $this->form->getInput('metadesc'); ?></td>
                </tr>
			<?php endif; ?>

            <tr>
            <td class="ig_left_col"> </td>
            <td><?php echo $this->form->getInput('id'); ?></td>
            </tr>

		</table>
	<div style="clear: both"></div>

	<input type="hidden" name="task" value="" id="ig_task" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0); ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>