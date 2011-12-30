<?php
// $Id: whatsnew_lang_conv.php,v 1.1 2011/12/30 21:45:46 ohwada Exp $

// 2005-09-29 K.OHWADA
// BUG : class name collides with other module
// rename this file name & class name

// 2005-06-20 K.OHWADA
// add convert_to_utf8()

// 2005-06-06 K.OHWADA
// add get_encode() get_ping_server_list() get_happy_linux_url()

//================================================================
// What's New Module
// class language convert
// 2004/08/22 K.OHWADA
//================================================================

class Whatsnew_Lang_Conv extends Whatsnew_Lang_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Lang_Conv()
{
	Whatsnew_Lang_Base::Whatsnew_Lang_Base();
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function convert_to_utf8($text)
{
	return mb_convert_encoding($text, "UTF-8", "EUC-JP");
}

function convert_from_utf8($text)
{
	return mb_convert_encoding($text, "EUC-JP", "UTF-8");
}

function get_encode()
{
	return 'EUC-JP';
}

function get_ping_server_list()
{
	$list  = '';
	$list .= "http://ping.bloggers.jp/rpc/\n";
	$list .= "http://ping.cocolog-nifty.com/xmlrpc\n";
	$list .= "http://bulkfeeds.net/rpc\n";
	$list .= "http://ping.myblog.jp/\n";
	$list .= "http://blog.goo.ne.jp/XMLRPC\n";

	return $list;
}

function get_happy_linux_url()
{
	return "http://linux.ohwada.jp/";
}

// --- class end ---
}

?>