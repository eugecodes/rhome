<?php
/**
* @package		Ignite Gallery
* @copyright	Copyright (C) 2014 Matthew Thomson. All rights reserved.
* @license		GNU/GPLv2
*/

defined('_JEXEC') or die('Restricted access');

$lang = JFactory::getLanguage();
$lang->load('com_igallery', JPATH_ADMINISTRATOR);

jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT_ADMINISTRATOR.'/defines.php');

jimport('joomla.application.component.model');
JModelLegacy::addIncludePath(IG_ADMINISTRATOR_COMPONENT.'/models');

$task = JRequest::getCmd('task', 'display');
$view = JRequest::getCmd('view', 'category');

if( strpos($task,'.') )
{
	$task = substr($task, strpos($task,'.') + 1);
}

$frontendTasks = array('display','reportImage','addHit','download','addRating');
$taskMatch = false;
$frontend = false;

foreach($frontendTasks as $key => $value)
{
	if($value == $task)
	{
		$taskMatch = true;
		break;
	}
}

if($taskMatch == true)
{
	if($task == 'display')
	{
		if($view == 'category')
		{
			$frontend = true;
		}
	}
	else
	{
		$frontend = true;
	}
}

if($frontend == false)
{
	if( JFactory::getUser()->get('guest') )
	{
		return JError::raiseWarning(404, 'Please login to manage images from the frontend');
	}

	$params = JComponentHelper::getParams('com_igallery');

	if($params->get('allow_frontend_creation', 0) == 0)
	{
		return JError::raiseWarning(404, JText::_('PLEASE_ENABLE_FRONTEND'));
	}

	if(!igGeneralHelper::authorise('core.igalleryfront.access'))
	{
		return JError::raiseWarning(404, 'Please go to the ignite gallery component options -> permissions tab, and set the "Frontend Access" task to allowed for this users group');
	}
}

$controller	= JControllerLegacy::getInstance('Igallery', array('default_view'=>'category'));

$controller->execute($task);
$controller->redirect();
?>