<?php
// $Id: whatsnew_auto_rss.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2005-09-29 K.OHWADA
// change rss_auto.php to class

//=========================================================
// What's New Module
// class RSS auto discovery
// 2005-09-29 K.OHWADA
//=========================================================

class Whatsnew_Auto_Rss extends Whatsnew_Auto_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Auto_Rss()
{
	Whatsnew_Auto_Base::Whatsnew_Auto_Base();

	$this->TEMPLATE     = 'db:whatsnew_rss_view.html';
	$this->MSG_ERR_AUTO = _WHATSNEW_ERROR_RSS_AUTO;
	$this->MSG_ERR_GET  = _WHATSNEW_ERROR_RSS_GET;

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Auto_Rss();
	}

	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_url_rss_auto($data_html)
{
	list($url_rss, $url_atom) = $this->get_rss_atom_link($data_html);
	return $url_rss;
}

function parse($data)
{

	$this->class_parser = new XoopsXmlRss2Parser($data);
	return $this->class_parser->parse();
}

function get_parse_error()
{
	return $this->class_parser->getErrors(false);
}

function show_feeds()
{
	$channel_data = $this->class_lang->convert_array_from_utf8( $this->class_parser->getChannelData() );
	$image_data   = $this->class_lang->convert_array_from_utf8( $this->class_parser->getImageData() );
	$items        = $this->class_lang->convert_array_array_from_utf8( $this->class_parser->getItems() );

	$tpl = new XoopsTpl();
	$tpl->assign_by_ref('channel', $channel_data);
	$tpl->assign_by_ref('image',   $image_data);

	$tpl->assign(
		array(
			'lang_lastbuild'   => _WHATSNEW_LASTBUILD,
			'lang_language'    => _WHATSNEW_LANGUAGE,
			'lang_description' => _WHATSNEW_DESCRIPTION,
			'lang_webmaster'   => _WHATSNEW_WEBMASTER,
			'lang_category'    => _WHATSNEW_CATEGORY,
			'lang_generator'   => _WHATSNEW_GENERATOR,
			'lang_title'       => _WHATSNEW_TITLE,
			'lang_pubdate'     => _WHATSNEW_PUBDATE,
			'lang_description' => _WHATSNEW_DESCRIPTION,
			'lang_more'        => _MORE
		));

	$count = count($items);
	for ($i = 0; $i < $count; $i++)
	{
		$tpl->append_by_ref('items', $items[$i]);
	}

	echo $tpl->fetch($this->TEMPLATE);
}


// --- class end ---
}

?>