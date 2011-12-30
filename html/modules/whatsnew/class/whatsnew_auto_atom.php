<?php
// $Id: whatsnew_auto_atom.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2005-10-14 K.OHWADA
// ATOM 1.0

// 2005-09-29 K.OHWADA
// change atom_auto.php to class

//=========================================================
// What's New Module
// class ATOM auto discovery
// 2005-09-29 K.OHWADA
//=========================================================

class Whatsnew_Auto_Atom extends Whatsnew_Auto_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Auto_Atom()
{
	Whatsnew_Auto_Base::Whatsnew_Auto_Base();

	$this->TEMPLATE     = 'db:whatsnew_atom_view.html';
	$this->MSG_ERR_AUTO = _WHATSNEW_ERROR_ATOM_AUTO;
	$this->MSG_ERR_GET  = _WHATSNEW_ERROR_ATOM_GET;

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Auto_Atom();
	}

	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_url_rss_auto($data_html)
{
	list($url_rss, $url_atom) = $this->get_rss_atom_link($data_html);
	return $url_atom;
}

function parse($data)
{
	$this->class_parser =& Whatsnew_Atom_Parser::getInstance();
	$ret = $this->class_parser->parse_data($data);

	if ($ret) 
	{
		return false;
	}

	return true;
}

function get_parse_error()
{
	return $this->class_parser->get_error();
}

function show_feeds()
{
	$feed   = $this->class_lang->convert_array_from_utf8( $this->class_parser->get_feed() );
	$entrys = $this->class_lang->convert_array_array_from_utf8( $this->class_parser->get_entrys() );

	$tpl = new XoopsTpl();
	$tpl->assign_by_ref('feed', $feed);

	$tpl->assign(
		array(
			'lang_id'           => _WHATSNEW_ID,
			'lang_updated'      => _WHATSNEW_MODIFIED,
			'lang_published'    => _WHATSNEW_ISSUED,
			'lang_generator'    => _WHATSNEW_GENERATOR,
			'lang_copyright'    => _WHATSNEW_COPYRIGHT,
			'lang_title'        => _WHATSNEW_TITLE,
			'lang_category'     => _WHATSNEW_CATEGORY,
			'lang_summary'      => _WHATSNEW_SUMMARY,
			'lang_content'      => _WHATSNEW_CONTENT,
			'lang_author_name'  => _WHATSNEW_AUTHOR_NAME,
			'lang_author_url'   => _WHATSNEW_AUTHOR_URL,
			'lang_author_email' => _WHATSNEW_AUTHOR_EMAIL,
			'lang_more'         => _MORE
		));

	$count = count($entrys);
	for ($i = 0; $i < $count; $i++)
	{
		$tpl->append_by_ref('entrys', $entrys[$i]);
	}

	echo $tpl->fetch($this->TEMPLATE);
}


// --- class end ---
}

?>