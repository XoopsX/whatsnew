<?php
// $Id: whatsnew_build_rss.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2006-06-20 K.OHWADA
// REQ 3873: login user can read RSS.

// 2005-12-17 K.OHWADA
// BUG 3351: show notice, if no data

// 2005-09-28 K.OHWADA
// change func.rss.php to class

//=========================================================
// What's New Module
// class RSS builder
// 2004/08/20 K.OHWADA
//=========================================================

class Whatsnew_Build_Rss extends Whatsnew_Build_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Build_Rss()
{
	Whatsnew_Build_Base::Whatsnew_Build_Base();

	$this->TEMPLATE    = 'db:whatsnew_rss.html';
	$this->TITLE_VIEW  = "Whats New RSS";

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Build_Rss();
	}

	return $instance;
}

//---------------------------------------------------------
// http://blogs.law.harvard.edu/tech/rss
// required paramter
// channel elements 
//   - title
//   - link
//   - description
// item elements
//   - title
//   - link
//   - description
//---------------------------------------------------------
function assign( &$tpl, $article_data )
{
	$CATEGORY  = "Whats New";
	$GENERATOR = 'XOOPS WhatsNew '._WHATSNEW_VERSION;

	$date = date("r");

// BUG 3351: show notice, if no data
	if ( isset($article_data[0]['time']) )
	{
		$lastbuild = date("r", $article_data[0]['time'] );
	}
	else
	{
		$lastbuild = '';
	}

	$utf8_lang = $this->convert_to_utf8( _LANGCODE );
	$utf8_date = $this->convert_to_utf8( $date );
	$utf8_lastbuild = $this->convert_to_utf8( $lastbuild );

	$config = $this->get_config_data();

	$channel = $this->make_rss_channel();
	$utf8_site_name = $channel['site_name'];
	$utf8_site_url  = $channel['site_url'];

	$tpl->assign('channel_language',  $utf8_lang );
	$tpl->assign('channel_pubdate',   $utf8_date );
	$tpl->assign('channel_lastbuild', $utf8_lastbuild );
	$tpl->assign('channel_category',  $this->convert_to_utf8( $CATEGORY) );
	$tpl->assign('channel_generator', $this->convert_to_utf8( $GENERATOR) );

	$tpl->assign('channel_title',     $utf8_site_name );
	$tpl->assign('channel_link',      $utf8_site_url);
	$tpl->assign('channel_desc',      $channel['site_desc'] );
	$tpl->assign('channel_copyright', $channel['site_copyright'] );

	if ( $channel['site_email'] )
	{
		$tpl->assign('channel_webmaster', $channel['site_email'] );
		$tpl->assign('channel_editor',    $channel['site_email'] );
	}

	if ( $channel['site_image_url'] )
	{
		$tpl->assign('image_url',    $channel['site_image_url'] );
		$tpl->assign('image_width',  $channel['site_image_width'] );
		$tpl->assign('image_height', $channel['site_image_height'] );
		$tpl->assign('image_title',  $utf8_site_name );
		$tpl->assign('image_link',   $utf8_site_url );
	}

// REQ 3873: login user can read RSS.
// return, if not permit
	if ( !$this->is_permit_show() )
	{	return;	}

// build items
	foreach ($article_data as $article)
	{
		$date = '';
		if ( isset($article['time']) && $article['time']  )
		{
			$date = date("r", $article['time'] );
		}

		$item = $this->make_rss_line( $article );

		$tpl->append('items', 
			array(
				'pubdate'     => $this->convert_to_utf8( $date ), 
				'link'        => $item['link'],
				'guid'        => $item['link'],
				'title'       => $item['title_rss'],
				'description' => $item['summary_rss'],
				'category'    => $item['mod_name_rss'],
			));
	}

}

// --- class end ---
}

?>