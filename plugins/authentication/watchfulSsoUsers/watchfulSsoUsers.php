<?php
/**
 * @version     plgAuthentication/watchfulSsoUsers.php 2015-09-14 11:40:00 UTC ch
 * @package     Watchful Plugin
 * @author      Watchful
 * @authorUrl   https://watchful.li
 * @copyright   Copyright (c) 2015, Watchful
 */
// No direct access
defined('_JEXEC') or die;
define('WATCHFULLI_PATH', JPATH_ADMINISTRATOR . '/components/com_watchfulli');
include 'class/watchfulLimiter.php';

/**
 * Watchful SSO Users Authentification 
 * 
 */
class plgAuthenticationWatchfulSsoUsers extends JPlugin
{
    /*
     * URL API authentification route
     * @var string
     */
    private $apiAuthURL = 'https://watchful.li/api/v1/ssousers/authentification';

    /*
     * Log message category
     * @var string 
     */
    private $logCategory = 'plg_auth_watchful_sso';

    /*
     * Result of API call
     * @var object 
     */
    private $request;

    /*
     * Error message
     * @var string 
     */
    private $errorMessage = null;
    
    /*
     * Brute force protection object
     */
    private $limiter;
    
    const INTERVAL_TIME = 180; //in second
    const MAX_FAILED_LOGIN = 10;
    const BAN_DURATION = 1200; //in second

    /**
     * Constructor
     * 
     * @throws Exception If curl not installed
     */
    public function __construct()
    {
        jimport('joomla.log.log');

        //Load Watchful encrypt lib
        include_once WATCHFULLI_PATH . '/classes/encrypt.php';

        //Get plugin params
        $plugin = JPluginHelper::getPlugin('authentication', 'watchfulSsoUsers');
        $params = new JRegistry($plugin->params);

        //Get log level (by default warning)
        $logLevel = $params->get('log_level', 31);

        //Set custom logger
        JLog::addLogger(
                array('text_file' => $this->logCategory . '.log.php'), $logLevel, array($this->logCategory)
        );

        //Check curl
        if (!function_exists('curl_init'))
        {
            $errorMsg = 'Curl is required for auth plugin';
            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = JText::sprintf('JGLOBAL_AUTH_FAILED', $errorMsg);
            JLog::add($errorMsg, JLog::ERROR, $this->logCategory);

            return false;
        }
        

        $this->limiter = new watchfulLimiter('ssoApiLimiter', $_SERVER['REMOTE_ADDR'], self::INTERVAL_TIME, self::MAX_FAILED_LOGIN, self::BAN_DURATION);
    }

    /**
     * Authentification event
     * 
     * @param array                   $credentials  User credentials
     * @param array                   $options      Login options: remember, return url, entry_url, action
     * @param JAuthenticationResponse $response     Return status
     */
    public function onUserAuthenticate($credentials, $options, &$response)
    {
        $username = $credentials['username'];
        $password = $credentials['password'];
        $response->type = 'watchful';

        //Require username and password
        if (empty($username) || empty($password))
        {
            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = JText::_('JGLOBAL_AUTH_EMPTY_PASS_NOT_ALLOWED');

            return false;
        }

        //Protect agains Brute Force
        if ($this->limiter->isLimited())
        {
            $response->status = JAuthentication::STATUS_FAILURE;
           $response->error_message = isset($this->errorMessage) ? $this->errorMessage : JText::_('Brute force detected for this IP, retry in 20min');
            return false;
        }


        //Send auth informations to Watchful SSO User API
        $isValidUser = $this->isValidSsoUser($username, $password);

        //If Watchful return auth error
        if (!$isValidUser)
        {
            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = isset($this->errorMessage) ? $this->errorMessage : JText::_('JGLOBAL_AUTH_FAIL');

            return false;
        }

        //Convert json to object
        $requestBody = json_decode($this->request->body);
        $ssoUser = $requestBody->msg;

        //Local standard Joomla user exist with same username
        if ($this->isLocalJoomlaUser($ssoUser->username))
        {
            $errorMsg = 'A local user already exist with the same username';

            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = JText::sprintf('JGLOBAL_AUTH_FAILED', $errorMsg);

            JLog::add($errorMsg . ' (' . $ssoUser->username . ')', JLog::DEBUG, $this->logCategory);

            return false;
        }

        //Get the local sso User if already exist
        $localSsoUser = $this->getLocalSsoUser($ssoUser->id);

        //Create or update local Joomla user with SSO Users informations
        $localSsoUserUpdated = $this->saveLocalUser($ssoUser, $localSsoUser);

        //Error on save
        if (!$localSsoUserUpdated)
        {
            $errorMsg = 'SSO user can\'t be created localy (' . $this->errorMessage . ')';

            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = JText::sprintf('JGLOBAL_AUTH_FAILED', $errorMsg);

            JLog::add($errorMsg, JLog::DEBUG, $this->logCategory);
            return false;
        }

        //If SSO User not already exist
        if (empty($localSsoUser))
        {
            //Add user to Watchful SSO Map Table
            $this->addUserToSsoMapTable($localSsoUserUpdated->id, $ssoUser->id);
        }

        //Generate status
        $response->status = JAuthentication::STATUS_SUCCESS;
        $response->error_message = '';

        //Set user parameters
        $response->email = $ssoUser->email;
        $response->username = $ssoUser->username;
        $response->fullname = $ssoUser->name;

        //Clean access group cache (JAccess::getGroupsByUser)
        JAccess::clearStatics();
    }

