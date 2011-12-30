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

//=========================================================
// What's New Module
// Language pack for English
// 2005-06-06 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WHATSNEW_LANG_MB_LOADED') ) 
{

define('WHATSNEW_LANG_MB_LOADED', 1);
// index.php
// use $xoopsModule
//define("_WHATSNEW_NAME","What's New");

define("_WHATSNEW_DESC","Este m�dulo coleta todos os �ltimos conte�dos de dois ou mais m�dulos do site e mostra em um bloco e mostra e tamb�m mostra esse conte�do nos formatos RSS e ATOM.");

define("_WHATSNEW_RSS_VALID","Checar a validade do RSS/ATOM");
define("_WHATSNEW_VALID","Checagem V�lida");

define("_WHATSNEW_RSS_AUTO","Descoberta autom�tica da URL RSS");
define("_WHATSNEW_ATOM_AUTO","Descoberta autom�tica da URL ATOM");

// not use config file
//define("_WHATSNEW_WARNING_NOT_EXIST","Not exist of config file");

// template rss
//define('_WHATSNEW_LASTBUILD', 'Last build date');
//define('_WHATSNEW_LANGUAGE', 'Language');
//define('_WHATSNEW_DESCRIPTION', 'Site');
//define('_WHATSNEW_WEBMASTER', 'Webmaster');
//define('_WHATSNEW_CATEGORY', 'Category');
//define('_WHATSNEW_GENERATOR', 'Generator');
//define('_WHATSNEW_TITLE', 'Title');
//define('_WHATSNEW_PUBDATE', 'Public date');

// template atom
//define('_WHATSNEW_ID', 'ID');
//define('_WHATSNEW_MODIFIED', 'Moditid date');
//define('_WHATSNEW_ISSUED',   'Issued date');
//define('_WHATSNEW_CREATED',  'Created date');
//define('_WHATSNEW_COPYRIGHT', 'Copyright');
//define('_WHATSNEW_SUMMARY', 'Summary');
//define('_WHATSNEW_CONTENT', 'Content');
//define('_WHATSNEW_AUTHOR_NAME', 'Author name');
//define('_WHATSNEW_AUTHOR_URL',  'Author URL');
//define('_WHATSNEW_AUTHOR_EMAIL','Author email');

define('_WHATSNEW_AUTO', 'Descoberta autom�tica');
define('_WHATSNEW_SET', 'Especifica��o');

define('_WHATSNEW_ERROR_CONNCET', 'N�o foi poss�vel conectar');
define('_WHATSNEW_ERROR_PARSE', 'N�o foi poss�vel analisar');
define('_WHATSNEW_ERROR_RSS_AUTO', 'N�o foi poss�vel a descoberta autom�tica do RSS');
define('_WHATSNEW_ERROR_RSS_GET', 'N�o foi poss�vel obter o RSS');
define('_WHATSNEW_ERROR_ATOM_AUTO', 'N�o foi poss�vel a descoberta autom�tica do ATOM');
define('_WHATSNEW_ERROR_ATOM_GET', 'N�o foi poss�vel obter o ATOM');

// 2005-10-10
define('_WHATSNEW_MAIN_PAGE', 'P�gina Principal');
define('_WHATSNEW_RSS_PERM', 'Usu�rios registrados n�o podem ler os ATOM/RSS/RDF<br />Por favor, efetue o logout e leia no modo an�nimo');

// 2007-05-12
define('_WHATSNEW_RDF_AUTO','Descoberta autom�tica da URL do RDF');

// 2007-10-10
// cache
define('_WHATSNEW_CACHED_TIME','Momento que o cache foi criado');
define('_WHATSNEW_REFRESH_CACHE','Atualizar o cache');

}
// --- define language end ---

?>
