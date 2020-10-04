<?php
/**
 * @version     plgAuthentication/class/watchfulLimiter.php 2015-09-16 11:50:00 UTC pav
 * @package     Watchful Plugin
 * @author      Watchful
 * @authorUrl   https://watchful.li
 * @copyright   Copyright (c) 2015, Watchful
 */
class watchfulLimiter
{
    private $db;
    private $type;
    private $interval_time; // interval in min
    private $max_event; // nb max durint the interval
    private $pause_duration; // nb of second to stop the user
    private $identifier; // key to link to a user

    public function __construct($type, $identifier, $interval_time, $max_event, $pause_duration)
    {

        $this->type = $type;
        $this->interval_time = $interval_time; // interval in min
        $this->max_event = $max_event; // nb max durint the interval
        $this->pause_duration = $pause_duration;
        $this->db = JFactory::getDbo();
        $this->identifier = $identifier;
    }

    /*
     * Is the current identifier banned
     */
    public function isLimited()
    {
    
        if ($this->isLimitedDB())
        {
            return true;
        }

        if ($this->haveTooManyEvent())
        {
            return true;
        }

        return false;
    }

    /*
     * is the current identifier in the banned identifier table
     * 
     * return boolean
     */
    private function isLimitedDB()
    {
        $sql = "SELECT count(*) from #__watchful_sso_bannedip"
                . " WHERE identifier =" . $this->db->quote($this->identifier)
                . " AND type=" . $this->db->quote($this->type)
                . " AND created > DATE_SUB(NOW()"
                . ", INTERVAL " . $this->pause_duration . " SECOND)";

        $this->db->setQuery($sql);
        if ($this->db->loadResult() > 0)
        {
            return true;
        }
        
        return false;
    }

    /*
     * Calculate if the current have to many failed events
     * return boolean
     */
    private function haveTooManyEvent()
    {
        // check if in the last $interval hours, $number incidents have occured already:
        $sql = "SELECT COUNT(*) FROM #__watchful_sso_failedlogin"
                . " WHERE identifier ='" . $this->identifier . "'"
                . " AND type=" . $this->db->quote($this->type)
                . " AND created > DATE_SUB(NOW()"
                . ", INTERVAL " . $this->interval_time . " SECOND)";

        $this->db->setQuery($sql);
        $numberOfFailedEvent = $this->db->loadResult();

        if ($this->max_event < $numberOfFailedEvent)
        {
            $this->recordIp();
            return true;
        }

        return false;
    }

    /*
     * Add an identifier to the banned event table 
     */
    public function recordEvent()
    {
        $eventRecord = new stdClass();
        $eventRecord->identifier = $this->identifier;
        $eventRecord->type = $this->type;
        $this->db->insertObject('#__watchful_sso_failedlogin', $eventRecord, 'id');
    }

    /*
     * Add an event to the banned event table 
     */
    private function recordIp()
    {
        $eventRecord = new stdClass();
        $eventRecord->identifier = $this->identifier;
        $eventRecord->type = $this->type;
        $this->db->insertObject('#__watchful_sso_bannedip', $eventRecord, 'id');

        $this->cleanUpDB();
    }

    /*
     * Clean the banned event table and banned identifier table
     * 
     */
    private function cleanUpDB()
    {
        //remove IP from __watchful_sso_bannedip
        $sql = "DELETE FROM #__watchful_sso_bannedip"
                . " WHERE type=" . $this->db->quote($this->type)
                . " AND created < DATE_SUB(NOW()"
                . ", INTERVAL " . $this->pause_duration . " SECOND)";
        $this->db->setQuery($sql);
        $this->db->query();

        $sql = "DELETE FROM #__watchful_sso_failedlogin"
                . " WHERE type=" . $this->db->quote($this->type)
                . " AND created < DATE_SUB(NOW()"
                . ", INTERVAL " . $this->interval_time . " SECOND)";
        $this->db->setQuery($sql);
        $this->db->query();
    }
}