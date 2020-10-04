<?php
/**
 * @version     plgUserWatchfulSso/install.php 2015-06-05 10:37:00 UTC ch
 * @package     Watchful Plugin
 * @author      Watchful
 * @authorUrl   https://watchful.li
 * @copyright   Copyright (c) 2015, Watchful
 */
// No direct access
defined('JPATH_PLATFORM') or die;
/**
 * Installer of Watchful SSO User plugin
 */
class plgUserWatchfulSsoInstallerScript
{

    /**
     * Install plugin
     */
    public function install()
    {
        //Publish plugin
        $this->publish();
    }
    
    /**
     * Auto publish the plugin
     */
    private function publish()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->update('#__extensions')
                ->set($db->quoteName('enabled') . ' = ' . $db->quote(1))
                ->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
                ->where($db->quoteName('folder') . ' = ' . $db->quote('user'))
                ->where($db->quoteName('element') . ' = ' . $db->quote('watchfulSso'));
        $db->setQuery($query);
        $db->execute();
    }

}