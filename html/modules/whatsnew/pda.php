<?php
// $Id: pda.php,v 1.1 2011/12/30 21:45:42 ohwada Exp $

// 2007-05-12 K.OHWADA
// module dupulication

// 2005-09-28 K.OHWADA
// change func.pda.php to class

//=========================================================
// What's New Module
// view for PDA 
// 2005-06-20 K.OHWADA
//=========================================================

include '../../mainfile.php';
define('WHATSNEW_DIRNAME', $xoopsModule->dirname() );
include_once XOOPS_ROOT_PATH . '/modules/' . WHATSNEW_DIRNAME . '/include/pda.inc.php';
exit();

?>