<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

class igalleryControllerCategories extends JControllerAdmin
{
    public function &getModel($name = 'Icategory', $prefix = 'IgalleryModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
	function delete()
	{
		$cid = JRequest::getVar('cid', array(), '', 'array');
		JArrayHelper::toInteger($cid);
		JRequest::setVar('cid', $cid, 'post');
		JFactory::getApplication()->input->post->set('cid', $cid );

		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );
		
		if(!igGeneralHelper::authorise('core.igalleryfront.delete', (int)$cid[0]))
		{
			return JError::raiseWarning(404, JText::_('JERROR_CORE_DELETE_NOT_PERMITTED'));
		}
		
		parent::delete();
	}
	
	function publish()
	{
		$cid = JRequest::getVar('cid', array(), '', 'array');
		JArrayHelper::toInteger($cid);
		JFactory::getApplication()->input->post->set('cid', $cid );

		JRequest::setVar('cid', $cid, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );
		
		for($i=0; $i<count($cid); $i++)
		{
			if(!igGeneralHelper::authorise('core.igalleryfront.edit.state', $cid[$i]))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}

		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		parent::publish();
		
	}
	
	function saveorder()
	{
		$cid = JRequest::getVar('cid', array(), '', 'array');
		JArrayHelper::toInteger($cid);
		JRequest::setVar('cid', $cid, 'post');
		JFactory::getApplication()->input->post->set('cid', $cid );

		$order = JRequest::getVar('order', null, 'get', 'array');
		JArrayHelper::toInteger($order);
		JRequest::setVar('order', $order, 'post');
		JFactory::getApplication()->input->post->set('order', $order );

		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );
		
		for($i=0; $i<count($cid); $i++)
		{
			if(!igGeneralHelper::authorise('core.igalleryfront.edit.state', $cid[$i]))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
		
		parent::saveorder();
		
	}

	public function reorder()
	{
		$cid = JRequest::getVar('cid', null, 'get', 'array');
		JArrayHelper::toInteger($cid);
		JRequest::setVar('cid', $cid, 'post');
		JFactory::getApplication()->input->post->set('cid', $cid );

		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );

		if(!igGeneralHelper::authorise('core.igalleryfront.edit.state', (int)$cid[0]))
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}

		parent::reorder();
	}
	
	
}