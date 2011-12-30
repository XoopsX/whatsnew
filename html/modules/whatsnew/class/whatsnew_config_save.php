<?php
// $Id: whatsnew_config_save.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2006-06-25 K.OHWADA
// small change save()

//================================================================
// What's New Module
// class config save
// 2005-10-01 K.OHWADA
//================================================================

class Whatsnew_Config_Save
{
// class
	var $_config_handler;


//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Config_Save()
{
// class
	$this->_config_handler =& Whatsnew_Config_Handler::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Config_Save();
	}

	return $instance;
}

//---------------------------------------------------------
// save config
//---------------------------------------------------------
function save()
{
	$conf_ids = $this->get_post('conf_ids');

	$count = count($conf_ids);
	if (!is_array($conf_ids) || ($count <= 0))  return; 

// list from POST 
	for ( $i=0; $i<$count; $i++ ) 
	{
		$id    = $conf_ids[$i];
		$value = $this->_config_handler->get_value_for_save($id, $_POST);

		$config =& $this->_config_handler->get($id);
		if ( !is_object($config) )  continue;

		$value_current = $config->getVar('conf_value');

// insert, when not in MySQL
		if ( $config->isNew() )
		{
			$this->_config_handler->insert($config);
		}
// update
		elseif ( is_array($value) || ($value != $value_current) )
		{
			$config->setConfValueForInput($value, true);
			$this->_config_handler->update($config);
		}

		unset($config);
	}

}

//---------------------------------------------------------
// upgrade config
//---------------------------------------------------------
function upgrade()
{
	$define_arr = $this->_config_handler->get_define_all();

// list from Define
	foreach ($define_arr as $id => $define) 
	{
		$config =& $this->_config_handler->get($id);
		if ( !is_object($config) )  continue;

// insert, when not in MySQL
		if ( $config->isNew() )
		{
			$this->_config_handler->insert($config);
		}

		unset($config);
	}

}

//---------------------------------------------------------
// init config
//---------------------------------------------------------
function init()
{
	$define_arr = $this->_config_handler->get_define_all();

// list from Define
	foreach ($define_arr as $id => $define) 
	{
		$name      = $define['name'];
		$valuetype = $define['valuetype'];
		$value     = $define['default'];

		$config =& $this->_config_handler->create();
		$config->setVar('conf_id',        $id );
		$config->setVar('conf_name',      $name);
		$config->setVar('conf_valuetype', $valuetype);
		$config->setConfValueForInput($value, true);
		$this->_config_handler->insert($config);

		unset($config);
	}

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