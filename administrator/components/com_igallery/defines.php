<?php
defined('_JEXEC') or die('Restricted access');

//define the paths used in php
define('IG_ADMINISTRATOR_COMPONENT', JPATH_ADMINISTRATOR.'/components/com_igallery');
define( 'IG_IMAGE_PATH', JPATH_SITE.'/images/igallery');
define( 'IG_TEMP_PATH', JPATH_SITE.'/images/igallery/temp');
define( 'IG_ORIG_PATH', JPATH_SITE.'/images/igallery/original');
define( 'IG_RESIZE_PATH', JPATH_SITE.'/images/igallery/resized');
define( 'IG_WATERMARK_PATH', JPATH_SITE.'/images/igallery/watermark');
define( 'IG_UPLOAD_PATH', IG_ADMINISTRATOR_COMPONENT.'/lib/uploaders');
define( 'IG_COMPONENT', JPATH_SITE.'/components/com_igallery');

//define the paths that will be outputted to the brower
define( 'IG_HOST', JURI::root() );
define( 'IG_IMAGE_HTML_RESIZE', JURI::root(true).'/images/igallery/resized/');
define( 'IG_IMAGE_HTML_RESIZE_ABSOLUTE', JURI::root().'images/igallery/resized/');
define( 'IG_IMAGE_HTML_ORIG', JURI::root(true).'/images/igallery/original/');
define( 'IG_IMAGE_HTML_WATERMARK', JURI::root(true).'/images/igallery/watermark/');
define( 'IG_IMAGE_ASSET_PATH', JURI::root(true).'/media/com_igallery/images/');

$igJVersion = new JVersion();
if( $igJVersion->isCompatible('3.0') )
{
    define( 'IG_J30', true);
}
else
{
    define( 'IG_J30', false);
}

define('IG_VERSION', '3.6.8');

//import some classes
jimport('joomla.environment.uri' );
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

require_once(IG_ADMINISTRATOR_COMPONENT.'/helpers/html.php');
require_once(IG_ADMINISTRATOR_COMPONENT.'/helpers/file.php');
require_once(IG_ADMINISTRATOR_COMPONENT.'/helpers/upload.php');
require_once(IG_ADMINISTRATOR_COMPONENT.'/helpers/general.php');
require_once(IG_ADMINISTRATOR_COMPONENT.'/helpers/tree.php');
require_once(IG_ADMINISTRATOR_COMPONENT.'/helpers/static.php');
require_once(IG_COMPONENT.'/helpers/utility.php');
require_once(IG_ADMINISTRATOR_COMPONENT.'/models/base.php');

if(!IG_J30)
{
	require_once(JPATH_LIBRARIES.'/joomla/application/web/webclient.php');
}

//make the base folders if needed
igFileHelper::makeFolder(IG_IMAGE_PATH);
igFileHelper::makeFolder(IG_TEMP_PATH);
igFileHelper::makeFolder(IG_ORIG_PATH);
igFileHelper::makeFolder(IG_RESIZE_PATH);
igFileHelper::makeFolder(IG_WATERMARK_PATH);
?>