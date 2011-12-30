<?php
// $Id: version.php,v 1.1 2011/12/30 21:45:50 ohwada Exp $

//================================================================
// What's New Module
// 2009-03-06 K.OHWADA
//================================================================

$dirname = basename( dirname( __FILE__ ) ) ;

// --- eval begin ---
eval( '

function '.$dirname.'_new_version()
{
	return nmblog_base_new_version( "'.$dirname.'" );
}

' ) ;
// --- eval end ---

// === nmblog_base_new ===
if( ! function_exists( 'nmblog_base_new_version' ) ) 
{

function nmblog_base_new_version( $dirname ) 
{
	$ver = array();

	$ver[1]['version']      = '1.50';
	$ver[1]['file']         = 'nmblog_150.inc.php';
	$ver[1]['description']  = 'nmblog v1.50';

	$ver[2]['version']      = '1.60';
	$ver[2]['file']         = 'nmblog_160.inc.php';
	$ver[2]['description']  = 'nmblog v1.60';

	return $ver;
}

// === nmblog_base_new ===
}

?>