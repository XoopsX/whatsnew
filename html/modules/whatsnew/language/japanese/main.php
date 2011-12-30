<?php
// $Id: main.php,v 1.1 2011/12/30 21:45:46 ohwada Exp $

// 2007-10-10
// cache

// 2007-05-12 K.OHWADA
// module dupulication
// add _WHATSNEW_RDF_AUTO
// remove _WHATSNEW_LASTBUILD

// 2005-10-10 K.OHWADA
// _WHATSNEW_RSS_PERM

// 2005-06-06 K.OHWADA
// _WHATSNEW_RSS_VALID

//=========================================================
// What's New Module
// Language pack for Japanese
// 2004/08/20 K.OHWADA
// ͭ����������
//=========================================================

// --- define language begin ---
if( !defined('WHATSNEW_LANG_MB_LOADED') ) 
{

define('WHATSNEW_LANG_MB_LOADED', 1);

// index.php
// use $xoopsModule
//define('_WHATSNEW_NAME','������� (What's New)');

define('_WHATSNEW_DESC','ʣ���Υ⥸�塼�뤫��ǿ��ε����򽸤�ơ�RSS��ATOM��������ޤ�');

define('_WHATSNEW_RSS_VALID','RSS/ATOM���������θ���');
define('_WHATSNEW_VALID','�ˤ���������θ���');

define('_WHATSNEW_RSS_AUTO','RSS URL �μ�ư����');
define('_WHATSNEW_ATOM_AUTO','ATOM URL �μ�ư����');

// not use config file
//define('_WHATSNEW_WARNING_NOT_EXIST','����ե����뤬¸�ߤ��Ƥ��ʤ�');

// template rss
//define('_WHATSNEW_LASTBUILD', '�ǽ�������');
//define('_WHATSNEW_LANGUAGE', '����');
//define('_WHATSNEW_DESCRIPTION', '������');
//define('_WHATSNEW_WEBMASTER', '�����֥ޥ�����');
//define('_WHATSNEW_CATEGORY', '���ƥ���');
//define('_WHATSNEW_GENERATOR', '����');
//define('_WHATSNEW_TITLE', '��̾');
//define('_WHATSNEW_PUBDATE', '����');

// template atom
//define('_WHATSNEW_ID', 'ID');
//define('_WHATSNEW_MODIFIED', '�ǽ�������');
//define('_WHATSNEW_ISSUED',   'ȯ����');
//define('_WHATSNEW_CREATED',  '������');
//define('_WHATSNEW_COPYRIGHT', '���ԡ��饤��');
//define('_WHATSNEW_SUMMARY', '����');
//define('_WHATSNEW_CONTENT', '����');
//define('_WHATSNEW_AUTHOR_NAME', '���̾');
//define('_WHATSNEW_AUTHOR_URL',  '��Ԥ�URL');
//define('_WHATSNEW_AUTHOR_EMAIL','��Ԥ��Żҥ᡼��');

define('_WHATSNEW_AUTO', '��ư����');
define('_WHATSNEW_SET', '����');

define('_WHATSNEW_ERROR_CONNCET', '��³�Ǥ��ޤ���');
define('_WHATSNEW_ERROR_PARSE', '���ϤǤ��ʤ�');
define('_WHATSNEW_ERROR_RSS_AUTO', 'RSS URL ����ư���ФǤ��ޤ���');
define('_WHATSNEW_ERROR_RSS_GET', 'RSS�μ������Ǥ��ޤ���');
define('_WHATSNEW_ERROR_ATOM_AUTO', 'ATOM URL ����ư���ФǤ��ޤ���');
define('_WHATSNEW_ERROR_ATOM_GET', 'ATOM�μ������Ǥ��ޤ���');

// 2005-10-10
define('_WHATSNEW_MAIN_PAGE', '�ᥤ�󡦥ڡ���');
define('_WHATSNEW_RSS_PERM', 'ATOM/RSS/RDF ����Ͽ�桼���ˤ�ɽ������ޤ���<br />�������Ȥ��ơ������Ȥξ��֤ǳ�ǧ���Ƥ���������');

// 2007-05-12
define('_WHATSNEW_RDF_AUTO','RDF URL �μ�ư����');

// 2007-10-10
// cache
define('_WHATSNEW_CACHED_TIME','����å����������������');
define('_WHATSNEW_REFRESH_CACHE','����å���򹹿�����');

}
// --- define language end ---

?>