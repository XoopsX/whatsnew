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
define('_WHATSNEW_MNAME','Nome do módulo');
define('_WHATSNEW_MDIR','Nome do diretório');
define('_WHATSNEW_NEW','Novo bloco Novidades');
define('_WHATSNEW_RSS','RSS/ATOM');
define('_WHATSNEW_ITEM','Item');
define('_WHATSNEW_LIMIT_SHOW','Número de artigos');
define('_WHATSNEW_LIMIT_SUMMARY','Número de sumario mostrado');
define('_WHATSNEW_MAX_SUMMARY','Número máximo de caractares do sumário');
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
define('_WHATSNEW_PING_DETAIL','Mostrar detalhe das informações');
define('_WHATSNEW_PING','Enviar Ping');
define('_WHATSNEW_PING_SENDED','Ping Enviado');

// 2005-06-06
define('_WHATSNEW_SYSTEM_COMMENT','Comentários');

// 2005-06-20
define('_WHATSNEW_NEW_IMAGE_WIDTH','Largura máxima do tamanho da imagem');
define('_WHATSNEW_NEW_IMAGE_HEIGHT','Altura máxima do tamanho da imagem');
define('_WHATSNEW_NEW_IMAGE_SIZE_NOT_SAVE','Tamanho máximo da imagem NÃO salva');

//define('_WHATSNEW_VIEW_RSS','Debug view of RSS');
//define('_WHATSNEW_VIEW_RDF','Debug view of RDF');
//define('_WHATSNEW_VIEW_ATOM','Debug view of ATOM');
//define('_WHATSNEW_MENU_PDA','View of PDA');

// 2005-10-01
//define('_WHATSNEW_SYSTEM_GROUPS','System Groups');
//define('_WHATSNEW_SYSTEM_BLOCKS','System Blocks');
define('_WHATSNEW_VIEW_DOCS','Manual');
define('_WHATSNEW_CONFIG_BLOCK','Bloco de Novidades e configuração do RSS/ATOM');
define('_WHATSNEW_CONFIG_MAIN','Configuração da página principal');
define('_WHATSNEW_CONFIG_SITE','Configuração das informações do site');
define('_WHATSNEW_CONFIG_PING','Configuração do Ping');
define('_WHATSNEW_GOTO_MENU_PING','Retornar ao envio de Ping');

// index
//define('_WHATSNEW_INIT_NOT','Not initialize Config table');
//define('_WHATSNEW_INIT_EXEC','Initialize Config table');
//define('_WHATSNEW_VERSION_NOT','Not Version %s');
//define('_WHATSNEW_UPGRADE_EXEC','Upgrade Config table');

define('_WHATSNEW_NOTICE','Aviso');
define('_WHATSNEW_NOTICE_PERM','Usuários anônimos não tem permissão de leitura do módulo Novidades<br />Qualquer um não pode ler RSS ou ATOM');
define('_WHATSNEW_NOTICE_BOTH',"Existem plugins There are plugins em ambos os módulos e no módulo de Novidades<br />Os pluging dos módulos são usados prioritariamente.<br />Mostrar o nome do diretório em <span style='color:#ff0000;'>RED</span> <br />Por favor, delete aquele mais antigo<br />");

//define('_WHATSNEW_NOTE_RSS_MARK','The mark <b>#</b> in RSS/ATOM means that anonymous have the permission to read each module<br />Someone have permission to read this WhatsNew module can read RSS or ATOM<br />');

define('_WHATSNEW_ICON_LIST','Lista de icones');

// config item
define('_WHATSNEW_WEIGHT','Peso');
define('_WHATSNEW_MIN_SHOW','Número mínimo de artigos mostrados em cada módulo');
define('_WHATSNEW_BLOCK_ICON','Icone padrão');

// conflit to blocks.php
//define('_WHATSNEW_BLOCK_MODULE','Showing order of modules');

define('_WHATSNEW_BLOCK_MODULE_0','Mais Recente');
define('_WHATSNEW_BLOCK_MODULE_1','Peso');
define('_WHATSNEW_BLOCK_SUMMARY_HTML','Permitir Html no sumário');
define('_WHATSNEW_BLOCK_MAX_TITLE','Número máximo de caracteres no título');

//define('_WHATSNEW_SITE_TAG','Site tag');
//define('_WHATSNEW_SITE_IMAGE_URL','URL of site logo');
//define('_WHATSNEW_SITE_IMAGE_WIDTH','Width of site logo');
//define('_WHATSNEW_SITE_IMAGE_HEIGHT','Height of site logo');

define('_WHATSNEW_MAIN_TPL',"Modelo da página principal");
define('_WHATSNEW_MAIN_TPL_0','Como o módulo Novidades');
define('_WHATSNEW_MAIN_TPL_1','Como o BopComments');

// --- 2006-06-18 ---
define('_WHATSNEW_CONFIG_RSS', 'Configuração da contrução do RDF/RSS/ATOM');

