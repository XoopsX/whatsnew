<?php
// $Id: whatsnew_module_save.php,v 1.1 2011/12/30 21:45:54 ohwada Exp $

// 2006-06-25 K.OHWADA
// change load_system_module(), save()
// change name flag_both to flag_plural_plugins

//=========================================================
// What's New Module
// class module save
// 2005-10-01 K.OHWADA
//=========================================================

class Whatsnew_Module_Save
{
// constant
	var $LIMIT_MODULE_DEFAULT = 5;

// class
	var $_module_handler;

// variable
	var $_system_module_array;
	var $_system_weight_array;
	var $_flag_plural_plugins;


//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Module_Save()
{
// class
	$this->_module_handler =& Whatsnew_Module_Handler::getInstance();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Module_Save();
	}

	return $instance;
}

//---------------------------------------------------------
// save module
//---------------------------------------------------------
function save()
{
// system module config
	$system_arr = $this->load_system_module();

	$mid_ids         = $this->get_post('mod_ids');
	$block_show_arr  = $this->get_post('block_shows');
	$block_limit_arr = $this->get_post('block_limits');
	$block_icon_arr  = $this->get_post('block_icons');
	$rss_show_arr    = $this->get_post('rss_shows');
	$rss_limit_arr   = $this->get_post('rss_limits');
	$plugin_arr      = $this->get_post('plugins');
	$mode            = $this->get_post('mode');

	$count = count($mid_ids);
	if (!is_array($mid_ids) || ($count <= 0))  return; 

// list from POST
	for ( $i=0; $i<$count; $i++ ) 
	{
		$mid = $mid_ids[$i];

		$system      = $system_arr[$mid];
		$dirname     = $system['dirname'];
		$in_module   = $system['in_module'];
		$in_whatsnew = $system['in_whatsnew'];
		$in_version  = $system['in_version'];

		if ( !$in_module && !$in_whatsnew && !$in_version)  continue;

		$module =& $this->_module_handler->get($mid);

// create, when not in MySQL
		$flag_insert = 0;
		if ( !is_object($module) )
		{
			$flag_insert = 1;
			$module =& $this->_module_handler->create();
			$module->setVar('mid', $mid );
		}

		$block_show  = $this->make_int($block_show_arr,  $mid);
		$block_limit = $this->make_int($block_limit_arr, $mid);
		$rss_show    = $this->make_int($rss_show_arr,    $mid);
		$rss_limit   = $this->make_int($rss_limit_arr,   $mid);
		$block_icon  = $this->make_text($block_icon_arr, $mid);
		$plugin      = $this->make_text($plugin_arr,     $mid);

		$module->setVar(WHATSNEW_FIELD_PLUGIN, $plugin );

		if ($mode == 'module')
		{
			$module->setVar('block_show',  $block_show );
			$module->setVar('block_limit', $block_limit );
			$module->setVar('block_icon',  $block_icon );
			$module->setVar('rss_show',    $rss_show );
			$module->setVar('rss_limit',   $rss_limit );
			$module->setVar('dirname',     $dirname );
		}

// insert, when not in MySQL
		if ( $flag_insert )
		{
			$this->_module_handler->insert($module);
		}
// update
		else
		{
			$this->_module_handler->update($module);
		}

		unset($module);
	}

}

//---------------------------------------------------------
// upgrade module
//---------------------------------------------------------
function upgrade()
{
// system module config
	$system_arr = $this->load_system_module();

	$block_show  = 0;
	$rss_show    = 0;
	$block_limit = $this->LIMIT_MODULE_DEFAULT;
	$rss_limit   = $this->LIMIT_MODULE_DEFAULT;
	$block_icon  = '';

	foreach ($system_arr as $mid => $system) 
	{
		$dirname     = $system['dirname'];
		$in_module   = $system['in_module'];
		$in_whatsnew = $system['in_whatsnew'];

		if ( !$in_module && !$in_whatsnew)  continue;

		$module =& $this->_module_handler->get($mid);
		if ( is_object($module) )  continue;

// create, when not in MySQL
		$module =& $this->_module_handler->create();
		$module->setVar('mid', $mid );
		$module->setVar('block_show',  $block_show );
		$module->setVar('block_limit', $block_limit );
		$module->setVar('block_icon',  $block_icon );
		$module->setVar('rss_show',    $rss_show );
		$module->setVar('rss_limit',   $rss_limit );
		$module->setVar('dirname',     $dirname );
		$this->_module_handler->insert($module);

		unset($module);
	}

}

