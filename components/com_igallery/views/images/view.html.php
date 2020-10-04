<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class igalleryViewImages extends JViewLegacy
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
		
		$model              = $this->getModel();
		$this->category		= $model->getCategory( JRequest::getInt('catid', 0) );


		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		if( empty($this->category->id) )
		{
			JError::raiseError(500, 'Error: No Category id in the page url');
			return false;
		}

		$this->params = JComponentHelper::getParams('com_igallery');
		$this->moderate = $this->params->get('moderate_img', 0);
	    
	    $this->thumbFiles = array();
	    $this->mainFiles = array();
		
	    for ($i=0; $i<count($this->items); $i++)
		{
		    $row = $this->items[$i];
		    
		    if(! $this->thumbFiles[$i] = igFileHelper::originalToResized($row->filename, $row->thumb_width,
		    $row->thumb_height, $row->img_quality, $row->crop_thumbs, $row->rotation,
		    $row->round_thumb, $row->round_fill) )
		    {
		        return false;
		    }
		    
		    if(! $this->mainFiles[$i] = igFileHelper::originalToResized($row->filename, $row->max_width,
		    $row->max_height, $row->img_quality, $row->crop_main, $row->rotation, $row->round_large, $row->round_fill, 
		    $row->watermark, $row->watermark_text, $row->watermark_text_color, $row->watermark_text_size, 
		    $row->watermark_filename, $row->watermark_position, $row->watermark_transparency, 1) )
		    {
		        return false;
		    }

		    $imgStateUsed = false;
			$imgDeleteUsed = false;


			$deleteImageOk = igGeneralHelper::authorise('core.igalleryfront.deleteimage', null, $row->id, $row->id_of_profile, $row->user);
			$editImageStateOk = igGeneralHelper::authorise('core.igalleryfront.editimage.state', null, $row->id, $row->id_of_profile, $row->user);

			if($editImageStateOk && $imgStateUsed == false)
			{
				JRequest::setVar('igImgStateUsed', 1);
				$imgStateUsed = true;
			}

			if($deleteImageOk && $imgDeleteUsed == false)
			{
				JRequest::setVar('igImgDeleteUsed', 1);
				$imgDeleteUsed = true;
			}
		}
		
        if(igGeneralHelper::authorise('core.igalleryfront.upload', $this->category->id))
        {
			$uploader = $this->params->get('file_uploader', 'plupload');
			$uploaderFileName = IG_UPLOAD_PATH.'/'.$uploader.'/'.$uploader.'.php';
			$uploaderClassName = 'igUpload'.ucfirst($uploader);
			$headJsFunctionName = $uploader.'HeadJs';
			$htmlFunctionName = $uploader.'HTML';

			require_once($uploaderFileName);
			call_user_func( array($uploaderClassName, $headJsFunctionName) );
			call_user_func( array($uploaderClassName, $htmlFunctionName) );
		}


        if(JFactory::getSession()->get('ig_uploaded', 0) == 1)
        {
            JFactory::getApplication()->enqueueMessage(JText::_('NEW_IMAGES_ADDED'));
            JFactory::getSession()->set( 'ig_uploaded', 0);
        }

        JHTML::_('behavior.framework');
		$document = JFactory::getDocument();
		$document->addScript(JURI::root(true).'/media/com_igallery/js/admin.js');
		$document->addStyleSheet(JURI::root(true).'/media/com_igallery/css/admin.css');

		parent::display($tpl);
		
	}
}