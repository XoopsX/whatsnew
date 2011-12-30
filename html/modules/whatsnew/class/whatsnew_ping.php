<?php
// $Id: whatsnew_ping.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2007-10-10 K.OHWADA
// remove send_ping_cache()

// 2007-05-12 K.OHWADA
// module dupulication
// divid to whatsnew_config_basic_handler

// 2005-09-28 K.OHWADA
// change func.ping.php to class

//=========================================================
// What's New Module
// class send weblog update ping
// 2004/08/20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('whatsnew_ping') ) 
{

//=========================================================
// class whatsnew_ping
//=========================================================
class whatsnew_ping
{
// constant
	var $_DIRNAME;
	var $_FILE_PING;

// class
	var $_weblog;
	var $_config_handler;
	var $_rss_builder;

	var $_conf = array();
	var $_print_levl = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function whatsnew_ping( $dirname )
{
	$this->_DIRNAME   = $dirname;
	$this->_FILE_PING = XOOPS_ROOT_PATH.'/modules/'.$dirname.'/cache/ping.send.log';

// class
	$this->_weblog         =& happy_linux_weblog_updates::getInstance();
	$this->_config_handler =& whatsnew_config_basic_handler::getInstance( $dirname );
	$this->_rss_builder    =& whatsnew_rss_builder::getInstance( $dirname );

	$this->_conf =& $this->_config_handler->get_conf();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new whatsnew_ping( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main function
//---------------------------------------------------------
function send_pings()
{
	$this->_rss_builder->clear_all_guest_cache();

	$param = array(
		'site_name'    => $this->_conf['site_name'],
		'site_url'     => $this->_conf['site_url'],
		'ping_servers' => $this->_conf['ping_servers'],
		'log_level'    => $this->_conf['ping_log'],
		'log_file'     => $this->_FILE_PING,
		'print_level'  => $this->_print_level,
	);

	$this->_weblog->send_pings_by_param( $param );

	$this->_config_handler->update_config_by_name( 'ping_time', time(), true );
}

function set_print_level($val)
{
	$this->_print_level = intval($val);
}

function get_config_pass()
{
	return $this->_conf['ping_pass'];
}

// --- class end ---
}

// === class end ===
}

?>