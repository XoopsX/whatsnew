<?php
// $Id: version.php,v 1.1 2011/12/30 21:45:47 ohwada Exp $

// 2006-06-25 K.OHWADA
// this is new file

//================================================================
// What's New Module
// 2006-06-25 K.OHWADA
//================================================================

function newbb_new_version() 
{
	$ver = array();

	$ver[1]['version']      = '1.00';
	$ver[1]['file']         = 'newbb1_data.inc.php';
	$ver[1]['description']  = 'newbb v1.00';

	$ver[2]['version']      = '2.02';
	$ver[2]['file']         = 'newbb2_data.inc.php';
	$ver[2]['description']  = 'newbb v2.02';

	return $ver;
}

?>