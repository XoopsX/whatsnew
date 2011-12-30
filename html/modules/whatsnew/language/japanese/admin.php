<?php
// $Id: admin.php,v 1.1 2011/12/30 21:45:46 ohwada Exp $

// 2007-12-01 K.OHWADA
// view
// _WHATSNEW_BLOCK_MODULE => _AM_WHATSNEW_CONF_BLOCK_MODULE_ORDER

// 2007-10-10 K.OHWADA
// banner cache_time

// 2007-05-12 K.OHWADA
// module dupulication
// _WHATSNEW_NOTICE_IMAGE_SIZE
// remove _WHATSNEW_INIT_NOT etc

// 2006-06-25
// _WHATSNEW_PLUGIN and more

// 2006-06-20
// _WHATSNEW_CONFIG_RSS and more

// 2005-10-01
// _WHATSNEW_CONFIG_BLOCK and more

// 2005-06-20
// _WHATSNEW_NEW_IMAGE_WIDTH

// 2005-06-14
// _WHATSNEW_MENU_RDF

// 2005-06-06
// _WHATSNEW_SYSTEM_COMMENT

//=========================================================
// What's New Module
// Language pack for Japanese
// 2004/08/20 K.OHWADA
// ͭ����������
//=========================================================

// --- define language begin ---
if( !defined('WHATSNEW_LANG_AM_LOADED') ) 
{

define('WHATSNEW_LANG_AM_LOADED', 1);

// use $xoopsModule
//define('_WHATSNEW_NAME','������� (What's New)');

// use blocks.php
//define('_WHATSNEW_ADMIN_DESC','ʣ���Υ⥸�塼�뤫��ǿ��ε����򽸤�ơ����嵭���֥�å���RSS��ATOM��������ޤ�');
//define('_WHATSNEW_MENU_CONFIG','��������');
//define('_WHATSNEW_MENU_PING','Ping ����');
//define('_WHATSNEW_MENU_RSS','RSS �Υ�ե�å���');
//define('_WHATSNEW_MENU_ATOM','ATOM �Υ�ե�å���');
//define('_WHATSNEW_MENU_RDF','RDF �Υ�ե�å���');
//define('_WHATSNEW_GOTO_WHATNEW','�⥸�塼�� ��');

// config
define('_WHATSNEW_MID','ID');
define('_WHATSNEW_MNAME','�⥸�塼��̾');
define('_WHATSNEW_MDIR','�ǥ��쥯�ȥ�̾');
define('_WHATSNEW_NEW','���嵭���֥�å�');
define('_WHATSNEW_RSS','RSS / ATOM');
define('_WHATSNEW_ITEM','����');
define('_WHATSNEW_LIMIT_SHOW','���Τ�ɽ���������ε�����');
define('_WHATSNEW_LIMIT_SUMMARY','����ɽ�����뵭����');
define('_WHATSNEW_MAX_SUMMARY','�����ʸ����');
define('_WHATSNEW_NEW_IMAGE','������ɽ������');
define('_WHATSNEW_NEW_PING','Ping����������');

//define('_WHATSNEW_SITE_NAME','������̾');
//define('_WHATSNEW_SITE_NAME_DESC','RSS/ATOM��ɬ�ܹ��ܤǤ�');
//define('_WHATSNEW_SITE_URL','������URL');
//define('_WHATSNEW_SITE_URL_DESC','RSS/ATOM��ɬ�ܹ��ܤǤ�');
//define('_WHATSNEW_SITE_DESC','�����Ȥ�����');
//define('_WHATSNEW_SITE_DESC_DESC','RSS��ɬ�ܹ��ܤǤ�');
//define('_WHATSNEW_SITE_AUTHOR','�����ȴ�����');
//define('_WHATSNEW_SITE_AUTHOR_DESC','ATOM��ɬ�ܹ��ܤǤ�');
//define('_WHATSNEW_SITE_EMAIL','�����ȴ����ԤΣť᡼��');
//define('_WHATSNEW_SITE_EMAIL_DESC','RSS/ATOM��Ǥ�չ��ܤǤ�');
//define('_WHATSNEW_SITE_LOGO','�����ȤΥ�����');
//define('_WHATSNEW_SITE_LOGO_DESC','RSS��Ǥ�չ��ܤǤ�');

define('_WHATSNEW_PING_SERVERS','Ping�����С��ΰ���');
define('_WHATSNEW_PING_PASS','update_ping.php �Υѥ����');
define('_WHATSNEW_PING_LOG','Ping�����Υ�');

//define('_WHATSNEW_SAVE','��¸');
//define('_WHATSNEW_DELETE','���');
//define('_WHATSNEW_CONFIG_SAVED','����ơ��֥����¸����');
//define('_WHATSNEW_WARNING_NOT_WRITABLE','cache�ǥ��쥯�ȥ�ν���ߵ��Ĥ��ʤ�');

// not use config file
//define('_WHATSNEW_CONFIG_DELETED','����ե������������');
//define('_WHATSNEW_WARNING_NOT_EXIST','����ե����뤬¸�ߤ��Ƥ��ʤ�');
//define('_WHATSNEW_ERROR_CONFIG','���꤬�������ʤ�');
//define('_WHATSNEW_ERROR_SITE_NAME','������̾�����ꤵ��Ƥ��ʤ�');
//define('_WHATSNEW_ERROR_SITE_URL','������URL�����ꤵ��Ƥ��ʤ�');
//define('_WHATSNEW_ERROR_SITE_DESC','�����Ȥ����������ꤵ��Ƥ��ʤ�');
//define('_WHATSNEW_ERROR_SITE_AUTHOR','�����ȴ����Ԥ����ꤵ��Ƥ��ʤ�');
//define('_WHATSNEW_ERROR_NEW_MAX_SUMMARY','���嵭���֥�å��������ʸ�������������ʤ�');
//define('_WHATSNEW_ERROR_RSS_MAX_SUMMARY','RSS/ATOM�������ʸ�������������ʤ�');

// ping
define('_WHATSNEW_PING_DETAIL','�ܺپ����ɽ������');
define('_WHATSNEW_PING','Ping����');
define('_WHATSNEW_PING_SENDED','Ping����������');

// 2005-06-06
define('_WHATSNEW_SYSTEM_COMMENT','������');

// 2005-06-20
define('_WHATSNEW_NEW_IMAGE_WIDTH','�����������β��κ�����');
define('_WHATSNEW_NEW_IMAGE_HEIGHT','�����������νĤκ�����');
define('_WHATSNEW_NEW_IMAGE_SIZE_NOT_SAVE','�����������κ����ͤ���¸����Ƥ��ʤ�');

//define('_WHATSNEW_VIEW_RSS','RSS�ΥǥХå�ɽ��');
//define('_WHATSNEW_VIEW_RDF','RDF�ΥǥХå�ɽ��');
//define('_WHATSNEW_VIEW_ATOM','ATOM�ΥǥХå�ɽ��');
//define('_WHATSNEW_MENU_PDA','PDA ��ɽ��');

// 2005-10-01
//define('_WHATSNEW_SYSTEM_GROUPS','���롼�״���');
//define('_WHATSNEW_SYSTEM_BLOCKS','�֥�å�����');
define('_WHATSNEW_VIEW_DOCS','�ޥ˥奢��');
define('_WHATSNEW_CONFIG_BLOCK','���嵭���֥�å���RSS/ATOM������');
define('_WHATSNEW_CONFIG_MAIN','�ᥤ��ڡ���������');
define('_WHATSNEW_CONFIG_SITE','�����Ⱦ��������');
define('_WHATSNEW_CONFIG_PING','Ping������');
define('_WHATSNEW_GOTO_MENU_PING','Ping���� �����');

// index
//define('_WHATSNEW_INIT_NOT','����ơ��֥뤬���������Ƥ��ʤ�');
//define('_WHATSNEW_INIT_EXEC','����ơ��֥����������');
//define('_WHATSNEW_VERSION_NOT','�С������ %s �ǤϤʤ�');
//define('_WHATSNEW_UPGRADE_EXEC','����ơ��֥�򥢥åץ��졼�ɤ���');

define('_WHATSNEW_NOTICE','���');
define('_WHATSNEW_NOTICE_PERM','���� WhatsNew �⥸�塼��ϥ����Ȥ˸�������Ƥ��ޤ���<br />RSS��ATOM��ɽ���Ǥ��ޤ���');
define('_WHATSNEW_NOTICE_BOTH','�ץ饰���󤬥⥸�塼��¦�� WhatsNew ��ξ����¸�ߤ��ޤ���<br />�ץ饰����ϡ��⥸�塼��¦��ͥ�褷�ƻ��Ѥ��ޤ���<br />���������Τϡ��ǥ��쥯�ȥꥣ̾�� <span style="color:#ff0000;">�ֻ�</span> ��ɽ�����ޤ���<br />�ɤ��餫�Ť��ۤ��������Ƥ���������<br />');

//define('_WHATSNEW_NOTE_RSS_MARK','RSS/ATOM��� <b>#</b> �ޡ����ϡ������Ȥ˥����������¤����뤳�Ȥ򼨤��ޤ���<br />RSS/ATOM�ϥ����ȸ��¤ǥ������������Ȥ��ˤΤ�ɽ������ޤ���<br />');

define('_WHATSNEW_ICON_LIST','�����������');

// config item
define('_WHATSNEW_WEIGHT','�¤ӽ�');
define('_WHATSNEW_MIN_SHOW','�⥸�塼�����ɽ������Ǿ��ε�����');
define('_WHATSNEW_BLOCK_ICON','��������Υǥե����');

// conflit to blocks.php
//define('_WHATSNEW_BLOCK_MODULE','�⥸�塼���ɽ����');

define('_WHATSNEW_BLOCK_MODULE_0','�����');
define('_WHATSNEW_BLOCK_MODULE_1','�¤ӽ�');
define('_WHATSNEW_BLOCK_SUMMARY_HTML','�����HTML��������Ĥ���');
define('_WHATSNEW_BLOCK_MAX_TITLE','�����ȥ��ʸ����');

//define('_WHATSNEW_SITE_TAG','������ ����');
//define('_WHATSNEW_SITE_IMAGE_URL','�����Ȳ�����URL');
//define('_WHATSNEW_SITE_IMAGE_WIDTH','�����Ȳ����β���');
//define('_WHATSNEW_SITE_IMAGE_HEIGHT','�����Ȳ����ι⤵');

define('_WHATSNEW_MAIN_TPL','�ᥤ��Υƥ�ץ졼��');
define('_WHATSNEW_MAIN_TPL_0','WhatsNew ��');
define('_WHATSNEW_MAIN_TPL_1','BopCommnets ��');

// --- 2006-06-18 ---
define('_WHATSNEW_CONFIG_RSS', 'RDF/RSS/ATOM ����������');

//define('_WHATSNEW_RSS_PERMIT_USER', '��Ͽ�桼����RSS��ɽ������');
//define('_WHATSNEW_RSS_PERMIT_USER_DESC', '�����ȤˤϾ��RSS��ɽ������');

// --- 2006-06-25 ---
define('_WHATSNEW_PLUGIN', '�ץ饰����');
define('_WHATSNEW_MOD_VERSION', '�С������');
define('_WHATSNEW_NOTICE_PLURAL','���ĤΥ⥸�塼���ʣ���Υץ饰����¸�ߤ��ޤ���<br />Ŭ�ڤʥץ饰��������򤷤Ƥ���������<br />');

// --- 2007-05-12 ---
define('_WHATSNEW_NOTICE_IMAGE_SIZE', '�����������򵬳ʤ˽��������å������Ȥ���XOOPS logo.gif �ǤϷٹ�ɽ������롣<br />���Τ��餤�ϵ��Ƥ�������');

// --- 2007-10-10 ---
// banner
define('_WHATSNEW_BANNER_FLAG','�Хʡ�������ɽ������');
define('_WHATSNEW_BANNER_WIDTH','�Хʡ������β��κ�����');
define('_WHATSNEW_BANNER_HEIGHT','�Хʡ������νĤκ�����');

// --- 2007-11-24 ---
// view
define('_AM_WHATSNEW_CONFIG_VIEW','ɽ��������');
define('_AM_WHATSNEW_CONF_NEWDAY_DAYS','��NEW�פ�ɽ����������');
define('_AM_WHATSNEW_CONF_NEWDAY_STRINGS','��NEW�פ�ʸ��');
define('_AM_WHATSNEW_CONF_NEWDAY_STYLE','��NEW�פΥ�������');
define('_AM_WHATSNEW_CONF_TODAY_HOURS','��TODAY�פ�ɽ��������� (Hours)');
define('_AM_WHATSNEW_CONF_TODAY_STRINGS','��TODAY�פ�ʸ��');
define('_AM_WHATSNEW_CONF_TODAY_STYLE','��TODAY�פΥ�������');

// main block
define('_AM_WHATSNEW_CONFIG_MAIN_BLOCK','�ᥤ��/�֥�å�/RSS������');
define('_AM_WHATSNEW_MAIN','�ᥤ��ڡ���');
define('_AM_WHATSNEW_CONF_NEWDAY','��NEW�פ�ɽ������');
define('_AM_WHATSNEW_CONF_TODAY','��TODAY�פ�ɽ������');
define('_AM_WHATSNEW_CONF_TODAY_DSC', '�֤������פ���ꤹ��ȡ���NEW�פ����꤬ͭ���Ȥʤ�');
define('_AM_WHATSNEW_CONF_DATE_STRINGS','���դν�');
define('_AM_WHATSNEW_CONF_DATE_STRINGS_DSC','���� <a href="http://www.php.net/manual/ja/function.date.php" target="_blank">PHP date �ؿ�</a>');

// permission
define('_AM_WHATSNEW_CONFIG_PERM','�⥸�塼��Υ����������¤�����');
define('_AM_WHATSNEW_CONFIG_PERM_DSC','�����������¤Τʤ��⥸�塼��ˤĤ��ơ�ɽ��������ܤ����ꤹ��');
define('_AM_WHATSNEW_CONF_PERM_MODULE','�����������¤Τʤ��⥸�塼���ɽ��');
define('_AM_WHATSNEW_CONF_PERM_MODULE_DSC','��ɽ������פΤȤ��ˡ��ʹߤ����꤬ͭ���ˤʤ�');
define('_AM_WHATSNEW_CONF_PERM_NOT_SHOW','ɽ�����ʤ�');
define('_AM_WHATSNEW_CONF_PERM_SHOW','ɽ������');
define('_AM_WHATSNEW_CONF_PERM_DIRNAME','�ǥ��쥯�ȥ�̾');
define('_AM_WHATSNEW_CONF_PERM_MOD_NAME','�⥸�塼��̾');
define('_AM_WHATSNEW_CONF_PERM_MOD_LINK','�⥸�塼��Υ��');
define('_AM_WHATSNEW_CONF_PERM_MOD_ICON','�⥸�塼��Υ�������');
define('_AM_WHATSNEW_CONF_PERM_CAT_NAME','���ƥ���̾');
define('_AM_WHATSNEW_CONF_PERM_CAT_LINK','���ƥ���Υ��');
define('_AM_WHATSNEW_CONF_PERM_TITLE','��������̾');
define('_AM_WHATSNEW_CONF_PERM_LINK','�����Υ��');
define('_AM_WHATSNEW_CONF_PERM_SUMMARY','����');
define('_AM_WHATSNEW_CONF_PERM_IMAGE','����');
define('_AM_WHATSNEW_CONF_PERM_BANNER','�Хʡ�');

define('_AM_WHATSNEW_PERM','����');
define('_AM_WHATSNEW_PERM_DSC','#1 �����Ȥ˥����������¤Τʤ��⥸�塼���ɽ������Ĥ���');
define('_AM_WHATSNEW_CONF_BLOCK_MODULE_ORDER','�⥸�塼���֥�å���ɽ����');

}
// --- define language end ---

?>