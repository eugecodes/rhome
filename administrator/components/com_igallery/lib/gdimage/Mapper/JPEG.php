<?php
/**
* @version    $Id: JPEG.php 63 2010-09-29 23:06:01Z mthomsonnz $
* @package	  GDImage
* @copyright  2007-2010 Gasper Kozak, Matthew Thomson
* @license	  GNU Lesser General Public License version 2.1
*/

defined('JPATH_BASE') or die();

class GDImage_Mapper_JPEG
{
	function load($uri)
	{
		return imagecreatefromjpeg($uri);
	}
	
	/**
	 * Saves the image to a file
	 *
	 * @param GDImage_Image $img
	 * @param string $uri
	 * @param integer $quality
	 */
	function save($handle, $uri = null, $quality = 100)
	{
		if($uri)
		{
			ob_start();
		    imagejpeg($handle, null, $quality);
			$imageBuffer = ob_get_contents();
	        ob_end_clean();
	
	    	JFile::write($uri, $imageBuffer);
		}
		else
		{
			imagejpeg($handle, null, $quality);
		}
    }
}
