<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

class igalleryControllerImage extends JControllerAdmin
{
	public function &getModel($name = 'Image', $prefix = 'IgalleryModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
	function plUpload()
	{
		if(!igGeneralHelper::authorise('core.igalleryfront.upload', JRequest::getInt('catid', 0) ) )
		{
			echo JText::_('JERROR_ALERTNOAUTHOR');
			return false;
		}
		
		$fileName = $_FILES['file']['name'];
		$tmpPath = $_FILES['file']['tmp_name'];
		$uploadError = $_FILES['file']['error'];
		
		if(! $fileData = igFileHelper::processUploadedImage($fileName, $tmpPath, $uploadError, 'igallery_img', false) )
		{
			return false;
		}
		
		$model = $this->getModel();

		$category = $model->getCategory(JRequest::getInt('catid',0));
		$profile = $model->getProfile($category->profile);

		if(!igFileHelper::makeResizedOnUpload($fileData, $profile, false))
		{
			return false;
		}
		
		if (!$model->store($fileData) ) 
		{
			return false;
		}

        JFactory::getSession()->set( 'ig_uploaded', 1);
		
		echo 1;
	}
}