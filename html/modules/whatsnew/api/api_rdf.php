<?php
// $Id: api_rdf.php,v 1.2 2011/12/31 02:08:47 ohwada Exp $

// 2011-12-31 K.OHWADA
// whatsnew_show_block.php -> whatsnew_show_block_handler.php

// 2006-06-20 K.OHWADA
// use constant WHATSNEW_ROOT_PATH
// use whatsnew_constant.php

//=========================================================
// What's New Module
// 2005-09-28 K.OHWADA
//=========================================================

if( !defined("WHATSNEW_ROOT_PATH") )
{
	define("WHATSNEW_ROOT_PATH", XOOPS_ROOT_PATH.'/modules/whatsnew' );
}

// include files
include_once XOOPS_ROOT_PATH.'/class/template.php';

include_once WHATSNEW_ROOT_PATH."/include/whatsnew_version.php";
include_once WHATSNEW_ROOT_PATH."/include/whatsnew_constant.php";
include_once WHATSNEW_ROOT_PATH."/class/whatsnew_show_block_handler.php";
include_once WHATSNEW_ROOT_PATH."/class/whatsnew_show_main.php";
include_once WHATSNEW_ROOT_PATH."/class/whatsnew_build_base.php";
include_once WHATSNEW_ROOT_PATH."/class/whatsnew_build_rdf.php";
include_once WHATSNEW_ROOT_PATH."/class/whatsnew_lang_base.php";

if ( file_exists(WHATSNEW_ROOT_PATH."/language/".$xoopsConfig['language']."/whatsnew_lang_conv.php") ) 
{
	include_once WHATSNEW_ROOT_PATH."/language/".$xoopsConfig['language']."/whatsnew_lang_conv.php";
}
else
{
	include_once WHATSNEW_ROOT_PATH."/language/english/whatsnew_lang_conv.php";
}

?>