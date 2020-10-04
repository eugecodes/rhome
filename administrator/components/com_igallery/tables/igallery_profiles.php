<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

if(IG_J30)
{
	require_once(JPATH_ADMINISTRATOR.'/components/com_igallery/tables/igallery_profiles_j3.php');
}
else
{
	require_once(JPATH_ADMINISTRATOR.'/components/com_igallery/tables/igallery_profiles_j25.php');
}

?>
