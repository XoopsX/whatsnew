<?php
// $Id: version.php,v 1.1 2011/12/30 21:45:48 ohwada Exp $

// 2006-06-25 K.OHWADA
// this is new file

//================================================================
// What's New Module
// 2006-06-25 K.OHWADA
//================================================================

function bluesbb_new_version() 
{
	$ver = array();

	$ver[1]['version']      = '0.23';
	$ver[1]['file']         = 'bluesbb_023_data.inc.php';
	$ver[1]['description']  = 'bluesbb v0.23';

	$ver[2]['version']      = '1.00';
	$ver[2]['file']         = 'bluesbb_100_data.inc.php';
	$ver[2]['description']  = 'bluesbb v1.00';

	$ver[3]['version']      = '1.04';
	$ver[3]['file']         = 'bluesbb_104_data.inc.php';
	$ver[3]['description']  = 'bluesbb v1.04';

	return $ver;
}

?>