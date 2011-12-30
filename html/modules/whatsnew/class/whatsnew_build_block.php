<?php
// $Id: whatsnew_build_block.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2007-10-10 K.OHWADA
// divid from whatsnew_show_block.php

// 2007-08-01 K.OHWADA
// BUG: cannot show HTML entity like &auml; &copy;

// 2007-05-12 K.OHWADA
// module dupulication
// XC 2.1 system comment
// divid to whatsnew_config_basic_handler whatsnew_module_basic_handler
// WHATSNEW_FIELD_PLUGIN -> 'plugin'

// 2006-07-17 K.OHWADA
// BUG 3142: include plugin more than one time

// 2006-06-25 K.OHWADA
// add get_plugins()

// 2006-06-20 K.OHWADA
// assign variable into template: date_m, date_l
// add _get_config()

// 2006-01-27 K.OHWADA
// BUG 3508: Undefined index: description
// REQ 3509: put into spacing in a summary 
//   add fucntion _add_space()

// 2006-01-10 K.OHWADA
// BUG: Undefined offset

// 2005-11-16 K.OHWADA
// REQ 3194: output real user name

// 2005-11-06 K.OHWADA
// BUG 3169: need to sanitaize $_SERVER['PHP_SELF']
// add _html_special_chars_url(), _conv_js()

// 2005-09-28 K.OHWADA
// change block.new.php & func.whatsnew.php to class

//=========================================================
// What's New Module
// class show block
// 2004/08/20 K.OHWADA
//=========================================================
// Hacked by hodaka <hodaka@kuri3.net>
// sort by date, group by module
// 2005/03/11
//=========================================================

