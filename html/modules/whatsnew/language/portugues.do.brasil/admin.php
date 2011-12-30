<?php
// $Id: admin.php,v 1.1 2011/12/30 21:45:46 ohwada Exp $

// 2007-12-09 K.OHWADA
// remove _WHATSNEW_SITE_TAG

// 2007-12-01 K.OHWADA
// view
// _WHATSNEW_BLOCK_MODULE => _AM_WHATSNEW_CONF_BLOCK_MODULE_ORDER

// 2007-10-10 K.OHWADA
// banner cache_time

// 2007-06-01 K.OHWADA
// mistake to remove _WHATSNEW_NEW_IMAGE_WIDTH

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
// Language pack for English
// 2005-06-06 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WHATSNEW_LANG_AM_LOADED') ) 
{

define('WHATSNEW_LANG_AM_LOADED', 1);

// use $xoopsModule
//define('_WHATSNEW_NAME','What's New');

// use blocks.php
//define('_WHATSNEW_ADMIN_DESC','This module collecte all latest reports from two or more modules, and show it in one block, and show it RSS and ATOM format.');
//define('_WHATSNEW_MENU_CONFIG','Preferences');
//define('_WHATSNEW_MENU_PING','Send of weblog update ping');
//define('_WHATSNEW_MENU_RSS','Refresf of RSS');
//define('_WHATSNEW_MENU_ATOM','Refresh of ATOM');
//define('_WHATSNEW_MENU_RDF','Refresh of RDF');
//define('_WHATSNEW_GOTO_WHATNEW','Goto Module');

// config
define('_WHATSNEW_MID','ID');
define('_WHATSNEW_MNAME','Nome do m�dulo');
define('_WHATSNEW_MDIR','Nome do diret�rio');
define('_WHATSNEW_NEW','Novo bloco Novidades');
define('_WHATSNEW_RSS','RSS/ATOM');
define('_WHATSNEW_ITEM','Item');
define('_WHATSNEW_LIMIT_SHOW','N�mero de artigos');
define('_WHATSNEW_LIMIT_SUMMARY','N�mero de sumario mostrado');
define('_WHATSNEW_MAX_SUMMARY','N�mero m�ximo de caractares do sum�rio');
define('_WHATSNEW_NEW_IMAGE','Mostrar imagem');
define('_WHATSNEW_NEW_PING','Enviar ping');

//define('_WHATSNEW_SITE_NAME','Site name');
//define('_WHATSNEW_SITE_NAME_DESC','Requirement for RSS/ATOM');
//define('_WHATSNEW_SITE_URL','Site URL');
//define('_WHATSNEW_SITE_URL_DESC','Requirement for RSS/ATOM');
//define('_WHATSNEW_SITE_DESC','Description of site');
//define('_WHATSNEW_SITE_DESC_DESC','Requirement for RSS');
//define('_WHATSNEW_SITE_AUTHOR','Webmaster');
//define('_WHATSNEW_SITE_AUTHOR_DESC','Requirement for ATOM');
//define('_WHATSNEW_SITE_EMAIL','Email of Webmaster');
//define('_WHATSNEW_SITE_EMAIL_DESC','Option for RSS/ATOM');
//define('_WHATSNEW_SITE_LOGO','Logo images of site');
//define('_WHATSNEW_SITE_LOGO_DESC','Option for RSS');

define('_WHATSNEW_PING_SERVERS','Lista de servidores Ping');
define('_WHATSNEW_PING_PASS','Senha do update_ping.php');
define('_WHATSNEW_PING_LOG','Log do envio do Ping');

//define('_WHATSNEW_SAVE','SAVE');
//define('_WHATSNEW_DELETE','DELETE');
//define('_WHATSNEW_CONFIG_SAVED','Saved config table');
//define('_WHATSNEW_WARNING_NOT_WRITABLE','Not writable for cache derectory');

// not use config file
//define('_WHATSNEW_CONFIG_DELETED','Deleted config file');
//define('_WHATSNEW_WARNING_NOT_EXIST','Not exist of config file');
//define('_WHATSNEW_ERROR_CONFIG','Error in config file');
//define('_WHATSNEW_ERROR_SITE_NAME','no site name');
//define('_WHATSNEW_ERROR_SITE_URL','No site url');
//define('_WHATSNEW_ERROR_SITE_DESC','No site description');
//define('_WHATSNEW_ERROR_SITE_AUTHOR','No webmaster');
//define('_WHATSNEW_ERROR_NEW_MAX_SUMMARY','Not correct of chars of summary in Whats New Block');
//define('_WHATSNEW_ERROR_RSS_MAX_SUMMARY','Not correct chars of summary in RSS/ATOM');

// ping
define('_WHATSNEW_PING_DETAIL','Mostrar detalhe das informa��es');
define('_WHATSNEW_PING','Enviar Ping');
define('_WHATSNEW_PING_SENDED','Ping Enviado');

// 2005-06-06
define('_WHATSNEW_SYSTEM_COMMENT','Coment�rios');

// 2005-06-20
define('_WHATSNEW_NEW_IMAGE_WIDTH','Largura m�xima do tamanho da imagem');
define('_WHATSNEW_NEW_IMAGE_HEIGHT','Altura m�xima do tamanho da imagem');
define('_WHATSNEW_NEW_IMAGE_SIZE_NOT_SAVE','Tamanho m�ximo da imagem N�O salva');

//define('_WHATSNEW_VIEW_RSS','Debug view of RSS');
//define('_WHATSNEW_VIEW_RDF','Debug view of RDF');
//define('_WHATSNEW_VIEW_ATOM','Debug view of ATOM');
//define('_WHATSNEW_MENU_PDA','View of PDA');

// 2005-10-01
//define('_WHATSNEW_SYSTEM_GROUPS','System Groups');
//define('_WHATSNEW_SYSTEM_BLOCKS','System Blocks');
define('_WHATSNEW_VIEW_DOCS','Manual');
define('_WHATSNEW_CONFIG_BLOCK','Bloco de Novidades e configura��o do RSS/ATOM');
define('_WHATSNEW_CONFIG_MAIN','Configura��o da p�gina principal');
define('_WHATSNEW_CONFIG_SITE','Configura��o das informa��es do site');
define('_WHATSNEW_CONFIG_PING','Configura��o do Ping');
define('_WHATSNEW_GOTO_MENU_PING','Retornar ao envio de Ping');

// index
//define('_WHATSNEW_INIT_NOT','Not initialize Config table');
//define('_WHATSNEW_INIT_EXEC','Initialize Config table');
//define('_WHATSNEW_VERSION_NOT','Not Version %s');
//define('_WHATSNEW_UPGRADE_EXEC','Upgrade Config table');

define('_WHATSNEW_NOTICE','Aviso');
define('_WHATSNEW_NOTICE_PERM','Usu�rios an�nimos n�o tem permiss�o de leitura do m�dulo Novidades<br />Qualquer um n�o pode ler RSS ou ATOM');
define('_WHATSNEW_NOTICE_BOTH',"Existem plugins There are plugins em ambos os m�dulos e no m�dulo de Novidades<br />Os pluging dos m�dulos s�o usados prioritariamente.<br />Mostrar o nome do diret�rio em <span style='color:#ff0000;'>RED</span> <br />Por favor, delete aquele mais antigo<br />");

//define('_WHATSNEW_NOTE_RSS_MARK','The mark <b>#</b> in RSS/ATOM means that anonymous have the permission to read each module<br />Someone have permission to read this WhatsNew module can read RSS or ATOM<br />');

define('_WHATSNEW_ICON_LIST','Lista de icones');

// config item
define('_WHATSNEW_WEIGHT','Peso');
define('_WHATSNEW_MIN_SHOW','N�mero m�nimo de artigos mostrados em cada m�dulo');
define('_WHATSNEW_BLOCK_ICON','Icone padr�o');

// conflit to blocks.php
//define('_WHATSNEW_BLOCK_MODULE','Showing order of modules');

define('_WHATSNEW_BLOCK_MODULE_0','Mais Recente');
define('_WHATSNEW_BLOCK_MODULE_1','Peso');
define('_WHATSNEW_BLOCK_SUMMARY_HTML','Permitir Html no sum�rio');
define('_WHATSNEW_BLOCK_MAX_TITLE','N�mero m�ximo de caracteres no t�tulo');

//define('_WHATSNEW_SITE_TAG','Site tag');
//define('_WHATSNEW_SITE_IMAGE_URL','URL of site logo');
//define('_WHATSNEW_SITE_IMAGE_WIDTH','Width of site logo');
//define('_WHATSNEW_SITE_IMAGE_HEIGHT','Height of site logo');

define('_WHATSNEW_MAIN_TPL',"Modelo da p�gina principal");
define('_WHATSNEW_MAIN_TPL_0','Como o m�dulo Novidades');
define('_WHATSNEW_MAIN_TPL_1','Como o BopComments');

// --- 2006-06-18 ---
define('_WHATSNEW_CONFIG_RSS', 'Configura��o da contru��o do RDF/RSS/ATOM');

//define('_WHATSNEW_RSS_PERMIT_USER', 'Permit user to show RSS feed');
//define('_WHATSNEW_RSS_PERMIT_USER_DESC', 'Anoymous user can show RSS feed always');

// --- 2006-06-25 ---
define('_WHATSNEW_PLUGIN', 'Plugin');
define('_WHATSNEW_MOD_VERSION', 'Vers�o');
define('_WHATSNEW_NOTICE_PLURAL','Existe mais de um plugins em um m�dulo<br />Por favor, selecione o plugin apropriado<br />');

// --- 2007-05-12 ---
define('_WHATSNEW_NOTICE_IMAGE_SIZE', 'um aviso � mostrado no XOOPS logo.gif quando � checado se o tamanho de uma imagem est� de acordo com a especifica��o. <br />Este valor ser� admiss�vel.');

// --- 2007-10-10 ---
// banner
define('_WHATSNEW_BANNER_FLAG',   'Mostrar a imagem do banner');
define('_WHATSNEW_BANNER_WIDTH',  'Largura m�xima do tamanho do banner');
define('_WHATSNEW_BANNER_HEIGHT', 'Altura m�xima do tamanho do banner');


// --- 2007-11-24 ---
// view
define('_AM_WHATSNEW_CONFIG_VIEW','Configura��o do estilo de vizualiza��o');
define('_AM_WHATSNEW_CONF_NEWDAY_DAYS','Dias para ser considerado como "NOVO" ');
define('_AM_WHATSNEW_CONF_NEWDAY_STRINGS','Strings do "NOVO" ');
define('_AM_WHATSNEW_CONF_NEWDAY_STYLE','Estilo do "NOVO" ');
define('_AM_WHATSNEW_CONF_TODAY_HOURS','Horas para ser considerado como "HOJE" ');
define('_AM_WHATSNEW_CONF_TODAY_STRINGS','Strings do "HOJE" ');
define('_AM_WHATSNEW_CONF_TODAY_STYLE','Estilo do "HOJE" ');

// main block
define('_AM_WHATSNEW_CONFIG_MAIN_BLOCK','Configura��o da p�gina principal, blocos e RSS');
define('_AM_WHATSNEW_MAIN','P�gina Principal');
define('_AM_WHATSNEW_CONF_NEWDAY','Mostrar "NOVO" ');
define('_AM_WHATSNEW_CONF_TODAY','Mostrar "HOJE" ');
define('_AM_WHATSNEW_CONF_TODAY_DSC', 'Quando "N�o", a configura��o do "NOVO" torna-se v�lida.');
define('_AM_WHATSNEW_CONF_DATE_STRINGS','Formato da data');
define('_AM_WHATSNEW_CONF_DATE_STRINGS_DSC','Refer�ncia <a href="http://www.php.net/manual/en/function.date.php" target="_blank">Fun��o data do PHP</a>');

// permission
define('_AM_WHATSNEW_CONFIG_PERM','Configura��o da permiss�o de acesso');
define('_AM_WHATSNEW_CONFIG_PERM_DSC','configura para mostrar ou n�o o item do m�dulo o qual o usu�rio n�o tem permiss�o de acesso.');
define('_AM_WHATSNEW_CONF_PERM_MODULE','Mostrar o m�dulo o qual o usu�rio n�o tem permiss�o de acesso');
define('_AM_WHATSNEW_CONF_PERM_MODULE_DSC','Quando "Mostrar", as configura��es seguintes tornam-se v�lidas.');
define('_AM_WHATSNEW_CONF_PERM_NOT_SHOW','N�o mostrar');
define('_AM_WHATSNEW_CONF_PERM_SHOW','Mostrar');
define('_AM_WHATSNEW_CONF_PERM_DIRNAME','Nome do diretorio');
define('_AM_WHATSNEW_CONF_PERM_MOD_NAME','Nome do m�dulo');
define('_AM_WHATSNEW_CONF_PERM_MOD_LINK','Link para o m�dulo');
define('_AM_WHATSNEW_CONF_PERM_MOD_ICON','�cone do m�dulo');
define('_AM_WHATSNEW_CONF_PERM_CAT_NAME','Nome da categoria');
define('_AM_WHATSNEW_CONF_PERM_CAT_LINK','Link para a categoria');
define('_AM_WHATSNEW_CONF_PERM_TITLE','T�tulo do artigo');
define('_AM_WHATSNEW_CONF_PERM_LINK','Link para o artigo');
define('_AM_WHATSNEW_CONF_PERM_SUMMARY','Sum�rio');
define('_AM_WHATSNEW_CONF_PERM_IMAGE','Imagem');
define('_AM_WHATSNEW_CONF_PERM_BANNER','Banner');

define('_AM_WHATSNEW_PERM','Permitir');
define('_AM_WHATSNEW_PERM_DSC','#1 Permitir mostrar o m�dulo o qual o convidado n�o tem permiss�o de acesso');
define('_AM_WHATSNEW_CONF_BLOCK_MODULE_ORDER','Mostrando a ordem de cada bloco do m�dulo');

}
// --- define language end ---

?>
