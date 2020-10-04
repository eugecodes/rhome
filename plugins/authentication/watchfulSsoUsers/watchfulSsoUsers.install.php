<?php
/**
 * @version     plgAuthentication/watchfulSsoUsers.install.php 2015-05-20 07:37:00 UTC ch
 * @package     Watchful Plugin
 * @author      Watchful
 * @authorUrl   https://watchful.li
 * @copyright   Copyright (c) 2015, Watchful
 */
// No direct access
defined('JPATH_PLATFORM') or die;
/**
 * Installer of Watchful SSO Authentification Plugin
 */
class plgAuthenticationWatchfulSsoUsersInstallerScript
{

    /**
     * Install plugin
     */
    public function install()
    {
        //Add column usertype
        $this->createTableSSO();

        //Publish plugin
        $this->publish();

        //Check if component watchful is installed
        if (!file_exists(JPATH_ROOT . '/administrator/components/com_watchfulli/watchfulli.xml'))
        {
            echo 'Watchful component is required for watchfulSsoUsers plugin';
        }
    }

    /**
     * method to update the plugin
     *
     * @return void
     */
    function update($parent)
    {
        $this->createTableSSO();
    }

    /**
     * Uninstall plugin
     */
    public function uninstall()
    {
        $db = JFactory::getDbo();

        $sqls = array(
            'DELETE users FROM `#__users` as users INNER JOIN `#__watchful_sso` AS sso ON users.id = sso.joomla_id',
            'DROP TABLE IF EXISTS `#__watchful_sso`',
            'DROP TABLE IF EXISTS `#__watchful_sso_failedlogin`',
            'DROP TABLE IF EXISTS `#__watchful_sso_bannedip`'
        );

        foreach ($sqls as $sql)
        {
            $db->setQuery($sql);
            $db->execute();
        }
    }

    /**
     * Create table watchful_sso
     */
    private function createTableSSO()
    {
        $db = JFactory::getDbo();

        $sqls = array();
        //Create table
        $sqls[] = 'CREATE TABLE IF NOT EXISTS `#__watchful_sso` ('
                . '`joomla_id` int(11) NOT NULL, '
                . '`sso_id` int(11) NOT NULL, '
                . 'PRIMARY KEY (`joomla_id`,`sso_id`))';

        $sqls[] = 'CREATE TABLE IF NOT EXISTS #__watchful_sso_failedlogin ('
	. 'identifier  varchar(45) NOT NULL, '
        . 'type varchar(45) NOT NULL, '
	. 'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP '
        . ') DEFAULT CHARSET=utf8';

        $sqls[] = 'CREATE TABLE IF NOT EXISTS #__watchful_sso_bannedip ('
	. 'identifier  varchar(45) NOT NULL, '
        . 'type varchar(45) NOT NULL, '
	. 'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP '
        . ') DEFAULT CHARSET=utf8';

        foreach ($sqls as $sql)
        {
            $db->setQuery($sql);
            $db->execute();
        }
    }

    /**
     * Publish and set plugin in the last position (for can display login error message)
     */
    private function publish()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->update('#__extensions')
                ->set($db->quoteName('enabled') . ' = ' . $db->quote(1))
                ->set($db->quoteName('ordering') . ' = ' . $db->quote(99))
                ->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
                ->where($db->quoteName('folder') . ' = ' . $db->quote('authentication'))
                ->where($db->quoteName('element') . ' = ' . $db->quote('watchfulSsoUsers'));
        $db->setQuery($query);
        $db->execute();
    }

}