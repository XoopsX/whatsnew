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
// Language pack for Japanese
// 2004/08/20 K.OHWADA
// ͭ����������
//=========================================================

// --- define language begin ---
if( !defined('WHATSNEW_LANG_MI_LOADED') ) 
{

define('WHATSNEW_LANG_MI_LOADED', 1);

// The name of this module
define("_MI_WHATSNEW_NAME","�������");

// A brief description of this module
define("_MI_WHATSNEW_DESC","ʣ���Υ⥸�塼�뤫��ǿ��ε����򽸤�ơ��������ΰ�����������ޤ�");

// Names of blocks for this module (Not all module has blocks)
define("_MI_WHATSNEW_BNAME1","������� (���ս�)");
define("_MI_WHATSNEW_BNAME2","������� (�⥸�塼���)");

// Admin menu
define("_MI_WHATSNEW_ADMENU1","�⥸�塼������ 1");

// 2005-10-01
define("_MI_WHATSNEW_BNAME_BOP","������� (BopComment��)");
define("_MI_WHATSNEW_ADMENU_CONFIG2","�⥸�塼������ 2");
define("_MI_WHATSNEW_ADMENU_RSS","RDF/RSS/ATOM �δ���");
define("_MI_WHATSNEW_ADMENU_PING","Ping �δ���");

}
// --- define language end ---

?>