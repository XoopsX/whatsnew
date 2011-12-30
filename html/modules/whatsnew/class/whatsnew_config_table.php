<?php
// $Id: whatsnew_config_table.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2006-06-20 K.OHWADA
// suppress following messages
//   Notice: Only variable references should be returned by reference

//================================================================
// What's New Module
// class config table
// modify form system XoopsConfigItem
// 2005-10-01 K.OHWADA
//================================================================

class Whatsnew_Config_Table extends XoopsObject
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Config_Table()
{
	$this->initVar('conf_id',        XOBJ_DTYPE_INT, 0, true);
	$this->initVar('conf_name',      XOBJ_DTYPE_OTHER);
	$this->initVar('conf_value',     XOBJ_DTYPE_TXTAREA);
	$this->initVar('aux_int_1',      XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',      XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1',     XOBJ_DTYPE_TXTBOX, null, false, 100);
	$this->initVar('aux_text_2',     XOBJ_DTYPE_TXTBOX, null, false, 100);

// not table value, refer to define
	$this->initVar('conf_exist',     XOBJ_DTYPE_INT, 0);
	$this->initVar('conf_catid',     XOBJ_DTYPE_INT, 0);
	$this->initVar('conf_valuetype', XOBJ_DTYPE_OTHER);
	$this->initVar('conf_formtype',  XOBJ_DTYPE_OTHER);
	$this->initVar('conf_title',     XOBJ_DTYPE_TXTBOX);
	$this->initVar('conf_desc',      XOBJ_DTYPE_OTHER);
	$this->initVar('conf_options',   XOBJ_DTYPE_OTHER);

}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function &getConfValueForOutput()
{
	switch ( $this->getVar('conf_valuetype') ) 
	{
		case 'int':
			$val = intval($this->getVar('conf_value', 'N'));
			break;

		case 'array':
			$val =  unserialize($this->getVar('conf_value', 'N'));
			break;

		case 'float':
			$val = floatval($this->getVar('conf_value', 'N'));
			break;

		case 'textarea':
			$val =  $this->getVar('conf_value');
			break;

		case 'text':
		default:
			$val = $this->getVar('conf_value', 'N');
			break;
	}

	return $val;
}

function setConfValueForInput(&$value, $force_slash = false)
{
	switch ( $this->getVar('conf_valuetype') ) 
	{
		case 'array':
			if (!is_array($value)) 
			{
				$value = explode('|', trim($value));
			}
			$this->setVar('conf_value', serialize($value), $force_slash);
			break;

		case 'text':
			$this->setVar('conf_value', trim($value), $force_slash);
			break;

		default:
			$this->setVar('conf_value', $value, $force_slash);
			break;
	}
}

// --- class end ---
}

?>