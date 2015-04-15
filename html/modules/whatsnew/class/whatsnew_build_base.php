<?php
// $Id: whatsnew_build_base.php,v 1.1 2011/12/30 21:45:54 ohwada Exp $

// 2006-06-20 K.OHWADA
// REQ 3873: login user can read RSS.
// add is_permit_show() is_use_cache()

// 2006-01-27 K.OHWADA
// REQ 3509: put into spacing in a summary

// 2005-11-16 K.OHWADA
// BUG 3193: error occur in kernel/user.php, if uid is null

// 2005-09-28 K.OHWADA
// change function to class

//=========================================================
// What's New Module
// class builder base
// 2005-09-28 K.OHWADA
//=========================================================

class Whatsnew_Build_Base
{
// constant
	var $MODULE_ID_DEFUALT = 1;
	var $HEADER;
	var $TEMPLATE;
	var $TITLE_VIEW;

	var $FLAG_XML_UNDO_XOOPS_CHAR = 1;	// undo XOOPS htmlSpcialChars
	var $FLAG_XML_STRIP_CONTROL   = 1;
	var $FLAG_XML_STRIP_CRLF      = 1;
	var $FLAG_XML_STRIP_STYLE     = 1;
	var $FLAG_XML_STRIP_SPACE     = 1;
	var $FLAG_XML_ADD_SPACE       = 1;

	var $FLAG_UTF8_STRIP_CONTROL  = 1;

	var $USE_CACHE_GUEST   = true;
	var $USE_CACHE_USER    = false;
	var $PERMIT_SHOW_GUEST = true;

// class
	var $_class_block;
	var $_class_lang;
	var $_myts;

// variable
	var $_config_data;
	var $_cache_time;
	var $_flag_debug;
	var $_count_line = 1;

	var $_is_user = false;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Build_Base()
{
// constant
	$this->HEADER      = "Content-Type:text/xml; charset=utf-8";

// dummy
	$this->TEMPLATE    = "db:whatsnew_rss.html";
	$this->TITLE_VIEW  = "Whats New RSS";

// class
	$this->_class_block =& Whatsnew_Show_Block::getInstance();
	$this->_class_lang  =& Whatsnew_Lang_Conv::getInstance();
	$this->_myts        =& MyTextSanitizer::getInstance();

// variable
	$this->set_cache_time(0);	// no cache
	$this->set_flag_debug(0);

	$config = $this->get_config_data();

	$this->_set_is_user();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Build_Base();
	}

	return $instance;
}