//---------------------------------------------------------
// init module
//---------------------------------------------------------
function init()
{
// system module config
	$system_arr = $this->load_system_module();

	$block_show  = 0;
	$rss_show    = 0;
	$block_limit = $this->LIMIT_MODULE_DEFAULT;
	$rss_limit   = $this->LIMIT_MODULE_DEFAULT;
	$block_icon  = '';

	foreach ($system_arr as $mid => $system) 
	{
		$dirname     = $system['dirname'];
		$in_module   = $system['in_module'];
		$in_whatsnew = $system['in_whatsnew'];

		if ( !$in_module && !$in_whatsnew)  continue;

		$module =& $this->_module_handler->create();
		$module->setVar('mid', $mid );
		$module->setVar('block_show',  $block_show );
		$module->setVar('block_limit', $block_limit );
		$module->setVar('block_icon',  $block_icon );
		$module->setVar('rss_show',    $rss_show );
		$module->setVar('rss_limit',   $rss_limit );
		$module->setVar('dirname',     $dirname );
		$this->_module_handler->insert($module);

		unset($module);
	}

}

//---------------------------------------------------------
// system config
//---------------------------------------------------------
function load_system_module()
{
	$module_handler     =& xoops_gethandler('module');
	$module_arr         =& $module_handler->getObjects( new CriteriaCompo() );
	$moduleperm_handler =& xoops_gethandler('groupperm');

// user permission: guest
	$groups = XOOPS_GROUP_ANONYMOUS;

	$system_arr  = array();
	$weight_arr  = array();
	$flag_plural = 0;

	foreach ( $module_arr as $module ) 
	{
		$mid     = $module->getVar('mid');
		$dirname = $module->getVar('dirname');
		$name    = $module->getVar('name');
		$weight  = $module->getVar('weight');
		$version = $module->getVar('version');

// check user permission
		if ( $moduleperm_handler->checkRight('module_read', $mid, $groups) )
		{
			$perm = 1;
		}
		else
		{
			$perm = 0;
		}

// plugin
		$file_modules  = XOOPS_ROOT_PATH."/modules/$dirname/include/data.inc.php";
		$file_whatsnew = XOOPS_ROOT_PATH."/modules/whatsnew/plugins/$dirname/data.inc.php";
		$file_version  = XOOPS_ROOT_PATH."/modules/whatsnew/plugins/$dirname/version.php";

		$in_module   = 0;
		$in_whatsnew = 0;
		$in_version  = 0;
		if ( file_exists($file_modules) )   $in_module   = 1;
		if ( file_exists($file_whatsnew) )  $in_whatsnew = 1;
		if ( file_exists($file_version) )   $in_version  = 1;
		if ( $in_module && $in_whatsnew )   $flag_plural = 1;
		if ( $in_version )                  $flag_plural = 1;

		$system_arr[$mid]['dirname']     = $dirname;
		$system_arr[$mid]['name']        = $name;
		$system_arr[$mid]['weight']      = $weight;
		$system_arr[$mid]['perm']        = $perm;
		$system_arr[$mid]['version']     = $version;
		$system_arr[$mid]['in_module']   = $in_module;
		$system_arr[$mid]['in_whatsnew'] = $in_whatsnew;
		$system_arr[$mid]['in_version']  = $in_version;

		$weight_arr[$mid] =  $weight;
	}

	$this->_system_module_array = $system_arr;
	$this->_system_weight_array = $weight_arr;
	$this->_flag_plural_plugins = $flag_plural;

	return $system_arr;
}

function get_system_module()
{
	return $this->_system_module_array;
}

function get_system_module_weight()
{
	return $this->_system_weight_array;
}

function get_flag_plural_plugins()
{
	return $this->_flag_plural_plugins;
}
 
//---------------------------------------------------------
// get value for input
//---------------------------------------------------------
function make_text($arr, $key, $default='')
{
	if ( isset($arr[$key]) )
	{
		return trim($arr[$key]);
	}

	return trim($default);
}

function make_int($arr, $key, $default=0)
{
	if ( isset($arr[$key]) )
	{
		return intval($arr[$key]);
	}

	return intval($default);
}

//---------------------------------------------------------
// get POST variable
//---------------------------------------------------------
function get_post($key, $default='')
{
	if ( isset($_POST[$key]) )
	{
		return $_POST[$key];
	}
	else

	return $default;
}

// --- class end ---
}

?>