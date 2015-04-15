<?php
// $Id: whatsnew_auto_base.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2005-12-31 K.OHWADA
// BUG 3402: parse error in whatsnew_auto_base.php

// 2005-11-06 K.OHWADA
// BUG 3169: need to sanitaize $_SERVER[PHP_SELF]

// 2005-09-29 K.OHWADA
// change function to class

//=========================================================
// Whats New Module
// class auto discovery base
// 2005-09-29 K.OHWADA
//=========================================================

class Whatsnew_Auto_Base
{
// constant
	var $TEMPLATE;
	var $MSG_ERR_AUTO;
	var $MSG_ERR_GET;

// class
	var $class_remote;
	var $class_lang;
	var $class_parser;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Auto_Base()
{
// class
	$this->class_remote =& Whatsnew_Remote_File::getInstance();
	$this->class_lang   =& Whatsnew_Lang_Conv::getInstance();

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Auto_Base();
	}

	return $instance;
}

//---------------------------------------------------------
// main function
//---------------------------------------------------------
function show()
{
	list($op, $url_html, $url_rss) = $this->get_param();

	$this->show_form_html($url_html);

	if ( $op != 'rss' )
	{
// correspondence to allow_url_fopen = off
		$data_html = $this->class_remote->read_file($url_html);

		if ($data_html == false)
		{
			$this->show_error_connect($url_html);
			return;
		}

		$url_rss = $this->get_url_rss_auto($data_html);
	}

	$this->show_form_rss($url_rss);

	if (empty($url_rss))
	{
		$this->show_error( $this->MSG_ERR_AUTO );
		return;
	}

// correspondence to allow_url_fopen = off
	$data_rss = $this->class_remote->read_file($url_rss);

	if ($data_rss == false)
	{
		$this->show_error_connect($url_rss);
		return;
	}

	if (empty($data_rss))
	{
		$this->show_error( $this->MSG_ERR_GET );
		return;
	}

	$ret = $this->parse($data_rss);

	$this->show_feeds();

	if ( !$ret )
	{
		$msg_arr = $this->get_parse_error();
		$this->show_error_parse($msg_arr, $data_rss);
	}

}

//---------------------------------------------------------
// RSS / ATOM Auto Discovery
//---------------------------------------------------------
function get_rss_atom_link($html)
{
	$href_rss  = '';
	$href_atom = '';

// save all <link> tags
	preg_match_all('/<link\s+(.*?)\s*\/?>/si', $html, $match);
	$link_tag_arr = $match[1];

	$link_arr = array();
	$link_tag_count = count($link_tag_arr);

// store each <link> tags s attributes
	for($i=0; $i<$link_tag_count; $i++)
	{
		$attr_wk_arr   = array();
		$link_attr_arr = preg_split('/\s+/s', $link_tag_arr[$i]);

		foreach($link_attr_arr as $link_attr)
		{
			$link_attr_pair = preg_split('/\s*=\s*/s', $link_attr, 2);

			if( isset($link_attr_pair[0]) && isset($link_attr_pair[1]) )
			{
				$key   = $link_attr_pair[0];
				$value = $link_attr_pair[1];
				$key   = strtolower( $key );
				$value = preg_replace('/([\'"]?)(.*)\1/', '$2', $value);
				$attr_wk_arr[$key] = $value;
			}
		}

		$link_arr[$i] = $attr_wk_arr;
	}

// find the link file
	for($i=0; $i<$link_tag_count; $i++)
	{
		if (strtolower($link_arr[$i]['rel']) != 'alternate')  continue;
		if ( !isset($link_arr[$i]['href']) )  continue;

		if (empty($href_rss) && (strtolower($link_arr[$i]['type']) == 'application/rss+xml'))
		{
			$href_rss = $link_arr[$i]['href'];
		}
		elseif (empty($href_atom) && (strtolower($link_arr[$i]['type']) == 'application/atom+xml'))
		{
			$href_atom = $link_arr[$i]['href'];
		}
	}

	return array($href_rss, $href_atom);
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_param()
{
	$op       = $this->get_post('op');
	$url_html = $this->get_post('url_html');
	$url_rss  = $this->get_post('url_rss');

	if ( empty($url_html) && ($op != 'rss') )
	{
		$url_html = XOOPS_URL."/";
	}

	return array($op, $url_html, $url_rss);
}

function get_post($key, $default='')
{
	if ( isset($_POST[$key]) )
	{
		$val = $_POST[$key];
	}
	else
	{
		$val = $default;
	}

	return $val;
}

function show_form_html($url_html)
{

// BUG 3169: need to sanitaize $_SERVER[PHP_SELF]
// BUG 3402: parse error in whatsnew_auto_base.php
	$self = xoops_getenv("PHP_SELF");

?>
<form action="<?php echo $self; ?>" method="post">
<input type="hidden" name="op" value="html">
HTML URL: <input type="text" name="url_html" value="<?php echo $url_html; ?>" size="100">
<input type="submit" value="<?php echo _WHATSNEW_AUTO; ?>">
</form>
HTML URL: <a href="<?php echo $url_html; ?>" target="_blank"><?php echo $url_html; ?></a><br>
<hr>
<?php

}

function show_form_rss($url_rss)
{
// BUG 3169: need to sanitaize $_SERVER[PHP_SELF]
// BUG 3402: parse error in whatsnew_auto_base.php
	$self = xoops_getenv("PHP_SELF");

?>
<form action="<?php echo $self; ?>" method="post">
<input type="hidden" name="op" value="rss">
RSS URL: <input type="text" name="url_rss" value="<?php echo $url_rss; ?>" size="100">
<input type="submit" value="<?php echo _WHATSNEW_SET; ?>">
</form>
RSS URL: <a href="<?php echo $url_rss; ?>" target="_blank"><?php echo $url_rss; ?></a><br>
<hr>
<?php

}

//---------------------------------------------------------
// error
//---------------------------------------------------------
function show_error_connect($url)
{
	$this->show_error(_WHATSNEW_ERROR_CONNCET, $url);
}

function show_error_parse($msg_arr, $data)
{
	$this->show_error(_WHATSNEW_ERROR_PARSE, $msg_arr);

	echo "<pre>-----\n";
	echo htmlspecialchars($data);
	echo "-----</pre>\n";
}

function show_error($title, $msg_arr='')
{
	echo "<h4><font color='red'>$title</font></h4>\n";

	if ( is_array($msg_arr) )
	{
		foreach ($msg_arr as $msg)
		{
			echo "$msg <br />\n";
		}
	}
	elseif ($msg_arr)
	{
		echo "$msg_arr <br />\n";
	}

}


//---------------------------------------------------------
// over ride
//---------------------------------------------------------
function get_url_rss_auto($data_html)
{
	// dummy
}

function parse($data)
{
	// dummy
}

function get_parse_error()
{
	// dummy
}

function show_feeds()
{
	// dummy
}


// --- class end ---
}

?>