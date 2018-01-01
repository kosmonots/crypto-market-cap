<?php

namespace AppBundle\Twig;

use Twig_Extension;
use Gregwar\Image\Image;

class ImageExtension extends  Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getimagesize', array($this, 'getImagesize'), array('is_safe' => array('html'))),
        );
    }

    public function Image($url, $width, $height)
    {
        $background = #fff;
        $yPos = 5;
        $xPos = 0;
       return Image::open($url)
            ->zoomCrop($width, $height, $background, $xPos,$yPos)
            ->jpeg();
    }

    public function getImagesize($fileName)
    {

    	if(file_exists($fileName)) {
			$img = getimagesize($fileName);
			if($img[0] > 1){

				return true;
			}

			return false;

		}

		return false;
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'logo';
    }
}