<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class IgalleryController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false)
	{
		$this->checkConfig();

        $view = JRequest::getCmd('view','categories');
		$id = JRequest::getInt('id', 0);
		
		if($view == 'icategory')
		{
			if( empty($id) )
			{
				if(!igGeneralHelper::authorise('core.create'))
				{
					return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
				}
			}
			else
			{
				if(!igGeneralHelper::authorise('core.edit', $id))
				{
					return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
				}
			}
			
			$model = $this->getModel('icategory');
		
			if( !$model->checkProfileExists() )
			{
				JFactory::getApplication()->enqueueMessage( JText::_( 'PLEASE_CREATE_PROFILE_FIRST' ) );
				$this->setRedirect('index.php?option=com_igallery&view=profiles');
				return;
			}
		}
		
		if($view == 'image')
		{
			if(!igGeneralHelper::authorise('core.edit', null, JRequest::getInt('id', 0) ))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
		
		
		if($view == 'profiles')
		{
			if(!igGeneralHelper::authorise('core.admin'))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
		
		if($view == 'profile')
		{
			if(!igGeneralHelper::authorise('core.admin'))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
			
			if( empty($id) )
			{
				if(!igGeneralHelper::authorise('core.create'))
				{
					return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
				}
			}
			else
			{
				if(!igGeneralHelper::authorise('core.edit'))
				{
					return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
				}
			}
		}
		
		if($view == 'serverimport')
		{
			if(!igGeneralHelper::authorise('core.admin'))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
	
		parent::display($cachable, $urlparams);
	}

    protected function checkConfig()
    {
        $params = JComponentHelper::getParams('com_igallery');
        $fbAppid = trim($params->get('fb_comments_appid'));

        if( !empty($fbAppid) )
        {
            if( !is_numeric($fbAppid) )
            {
                JFactory::getApplication()->enqueueMessage('Warning, the facebook app id entered into the component options ('.$fbAppid.') should be numbers only with no letters, please check you have not entered the app secret.');
            }
        }
    }
}