// === class begin ===
if( !class_exists('whatsnew_build_block') ) 
{

//=========================================================
// class whatsnew_build_block
//=========================================================
class whatsnew_build_block extends whatsnew_collect_plugins
{
	var $_DIRNAME;
	var $_DIR_MODULE;
	var $_URL_MODULE;
	var $_URL_ICON;
	var $_icon_default;

	var $_image_size;

	var $_DEFAULT_NULL  = '-';	// user, hits, replies
	var $_FLAG_IMAGE_FORCE   = true;
	var $_FLAG_BANNER_FORCE  = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function whatsnew_build_block( $dirname )
{
	$this->whatsnew_collect_plugins( $dirname );

	$this->_image_size =& happy_linux_image_size::getInstance();

	$this->_DIRNAME        = $dirname;
	$this->_URL_MODULE     = XOOPS_URL.'/modules/'.$dirname;
	$this->_DIR_MODULE     = XOOPS_ROOT_PATH.'/modules/'.$dirname;
	$this->_URL_ICON       = $this->_URL_MODULE.'/images/icons';
	$this->_icon_default   = $this->_URL_ICON.'/'.$this->_get_conf('block_icon_default');

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new whatsnew_build_block( $dirname );
	}
	return $instance;
}

//=========================================================
// public
//=========================================================
//---------------------------------------------------------
// sort by date
//---------------------------------------------------------
function &build_block_date()
{
	$i = 0;
	$lines = array();
	foreach ($this->collect_block_date('block') as $article)
	{
		$lines[$i] = $this->_make_block_line($i, $article);
		$i ++;
	}
	return $lines;
}

//---------------------------------------------------------
// sort by date, group by module
//---------------------------------------------------------
function &build_block_module()
{
	$i = 0;
	$module = array();
	foreach ($this->collect_block_module('block') as $module)
	{
		$modules[$i++] = $this->_make_block_module( $module );
	}
	return $modules;
}

// --------------------------------------------------------
// build icon list
// --------------------------------------------------------
function &build_icon_list()
{
	$i = 0;
	$icon_list = array();

	foreach ($this->get_module_work_array() as $mid => $module)
	{
		if ( $module['mod']['mod_icon'] )
		{
			$mod_link = '';
			if ( $module['mod']['dirname'] )
			{
				$mod_link = XOOPS_URL."/modules/".$module['mod']['dirname']."/";
			}

			$icon_list[$i]['mod_link']  = $mod_link;
			$icon_list[$i]['icon_link'] = $this->_URL_ICON."/".$module['mod']['mod_icon'];
			$icon_list[$i]['mod_name']  = $this->sanitize_text( $module['mod']['mod_name'] );

			$i ++;
		}
	}

	$icon_list[$i]['mod_name']  = $this->sanitize_text( _WHATSNEW_BLOCK_ETC );
	$icon_list[$i]['icon_link'] = $this->_icon_default;

	return $icon_list;
}

//=========================================================
// private
//=========================================================
//--------------------------------------------------------
// make module
//--------------------------------------------------------
function &_make_block_module( $module )
{
// module link
	$mod_dirname = '';
	$mod_link    = '';
	if ( isset($module['mod']['dirname']) && $module['mod']['dirname'] )
	{
		$mod_dirname  = $module['mod']['dirname'];
		$mod_link = XOOPS_URL."/modules/".$mod_dirname."/";
	}

// icon
	if ( isset($module['mod']['mod_icon']) && $module['mod']['mod_icon'] )
	{
		$mod_icon_link = $this->_URL_ICON."/".$module['mod']['mod_icon'];
	}
	else
	{
		$mod_icon_link = $this->_icon_default;
	}

	$mod_arr = array(
// sanitaize
		'mod_name'      => $this->sanitize_text( $module['mod']['mod_name'] ),
		'mod_link'      => $this->sanitize_url( $mod_link ),
		'mod_icon_link' => $this->sanitize_url( $mod_icon_link ),
		'mid'           => intval( $module['mod']['mid'] ),
		'dirname'       => $mod_dirname,
	);

// lines
	$i = 0;
	foreach ( $module['article_arr'] as $article )
	{
		$mod_arr['lines'][$i] = 
			$this->_make_block_line($i, $article);
		$i ++;
	}

	return $mod_arr;
}

// --------------------------------------------------------
// make line
// --------------------------------------------------------
function &_make_block_line($num, $article)
{
	$time = intval( $article['time'] );

// module
	$mod_dirname  = '';
	$mod_link = '';
	if ( isset($article['dirname']) && $article['dirname'] )
	{
		$mod_dirname  = $article['dirname'];
		$mod_link = XOOPS_URL."/modules/".$article['dirname']."/";
	}

// category
	$cat_name = '';
	if ( isset($article['cat_name']) && $article['cat_name'] )
	{
		$cat_name = $article['cat_name'];
	}

	$cat_link = '';
	if ( isset($article['cat_link']) && $article['cat_link'] )
	{
		$cat_link = $article['cat_link'];
	}

// uid
	list($uid, $uname, $rname) = $this->_get_user_name( $article );

// make image width & height
	list($image, $width, $height) = $this->_make_block_image($article);
	list($banner_url, $banner_width, $banner_height) = $this->_make_block_banner($article);

// icon
	$mod_icon_link = $this->_icon_default;
	if ( isset($article['mod_icon']) && $article['mod_icon'] )
	{
		$mod_icon_link = $this->_URL_ICON."/".$article['mod_icon'];
	}

// hit count
	$hits    = $this->_make_block_int($article, 'hits');
	$replies = $this->_make_block_int($article, 'replies');

// BUG 3508: Undefined index: description
// description
	$content = '';
	if ( isset($article['description']) && $article['description'] )
	{
		$content = $article['description'];
	}

	$line = array(

// sanitaize
		'title'     => $this->_make_html_title( $article ),
		'desc'      => $this->_make_html_summary( $num, $article ),
		'mod_name'  => $this->sanitize_text( $article['mod_name'] ),
		'dirname'   => $this->sanitize_text( $mod_dirname ),
		'cat_name'  => $this->sanitize_text( $cat_name ),

// REQ 3194: output real user name
		'user'      => $this->sanitize_text( $uname ),
		'user_name' => $this->sanitize_text( $uname ),
		'real_name' => $this->sanitize_text( $rname ),

		'link'      => $this->sanitize_url( $article['link'] ),
		'mod_link'  => $this->sanitize_url( $mod_link ),
		'cat_link'  => $this->sanitize_url( $cat_link ),
		'image'     => $this->sanitize_url( $image ),
		'mod_icon_link' => $this->sanitize_url( $mod_icon_link ),

// int
		'uid'      => $uid,
		'width'    => $width,
		'height'   => $height,
		'hits'     => $hits,
		'replies'  => $replies,

// time stamp
		'time'       => $time,
		'date_s'     => formatTimestamp( $time, 's' ),
		'date_m'     => formatTimestamp( $time, 'm' ),
		'date_l'     => formatTimestamp( $time, 'l' ),
		'date_mysql' => formatTimestamp( $time, 'mysql'),

// raw data
		'content'  => $content,

// banner
		'banner_url'    => $this->sanitize_url( $banner_url ),
		'banner_width'  => $banner_width,
		'banner_height' => $banner_height,
	);

	return $line;
}

// --------------------------------------------------------
// make html title
// --------------------------------------------------------
function _make_html_title( $article )
{
	if ( !isset($article['title']) )  return '';

	return $this->build_summary( 
		$article['title'], $this->_get_conf('block_max_title')
	);
}

function _make_html_summary( $num, $article )
{
	if ( !isset($article['description']) )  return '';
	if ( empty($article['description'] ) )  return '';
	if ( $num >= $this->_get_conf('block_limit_summary') )  return '';

	return $this->build_summary(
		$article['description'], $this->_get_conf('block_max_summary') 
	);
}

// --------------------------------------------------------
// make block int
// --------------------------------------------------------
function _make_block_int($article, $key)
{
	if ( isset($article[$key]) )
	{
		return intval( $article[$key] );
	}
	return $this->_DEFAULT_NULL;
}

// --------------------------------------------------------
// make image
// --------------------------------------------------------
function _make_block_image($article)
{
	if ( !$this->_get_conf('block_image_flag') ) return array('', '', '');
	if ( !isset($article['image']) ) return array('', '', '');

	$image  = $article['image'];	
	$width  = '';
	$height = '';

	if ( isset($article['width']) && isset($article['height']) )
	{
		list($width, $height) = $this->_image_size->adjust_size(
				$article['width'], 
				$article['height'], 
				$this->_get_conf('block_image_width'), 
				$this->_get_conf('block_image_height')
			);
	}
	elseif ($this->_FLAG_IMAGE_FORCE)
	{
		$width  = $this->_get_conf('block_image_width');
		$height = $this->_get_conf('block_image_height');
	}

	return array($image, intval($width), intval($height) );
}

function _make_block_banner($article)
{
	if ( !$this->_get_conf('block_banner_flag') ) return array('', '', '');
	if ( !isset($article['banner_url']) ) return array('', '', '');

	$url    = $article['banner_url'];	
	$width  = '';
	$height = '';

	if ( isset($article['banner_width']) && isset($article['banner_height']) )
	{
		list($width, $height) = $this->_image_size->adjust_size(
				$article['banner_width'], 
				$article['banner_height'], 
				$this->_get_conf('block_banner_width'), 
				$this->_get_conf('block_banner_height')
			);
	}
	elseif ($this->_FLAG_BANNER_FORCE)
	{
		$width  = $this->_get_conf('block_banner_width');
		$height = $this->_get_conf('block_banner_height');
	}

	return array( $url, intval($width), intval($height) );
}

//---------------------------------------------------------
// user name
// REQ 3194: output real user name
//---------------------------------------------------------
function _get_user_name( $article )
{
	$uid   = '';
	$uname = $this->_DEFAULT_NULL;
	$rname = $this->_DEFAULT_NULL;

	if ( !isset($article['uid']) )
	{
		return array($uid, $uname, $rname);
	}

	if ( $article['uid'] )
	{
		$user =& $this->_system->get_user_by_uid( $article['uid'] );

		if ( $user['isactive'] )
		{
			$uname = $user['uname'];
			$name  = $user['name'];

			if ($name)
			{
				$rname = $name;
			}
			else
			{
				$rname = $uname;
			}

		}
		else
		{
			$uid   = 0;
			$uname = $this->_system->get_anonymous();
			$rname = $uname;
		}
	}
	elseif ( $article['uid'] == 0 )
	{
		$uid   = 0;
		$uname = $this->_system->get_anonymous();
		$rname = $uname;
	}

	return array($uid, $uname, $rname);
}

//--------------------------------------------------------
// strings
//--------------------------------------------------------
function sanitize_text($str)
{
	return $this->_strings->sanitize_text($str);
}

function sanitize_url($str)
{
	return $this->_strings->sanitize_url($str);
}

function build_summary($text, $max, $keyword=null, $format='s')
{
	return $this->_strings->build_summary($text, $max, $keyword, $format);
}

// --- class end ---
}

// === class end ===
}

?>