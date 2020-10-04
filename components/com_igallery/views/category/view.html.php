<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class igalleryViewcategory extends JViewLegacy
{
	function display($tpl = null)
	{
        if( !$this->checkUrl() )
        {
            return;
        }

        $this->removeCanonical();

		$app = JFactory::getApplication();
        JHTML::_('behavior.framework', false);
	    $this->user = JFactory::getUser();
	    $this->guest = $this->user->get('guest') ? true : false;
	    $document = JFactory::getDocument();
	    $this->params = JComponentHelper::getParams('com_igallery');
	    $model = $this->getModel();
        $this->languageTag = JFactory::getLanguage()->getTag();
        $this->currentUrl = JFactory::getURI()->toString();
        $this->activeImage = 0;
		
		$this->source = JRequest::getCmd('igsource', 'component');
		$this->catid = JRequest::getInt('igid', 0);
    	$searchChildren = JRequest::getInt('igchild', 0);
    	$tags = JRequest::getVar('igtags', '');
    	$this->type = JRequest::getCmd('igtype', 'category');
    	$profileId = JRequest::getInt('igpid', 0);
    	$this->Itemid = JRequest::getInt('Itemid', '');
    	$this->ajaxUrlImageName = JRequest::getCmd('_escaped_fragment_', '');
        $this->urlImageName = JRequest::getCmd('image', '');
        $limit = JRequest::getInt('iglimit', 0);
        $limit = $limit == 0 ? 1000 : $limit;
        $uniqueid = JRequest::getCmd('iguniqueid', 0);
        $this->uniqueid = !empty($uniqueid) ? $uniqueid : $this->catid;
        
        if($this->source != 'component')
		{
			$overridePath = JPATH_BASE.'/templates/'.$app->getTemplate().'/html/com_igallery/'.$this->getName();
			$this->_addPath('template', $overridePath);
		}

        $this->category = $model->getCategory($this->catid);
		if($this->category == null)
	    {
	    	JError::raise(2, 404, 'Error the gallery with an id of: '.$this->catid.' is not published' );
	        return;
	    }
	    
        $profileId = $profileId == 0 ? $this->category->profile : $profileId;
		$this->profile = $model->getProfile($profileId);
		
		if($this->profile == null)
		{
			JError::raise(2, 404, JText::_('Profile Unpublished') );
			return;
		}
		
		if($this->profile->show_large_image == 0 && $this->profile->show_thumbs == 0)
		{
			JError::raise(2, 500, JText::_('Thumbs or main image display must be enabled in profile settings') );
			return;
		}

        $this->profile->refresh_mode = $this->source == 'module' ? 'javascript' : $this->profile->refresh_mode;
        $this->profile->refresh_mode = JRequest::getInt('igplugincalled', 0) == 1 ? 'javascript' : $this->profile->refresh_mode;

        if($this->source == 'plugin')
		{
			JRequest::setVar('igplugincalled', 1);
		}
		
		$this->registerLink = $this->params->get('register_link', 'index.php?option=com_user&amp;task=register');

        if($this->profile->access == 999)
        {
            $owners = array();
            $owners[] = $this->category->user;
            if(!empty($this->category->second_user)){$owners[] = $this->category->second_user;}
            if(!empty($this->category->third_user)){$owners[] = $this->category->third_user;}
            if(!empty($this->category->fourth_user)){$owners[] = $this->category->fourth_user;}

            if(!in_array($this->user->id, $owners))
            {
                return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
            }
        }
        else if( !in_array($this->profile->access, $this->user->getAuthorisedViewLevels() ) )
		{
			if($this->profile->access == 2)
			{
                JFactory::getApplication()->redirect(JRoute::_($this->registerLink), JText::_( 'PLEASE_LOGIN_TO_VIEW' ));
                return;
			}
			else
			{
				return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			}
		}

        if($this->source == 'component' || $this->type == 'child_menu_images' || $this->type == 'latest_menu_images' || $this->type == 'hits_menu_images' || $this->type == 'random_menu_images')
        {
            $this->categoryChildren = $model->getCategoryChildren($this->catid, $this->profile, $this->type, $this->source, $limit);
        }
        else
        {
            $this->categoryChildren = null;
        }

        if($this->source == 'component' || $this->type == 'category' || $this->type == 'latest' || $this->type == 'hits' || $this->type == 'rated' || $this->type == 'random')
        {
            switch($this->type)
            {
                case 'random' : $this->photoList = $model->getRandomList($this->profile, $this->catid, $tags, $searchChildren, $limit);break;
                case 'latest' : $this->photoList = $model->getLatestList($this->profile, $this->catid, $tags, $searchChildren, $limit);break;
                case 'hits'   : $this->photoList = $model->getHitsList($this->profile, $this->catid, $tags, $searchChildren, $limit);break;
                case 'rated'  : $this->photoList = $model->getRatedList($this->profile, $this->catid, $tags, $searchChildren, $limit);break;
                default       : $this->photoList = $model->getCategoryImagesList($this->profile, $this->catid, $tags, $searchChildren, $limit);
            }
        }
        else
        {
            $this->photoList = null;
        }
		
    	if($this->profile->menu_pagination == 1 && count($this->categoryChildren) )
    	{
	        $this->menuPagination = $model->getPagination($model->menuTotal, $this->profile->menu_pagination_amount, 'menu_');
    	}
    	if($this->profile->thumb_pagination == 1 && $this->photoList != null )
    	{
	        $this->thumbPagination = $model->getPagination($model->thumbTotal,$this->profile->thumb_pagination_amount, 'thumb_');
    	}

		$this->thumbFiles = array();
		$this->mainFiles = array();
		$this->lboxFiles = array();
		$this->lboxThumbFiles = array();

		$this->desVars = new stdClass();

		if( !empty($this->photoList) )
		{

    	    $this->desVars->mainHasDescriptions = $this->profile->show_filename == 'none' ? false : true;
    	    $this->desVars->lboxHasDescriptions = $this->profile->lbox_show_filename == 'none' ? false : true;

            $this->desVars->mainHasDescriptions = ($this->profile->allow_comments == 4 && $this->profile->comments_position == 'match_descriptions') ? true : $this->desVars->mainHasDescriptions;
            $this->desVars->lboxHasDescriptions = ($this->profile->lbox_allow_comments == 4 && $this->profile->lbox_comments_position == 'match_descriptions') ? true : $this->desVars->lboxHasDescriptions;

    		for($i=0; $i<count($this->photoList); $i++)
    		{
    		    $row = $this->photoList[$i];

    			if(! $this->thumbFiles[$i] = igFileHelper::originalToResized($row->filename, $this->profile->thumb_width,
    		    $this->profile->thumb_height, $this->profile->img_quality, $this->profile->crop_thumbs, $row->rotation, $this->profile->round_thumb, $this->profile->round_fill) )
    		    {
    		        return false;
    		    }

    		    if(! $this->mainFiles[$i] = igFileHelper::originalToResized($row->filename, $this->profile->max_width,
    		    $this->profile->max_height, $this->profile->img_quality, $this->profile->crop_main, $row->rotation, $this->profile->round_large, $this->profile->round_fill,
    		    $this->profile->watermark, $this->profile->watermark_text, $this->profile->watermark_text_color, $this->profile->watermark_text_size, $this->profile->watermark_filename,
    		    $this->profile->watermark_position, $this->profile->watermark_transparency, 0) )
    		    {
    		        return false;
    		    }

    		    if(! $this->lboxThumbFiles[$i] = igFileHelper::originalToResized($row->filename, $this->profile->lbox_thumb_width,
    		    $this->profile->lbox_thumb_height, $this->profile->img_quality, $this->profile->lbox_crop_thumbs, $row->rotation, $this->profile->round_thumb, $this->profile->round_fill) )
    		    {
    		        return false;
    		    }

    		    if(! $this->lboxFiles[$i] = igFileHelper::originalToResized($row->filename, $this->profile->lbox_max_width,
    		    $this->profile->lbox_max_height, $this->profile->img_quality, $this->profile->crop_lbox, $row->rotation, $this->profile->round_large, $this->profile->round_fill,
    		    $this->profile->watermark, $this->profile->watermark_text, $this->profile->watermark_text_color, $this->profile->watermark_text_size,  $this->profile->watermark_filename,
    		    $this->profile->watermark_position, $this->profile->watermark_transparency, 0) )
    		    {
    		        return false;
    		    }
    		    
    		    if( strlen($row->description) > 0 )
    		    {
    		    	$this->desVars->mainHasDescriptions = true;
    		    	$this->desVars->lboxHasDescriptions = true;
    		    }
    		}

    		$this->dimensions = igUtilityHelper::getGalleryDimensions($this->mainFiles, $this->lboxFiles, $this->thumbFiles, $this->lboxThumbFiles, $this->categoryChildren, $this->profile);
			
		}

        if( empty($this->photoList) && !empty($this->categoryChildren) )
        {
            $this->dimensions = igUtilityHelper::getGalleryDimensions(array(), array(), array(), array(), $this->categoryChildren, $this->profile);
        }

        $this->setMetaData();

		if($this->source == 'component')
	    {
    		igUtilityHelper::writeBreadcrumbs($this->category);
    	}

        if($this->profile->report_image == 1 || $this->profile->lbox_report_image == 1)
        {
            $session = JFactory::getSession();
            $session->set( 'ig_report_url', JFactory::getURI()->toString() );
        }
	    
	    parent::display('main');
	}

	function setMetaData()
	{
		$document = JFactory::getDocument();
		$app = JFactory::getApplication();
		$metaData = $this->getMetaData();

		$document->addStyleSheet(JURI::root(true).'/media/com_igallery/css/category.css');
        $document->addScript(JURI::root(true).'/media/com_igallery/js/category_mt13.js');

		if( !empty($this->photoList) )
		{
			$headJs = igUtilityHelper::makeHeadJs($this->category, $this->profile, $this->photoList, $this->dimensions['galleryWidth'],
			$this->dimensions['galleryLboxWidth'], $this->mainFiles, $this->lboxFiles, $this->thumbFiles, $this->lboxThumbFiles,
			$this->source, $this->catid, $this->uniqueid, $this->activeImage, $this->dimensions, $this->params);

			$document->addScriptDeclaration($headJs);

			if($this->profile->lightbox == 1)
			{
				$document->addStyleSheet(JURI::root(true).'/media/com_igallery/css/lightbox.css');
			}
		}

		if(isset($metaData['title']))
		{
			if( $app->getCfg('sitename_pagetitles', 0) == 1 )
			{
				$pageTitle = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $metaData['title']);
			}
			elseif($app->getCfg('sitename_pagetitles', 0) == 2)
			{
				$pageTitle = JText::sprintf('JPAGETITLE', $metaData['title'], $app->getCfg('sitename'));
			}
			else
			{
				$pageTitle = $metaData['title'];
			}

			$document->addCustomTag('<meta property="og:title" content="'.$pageTitle.'" />');
			$document->setTitle($pageTitle);


		}

		if(isset($metaData['description']))
		{
			$description = substr( JFilterOutput::cleanText($metaData['description']), 0, 200 );
			$document->setDescription($description);

			$ogDescription = substr( strip_tags( str_replace('"','\'',html_entity_decode($metaData['description'], ENT_QUOTES, 'UTF-8') ) ), 0, 200 );
			$document->addCustomTag('<meta property="og:description" content="'.$ogDescription.'" />');
		}

		if(isset($metaData['image']))
		{
			$metaTag = '<meta property="og:image" content="'.$metaData['image'].'" />';
			$document->addCustomTag($metaTag);
		}
		
		if( !empty($this->photoList) )
		{
			if($this->profile->share_facebook == 1 || $this->profile->lbox_share_facebook == 1 || $this->profile->allow_comments == 4 || $this->profile->lbox_allow_comments == 4)
			{
				$fb_comments_userid = $this->params->get('fb_comments_userid', '');
				if( !empty($fb_comments_userid) )
				{
					$document->addCustomTag('<meta property="fb:admins" content="'.$fb_comments_userid.'" />');
				}

				$fb_comments_appid = $this->params->get('fb_comments_appid', '');
				if( !empty($fb_comments_appid) )
				{
					$document->addCustomTag('<meta property="fb:app_id" content="'.$fb_comments_appid.'" />');
				}

				if( (empty($fb_comments_userid) || empty($fb_comments_appid) ) && ($this->profile->allow_comments == 4 || $this->profile->lbox_allow_comments == 4) )
				{
					JError::raise(2, 500, JText::_('Facebook comments are On, Please enter a facebook user id and app into the gallery component options, See support common questions') );
				}
			}
		}
	}

	function getMetaData()
	{
		$metaData = array();

        if( empty($this->ajaxUrlImageName) )
        {
            if(!empty($this->urlImageName))
            {
                $this->ajaxUrlImageName = $this->urlImageName;
            }
        }

		if(!empty($this->ajaxUrlImageName) && !empty($this->photoList))
		{
			for($i=0; $i<count($this->photoList); $i++)
			{
				$fileNameNoExt = JFile::stripExt($this->photoList[$i]->filename);
				$fileNameNoRef = substr($fileNameNoExt, 0, strpos($fileNameNoExt, '-') );

				if( $fileNameNoRef == $this->ajaxUrlImageName)
				{
					$this->activeImage = $i;
					$metaData['image'] = IG_IMAGE_HTML_RESIZE_ABSOLUTE.$this->mainFiles[$i]['folderName'].'/'.$this->mainFiles[$i]['fullFileName'];

					if(!empty($this->photoList[$i]->alt_text))
					{
						$metaData['title'] = $this->photoList[$i]->alt_text;
					}

					if(!empty($this->photoList[$i]->description))
					{
						$metaData['description'] = $this->photoList[$i]->description;
					}

					break;
				}
			}
		}

		if($this->source == 'component')
	    {
			if(!isset($metaData['title']) && strlen($this->category->page_title) > 1)
			{
				$metaData['title'] = $this->category->page_title;
			}

			if(!isset($metaData['title']) && strlen($this->category->name) > 1)
			{
				$metaData['title'] = $this->category->name;
			}


			if(!isset($metaData['description']) && strlen($this->category->metadesc) > 1)
			{
				$metaData['description'] = 	$this->category->metadesc;
			}

			if(!isset($metaData['description']) && strlen($this->category->gallery_description) > 1)
			{
				$metaData['description'] = 	$this->category->gallery_description;
			}

            if( !isset($metaData['image']) && !empty($this->category->menu_image_filename))
            {
                $menuImageFileArray = igFileHelper::originalToResized($this->category->menu_image_filename, $this->profile->menu_max_width,
                $this->profile->menu_max_height, $this->profile->img_quality, $this->profile->crop_menu, 0, $this->profile->round_menu, $this->profile->round_fill);

                $metaData['image'] = IG_IMAGE_HTML_RESIZE_ABSOLUTE.$menuImageFileArray['folderName'].'/'.$menuImageFileArray['fullFileName'];
            }
		}

		return $metaData;
	}

    function checkUrl()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if( stripos($userAgent, 'Trident') === false && stripos($userAgent, 'MSIE') === false && stripos($userAgent, 'Opera') === false && stripos($userAgent, 'Firefox') === false && stripos($userAgent, 'Chrome') === false && stripos($userAgent, 'Safari') === false)
        {
            return true;
        }

        $escapedFragment = JRequest::getVar('_escaped_fragment_', '');
        $fbActionIds = JRequest::getVar('fb_action_ids', '');
        $fbActionTypes = JRequest::getVar('fb_action_types', '');
        $fbSource = JRequest::getVar('fb_source', '');
        $fbAggregationId = JRequest::getVar('fb_aggregation_id', '');

        $actionObjectMap = JRequest::getVar('action_object_map', '');
        $actionTypeMap = JRequest::getVar('action_type_map', '');
        $actionRefMap = JRequest::getVar('action_ref_map', '');

        $urlImageName = JRequest::getCmd('image', '');

        if( strlen($escapedFragment) == 0 && strlen($fbActionIds) == 0 && strlen($actionObjectMap) == 0 && strlen($urlImageName) == 0)
        {
            return true;
        }

        $hashToAdd = '';
        $currentUrl = JFactory::getURI()->toString();
        $queryString = substr($currentUrl, (strrpos($currentUrl, '?') + 1) );
        $queryString = urldecode($queryString);
        $beforeQueryString = substr($currentUrl, 0, strrpos($currentUrl, '?') );
        $queryParams = explode('&', $queryString);

        if( strlen($escapedFragment) > 1)
        {
            $hashToAdd = $escapedFragment;
            $key = array_search('_escaped_fragment_='.$escapedFragment, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($urlImageName) > 1)
        {
            $hashToAdd = $urlImageName;
            $key = array_search('image='.$urlImageName, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($fbActionIds) > 1)
        {
            $key = array_search('fb_action_ids='.$fbActionIds, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($fbActionTypes) > 1)
        {
            $key = array_search('fb_action_types='.$fbActionTypes, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($fbSource) > 1)
        {
            $key = array_search('fb_source='.$fbSource, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($fbAggregationId) > 1)
        {
            $key = array_search('fb_aggregation_id='.$fbAggregationId, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($actionObjectMap) > 1)
        {
            $key = array_search('action_object_map='.$actionObjectMap, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($actionTypeMap) > 1)
        {
            $key = array_search('action_type_map='.$actionTypeMap, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( strlen($actionRefMap) > 1)
        {
            $key = array_search('action_ref_map='.$actionRefMap, $queryParams);
            if( $key !== false)
            {
                unset($queryParams[$key]);
            }
        }

        if( count($queryParams) )
        {
            $newQueryString = implode('&',$queryParams);
            $newUrl = $beforeQueryString.'?'.$newQueryString;
            $newUrl = strlen($hashToAdd) > 0 ? $newUrl.'#!'.$hashToAdd : $newUrl;
        }
        else
        {
            $newUrl = strlen($hashToAdd) > 0 ? $beforeQueryString.'#!'.$hashToAdd : $beforeQueryString;
        }
        JFactory::getApplication()->redirect($newUrl);
        return false;
    }

    function removeCanonical()
	{
		$document = JFactory::getDocument();

		foreach($document->_links as $key => $value)
		{
			if($value['relation'] == 'canonical')
			{
				unset($document->_links[$key]);
			}
		}

	}



}

class igViewcategory extends igalleryViewcategory{}