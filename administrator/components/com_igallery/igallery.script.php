<?php
defined('_JEXEC') or die('Restricted access');

class com_igalleryInstallerScript
{
    function update($parent)
    {
        define('IG_ADMIN_ROOT', JPATH_ADMINISTRATOR.'/components/com_igallery');
        define('IG_FRONTEND_ROOT', JPATH_SITE.'/components/com_igallery');

        //DELETE OLD FILES PART
        $filesToDelete = array();
        $filesToDelete[] = IG_FRONTEND_ROOT.'/views/category/tmpl/default.php';
        $filesToDelete[] = IG_FRONTEND_ROOT.'/models/image.php';
        $filesToDelete[] = IG_ADMIN_ROOT.'/lib/uploaders/plupload/js/jquery-1.3.2.js';
        $filesToDelete[] = IG_ADMIN_ROOT.'/install.igallery.php';
        $filesToDelete[] = IG_ADMIN_ROOT.'/uninstall.igallery.php';
        $filesToDelete[] = JPATH_SITE.'/media/com_igallery/css/grey-border-shadow.css';
        $filesToDelete[] = JPATH_SITE.'/media/com_igallery/css/plain.css';

        for($i=0; $i<count($filesToDelete); $i++)
        {
            if(JFile::exists($filesToDelete[$i]))
            {
                if( !JFile::delete($filesToDelete[$i]) )
                {
                    echo 'The Unused File: '.$filesToDelete[$i]. ' could not be removed,
                    please remove it manually <br />';
                }
            }
        }

        //DELETE OLD FOLDERS PART
        $foldersToDelete = array();
        $foldersToDelete[] = IG_ADMIN_ROOT.'/lib/uploaders/plupload/css';
        $foldersToDelete[] = IG_ADMIN_ROOT.'/lib/uploaders/plupload/img';
        $foldersToDelete[] = IG_ADMIN_ROOT.'/lib/uploaders/plupload/js';

        for($i=0; $i<count($foldersToDelete); $i++)
        {
            if(JFolder::exists($foldersToDelete[$i]))
            {
                if( !JFolder::delete($foldersToDelete[$i]) )
                {
                    echo 'The Unused Folder: '.$foldersToDelete[$i]. ' could not be removed,
                    please remove it manually <br />';
                }
            }
        }

        //UPDATE DATABASE
        $db = JFactory::getDBO();
        $queries = array();

        //ADD NEW CATEGORY COLUMNS
        $catColumns = array(
            "moderate" => "INT(1) NOT NULL DEFAULT '1'",
            "publish_up" => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'",
            "publish_down" => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'",
            "page_title" => "VARCHAR(255) NOT NULL",
            "metadesc" => "TEXT NOT NULL",
            "second_user" => "INT(9) NOT NULL",
            "third_user" => "INT(9) NOT NULL",
            "fourth_user" => "INT(9) NOT NULL"
        );

        foreach($catColumns as $column => $structure)
        {
            $query = "SHOW COLUMNS FROM `#__igallery` LIKE '".$column."'";
            $db->setQuery($query);
            $db->query();
            if($db->getNumRows() == 0)
            {
                $queries[] = "ALTER TABLE `#__igallery` ADD `".$column."` ".$structure;
            }
        }

        //ADD NEW IMAGE COLUMNS
        $imgColumns = array(
            "moderate" => "INT(1) NOT NULL DEFAULT '1'",
            "publish_up" => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'",
            "publish_down" => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'"
        );

        foreach($imgColumns as $column => $structure)
        {
            $query = "SHOW COLUMNS FROM `#__igallery_img` LIKE '".$column."'";
            $db->setQuery($query);
            $db->query();
            if($db->getNumRows() == 0)
            {
                $queries[] = "ALTER TABLE `#__igallery_img` ADD `".$column."` ".$structure;
            }
        }

        //ADD NEW PROFILE COLUMNS
        $profileColumns = array(
            "asset_id" => "int(10) NOT NULL",
            "slideshow_position" => "VARCHAR(24) NOT NULL DEFAULT 'below'",
            "lbox_slideshow_position" => "VARCHAR(24) NOT NULL DEFAULT 'below'",
            "show_filename" => "VARCHAR(24) NOT NULL DEFAULT 'none'",
            "lbox_show_filename" => "VARCHAR(24) NOT NULL DEFAULT 'none'",
            "show_numbering" => "INT(1) NOT NULL DEFAULT '0'",
            "lbox_show_numbering" => "INT(1) NOT NULL DEFAULT '0'",
            "show_thumb_info" => "VARCHAR(24) NOT NULL DEFAULT 'none'",
            "lbox_show_thumb_info" => "VARCHAR(24) NOT NULL DEFAULT 'none'",
            "plus_one" => "INT(1) NOT NULL DEFAULT '0'",
            "lbox_plus_one" => "INT(1) NOT NULL DEFAULT '0'",
            "main_image_align_horiz" => "VARCHAR(24) NOT NULL DEFAULT 'center'",
            "main_image_align_vert" => "VARCHAR(24) NOT NULL DEFAULT 'center'",
            "lbox_image_align_horiz" => "VARCHAR(24) NOT NULL DEFAULT 'center'",
            "lbox_image_align_vert" => "VARCHAR(24) NOT NULL DEFAULT 'center'",
            "show_image_count" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "image_ordering" => "VARCHAR( 24 ) NOT NULL DEFAULT 'ordering'",
            "twitter_button" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "lbox_twitter_button" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "access" => "int(2) NOT NULL DEFAULT '1'",
            "menu_access" => "int(2) NOT NULL DEFAULT '1'",
            "show_category_hits" => "int(1) NOT NULL DEFAULT '0'",
            "search_results" => "varchar(24) NOT NULL DEFAULT 'joomla'",
            "show_thumb_arrows" => "INT( 1 ) NOT NULL DEFAULT '1'",
            "lbox_show_thumb_arrows" => "INT( 1 ) NOT NULL DEFAULT '1'",
            "pinterest_button" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "lbox_pinterest_button" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "comments_position" => "VARCHAR( 32 ) NOT NULL DEFAULT 'below'",
            "lbox_comments_position" => "VARCHAR( 32 ) NOT NULL DEFAULT 'below'",
            "show_cat_author" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "show_image_author" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "lbox_show_image_author" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "show_image_hits" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "lbox_show_image_hits" => "INT( 1 ) NOT NULL DEFAULT '0'",
            "lbox_back_color" => "VARCHAR( 32 ) NOT NULL DEFAULT 'black'",
            "lbox_back_custom" => "VARCHAR( 32 ) NOT NULL",
            "lbox_back_opacity" => "INT( 4 ) NOT NULL DEFAULT '70'",
            "lbox_front_color" => "VARCHAR( 32 ) NOT NULL DEFAULT 'white'",
            "lbox_front_custom" => "VARCHAR( 32 ) NOT NULL",
            "mobile_hide_thumbs" => "INT NOT NULL DEFAULT '1'",
            "mobile_lbox_hide_thumbs" => "INT( 1 ) NOT NULL DEFAULT '1'"
        );

        foreach($profileColumns as $column => $structure)
        {
            $query = "SHOW COLUMNS FROM `#__igallery_profiles` LIKE '".$column."'";
            $db->setQuery($query);
            $db->query();
            if($db->getNumRows() == 0)
            {
                $queries[] = "ALTER TABLE `#__igallery_profiles` ADD `".$column."` ".$structure;
            }
        }

		//ADD RATINGS TABLE IF NOT PRESENT
        $queries[] = 'CREATE TABLE IF NOT EXISTS `#__igallery_ratings`(
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `image_id` int(11) NOT NULL,
		  `rating` int(1) NOT NULL,
		  `ip` varchar(24) NOT NULL,
		  `user` int(11) NOT NULL,
		  `published` int(1) NOT NULL DEFAULT "1",
		  `date` int(20) NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `image_id` (`image_id`),
		  KEY `published` (`published`)
		)  DEFAULT CHARSET=utf8;';

