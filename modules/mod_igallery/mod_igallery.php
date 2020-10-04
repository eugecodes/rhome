<?php

defined('_JEXEC') or die('Restricted access');

JRequest::setVar('igsource', 'module');
JRequest::setVar('iguniqueid', 'M'.$module->id);
JRequest::setVar('igid', $params->get('category_id'));
JRequest::setVar('igtype', $params->get('type'));
JRequest::setVar('igchild', $params->get('children'));
JRequest::setVar('igpid', $params->get('profile_id'));
JRequest::setVar('igtags', $params->get('tag'));
JRequest::setVar('igaddlinks', $params->get('add_links'));

$photoLimit = $params->get('photo_limit') == 0 ? 150 : $params->get('photo_limit');
JRequest::setVar('iglimit', $photoLimit);

$view = JRequest::getCmd('view',null);
$layout= JRequest::getCmd('layout',null);

JRequest::setVar('view', 'category');
JRequest::setVar('layout', 'default');


$lang = JFactory::getLanguage();
$lang->load('com_igallery', JPATH_ADMINISTRATOR);

require_once(JPATH_ADMINISTRATOR.'/components/com_igallery/defines.php');
require_once(IG_COMPONENT.'/controller.php');

$controller = new IgalleryController();
$controller->execute('display');

if($view != null)
{
	JRequest::setVar('view', $view);
}

if($layout != null)
{
	JRequest::setVar('layout', $layout);
}
?>