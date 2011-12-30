<?php
// $Id: whatsnew_image_size.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2005-09-28 K.OHWADA
// copy from weblinks

//=========================================================
// class image size
// for PHP gennerally
// 2005-01-20 K.OHWADA
//=========================================================

class Whatsnew_Image_Size
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Image_Size()
{
// dummy
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Image_Size();
	}

	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_size($file)
{
	$size = GetImageSize( $file );	// PHP function
	if ( !$size ) 
	{
		return array(0,0);
	}

	$width  = intval( $size[0] );
	$height = intval( $size[1] );

	return array($width, $height);
}

function adjust_size($width, $height, $max_width, $max_height)
{
	if ($width > $max_width)
    {
    	$mag    = $max_width / $width;
    	$width  = $max_width;
    	$height = $height * $mag;
    }

	if ($height > $max_height)
    {
    	$mag    = $max_height / $height;
    	$height = $max_height;
    	$width  = $width * $mag;
    }

    $width  = intval($width);
    $height = intval($height);

	return array($width, $height);
}

function minimum_size($width, $height, $min_width=0, $min_height=0)
{
	if ( empty($width) ) 
	{
		$width = $min_width;
	}

	if ( empty($height) ) 
	{
		$height = $min_height;
	}

	return array($width, $height);
}

//---------------------------------------------------------
}

?>
