<?php
// $Id: modinfo.php,v 1.1 2011/12/30 21:45:46 ohwada Exp $

// 2007-10-10 K.OHWADA
// change slightly

// 2007-05-12 K.OHWADA
// module dupulication

// 2005-10-01 K.OHWADA
// _MI_WHATSNEW_BNAME_BOP

//=========================================================
// What's New Module
// Language pack for English
// 2005-06-06 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WHATSNEW_LANG_MI_LOADED') ) 
{

define('WHATSNEW_LANG_MI_LOADED', 1);

// The name of this module
define("_MI_WHATSNEW_NAME","Novidades");

// A brief description of this module
define("_MI_WHATSNEW_DESC","Este m�dulo coleta todos os �ltimos conte�dos de dois ou mais m�dulos do site e mostra em um bloco");

// Names of blocks for this module (Not all module has blocks)
define("_MI_WHATSNEW_BNAME1","Novidades");
define("_MI_WHATSNEW_BNAME2","Novidades (Cada m�dulo)");

// Admin menu
define("_MI_WHATSNEW_ADMENU1","Configura��o 1");

// 2005-10-01
define("_MI_WHATSNEW_BNAME_BOP","Novidades (Como BopComments)");
define("_MI_WHATSNEW_ADMENU_CONFIG2","Configura��o 2");
define("_MI_WHATSNEW_ADMENU_RSS","Administra��o do RDF/RSS/ATOM");
define("_MI_WHATSNEW_ADMENU_PING","Administra��o do Ping");

}
// --- define language end ---

?>
