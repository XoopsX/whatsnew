<?php
// $Id: rss_auto.php,v 1.1 2011/12/30 21:45:42 ohwada Exp $

// 2006-09-18 K.OHWADA
// BUG 4259: Fatal error: Class 'Whatsnew_Auto_Rss' not found 

// 2006-06-20 K.OHWADA
// use constant WHATSNEW_ROOT_PATH

// 2005-09-29 K.OHWADA
// use Whatsnew_Auto_Rss class

//=========================================================
// What's New Module
// RSS auto discovery and and view
// 2004-08-22 K.OHWADA
//=========================================================

include "header_auto.php";

// BUG 4259: Fatal error: Class 'Whatsnew_Auto_Rss' not found 
// failed to open stream: No such file or directory
include_once XOOPS_ROOT_PATH.'/class/xml/rss/xmlrss2parser.php';
include_once WHATSNEW_ROOT_PATH.'/class/whatsnew_auto_rss.php';

// start
include XOOPS_ROOT_PATH."/header.php";

print_top( _WHATSNEW_RSS_AUTO );

$class_auto_rss =& Whatsnew_Auto_Rss::getInstance();
$class_auto_rss->show();

include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---


function print_top($sub_title)
{
// module name
	global $xoopsModule;
	$module_name = $xoopsModule->getVar('name');

?>
<h3 align='center'><?php echo $module_name; ?></h3>
<h4><?php echo $sub_title; ?></h4>
<ul>
<li><a href='index.php'><?php echo _WHATSNEW_MAIN_PAGE; ?></a></li>
<li><a href='rss_valid.php'><?php echo _WHATSNEW_RSS_VALID; ?></a><br />
</ul>
<hr />
<?php

}

?>