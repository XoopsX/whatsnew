<?php
// $Id: whatsnew_build_atom.php,v 1.1 2011/12/30 21:45:54 ohwada Exp $

// 2006-06-20 K.OHWADA
// REQ 3873: login user can read RSS.

// 2005-10-14 K.OHWADA
// ATOM 1.0

// 2005-09-28 K.OHWADA
// change func.atom.php to class

//=========================================================
// What's New Module
// class ATOM builder
// 2004/08/20 K.OHWADA
//=========================================================

class Whatsnew_Build_Atom extends Whatsnew_Build_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Build_Atom()
{
	Whatsnew_Build_Base::Whatsnew_Build_Base();

	$this->TEMPLATE    = 'db:whatsnew_atom.html';
	$this->TITLE_VIEW  = "Whats New ATOM";

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Build_Atom();
	}

	return $instance;
}

//---------------------------------------------------------
// http://www.mnot.net/drafts/draft-nottingham-atom-format-02.html
// required paramter
// feed elements 
//   - id
//   - title
//   - updated
//   - author name
// entry elements 
//   - id
//   - title
//   - updated
//   - author name
//   - summary or content
//---------------------------------------------------------
function assign( &$tpl, $article_data )
{
	$GENERATOR     = 'XOOPS WhatsNew '._WHATSNEW_VERSION;
	$GENERATOR_URL = 'http://linux2.ohwada.net/';

	$link_alt  = XOOPS_URL."/";
	$link_self = XOOPS_URL."/modules/whatsnew/atom.php";

	$date = $this->iso8601_date( time() );

	$utf8_lang = $this->convert_to_utf8( _LANGCODE );
	$utf8_date = $this->convert_to_utf8( $date );

	$config = $this->get_config_data();

	$feed = $this->make_rss_channel();
	$utf8_site_author = $feed['site_author'];

	$tpl->assign('xml_lang',           $utf8_lang );
	$tpl->assign('feed_updated',       $utf8_date );
	$tpl->assign('feed_generator',     $this->convert_to_utf8( $GENERATOR ) );
	$tpl->assign('feed_generator_uri', $this->convert_to_utf8( $GENERATOR_URL ) );
	$tpl->assign('feed_link_alt',      $this->convert_to_utf8( $link_alt ) );
	$tpl->assign('feed_link_self',     $this->convert_to_utf8( $link_self ) );
	$tpl->assign('feed_author_uri',    $this->convert_to_utf8( $link_alt ) );
	$tpl->assign('feed_author_name',   $utf8_site_author );
	$tpl->assign('feed_title',         $feed['site_name'] );
	$tpl->assign('feed_rights',        $feed['site_copyright'] );
	$tpl->assign('feed_id',            $feed['site_id'] );

// REQ 3873: login user can read RSS.
// return, if not permit
	if ( !$this->is_permit_show() )
	{	return;	}

// build items
	$this->_count_line = 1;

	foreach ($article_data as $article)
	{
		$entry = $this->make_rss_line( $article );

		$updated   = $this->iso8601_date( $entry['unix_updated'] );
		$published = $this->iso8601_date( $entry['unix_published']   );

		$created = '';
		if ( isset($article['created']) && $article['created'] )
		{
			$created  = $this->iso8601_date( $article['created']  );
		}

		if ( $entry['author_name'] )
		{
			$utf8_author_name = $entry['author_name'];
		}
		else
		{
			$utf8_author_name = $utf8_site_author;
		}

		if ( $entry['summary_atom'] )
		{
			$summary = $entry['summary_atom'];
		}
		else
		{
			$summary = $entry['title_atom'];
		}

		$tpl->append('entrys', 
			array(
				'author_name'  => $utf8_author_name,
				'updated'      => $this->convert_to_utf8( $updated ),
				'published'    => $this->convert_to_utf8( $published ), 
				'author_uri'   => '',
				'author_email' => '',
				'title'        => $entry['title_atom'],
				'summary'      => $summary,
				'category'     => $entry['mod_name_atom'],
				'content'      => $entry['content'],
				'link'         => $entry['link'],
				'id'           => $entry['atom_id'], 
			));
	}
}

// --- class end ---
}

?>