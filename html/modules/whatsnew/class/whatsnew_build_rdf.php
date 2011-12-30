<?php
// $Id: whatsnew_build_rdf.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2006-06-20 K.OHWADA
// REQ 3873: login user can read RSS.

// 2005-09-28 K.OHWADA
// change func.rdf.php to class

//=========================================================
// What's New Module
// class RDF builder
// http://www.hoshiba-farm.com/
// 2005-05-06 hoshiyan
//=========================================================

class Whatsnew_Build_Rdf extends Whatsnew_Build_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Build_Rdf()
{
	Whatsnew_Build_Base::Whatsnew_Build_Base();

	$this->TEMPLATE    = 'db:whatsnew_rdf.html';
	$this->TITLE_VIEW  = "Whats New RDF";

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Build_Rdf();
	}

	return $instance;
}

//---------------------------------------------------------
// http://web.resource.org/rss/1.0/spec
// required paramter
// channel elements 
//   - title
//   - link
// item elements
//   - title
//   - link
//---------------------------------------------------------
function assign( &$tpl, $article_data  )
{
	$date = $this->iso8601_date( time() );

	$utf8_lang = $this->convert_to_utf8( _LANGCODE );
	$utf8_date = $this->convert_to_utf8( $date );

	$config = $this->get_config_data();

	$channel = $this->make_rss_channel();
	$utf8_site_name = $channel['site_name'];
	$utf8_site_url  = $channel['site_url'];

	$tpl->assign('xml_lang',          $utf8_lang );
	$tpl->assign('channel_language',  $utf8_lang );
	$tpl->assign('channel_date',      $utf8_date );
	$tpl->assign('channel_title',     $utf8_site_name );
	$tpl->assign('channel_link',      $utf8_site_url);
	$tpl->assign('channel_desc',      $channel['site_desc'] );

// REQ 3873: login user can read RSS.
// return, if not permit
	if ( !$this->is_permit_show() )
	{	return;	}

// build items
	foreach ($article_data as $article)
	{
		$date = '';
		if ( isset($article['time']) && $article['time'] )
		{
			$date = $this->iso8601_date( $article['time'] );
		}

		$item = $this->make_rss_line( $article );

		$tpl->append('items', 
			array(
				'dc_date'     => $this->convert_to_utf8( $date ), 
				'link'        => $item['link'],
				'title'       => $item['title_rss'],
				'description' => $item['summary_rss'],
				'dc_subject'  => $item['mod_name_rss'],
				'content'     => $item['content'],
				'dc_creator'  => $item['author_name'], 
			));
	}

}

// --- class end ---
}

?>