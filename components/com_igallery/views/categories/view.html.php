<?php
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view');

class igalleryViewcategories extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->user         = JFactory::getUser();
		$this->params = JComponentHelper::getParams('com_igallery');
		$this->moderate = $this->params->get('moderate_cat', 0);

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		JHTML::_('behavior.framework');
		$document = JFactory::getDocument();
		$document->addScript(JURI::root(true).'/media/com_igallery/js/admin.js');
		$document->addStyleSheet(JURI::root(true).'/media/com_igallery/css/admin.css');

		parent::display($tpl);
	}
}