        for($i=0;$i<count($queries); $i++)
        {
            $db->setQuery($queries[$i]);
            $db->query();
        }

        //SOCIAL BUTTON LEGACY OPTION:
        $query = 'SELECT * FROM #__igallery_profiles LIMIT 1';
        $db->setQuery($query);
        $profile = $db->loadAssoc();
        if( is_array($profile) )
        {
            if( !array_key_exists('twitter_button', $profile) )
            {
                $socialUsed = false;

                $query = 'SELECT * FROM #__igallery_profiles';
                $db->setQuery($query);
                $profiles = $db->loadObjectList();

                for($i=0; $i<count($profiles); $i++)
                {
                    if($profiles[$i]->share_facebook == 1 || $profiles[$i]->lbox_share_facebook == 1 || $profiles[$i]->allow_comments == 4 || $profiles[$i]->lbox_allow_comments == 4)
                    {
                        $socialUsed = true;
                    }
                }

                if($socialUsed == true)
                {
                    $db->setQuery('SELECT params FROM #__extensions WHERE name = '.$db->quote('com_igallery'));
                    $params = json_decode( $db->loadResult(), true );
                    $params['fb_legacy_urls'] = '1';
                    $paramsString = json_encode($params);
                    $db->setQuery('UPDATE #__extensions SET params = '.$db->quote($paramsString).' WHERE name = '.$db->quote('com_igallery'));
                    $db->query();
                }
            }
        }

