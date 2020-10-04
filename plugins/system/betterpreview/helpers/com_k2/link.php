<?php
/**
 * @package         Better Preview
 * @version         5.1.0PRO
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2016 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

class HelperBetterPreviewLinkK2 extends HelperBetterPreviewLink
{
	function getLinks()
	{
		// don't show any extra links by default
		return array();
	}
}
