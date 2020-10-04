<?php
/* * ***********************************************************************
 * SSO Users
 * Copyright (c) 2015 Watchful.li
 * ************************************************************************
 * Watchful.li is a web site monitoring and security service.
 * 
 * Although Watchful.li is a paid service, this program is free software;
 * you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; 
 * either version 2 of the License, or (at your option) any later version.
 *
 * This header must not be removed. Additional contributions/changes
 * may be added to this header as long as no information is deleted.
 * ************************************************************************
 * Get the latest version of this program at: https://watchful.li
 * *********************************************************************** */

// no direct access
defined('_JEXEC') or die();

//Require the watchfulliApps class from Watchful.li component
require_once(JPATH_ADMINISTRATOR . '/components/com_watchfulli/classes/apps.php');
// We extend a base class to pass additional parameters in the language strings
// It will probably be included in the client but we also put it here so the app will work
// even for older version of the Watchful client.
class SsoAppAlert extends AppAlert
{
    public $parameter1;
    public $parameter2;
    public $parameter3;

    public function SsoAppAlert($level, $message, $parameter1 = null, $parameter2 = null, $parameter3 = null)
    {
        if ($level != null && $message != null)
        {
            $this->level = $level;
            $this->message = $message;
            $this->parameter1 = $parameter1;
            $this->parameter2 = $parameter2;
            $this->parameter3 = $parameter3;
        }
    }

}
class plgWatchfulliAppsSsoApp extends watchfulliApps
{

    /**
     * Create alert message
     * 
     * @param int    $level   Select level (1 for info, 2 for Error)
     * @param string $message
     */
    public function createAppAlert($level, $message, $parameter1 = null, $parameter2 = null, $parameter3 = null)
    {
        $alert = new SsoAppAlert($level, $message, $parameter1, $parameter2, $parameter3);
        $this->addAlert($alert);
    }

    /**
     * Main program
     * 
     * @param string @oldValuesSerialized old values for the plugins
     */
    public function appMainProgram($oldValuesSerialized = null)
    {
        //Config App
        $this->setName("SsoApp");
        $this->setDescription("Remove local SSO User deleted from the API");
        $debug = $this->params->get('debug', 0);

        //Get sended user array
        $jinput = JFactory::getApplication()->input;
        $ssoUsers = $jinput->get('sso', false, 'raw');

        //Fields SSO not sended, no remove users
        if ($ssoUsers === false)
        {
            if ($debug)
            {
                $this->createAppAlert(1, '[DEBUG] POST SSO field no sended, no users has been removed');
            }
            return $this;
        }

        $ssoUsersArray = json_decode($ssoUsers);

        //Remove SSO Users not listed in array
        $this->deleteAllSsoUsersExcept($ssoUsersArray);

        if ($debug)
        {
            $this->createAppAlert(1, '[DEBUG] SSO Users array: ' . json_encode($ssoUsersArray));
        }

        return $this;
    }

    /**
     * Delete all local SSO users excepted these in array
     * 
     * @param array $ssoUsers Preserved Users
     */
    private function deleteAllSsoUsersExcept($ssoUsers = null)
    {
        //Remove SSO users
        $db = JFactory::getDbo();
        $delQuery = 'DELETE users,sso '
                . 'FROM `#__users` as users '
                . 'INNER JOIN `#__watchful_sso` AS sso '
                . 'ON users.id = sso.joomla_id ';

        if (is_array($ssoUsers) && !empty($ssoUsers))
        {
            $delQuery .= 'WHERE sso.sso_id NOT IN (' . implode($ssoUsers, ', ') . ') ';
        }

        $db->setQuery($delQuery);

        return $db->execute();
    }

}