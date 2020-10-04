<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

class igalleryControllerimages extends JControllerAdmin
{
	public function &getModel($name = 'Image', $prefix = 'IgalleryModel', $config=array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
	function browserUpload()
	{
		if(!igGeneralHelper::authorise('core.igalleryfront.upload', JRequest::getInt('catid', 0) ) )
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		
		for($i=0; $i<count($_FILES['uploads']['name']); $i++)
		{
			$fileName = $_FILES['uploads']['name'][$i];
			$tmpPath = $_FILES['uploads']['tmp_name'][$i];
			$uploadError = $_FILES['uploads']['error'][$i];
			
			if(! $fileData = igFileHelper::processUploadedImage($fileName, $tmpPath, $uploadError, 'igallery_img', true) )
			{
				$this->setRedirect('index.php?option=com_igallery&controller=igphoto&catid='.JRequest::getInt('catid'));
				return false;
			}
			
			$model = $this->getModel();

			$category = $model->getCategory(JRequest::getInt('catid',0));
			$profile = $model->getProfile($category->profile);

			if(!igFileHelper::makeResizedOnUpload($fileData, $profile, true))
			{
				return false;
			}
			
			if (!$model->store($fileData) ) 
			{
				return false;
			}
		}
		
		$this->setRedirect( JRoute::_('index.php?option=com_igallery&view=images&catid='.JRequest::getInt('catid'), false) );
	}
	
	function publish()
	{
		$cid = JRequest::getVar('cid', array(), '', 'array');
		JArrayHelper::toInteger($cid);
		JRequest::setVar('cid', $cid, 'post');
		JFactory::getApplication()->input->post->set('cid', $cid );

		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );
		
		for($i=0; $i<count($cid); $i++)
		{
			if(!igGeneralHelper::authorise('core.igalleryfront.editimage.state', null, $cid[$i]))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
		
		$this->view_list = 'images&catid='.JRequest::getInt('catid');
		parent::publish();
	}
	
	function reorder()
	{	
		$cid = JRequest::getVar('cid', null, 'get', 'array');
		JArrayHelper::toInteger($cid);
		JRequest::setVar('cid', $cid, 'post');
		JFactory::getApplication()->input->post->set('cid', $cid );

		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );
		
		if(!igGeneralHelper::authorise('core.igalleryfront.editimage.state', null, (int)$cid[0]))
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		
		$this->view_list = 'images&catid='.JRequest::getInt('catid');
		parent::reorder();
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
			if(!igGeneralHelper::authorise('core.igalleryfront.editimage.state', null, $cid[$i]))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
		
		$this->view_list = 'images&catid='.JRequest::getInt('catid');
		parent::saveorder();
	}
	
	function delete()
	{
		$cid = JRequest::getVar('cid', array(), '', 'array');
		JArrayHelper::toInteger($cid);
		JRequest::setVar('cid', $cid, 'post');
		JRequest::setVar(JRequest::getCmd('formtoken'), 1, 'post');
		JFactory::getApplication()->input->post->set(JRequest::getCmd('formtoken'), 1 );

		for($i=0; $i<count($cid); $i++)
		{
			if(!igGeneralHelper::authorise('core.igalleryfront.deleteimage', null, $cid[$i]))
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}
		
		$this->view_list = 'images&catid='.JRequest::getInt('catid');
		parent::delete();
	}
	
	function rotate()
	{
		if(!igGeneralHelper::authorise('core.igalleryfront.editimage.state', null, JRequest::getInt('id', 0) ) )
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		
		$model = $this->getModel();
	
		if( !$model->rotate() ) 
		{
			$msg = '';
			JError::raise(2, 500, $model->getError() );
		}
		
		$this->setRedirect(JRoute::_('index.php?option=com_igallery&view=images&catid='.JRequest::getInt('catid'), false) );
	}
	
	function assignMenuImage()
	{
		if(!igGeneralHelper::authorise('core.igalleryfront.editimage.state', null, JRequest::getInt('id', 0) ) )
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		
		$model = $this->getModel();
	
		if( !$model->assignMenuImage() ) 
		{
			JError::raise(2, 500, $model->getError() );
		}
		
		$this->setRedirect( JRoute::_('index.php?option=com_igallery&view=images&catid='.JRequest::getInt('catid'), false) );
	}
	
	public function setRedirect($url, $msg = null, $type = null)
	{

		if(!strpos($url,'Itemid'))
		{
			$url = $url.'&Itemid='.JRequest::getInt('Itemid', '');
		}
		
		parent::setRedirect($url, $msg, $type);
	}

}	