//define('_WHATSNEW_RSS_PERMIT_USER', 'Permit user to show RSS feed');
//define('_WHATSNEW_RSS_PERMIT_USER_DESC', 'Anoymous user can show RSS feed always');

// --- 2006-06-25 ---
define('_WHATSNEW_PLUGIN', 'Plugin');
define('_WHATSNEW_MOD_VERSION', 'Versão');
define('_WHATSNEW_NOTICE_PLURAL','Existe mais de um plugins em um módulo<br />Por favor, selecione o plugin apropriado<br />');

// --- 2007-05-12 ---
define('_WHATSNEW_NOTICE_IMAGE_SIZE', 'um aviso é mostrado no XOOPS logo.gif quando é checado se o tamanho de uma imagem está de acordo com a especificação. <br />Este valor será admissível.');

// --- 2007-10-10 ---
// banner
define('_WHATSNEW_BANNER_FLAG',   'Mostrar a imagem do banner');
define('_WHATSNEW_BANNER_WIDTH',  'Largura máxima do tamanho do banner');
define('_WHATSNEW_BANNER_HEIGHT', 'Altura máxima do tamanho do banner');


// --- 2007-11-24 ---
// view
define('_AM_WHATSNEW_CONFIG_VIEW','Configuração do estilo de vizualização');
define('_AM_WHATSNEW_CONF_NEWDAY_DAYS','Dias para ser considerado como "NOVO" ');
define('_AM_WHATSNEW_CONF_NEWDAY_STRINGS','Strings do "NOVO" ');
define('_AM_WHATSNEW_CONF_NEWDAY_STYLE','Estilo do "NOVO" ');
define('_AM_WHATSNEW_CONF_TODAY_HOURS','Horas para ser considerado como "HOJE" ');
define('_AM_WHATSNEW_CONF_TODAY_STRINGS','Strings do "HOJE" ');
define('_AM_WHATSNEW_CONF_TODAY_STYLE','Estilo do "HOJE" ');

// main block
define('_AM_WHATSNEW_CONFIG_MAIN_BLOCK','Configuração da página principal, blocos e RSS');
define('_AM_WHATSNEW_MAIN','Página Principal');
define('_AM_WHATSNEW_CONF_NEWDAY','Mostrar "NOVO" ');
define('_AM_WHATSNEW_CONF_TODAY','Mostrar "HOJE" ');
define('_AM_WHATSNEW_CONF_TODAY_DSC', 'Quando "Não", a configuração do "NOVO" torna-se válida.');
define('_AM_WHATSNEW_CONF_DATE_STRINGS','Formato da data');
define('_AM_WHATSNEW_CONF_DATE_STRINGS_DSC','Referência <a href="http://www.php.net/manual/en/function.date.php" target="_blank">Função data do PHP</a>');

// permission
define('_AM_WHATSNEW_CONFIG_PERM','Configuração da permissão de acesso');
define('_AM_WHATSNEW_CONFIG_PERM_DSC','configura para mostrar ou não o item do módulo o qual o usuário não tem permissão de acesso.');
define('_AM_WHATSNEW_CONF_PERM_MODULE','Mostrar o módulo o qual o usuário não tem permissão de acesso');
define('_AM_WHATSNEW_CONF_PERM_MODULE_DSC','Quando "Mostrar", as configurações seguintes tornam-se válidas.');
define('_AM_WHATSNEW_CONF_PERM_NOT_SHOW','Não mostrar');
define('_AM_WHATSNEW_CONF_PERM_SHOW','Mostrar');
define('_AM_WHATSNEW_CONF_PERM_DIRNAME','Nome do diretorio');
define('_AM_WHATSNEW_CONF_PERM_MOD_NAME','Nome do módulo');
define('_AM_WHATSNEW_CONF_PERM_MOD_LINK','Link para o módulo');
define('_AM_WHATSNEW_CONF_PERM_MOD_ICON','Ícone do módulo');
define('_AM_WHATSNEW_CONF_PERM_CAT_NAME','Nome da categoria');
define('_AM_WHATSNEW_CONF_PERM_CAT_LINK','Link para a categoria');
define('_AM_WHATSNEW_CONF_PERM_TITLE','Título do artigo');
define('_AM_WHATSNEW_CONF_PERM_LINK','Link para o artigo');
define('_AM_WHATSNEW_CONF_PERM_SUMMARY','Sumário');
define('_AM_WHATSNEW_CONF_PERM_IMAGE','Imagem');
define('_AM_WHATSNEW_CONF_PERM_BANNER','Banner');

define('_AM_WHATSNEW_PERM','Permitir');
define('_AM_WHATSNEW_PERM_DSC','#1 Permitir mostrar o módulo o qual o convidado não tem permissão de acesso');
define('_AM_WHATSNEW_CONF_BLOCK_MODULE_ORDER','Mostrando a ordem de cada bloco do módulo');

}
// --- define language end ---

?>
