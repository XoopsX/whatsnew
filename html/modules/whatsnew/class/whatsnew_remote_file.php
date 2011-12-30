<?php
// $Id: whatsnew_remote_file.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2005-09-28 K.OHWADA
// copy from weblinks

//=========================================================
// class remote file
// correspondence to allow_url_fopen = off
// use class snoopy
// 2005-01-20 K.OHWADA
//=========================================================

class Whatsnew_Remote_File
{
	var $fp;
	var $content;

// image
	var $dir_temp;

// class instance
	var $class_image;
	var $class_snoopy;


//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Remote_File()
{
// image
	$dir_temp = XOOPS_ROOT_PATH."/modules/whatsnew/cache";
	$this->set_dir_temp($dir_temp);

// class instance
	if ( class_exists('Whatsnew_Image_Size') )
	{
		$this->class_image  =& Whatsnew_Image_Size::getInstance();
	}

	if ( class_exists('Snoopy') )
	{
		$this->class_snoopy = new Snoopy();
	}

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Remote_File();
	}

	return $instance;
}


//---------------------------------------------------------
// check_url
//---------------------------------------------------------
function check_url($url)
{
// allow_url_fopen
	if ( get_cfg_var('allow_url_fopen') )
	{
		return $this->_check_url_local( $url );
	}
// not allow_url_fopen
	{
		return $this->_check_url_remote( $url );
	}
}

function _check_url_local($url)
{
	if ( $this->open($url, "r") )
	{
		$this->close();
		return true;
	}
	else
	{
		return false;
	}
}


//=========================================================
// read_file
//=========================================================
function read_file($url)
{

// allow_url_fopen
	if ( get_cfg_var('allow_url_fopen') )
	{
		return $this->_read_file_local( $url );
	}
// not allow_url_fopen
	else
	{
		return $this->_read_file_remote( $url );
	}

}


//=========================================================
// use class image_size
//=========================================================
//---------------------------------------------------------
//  get_image_size
//---------------------------------------------------------
function get_image_size($url)
{
	if ( !$url )  return array(0,0);

// allow_url_fopen
	if ( get_cfg_var('allow_url_fopen') )
	{
		return $this->class_image->get_size($url);
	}
// not allow_url_fopen
	{
		return $this->_get_image_size_local($url);
	}

}

function _get_image_size_local($url)
{
	if ( !$url )  return array(0,0);

	if ( !is_writable($this->dir_temp) )
	{
		return array(0,0);
	}

	$data = $this->_read_file_remote( $url );
	if ( !$data )
	{
		return array(0,0); 
	}

	$file = tempnam($this->dir_temp, "image");

	$ret1 = $this->write_file( $file, $data );
	if ( !$ret1 )
	{
		return array(0,0);
	}

	$ret2 = $this->class_image->get_size($file);

	unlink($file);

	return $ret2;

}

//---------------------------------------------------------
// set and get property
//---------------------------------------------------------
function set_dir_temp($value='')
{
	$this->dir_temp = $value;
}


//=========================================================
// private function
//=========================================================
//---------------------------------------------------------
// open & close file
//---------------------------------------------------------
function open( $filename, $mode )
{
	$this->fp = '';

	$fp = fopen($filename, $mode);

	if ($fp)
	{
		$this->fp = $fp;
	}

	return $fp;
}

function close()
{
	if ( $this->fp )
	{
		fclose($this->fp);
	}
}

//---------------------------------------------------------
// read file
//---------------------------------------------------------
function _read_file_local( $filename )
{
	$fp = $this->open( $filename, "r" );
	if ( !$fp )
	{
		return false;
	}

	$content = $this->read();
	$this->close();

	return $content;
}

function read()
{
	if ( !$this->fp )  return false;

	$content = '';

	do 
	{
		$data = fread($this->fp, 8192);
		if ( strlen($data) == 0 )  break;
		$content .= $data;
	} while(true);

	return $content;
}

//---------------------------------------------------------
// write file
//---------------------------------------------------------
function write_file( $filename, $data )
{
	$fp = $this->open( $filename, "w" );
	if ( !$fp )
	{
		return false;
	}

	$ret = $this->write($data);
	$this->close();

	return $ret;
}

function write($data)
{
	return fwrite($this->fp, $data);
}

//=========================================================
// use class spoopy
//=========================================================
function _check_url_remote( $url )
{
	return $this->class_snoopy->fetch( $url );
}

function _read_file_remote( $url )
{

	if ( $this->class_snoopy->fetch( $url ) )
	{
		return $this->class_snoopy->results;
	}
	else
	{
		return false;
	}
}


//---------------------------------------------------------
}

?>
