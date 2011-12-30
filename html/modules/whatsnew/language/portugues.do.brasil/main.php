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

define("_WHATSNEW_DESC","Este módulo coleta todos os últimos conteúdos de dois ou mais módulos do site e mostra em um bloco e mostra e também mostra esse conteúdo nos formatos RSS e ATOM.");

define("_WHATSNEW_RSS_VALID","Checar a validade do RSS/ATOM");
define("_WHATSNEW_VALID","Checagem Válida");

define("_WHATSNEW_RSS_AUTO","Descoberta automática da URL RSS");
define("_WHATSNEW_ATOM_AUTO","Descoberta automática da URL ATOM");

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

define('_WHATSNEW_AUTO', 'Descoberta automática');
define('_WHATSNEW_SET', 'Especificação');

define('_WHATSNEW_ERROR_CONNCET', 'Não foi possível conectar');
define('_WHATSNEW_ERROR_PARSE', 'Não foi possível analisar');
define('_WHATSNEW_ERROR_RSS_AUTO', 'Não foi possível a descoberta automática do RSS');
define('_WHATSNEW_ERROR_RSS_GET', 'Não foi possível obter o RSS');
define('_WHATSNEW_ERROR_ATOM_AUTO', 'Não foi possível a descoberta automática do ATOM');
define('_WHATSNEW_ERROR_ATOM_GET', 'Não foi possível obter o ATOM');

// 2005-10-10
define('_WHATSNEW_MAIN_PAGE', 'Página Principal');
define('_WHATSNEW_RSS_PERM', 'Usuários registrados não podem ler os ATOM/RSS/RDF<br />Por favor, efetue o logout e leia no modo anônimo');

// 2007-05-12
define('_WHATSNEW_RDF_AUTO','Descoberta automática da URL do RDF');

// 2007-10-10
// cache
define('_WHATSNEW_CACHED_TIME','Momento que o cache foi criado');
define('_WHATSNEW_REFRESH_CACHE','Atualizar o cache');

}
// --- define language end ---

?>
