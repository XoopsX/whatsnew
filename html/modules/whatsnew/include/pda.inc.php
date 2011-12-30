<?php
// $Id: pda.inc.php,v 1.1 2011/12/30 21:45:44 ohwada Exp $

// 2007-10-10 K.OHWADA
// api_pda.php
// build()

// 2007-05-12 K.OHWADA
// module dupulication
// move from whatsnew/pda.php

//=========================================================
// What's New Module
// 2005-06-20 K.OHWADA
//=========================================================

if( !defined('WHATSNEW_DIRNAME') )
{
	$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );
	define('WHATSNEW_DIRNAME', $WEBLINKS_DIRNAME );
}

include_once XOOPS_ROOT_PATH.'/modules/'.WHATSNEW_DIRNAME.'/api/api_pda.php';

$whatsnew_builder =& whatsnew_pda_builder::getInstance( WHATSNEW_DIRNAME );
$whatsnew_builder->build_pda();

?>