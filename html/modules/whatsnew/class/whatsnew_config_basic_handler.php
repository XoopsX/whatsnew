<?php
// $Id: whatsnew_config_basic_handler.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2007-10-10 K.OHWADA
// happy_linux_basic_handler

// 2007-05-12 K.OHWADA
// divid from whatsnew_show_block.php

//=========================================================
// What's New Module
// 2007-05-12 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('whatsnew_config_basic_handler') ) 
{

//=========================================================
// class whatsnew_config_basic_handler
//=========================================================
class whatsnew_config_basic_handler extends happy_linux_basic_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function whatsnew_config_basic_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );
	$this->set_table_name('config');
	$this->set_id_name('conf_id');

// load config
	$this->_load_config_once();
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new whatsnew_config_basic_handler( $dirname );
	}
	return $instance;
}

// --- class end ---
}

// === class end ===
}

?>