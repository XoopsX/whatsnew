<?php
// $Id: view_rss.php,v 1.1 2011/12/30 21:45:47 ohwada Exp $

// 2007-10-10 K.OHWADA
// view()

// 2007-05-12 K.OHWADA
// module dupulication

// 2005-09-28 K.OHWADA
// change func.rss.php to class

//=========================================================
// What's New Module
// view RSS 
// 2005-06-20 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once WHATSNEW_ROOT_PATH.'/api/api_rss.php';

//=========================================================
// main
//=========================================================
$whatsnew_builder =& whatsnew_rss_builder::getInstance( WHATSNEW_DIRNAME );
$whatsnew_builder->view( 'rss' );
exit();
// --- main end ---

?>