        //MIGRATE AL RATINGS
        if(JFile::exists(JPATH_ADMINISTRATOR.'/components/com_alratings/alratings.php') )
		{
			$db = JFactory::getDBO();
			$query = 'SELECT id FROM #__igallery_ratings';
			$db->setQuery($query);
			$rows = $db->loadObjectList();

			if(empty($rows))
			{
				$db = JFactory::getDBO();
				$query = "SELECT * FROM #__alratings WHERE object_group = 'com_igallery'";
				$db->setQuery($query);
				$rows = $db->loadObjectList();

				if(count($rows) > 0)
				{
					JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_igallery/tables/');

					foreach($rows as $oldRating)
					{
						for( $i=0; $i<(int)$oldRating->rating_count;$i++)
						{
							$row = JTable::getInstance('igallery_ratings', 'Table');
							$row->image_id = (int)$oldRating->object_id;
							$row->rating = (int)$oldRating->rating_sum/$oldRating->rating_count;
							$row->ip = 0;
							$row->user = 0;
							$row->published = 1;
							$row->store();
						}
					}
				}

			}
    	}

        //NOTIFY IF UPGRADED TO NEW ACL TASKS
		$lastVersion = JRequest::getVar('ig_last_version', 0);
		if($lastVersion != 0)
		{
			if(version_compare($lastVersion, '3.6', '<'))
			{
				echo '<h2>Important Ignite Gallery Version 3.6.x Infomation:</h2>'.
				'<p style="font-size: 20px;">Version 3.6 has new access control tasks for frontend gallery creation/management. '.
				'If you have frontend users that do gallery creation/management, please go to the Ignite Gallery component options, then access tab, and set the permissions '.
				'for any user groups that need to do frontend gallery creation/management. If your users do not do '.
				'frontend gallery creation/management, you do not need to do anything.';
			}
		}
	}

    function uninstall($parent)
    {
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');
        require_once(JPATH_ADMINISTRATOR.'/components/com_igallery/defines.php');

        if ( JFolder::exists(IG_IMAGE_PATH) )
        {
            JFolder::delete(IG_IMAGE_PATH);
        }
    }

    function preflight($type, $parent)
    {
        $jversion = new JVersion();
        if(! $jversion->isCompatible('2.5.5') )
        {
            JError::raiseWarning(404, 'Ignite Gallery requires Joomla 2.5.5 or greater to function, you current Joomla version is '.$jversion->getShortVersion().', Please upgrade Joomla, and then install the gallery.');
            return false;
        }

        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('manifest_cache');
		$query->from('#__extensions');
		$query->where('element = "com_igallery"');
		$db->setQuery($query);
		$row = $db->loadObject();

		if(isset($row->manifest_cache))
		{
			if(strrpos($row->manifest_cache, '{') !== false && strrpos($row->manifest_cache, '}') !== false)
			{
				$manifestParams = new JRegistry;
				$manifestParams->loadString($row->manifest_cache);
				$lastVersion = $manifestParams->get('version');
				JRequest::setVar('ig_last_version', $lastVersion);
			}
		}

        return true;
    }
}