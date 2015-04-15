<?php
// $Id: whatsnew_build_pda.php,v 1.1 2011/12/30 21:45:54 ohwada Exp $

// 2005-09-28 K.OHWADA
// change func.pda.php to class

//=========================================================
// What's New Module
// class template builder for PDA 
// 2005-06-20 K.OHWADA
//=========================================================

class Whatsnew_Build_Pda extends Whatsnew_Build_Base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Build_Pda()
{
	Whatsnew_Build_Base::Whatsnew_Build_Base();

	$this->HEADER      = "Content-Type:text/html";
	$this->TEMPLATE    = "db:whatsnew_pda.html";
	$this->TITLE_VIEW  = "Whats New PDA";

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Build_Pda();
	}

	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_article()
{
	return $this->_class_block->collect_block_date('block');
}

function assign( &$tpl, $article_data )
{
	$config = $this->get_config_data();

// sanitize
	$site_name = $this->_class_block->_html_special_chars( $config['site_name'] );
	$site_desc = $this->_class_block->_html_special_chars( $config['site_desc'] );

	$tpl->assign('xoops_charset', _CHARSET);
	$tpl->assign('site_url',  $config['site_url'] );
	$tpl->assign('site_name', $site_name);
	$tpl->assign('site_desc', $site_desc);

	if ( isset($config['image_url']) && $config['image_url'] )
	{
		$tpl->assign('image_url', $config['image_url'] );
	}

	$i     = 0;
	$block = array();

	foreach ($article_data as $article)
	{
		$line = $this->_class_block->make_block_line($i, $article);

		if ( isset($article['pda']) && $article['pda'] )
		{
			$line['link'] = $article['pda'];
		}

		$block[] = $line;
		$i ++;
	}

	$tpl->assign('whatsnew', $block);
}


// --- class end ---
}

?>