<?php
// $Id: whatsnew_lang_base.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2005-09-29 K.OHWADA
// BUG : class name collides with other module
// rename this file name & class name
// add function convert_array_array_from_utf8() convert_array_from_utf8()
//     getInstance()

// 2005-06-20 K.OHWADA
// add convert_to_utf8()

// 2005-06-06 K.OHWADA
// add get_encode() get_ping_server_list() get_happy_linux_url()

//================================================================
// What's New Module
// class language base
// 2004/08/22 K.OHWADA
//================================================================

// BUG : class name collides with other module
class Whatsnew_Lang_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Lang_Base()
{
	// dummy
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Lang_Conv();
	}

	return $instance;
}

//---------------------------------------------------------
// convert from utf8
//---------------------------------------------------------
function convert_array_array_from_utf8($in_arr)
{
	$out_arr = array();

	foreach ($in_arr as $key => $value)
	{
		$out_arr[$key] = $this->convert_array_from_utf8($value);
	}

	return $out_arr;
}

function convert_array_from_utf8($in_arr)
{
	$out_arr = array();

	foreach ($in_arr as $key => $value)
	{
		$out_arr[$key] = $this->convert_from_utf8($value);
	}

	return $out_arr;
}

function convert_from_utf8($text)
{
	return utf8_decode($text);
}

//---------------------------------------------------------
// convert to utf8
//---------------------------------------------------------
function convert_to_utf8($text)
{
	if ( (XOOPS_USE_MULTIBYTES == 1) && function_exists('mb_convert_encoding') ) 
	{
		$text = mb_convert_encoding($text, 'UTF-8', 'auto');
	}
	else
	{
		$text = utf8_encode($text);
	}

	return $text;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_encode()
{
	return 'ISO-8859-1';
}

function get_ping_server_list()
{
	$list = "http://rpc.weblogs.com/RPC2\n";
	return $list;
}

function get_happy_linux_url()
{
	return "http://linux2.ohwada.net/";
}

// --- class end ---
}

?>