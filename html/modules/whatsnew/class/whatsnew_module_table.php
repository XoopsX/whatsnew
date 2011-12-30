<?php
// $Id: whatsnew_module_table.php,v 1.1 2011/12/30 21:45:54 ohwada Exp $

//================================================================
// What's New Module
// class table module table
// 2005-10-01 K.OHWADA
//================================================================

class Whatsnew_Module_Table extends XoopsObject
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Module_Table()
{
	$this->initVar('mid',         XOBJ_DTYPE_INT, 0, true);
	$this->initVar('dirname',     XOBJ_DTYPE_TXTBOX, null, true, 100);
	$this->initVar('block_show',  XOBJ_DTYPE_INT,   0, true);
	$this->initVar('block_limit', XOBJ_DTYPE_INT,   0, true);
	$this->initVar('rss_show',    XOBJ_DTYPE_INT,   0, true);
	$this->initVar('rss_limit',   XOBJ_DTYPE_INT,   0, true);
	$this->initVar('block_icon',  XOBJ_DTYPE_TXTBOX, null, false, 100);
	$this->initVar('aux_int_1',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1',  XOBJ_DTYPE_TXTBOX, null, false, 100);
	$this->initVar('aux_text_2',  XOBJ_DTYPE_TXTBOX, null, false, 100);
}

// --- class end ---
}

?>