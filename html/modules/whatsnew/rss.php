<?php
// $Id: rss.php,v 1.1 2011/12/30 21:45:42 ohwada Exp $

// 2007-05-12 K.OHWADA
// module dupulication

// 2005-11-23 K.OHWADA
// BUG 3222: forget to set cache time

// 2005-09-28 K.OHWADA
// change func.rss.php to class

//=========================================================
// What's New Module
// build and view RSS 
// 2004/08/20 K.OHWADA
//=========================================================

include '../../mainfile.php';
define('WHATSNEW_DIRNAME', $xoopsModule->dirname() );
include_once XOOPS_ROOT_PATH . '/modules/' . WHATSNEW_DIRNAME . '/include/rss.inc.php';
exit();

?>