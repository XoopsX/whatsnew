<?php
// $Id: header_auto.php,v 1.1 2011/12/30 21:45:42 ohwada Exp $

// 2006-08-07 K.OHWADA
// BUG 4190: parse error, unexpected T_CLASS in line 29

// 2006-06-20 K.OHWADA
// use constant WHATSNEW_ROOT_PATH

//=========================================================
// What's New Module
// 2005-09-28 K.OHWADA
//=========================================================

// include files
include '../../mainfile.php';

if( !defined('WHATSNEW_ROOT_PATH') )
{
	define('WHATSNEW_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/whatsnew' );
}

$XOOPS_LANGUAGE = $xoopsConfig['language'];

// correspondence to allow_url_fopen = off
if ( !get_cfg_var('allow_url_fopen') )
{
	include_once XOOPS_ROOT_PATH.'/class/snoopy.php';
}

include_once WHATSNEW_ROOT_PATH.'/class/whatsnew_remote_file.php';
include_once WHATSNEW_ROOT_PATH.'/class/whatsnew_auto_base.php';
include_once WHATSNEW_ROOT_PATH.'/class/whatsnew_lang_base.php';

if ( file_exists(WHATSNEW_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/whatsnew_lang_conv.php') ) 
{
	include_once WHATSNEW_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/whatsnew_lang_conv.php';
}
else
{
	include_once WHATSNEW_ROOT_PATH.'/language/english/whatsnew_lang_conv.php';
}

?>