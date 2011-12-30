<?php
// $Id: atom_auto.php,v 1.1 2011/12/30 21:45:42 ohwada Exp $

// 2006-06-20 K.OHWADA
// use constant WHATSNEW_ROOT_PATH

// 2005-09-29 K.OHWADA
// use Whatsnew_Auto_Rss class

//=========================================================
// What's New Module
// ATOM auto discovery and and view
// 2004-08-22 K.OHWADA
//=========================================================

include "header_auto.php";
include_once WHATSNEW_ROOT_PATH.'/class/whatsnew_atom_parser.php';
include_once WHATSNEW_ROOT_PATH.'/class/whatsnew_auto_atom.php';

// start
include XOOPS_ROOT_PATH."/header.php";

print_top( _WHATSNEW_ATOM_AUTO );

$class_auto_atom =& Whatsnew_Auto_Atom::getInstance();
$class_auto_atom->show();

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