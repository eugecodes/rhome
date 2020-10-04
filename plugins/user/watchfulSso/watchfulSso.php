<?php
/**
 * @version     plgUser/watchfulSso.php 2015-06-04 14:13:00 UTC ch
 * @package     Watchful Plugin
 * @author      Watchful
 * @authorUrl   https://watchful.li
 * @copyright   Copyright (c) 2015, Watchful
 */
// No direct access
defined('_JEXEC') or die;
/**
 * Watchful SSO User
 *
 */
class plgUserWatchfulSso extends JPlugin
{

    /**
     * Remove user from Watchful SSO mapping table
     *
     * @param	array		$user	Holds the user data
     * @param	boolean		$succes	True if user was succesfully stored in the database
     * @param	string		$msg	Message
     *
     * @return	boolean
     */
    public function onUserAfterDelete($user, $succes, $msg)
    {
        if (!$succes)
        {
            return false;
        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->delete('#__watchful_sso')
                ->where('joomla_id = ' . (int) $user['id']);
        $db->setQuery($query);
        $db->execute();

        return true;
    }

}