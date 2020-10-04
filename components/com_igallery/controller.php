<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class IgalleryController extends JControllerLegacy
{
	function __construct($config = array())
	{	
		$config['base_path'] = JPATH_SITE.'/components/com_igallery';
		parent::__construct($config);
	}
	
	function display($cachable = false, $urlparams = false)
	{
		$view = JRequest::getCmd('view','categories');
		$id = JRequest::getInt('id', 0);

		if($view == 'icategory')
		{
			if( empty($id) )
			{
				if(!igGeneralHelper::authorise('core.igalleryfront.create'))
				{
					return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
				}
			}
			else
			{
				if(!igGeneralHelper::authorise('core.igalleryfront.edit', $id))
				{
					return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
				}
			}
		}

		if($view == 'image')
		{
			if(!igGeneralHelper::authorise('core.igalleryfront.editimage', null, JRequest::getInt('id', 0) ))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}

		parent::display($cachable, $urlparams);
	}
}

//old content plugins call IgController
class IgController extends IgalleryController{}