function _set_is_user()
{
	global $xoopsUser;

	if ( is_object($xoopsUser) )
	{
		$this->_is_user = true;
	}
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function build()
{
// no output encode
	if (function_exists('mb_http_output')) 
	{	mb_http_output('pass');	}

	header($this->HEADER);

	$tpl = new XoopsTpl();

// use cached data
	if ( $this->is_use_cache() )
	{
		$tpl->xoops_setCaching(2);
		$tpl->xoops_setCacheTime($this->_cache_time);
	}

// build new data
	if ( !$this->is_use_cache() || !$tpl->is_cached($this->TEMPLATE) ) 
	{
		$this->assign( $tpl, $this->get_article() );
	}

	$tpl->display($this->TEMPLATE);
}

function view()
{
	header ('Content-Type:text/html; charset=utf-8');

	if ( empty($this->TEMPLATE) )
	{
		echo "<font color='red'>No Template</font><br />\n";
		return;
	}

	$tpl = new XoopsTpl();

	$this->assign( $tpl, $this->get_article() );

	$xml  = $tpl->fetch($this->TEMPLATE);
	$body = $this->_class_block->_html_special_chars( $xml );

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->TITLE_VIEW; ?></title>
</head>
<body>
<pre>
<?php echo $body; ?>
</pre>
</body>
</html>
<?php

}

function clear()
{
	$tpl = new XoopsTpl();
	$tpl->clear_cache($this->TEMPLATE);
}

// --------------------------------------------------------
// set param
// --------------------------------------------------------
function set_cache_time($value)
{
	$this->_cache_time = intval($value);
}

function set_flag_debug($value=0)
{
	$this->_flag_debug = intval($value);
}

// --------------------------------------------------------
// is_use_cache
// --------------------------------------------------------
function is_use_cache()
{
	if ( $this->_cache_time > 0 )
	{
		if ( !$this->_is_user && $this->USE_CACHE_GUEST )
		{
			return true;
		}

		if ( $this->_is_user && $this->USE_CACHE_USER )
		{
			return true;
		}
	}

	return false;
}

// --------------------------------------------------------
// is_permit_show
// REQ 3873: login user can read RSS.
// --------------------------------------------------------
function is_permit_show()
{
	if ( !$this->_is_user && $this->PERMIT_SHOW_GUEST )
	{
		return true;
	}

	if ( $this->_is_user && $this->_config_data['rss_permit_user'] )
	{
		return true;
	}

	if ( $this->_flag_debug )
	{
		return true;
	}

	return false;
}

// --------------------------------------------------------
// make rss channel
// --------------------------------------------------------
function make_rss_channel()
{
	$site_email        = '';
	$site_image_url    = '';
	$site_image_width  = '';
	$site_image_height = '';

	if ( isset($this->_config_data['site_email']) && $this->_config_data['site_email'] )
	{
		$site_email = $this->_config_data['site_email'];
	}

	if ( isset($this->_config_data['site_image_url']) && $this->_config_data['site_image_url'] )
	{
		$site_image_url    = $this->_config_data['site_image_url'];
		$site_image_width  = intval( $this->_config_data['site_image_width'] );
		$site_image_height = intval( $this->_config_data['site_image_height'] );
	}

// site tag
	$site_tag    = $this->_config_data['site_tag'];
	$site_author = $this->_config_data['site_author'];
	$year        = date("Y");
	$copyright   = "Copyright (c) $year, $site_author";
	$feed_id     = "tag:$site_tag,$year://1";

// sanitaize
	$site_url       = $this->xml_htmlspecialchars_url( $this->_config_data['site_url'] );
	$site_image_url = $this->xml_htmlspecialchars_url( $site_image_url );
	$site_name   = $this->xml_htmlspecialchars_strict( $this->_config_data['site_name'] );
	$site_desc   = $this->xml_htmlspecialchars_strict( $this->_config_data['site_desc'] );
	$site_author = $this->xml_htmlspecialchars_strict( $site_author );
	$site_email  = $this->xml_htmlspecialchars_strict( $site_email );
	$copyright   = $this->xml_htmlspecialchars_strict( $copyright );
	$feed_id     = $this->xml_htmlspecialchars_strict( $feed_id );

	$ret = array(
		'site_url'          => $this->convert_to_utf8( $site_url ),
		'site_image_url'    => $this->convert_to_utf8( $site_image_url ),
		'site_name'         => $this->convert_to_utf8( $site_name ),
		'site_desc'         => $this->convert_to_utf8( $site_desc ),
		'site_author'       => $this->convert_to_utf8( $site_author ),
		'site_email'        => $this->convert_to_utf8( $site_email ),
		'site_image_width'  => $this->convert_to_utf8( $site_image_width ),
		'site_image_height' => $this->convert_to_utf8( $site_image_height ),
		'site_copyright'    => $this->convert_to_utf8( $copyright ),
		'site_id'           => $this->convert_to_utf8( $feed_id ),
	);

	return $ret;
}

// --------------------------------------------------------
// make rss line
// --------------------------------------------------------
function make_rss_line( $article )
{
	if ( isset($article['modified']) )
	{
		$updated = $article['modified'];
	}
	elseif( isset($article['time']) )
	{
		$updated = $article['time'];
	}
	else
	{
		$updated = time();
	}

	if ( isset($article['issued']) )
	{
		$published = $article['issued'];
	}
	else
	{
		$published = $updated;
	}

	$mid = '';
	$aid = '';
	if ( isset($article['mod_id']) )  $mid = $article['mod_id'];
	if ( isset($article['id']) )      $aid = $article['id'];
	if ( empty($mid) )  $mid = $this->MODULE_ID_DEFUALT;
	if ( empty($aid) )  $aid = $this->_count_line;
	$this->_count_line ++;

	$site_tag = $this->_config_data['site_tag'];
	$year     = date("Y");
	$atom_id  = "tag:$site_tag,$year://1.$mid.$aid";;

// BUG 3193: occure error in kernel/user.php, if uid is null
	$author_name = '';
	if ( isset($article['uid']) && $article['uid'] )
	{
		$uid = intval( $article['uid'] );

		if ( $uid > 0 )
		{
			$user = new xoopsUser( intval($article['uid']) );
			$author_name = $user->getvar('uname');
		}
	}

// title content 
	list($title_normal, $title_strip)       = $this->make_xml_title($article);
	list($content, $sum_normal, $sum_strip) = $this->make_xml_cont_sum($article);
	list($mod_name_normal, $mod_name_strip) = $this->make_xml_mod_name($article);

// sanitize
	$link        = $this->xml_htmlspecialchars_url( $article['link'] );
	$author_name = $this->xml_htmlspecialchars_strict( $author_name );
	$atom_id     = $this->xml_htmlspecialchars_strict( $atom_id );

	$ret = array(
		'unix_updated'   => $updated,  // unixtime
		'unix_published' => $published,    // unixtime
		'title_rss'      => $this->convert_to_utf8( $title_strip ),
		'title_atom'     => $this->convert_to_utf8( $title_normal ),
		'summary_rss'    => $this->convert_to_utf8( $sum_normal ),
		'summary_atom'   => $this->convert_to_utf8( $sum_normal ),
		'mod_name_rss'   => $this->convert_to_utf8( $mod_name_normal ),
		'mod_name_atom'  => $this->convert_to_utf8( $mod_name_normal ),
		'content'        => $this->convert_to_utf8( $content ),
		'link'           => $this->convert_to_utf8( $link ),
		'author_name'    => $this->convert_to_utf8( $author_name ),
		'atom_id'        => $this->convert_to_utf8( $atom_id ), 
	);

	return $ret;
}


// --------------------------------------------------------
// meke title
// --------------------------------------------------------
function make_xml_title($article)
{
	$title   = $article['title'];
	$title_1 = $this->xml_htmlspecialchars( $title );

	$title_2 = $this->_strip_html_entity_char( $title );
	$title_2 = $this->_strip_html_entity_numeric($title_2);
	$title_2 = $this->xml_htmlspecialchars($title_2);

	return array($title_1, $title_2);
}

// --------------------------------------------------------
// meke content & summary
// --------------------------------------------------------
function make_xml_cont_sum($article)
{
	if ( !isset($article['description']) )  return array('', '', '');

	$desc = $article['description'];

	if ($this->FLAG_XML_STRIP_CONTROL)
	{
		$desc = $this->_class_block->_strip_control_code($desc);
	}

	if ($this->FLAG_XML_UNDO_XOOPS_CHAR)
	{
		$desc = $this->_undo_html_special_chars($desc);
	}

	$sum = $desc;

	if ($this->FLAG_XML_STRIP_CRLF)
	{
		$sum = $this->_class_block->_strip_crlf($sum);
	}

	if ($this->FLAG_XML_STRIP_STYLE)
	{
		$sum = $this->_class_block->_strip_style_tag($sum);
	}

// REQ 3509: put into spacing in a summary
	if ($this->FLAG_XML_ADD_SPACE)
	{
		$sum = $this->_class_block->_add_space($sum);
	}

	$sum = strip_tags($sum);

	if ($this->FLAG_XML_STRIP_SPACE)
	{
		$sum = $this->_class_block->_strip_space($sum);
	}

	$sum = $this->_class_block->_shorten_text($sum, $this->_config_data['rss_max_summary'] );

	$sum_1 = $this->xml_htmlspecialchars($sum);

	$sum_2 = $this->_strip_html_entity_char($sum);
	$sum_2 = $this->_strip_html_entity_numeric($sum_2);
	$sum_2 = $this->xml_htmlspecialchars($sum_2);

// not sanitize
	$cont = $this->convert_cdata($desc);

	return array($cont, $sum_1, $sum_2);
}

// --------------------------------------------------------
// meke mod name
// --------------------------------------------------------
function make_xml_mod_name($article)
{
	if ( !isset($article['mod_name']) )  return '';

	$name   = $article['mod_name'];
	$name_1 = $this->xml_htmlspecialchars( $name );

	$name_2 = $this->_strip_html_entity_char( $name );
	$name_2 = $this->_strip_html_entity_numeric($name_2);
	$name_2 = $this->xml_htmlspecialchars($name_2);

	return array($name_1, $name_2);
}

// --------------------------------------------------------
// htmlspecialchars
// http://www.w3.org/TR/REC-xml/#dt-markup
// http://www.fxis.co.jp/xmlcafe/tmp/rec-xml.html#dt-markup
//   &  -> &amp;	// without html entity
//   <  -> &lt;
//   >  -> &gt;
//   "  -> &quot;
//   '  -> &apos;
// --------------------------------------------------------
function xml_htmlspecialchars($text)
{
	$text = htmlspecialchars($text);
	$text = preg_replace("/'/", '&apos;', $text);
	return $text;
}

function xml_htmlspecialchars_strict($text)
{
	$text = $this->_strip_html_entity_char($text);
	$text = $this->xml_htmlspecialchars($text);
	return $text;
}

function xml_htmlspecialchars_url($text)
{
	$text = preg_replace("/&amp;/sU", '&', $text);
	$text = $this->_strip_html_entity_char($text);
	$text = $this->xml_htmlspecialchars($text);
	return $text;
}

function convert_cdata($text)
{
	$text = preg_replace("/]]>/", ']]&gt;', $text);
	return $text;
}


// --------------------------------------------------------
// undo XOOPS HtmlSpecialChars
//   &lt;   -> <
//   &gt;   -> >
//   &quot; -> "
//   &#039; -> '
//   &amp;  -> &
//   &amp;nbsp; -> &nbsp;
// --------------------------------------------------------
function _undo_html_special_chars($text)
{
	$text = $this->_myts->undoHtmlSpecialChars($text);
	$text = preg_replace("/&amp;nbsp;/i", '&nbsp;', $text);
	return $text;
}

// --------------------------------------------------------
// undo html entities
//   &amp;abc;  -> &abc;
// --------------------------------------------------------
function _undo_html_entity_char($text)
{
	return preg_replace("/&amp;([0-9a-zA-z]+);/sU", '&\\1;', $text);
}

// --------------------------------------------------------
// undo html entities
//   &amp;#123; -> &#123;
// --------------------------------------------------------
function _undo_html_entity_numeric($text)
{
	return preg_replace("/&amp;#([0-9a-fA-F]+);/sU", '&#\\1;', $text);
}

// --------------------------------------------------------
// strip html entities
//   &abc; -> ' '
// --------------------------------------------------------
function _strip_html_entity_char($text)
{
	return preg_replace("/&[0-9a-zA-z]+;/sU", ' ', $text);
}

// --------------------------------------------------------
// strip html entities
//   &#123; -> ' '
// --------------------------------------------------------
function _strip_html_entity_numeric($text)
{
	return preg_replace("/&amp;#([0-9a-fA-F]+);/sU", '&#\\1;', $text);
}

//---------------------------------------------------------
// http://www.w3.org/TR/NOTE-datetime
// 2003-12-13T18:30:02+09:00
//
// http://www.php.net/manual/ja/function.date.php
// User Contributed Notes
//---------------------------------------------------------
function iso8601_date($time)
{
	$tzd  = date('O',$time);
	$tzd  = substr( chunk_split( $tzd, 3, ':' ), 0, 6 );
	$date = date('Y-m-d\TH:i:s', $time) . $tzd;
	return $date;
}

//-----------------------------------------------
// use class show block
//-----------------------------------------------
function &get_config_data()
{
	$this->_config_data =& $this->_class_block->get_config_data();
	return $this->_config_data;
}

//-----------------------------------------------
// use class lang
//-----------------------------------------------
function convert_to_utf8( $text )
{
	$text = $this->_class_lang->convert_to_utf8( $text );

	if ($this->FLAG_UTF8_STRIP_CONTROL)
	{
		$text = $this->_class_block->_strip_control_code( $text );
	}

	return $text;
}

//-----------------------------------------------
// over ride
//-----------------------------------------------
function get_article()
{
	return $this->_class_block->collect_block_date('rss');
}

function assign( &$tpl, $article_data )
{
// dummy
}

// --- class end ---
}

?>