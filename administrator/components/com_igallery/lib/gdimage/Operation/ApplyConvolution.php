<?php

	class GDImage_Operation_ApplyConvolution
	{
		function execute($image, $matrix, $div, $offset)
		{
			$new = $image->asTrueColor();
			if (!imageconvolution($new->getHandle(), $matrix, $div, $offset))
                JError::raiseError(500, "imageconvolution() returned false");
			return $new;
		}
	}
