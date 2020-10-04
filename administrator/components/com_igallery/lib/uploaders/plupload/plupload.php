<?php
defined('_JEXEC') or die('Restricted access');

class igUploadPlupload
{
	static function pluploadHeadJs()
	{
		$app = JFactory::getApplication();
        $catid = JRequest::getInt('catid',0);
		$Itemid = JRequest::getInt('Itemid', null);
		$ItemIdString = empty($Itemid) ? '' : '&Itemid='.$Itemid;
		
		$params = JComponentHelper::getParams('com_igallery');
		$resize = $params->get('client_resize', 1);
		$resizeWidth = $params->get('client_resize_width', 2000);
		$resizeHeight = $params->get('client_resize_height', 1500);
		$resizeQuality = $params->get('client_resize_quality', 90);

        if( $params->get('pl_runtime_first', 'html5') == 'flash')
        {
            $preferencesString = 'flash,html5';
        }
        else
        {
            $preferencesString = 'html5,flash';
        }
		
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root(true).'/media/com_igallery/plupload/css/plupload.queue.css');
		
		if(IG_J30)
        {
            if(JFactory::getApplication()->isSite() && $params->get('pl_include_jquery', 1) == 1)
            {
                $document->addScript(JURI::root(true).'/media/com_igallery/plupload/js/jquery.js');
            }
        }
        else
        {
            if(!JFactory::getApplication()->isSite() || $params->get('pl_include_jquery', 1) == 1)
            {
                $document->addScript(JURI::root(true).'/media/com_igallery/plupload/js/jquery.js');
            }
        }

        ?>
		<script type="text/javascript" src="<?php echo JURI::root(true).'/media/com_igallery/plupload/js/plupload.full.min.js';?>"></script>
		<script type="text/javascript" src="<?php echo JURI::root(true).'/media/com_igallery/plupload/js/jquery.plupload.queue.min.js';?>"></script>
		<?php

        $urlExtra = (JFactory::getApplication()->isSite() && $app->getCfg('sef', 0) == 1 && $app->getCfg('sef_suffix', 0) == 1) ? '&format=raw' : '';

		$headJs = '
		jQuery.noConflict();
		
		jQuery(function()
		{
			jQuery("#plupload_div").pluploadQueue(
			{
				runtimes : \''.$preferencesString.'\',
				url : \''.JRoute::_('index.php?option=com_igallery&task=image.plUpload&catid='.$catid.'&format=raw',false).$urlExtra.'\',
				filters:
				{
				    max_file_size : \'20mb\',
                    mime_types: [{title : "Image files", extensions : "jpg,jpeg,gif,png"}]
                },

				unique_names : false,
				preinit: attachCallbacks,
				multipart: true,

				flash_swf_url : \''.JURI::root(true).'/media/com_igallery/plupload/js/Moxie.swf\'';
				
				if($resize == 1)
				{
				$headJs .= ',
		 		resize:{width : '.$resizeWidth.', height : '.$resizeHeight.', quality : '.$resizeQuality.'}';
				}
				$headJs .= '
			});
		});
		
		function attachCallbacks(Uploader)
		{
			Uploader.bind(\'FileUploaded\', function(Up, File, Response)
			{
				if(Response.response.trim().length > 2)
				{
		        	alert(\'Upload Error, Adjusting the uploader settings in the component paramaters -> upload tab may help, response from server: \' + Response.response);
		        	Up.trigger("Error", {message : Response.response, code : 9999, details : Response.response, file: File});
		        	Uploader.stop();
		        	return false;
				}
					
				if( (Uploader.total.uploaded + 1) >= Uploader.files.length)
				{
					window.location = \''.JRoute::_('index.php?option=com_igallery&view=images&catid='.$catid.$ItemIdString ,false).'\';
				}
		
	    	});
		};
		';
		?><script type="text/javascript"><?php echo $headJs; ?></script>
		<?php		
	}
	
	static function pluploadHTML()
	{
		?>
        <style type="text/css">
        .plupload_header{
        display: none;
        }
        </style>
		<div id="plupload_div" style="width: 450px; height: 330px;">Plupload Initialising...</div>
		<?php
	}
}