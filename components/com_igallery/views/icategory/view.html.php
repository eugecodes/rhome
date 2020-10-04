<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class igalleryViewicategory extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;
	
	function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		$this->params = JComponentHelper::getParams('com_igallery');
		
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$model = $this->getModel();
		
		if($this->item->parent != 0)
		{
			$parentCat = $model->getCategory($this->item->parent);
			$profile = $model->getProfile($parentCat->profile);
		}
		else
		{
			$profile = $model->getProfile($this->item->profile);
		}
		
		if( !empty($this->item->menu_image_filename) )
		{
		    if(! $this->fileArray = igFileHelper::originalToResized($this->item->menu_image_filename, $profile->menu_max_width,
		    $profile->menu_max_height, $profile->img_quality, $profile->crop_menu, 0, $profile->round_menu, $profile->round_fill) )
		    {
		        return false;
		    }
		    
		}

		JHTML::_('behavior.framework');
		$document = JFactory::getDocument();
		$document->addScript(JURI::root(true).'/media/com_igallery/js/admin.js');
		$document->addStyleSheet(JURI::root(true).'/media/com_igallery/css/admin.css');

		parent::display($tpl);
			
	}
}