    /**
     * Call Watchful API to check if user credentials are true
     * 
     * @param string $username
     * @param string $password
     * 
     * @return boolean True, if SSO User is valid
     */
    private function isValidSsoUser($username, $password)
    {
        //Check if component watchful is installed
        if (!file_exists(JPATH_ROOT . '/administrator/components/com_watchfulli/watchfulli.xml'))
        {
            JLog::add('Watchful component is required for watchfulSsoUsers plugin', JLog::ERROR, $this->logCategory);
            return false;
        }

        if (!class_exists('WatchfulliEncrypt'))
        {
            JLog::add('Watchful encrypt lib required', JLog::ERROR, $this->logCategory);
            return false;
        }

        //Get Watchful key
        $comWatchParam = JComponentHelper::getParams('com_watchfulli');
        $key = $comWatchParam->get('secret_key');

        //No Watchful API Key
        if (empty($key))
        {
            JLog::add('No Watchful API Key found', JLog::ERROR, $this->logCategory);
            return false;
        }

        $b64Pass = base64_encode($password);
        $aesPass = WatchfulliEncrypt::AESEncryptCtr($b64Pass, $key, 256);

        //Get current time for generate key
        $time = time();

        //Request params
        $params = array(
            'username' => $username,
            'aespass' => urlencode($aesPass),
            'url' => urlencode(JURI::root()),
            'hash' => $this->hashKey($key, $time),
            'time' => $time
        );

        //Call Watchful API and return data
        $this->request = $this->callApiAuthentification($params);

        //Log response if full log enabled
        JLog::add('API return: ' . $this->request->body, JLog::DEBUG, $this->logCategory);

        //If SSO user is disabled on API
        if ($this->request->status == 401)
        {
            $this->errorMessage = "This user is disabled";
            return false;
        }

        //Don't log wrong password errors
        if ($this->request->status == 400)
        {
            $this->limiter->recordEvent();
            return false;
        }

        //If API return error
        if ($this->request->status != 200)
        {
            JLog::add('API return status:' . $this->request->status . ' body: ' . $this->request->body, JLog::WARNING, $this->logCategory);
            return false;
        }

        return true;
    }

    /**
     * Send Watchful API Authentificate request
     * 
     * @param array $params
     */
    private function callApiAuthentification($params)
    {
        $curl = curl_init();
        $url = $this->apiAuthURL . $this->generateUrl($params);

        //Log API call URL
        JLog::add('API Call: ' . $url, JLog::DEBUG, $this->logCategory);

        //Create CURL request
        $options = array(
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        );

        //Set CURL params
        curl_setopt_array($curl, ($options));

        //Send request and get result
        $result = new stdClass();
        $result->raw = curl_exec($curl);
        $result->status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        //Split header and body
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $result->header = substr($result->raw, 0, $header_size);
        $result->body = substr($result->raw, $header_size);

        return $result;
    }

    /**
     * Generate URL parms with indexed array
     * 
     * @param array $params  Array of params
     * 
     * @return string Parameters formated for URL
     */
    private function generateUrl($params)
    {
        $url = '?';
        foreach ($params as $param => $value)
        {
            $url .= $param . '=' . $value . '&';
        }

        return substr($url, 0, -1);
    }

    /**
     * Check with if a specified username is already user by a Joomla local user (exclude SSO users)
     * 
     * @param  string    $username
     * @return booleans  True, if username already used
     */
    private function isLocalJoomlaUser($username)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('*')
                ->from('#__users as users')
                ->leftJoin('#__watchful_sso as sso ON users.id = sso.joomla_id')
                ->where('users.username = ' . $db->quote($username))
                ->where('sso.sso_id is NULL');
        $db->setQuery($query);
        $db->execute();

        return ($db->getNumRows() > 0);
    }

    /**
     * Return (if already exist) the local SSO User
     * 
     * @param int $id SSO User ID
     * 
     * @return JUser
     */
    public function getLocalSsoUser($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('*')
                ->from('#__users as users')
                ->innerJoin('#__watchful_sso as sso ON users.id = sso.joomla_id')
                ->where('sso.sso_id = ' . $db->quote($id));
        $db->setQuery($query);

        return $db->loadObject();
    }

    /**
     * Add user to Watchful SSO Map Table
     * 
     * This mapping is used for keep the link between local and distant SSO Users
     * 
     * @param  string    $username
     */
    private function addUserToSsoMapTable($joomlaUserId, $ssoUserId)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->insert('#__watchful_sso')
                ->set('joomla_id = ' . $db->quote($joomlaUserId))
                ->set('sso_id = ' . $db->quote($ssoUserId));
        $db->setQuery($query);

        return $db->execute();
    }

    /**
     * Create or Update the local SSO user and set permission group
     * 
     * @param ssoUser $ssoUser
     * @param JUser   $oldLocalUser
     * 
     * @return JTable
     */
    private function saveLocalUser($ssoUser, $oldLocalUser)
    {
        $user = new stdClass();

        //Set user propertis
        $user->id = 0;
        $user->name = $ssoUser->name;
        $user->username = $ssoUser->username;
        $user->email = $ssoUser->email;
        $user->usertype = 'watchful';
        $user->groups = array($ssoUser->groupid);

        //If user already exit reset her id and register date
        if (!empty($oldLocalUser))
        {
            $user->id = $oldLocalUser->id;
            $user->registerDate = $oldLocalUser->registerDate;
        }

        $table = JTable::getInstance('user');
        $table->bind($user);

        if (!$table->check())
        {
            $this->errorMessage = $table->getError();
            return false;
        }

        if (!$table->store())
        {
            $this->errorMessage = $table->getError();
            return false;
        }

        return $table;
    }

    /**
     * Hash private key with current time
     * 
     * @param string $key   Site key
     * @param int    $time  Timestamp
     * 
     * @return string Hashed key
     */
    private function hashKey($key, $time)
    {
        return hash_hmac('sha256', $time, $key);
    }
}