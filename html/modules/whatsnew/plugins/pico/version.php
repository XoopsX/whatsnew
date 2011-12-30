<?php
// $Id: version.php,v 1.1 2011/12/30 21:45:48 ohwada Exp $

//================================================================
// What's New Module
// 2007-12-21 K.OHWADA
//================================================================

$dirname = basename( dirname( __FILE__ ) ) ;

// --- eval begin ---
eval( '

function '.$dirname.'_new_version()
{
	return pico_base_new_version( "'.$dirname.'" );
}

' ) ;
// --- eval end ---

// === pico_base_new ===
if( ! function_exists( 'pico_base_new_version' ) ) 
{

function pico_base_new_version( $dirname ) 
{
	$ver = array();

	$ver[1]['version']      = '1.601';
	$ver[1]['file']         = 'pico_160_1.inc.php';
	$ver[1]['description']  = 'pico v1.60';

	$ver[2]['version']      = '1.602';
	$ver[2]['file']         = 'pico_160_2.inc.php';
	$ver[2]['description']  = 'pico v1.60 with permission option';

	$ver[3]['version']      = '1.701';
	$ver[3]['file']         = 'pico_170_1.inc.php';
	$ver[3]['description']  = 'pico v1.70';

	$ver[4]['version']      = '1.702';
	$ver[4]['file']         = 'pico_170_2.inc.php';
	$ver[4]['description']  = 'pico v1.70 with permission option';

	$ver[5]['version']      = '1.801';
	$ver[5]['file']         = 'pico_180_1.inc.php';
	$ver[5]['description']  = 'pico v1.80';

	$ver[6]['version']      = '1.802';
	$ver[6]['file']         = 'pico_180_2.inc.php';
	$ver[6]['description']  = 'pico v1.80 with permission option';

	return $ver;
}

// === pico_base_new ===
}

?>