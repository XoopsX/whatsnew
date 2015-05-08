<?php
// $Id: whatsnew_atom_parser.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2005-10-14 K.OHWADA
// ATOM 1.0
// data part may be divided including a space. 

// 2005-09-29 K.OHWADA
// change file name & class name

// 2004-08-30 K.OHWADA
// use parse_w3cdtf()
// add $atom_parent_num
// add convert_array_from_utf8(), convert_from_utf8()

//=========================================================
// What's New Module
// class for ATOM Parser 
// 2004-08-01 K.OHWADA
//=========================================================

//=========================================================
// global function
//=========================================================
//  $atom_feed
//  $atom_entrys
//  $atom_entry_num
//  $atom_parent
//  $atom_parent_num
//  $atom_uris

//---------------------------------------------------------
// start element handler
//---------------------------------------------------------
function atom_start_element($parser, $name, $attrs)
{
	global $atom_parent, $atom_parent_num, $atom_uris;
	global $atom_feed, $atom_entrys, $atom_entry_num;

//  echo "<br>\n";
//  echo "parent:  $atom_parent <br>\n";
//  echo "current: $atom_current <br>\n";
//  echo "name:    $name <br>\n";
//  print_r($attrs);
//  echo "<br>\n";

	$parent = $atom_parent[$atom_parent_num];

	$parent_num_prev = $atom_parent_num - 1;
	if ($parent_num_prev < 0)  $parent_num_prev = 0;
	$parent_prev = $atom_parent[$parent_num_prev];

	$name_ns = explode(':',$name);
	$name_wk = array_pop($name_ns);
	$uri1 = implode($name_ns,":");

	$name_low = strtolower( $name_wk );

	$flag = 0;
	foreach($atom_uris as $uri2)
	{
  		if ($uri1 == $uri2)
  		{
    		$flag = 1;
    		break;
  		}
	}

// FEED
	if ( $name_wk == 'FEED' )
	{
		$atom_parent_num = 0;
		$atom_parent[0]  = $name_wk;
		return;
	}

// CONTENT
	if (($parent_prev == 'ENTRY')&&($parent == 'CONTENT'))
	{
		$data = '';

  		if (($name_wk == 'P')||($name_wk == 'BR'))
  		{
			$data .= "<br />\n";
  		}
  		elseif ($name_wk == 'A')
  		{
	  		$href   = '';
	  		$target = '';
  			if ( isset($attrs['HREF']) )    $href   = $attrs['HREF'];
			if ( isset($attrs['TARGET']) )  $target = "target=\"{$attrs['TARGET']}\" ";

			$data .= "<a href=\"$href\" $target >";

  		}
  		elseif ($name_wk == 'IMG')
  		{
			$src    = '';
			$width  = '';
			$height = '';
			$border = 0;
			if ( isset($attrs['SRC']) )     $src    = $attrs['SRC'];
			if ( isset($attrs['BORDER']) )  $border = $attrs['BORDER'];
			if ( isset($attrs['WIDTH']) )   $width  = "width=\"{$attrs['WIDTH']}\" ";
			if ( isset($attrs['HEIGHT']) )  $height = "hight=\"{$attrs['HEIGHT']}\" ";

			$data .= "<img src=\"$src\" border=\"$border\" $width $height >";
  		}

		$atom_entrys[$atom_entry_num]['content'] .= $data;
		return;
	}

// LINK
	if ( $name_wk == 'LINK' )
	{
  		$rel  = '';
  		$href = '';
  		if ( isset($attrs['REL']) )   $rel  = $attrs['REL'];
  		if ( isset($attrs['HREF']) )  $href = $attrs['HREF'];

		$rel = strtolower($rel);

		if ( $parent == 'FEED' )
		{
    		$atom_feed[$name_low.'_'.$rel] = $href;
		}
		elseif (($parent == 'ENTRY') && ($rel == 'alternate'))
		{
			$atom_entrys[$atom_entry_num][$name_low] = $href;
		}
	}

// CATEGORY
	if ( $name_wk == 'CATEGORY' )
	{
  		$term = '';
  		if ( isset($attrs['TERM']) )  $term = $attrs['TERM'];

		if ( $parent == 'FEED' )
		{
    		$atom_feed[$name_low] = $term;
		}
		elseif ( $parent == 'ENTRY' ) 
		{
   			$atom_entrys[$atom_entry_num][$name_low] = $term;
		}
	}

// increment parent
	if ( $flag || empty($uri1) )
	{
		$atom_parent_num ++;
		$atom_parent[$atom_parent_num] = $name_wk;
	}

}

//---------------------------------------------------------
// end element handler
//---------------------------------------------------------
function atom_end_element($parser, $name)
{
	global $atom_parent, $atom_parent_num, $atom_entry_num, $atom_entrys, $atom_uris;

	$parent = $atom_parent[$atom_parent_num];

	$parent_num_prev = $atom_parent_num - 1;
	if ($parent_num_prev < 0)  $parent_num_prev = 0;
	$parent_prev = $atom_parent[$parent_num_prev];

	$name_ns = explode(':',$name);
	$name_wk = array_pop($name_ns);
	$uri1 = implode($name_ns,":");

//	echo "<br>\n";
//	echo "parent num : $atom_parent_num <br>\n";
//	echo "parent prev: $parent_prev <br>\n";
//	echo "parent  :    $parent <br>\n";
//	echo "current :    $name_wk <br>\n";

	$flag = 0;
	foreach($atom_uris as $uri2)
	{
  		if ($uri1 == $uri2)
  		{
			$flag = 1;
    		break;
  		}
	}

// CONTENT
	if (($parent_prev == 'ENTRY')&&($parent == 'CONTENT'))
	{
  		if ($name_wk == 'A')
  		{
			$atom_entrys[$atom_entry_num]['content'] .= "</a>";
  		}

  		if ($name_wk != 'CONTENT')
		{
  			return;
  		}
  	}

// decrement parent
	if (( $flag || empty($uri1) )&&( $parent == $name_wk ))
	{
		$atom_parent_num --;
		if ($atom_parent_num < 0)  $atom_parent_num = 0;

      	if ($name_wk == 'ENTRY')
      	{
      		$atom_entry_num ++;
      	}
	}

}

//---------------------------------------------------------
// character data handler
//---------------------------------------------------------
function atom_character_data($parser, $data) 
{
	global $atom_parent, $atom_parent_num, $atom_feed, $atom_entrys, $atom_entry_num;

	$parent_0 = '';
	$parent_1 = '';
	$parent_2 = '';
	if ( isset($atom_parent[0]) )	$parent_0 = $atom_parent[0];
	if ( isset($atom_parent[1]) )	$parent_1 = $atom_parent[1];
	if ( isset($atom_parent[2]) )	$parent_2 = $atom_parent[2];

	$current     = $atom_parent[$atom_parent_num];
	$current_low = strtolower( $current );

// data part may be divided including a space. 
//	$data        = trim($data);

//	echo "<br>\n";
//	echo "parent num: $atom_parent_num <br>\n";
//	echo "parent 0:   $parent_0 <br>\n";
//	echo "parent 1:   $parent_1 <br>\n";
//	echo "parent 2:   $parent_2 <br>\n";
//	echo "current :   $current <br>\n";
//	echo "data:       $data <br>\n";

	if ($parent_0 != 'FEED')  return;

	switch($parent_1)
	{
// ENTRY
		case 'ENTRY':
    		switch($parent_2)
    		{

// ENTRY AUTHOR
				case 'AUTHOR':
    				switch($current)
    				{
    					case 'NAME':
    					case 'URL':
    // atom 1.0
       					case 'URI':
    // atom 0.3
       					case 'URL':
    						$key = 'author_'.$current_low;
     						if ( isset( $atom_entrys[$atom_entry_num][$key] ) )
     						{
     							$atom_entrys[$atom_entry_num][$key] .= $data;
     						}
     						else
     						{
     							$atom_entrys[$atom_entry_num][$key] = $data;
      						}
      						break;
      				}
					break;

// ENTRY others
				default:
    				switch($current)
    				{
    					case 'TITLE':
    					case 'SUMMARY':
    					case 'SUBJECT':
    					case 'ID':
    					case 'CONTENT':
    // atom 1.0
    					case 'UPDATED';
    					case 'PUBLISHED';
    					case 'CATEGORY':
    					case 'RIGHTS':
        	 			case 'SOURCE':
    // atom 0.3
    					case 'MODIFIED';
    					case 'ISSUED';
    					case 'CREATED';
     						if ( isset( $atom_entrys[$atom_entry_num][$current_low] ) )
     						{
     							$atom_entrys[$atom_entry_num][$current_low] .= $data;
     						}
     						else
     						{
     							$atom_entrys[$atom_entry_num][$current_low] = $data;
      						}
      						break;
      				}
					break;
			}
			break;

// FEED AUTHOR
		case 'AUTHOR':
    		switch($current)
    		{
    			case 'NAME':
    			case 'EMAIL':
    // atom 1.0
       			case 'URI':
    // atom 0.3
       			case 'URL':
    				$key = 'author_'.$current_low;
    			    if ( isset( $atom_feed[$key] ) )
     				{
     					$atom_feed[$key] .= $data;
     				}
     				else
     				{
     					$atom_feed[$key] = $data;
      				}
      				break;
      		}
      		break;

// FEED others
		default:
    		switch($current)
    		{
    			case 'TITLE':
    			case 'ID':
    			case 'GENERATOR':
    // atom 1.0
    			case 'RIGHTS':
    			case 'UPDATED';
    			case 'SUBTITLE':
    			case 'CATEGORY':
    			case 'ICON':
    			case 'LOGO':
     			case 'SOURCE':
    // atom 0.3
	   			case 'COPYRIGHT':
    			case 'MODIFIED';
    			case 'TAGLINE':
    			case 'INFO':
    			    if ( isset( $atom_feed[$current_low] ) )
     				{
     					$atom_feed[$current_low] .= $data;
     				}
     				else
     				{
     					$atom_feed[$current_low] = $data;
      				}
					break;
			}
			break;
	}

}

//---------------------------------------------------------
// start namespace handler
//---------------------------------------------------------
function atom_ns_start($parser, $prefix, $uri)
{
  global $atom_uris;

//  echo "nss;$prefix;$uri <br>\n";

  array_push($atom_uris, strtoupper($uri));
}

//---------------------------------------------------------
// end namespace handler
//---------------------------------------------------------
function atom_ns_end($parser, $prefix)
{
  global $atom_uris;
  array_pop($atom_uris);
}

//=========================================================
// class atom_parser
//=========================================================
class Whatsnew_Atom_Parser
{
  	var $max_entry   = 10;
  	var $max_content = 5000;
  	var $error;
  	var $flag_target;
	var $flag_convert;
	var $flag_date;

// multibyte
	var $user_encode;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Atom_Parser()
{
	$this->flag_target  = 0;
	$this->flag_convert = 0;
	$this->flag_date    = 0;

// for English
	$this->set_encode("ISO-8859-1");
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Atom_Parser();
	}

	return $instance;
}

//---------------------------------------------------------
// get_feed
//---------------------------------------------------------
function get_feed()
{
	global $atom_feed;

  	$feed = $atom_feed;

	if ( $this->flag_convert )
  	{
  		$feed = $this->convert_array_from_utf8( $feed );
  	}

	return $feed;
}

//---------------------------------------------------------
// get_entrys
//---------------------------------------------------------
function get_entrys()
{
	global $atom_entrys;

	$entrys = $atom_entrys;

	if ( $this->flag_convert )
  	{
  		$entrys = $this->convert_array_array_from_utf8( $entrys );
  	}

	return $entrys;
}

//---------------------------------------------------------
// get_error
//---------------------------------------------------------
function get_error()
{
  return $this->error;
}

//---------------------------------------------------------
// parse_data
//---------------------------------------------------------
function parse_data($data)
{
	global $atom_entry_num,$atom_parent_num,$atom_parent,$atom_feed,$atom_entrys,$atom_uris;

// global
	$atom_feed       = array();
	$atom_entrys     = array();
	$atom_entry_num  = 0;
	$atom_parent     = array();
	$atom_parent[0]  = '';
	$atom_parent_num = 0;
	$atom_uris       = array();

	$this->error = '';

	$xml_parser = xml_parser_create_ns("UTF-8");
	xml_set_element_handler($xml_parser, "atom_start_element", "atom_end_element");
	xml_set_character_data_handler($xml_parser, "atom_character_data");
	xml_set_start_namespace_decl_handler($xml_parser, "atom_ns_start");
	xml_set_end_namespace_decl_handler($xml_parser, "atom_ns_end");

	if (!xml_parse($xml_parser, $data, sizeof($data)))
	{
		$line  = xml_get_current_line_number($xml_parser);
		$error = xml_error_string(xml_get_error_code($xml_parser));

		if ($line == 1)
		{
			$this->error = 'XML error at line 1, check URL';
		}
		else
		{
			$this->error = sprintf('XML error: %s at line %d', $error, $line );
		}

		xml_parser_free($xml_parser);
		return 1;
	}

	xml_parser_free($xml_parser);
  
	if (empty($atom_feed))
	{
		$this->error = 'not ATOM format';
		return 1;
	}

	return 0;
}

//=========================================================
// print option
//=========================================================

//---------------------------------------------------------
// parse_url
//---------------------------------------------------------
function parse_url($url)
{
	if (empty($url))
  	{
  		$this->error = "not ATOM url: $url";
  		return 1;
  	}

	$data = $this->read_remote_file($url);
  	if ($data == false)
  	{
  		$this->error = "can't open ATOM url: $url";
  		return 1;
  	}

  	if (empty($data))
  	{
  		$this->error = "no ATOM data";
  		return 1;
  	}

  	return $this->parse_data($data);
}

//---------------------------------------------------------
// get html content by url 
//---------------------------------------------------------
function read_remote_file($url)
{
	$fp = fopen($url,"r");
	if (!$fp) return false;

	$text = '';
	while ( !feof($fp) )
	{
		$text .= fgets($fp,4096);
	}

	return $text;
}

//---------------------------------------------------------
// print_list_with_feed_by_url
//---------------------------------------------------------
function print_list_by_url($url, $num=1)
{ 
  $ret = $this->parse_url($url);
  {
  	$error = $this->get_error();
  	print "<font color=red>$error</font><br>\n";
  }
  
  $feed   = $this->get_feed();
  $entrys = $this->get_entrys();

  print "<h4>";
  $this->print_feed($feed);
  print "</h4>\n";

  $this->print_entrys($entrys, 1,      $num,             1);
  $this->print_entrys($entrys, $num+1, $this->max_entry, 0);
}

//---------------------------------------------------------
// print_feed
//---------------------------------------------------------
function print_feed($feed)
{
  $target = $this->get_target();
  $link = "<a href=\"{$feed['link']}\" $target>{$feed['title']}</a>";
  print $link;
}

//---------------------------------------------------------
// print_entrys
//---------------------------------------------------------
function print_entrys($entrys,$start=1,$end=100,$flag_cont=0)
{
	$start = $start - 1;
	if ( $start < 0 ) $start = 0;

	$count = count($entrys);

	for ($i=$start; $i<$count; $i++)
  	{
    	if ($i >= $end) break;
    	$this->print_entry($entrys[$i],$flag_cont);
  	}
}

//---------------------------------------------------------
// print_entry
//---------------------------------------------------------
function print_entry($entry,$flag_cont=0)
{
	print "<p id='atom'>";
	print $this->get_title($entry);
	print " "; 
	print $this->get_date_parenthesis($entry);
	print "</p>\n";

	if ($flag_cont)
	{
		print "<font size='-1'>";
		print $this->get_content($entry,$this->max_content);
		print "</font><br>\n";
	}

}

//---------------------------------------------------------
// get_title
//---------------------------------------------------------
function get_title($entry)
{
	$target = $this->get_target();
	$title = "<a href=\"{$entry['link']}\" $target>{$entry['title']}</a>";
	return $title;
}

//---------------------------------------------------------
// get_date_parenthesis
//---------------------------------------------------------
function get_date_parenthesis($entry,$key='issued')
{
	$date = $this->get_date($entry,$key);

	if ($date)
	{
		$date = "($date)"; 
	}

	return $date;
}

//---------------------------------------------------------
// get_date
//---------------------------------------------------------
function get_date($entry,$key='issued')
{
	$datetime = $entry[$key];

	if ( empty($datetime) ) return;

	$time_arr = $this->parse_w3cdtf($datetime);
	$unixtime = $time_arr['timestamp'];

	if ( $this->flag_date )
	{
		$date = date("Y-m-d", $unixtime);
	}
	else
	{
		$date = date("Y-m-d H:i:s T", $unixtime);
	}

	return $date;
}

//---------------------------------------------------------
// get_content
//---------------------------------------------------------
function get_content($entry, $max)
{
	$cont = $entry['content'];

	if (empty($cont))
	{
		$cont = $entry['summary'];
	}

	if (empty($cont)) return;

	if (strlen($cont) > $max)
	{
		$cont = strip_tags($cont, '<br>');
		$cont = $this->shorten_text($cont, $max);
	}

	return $cont;
}

//---------------------------------------------------------
// get_target
//---------------------------------------------------------
function get_target()
{
  	if ($this->flag_target)
  	{
  		return "target=_blank";
	}
  
  	return '';
}

//---------------------------------------------------------
// set_flag_target
//---------------------------------------------------------
function set_flag_target()
{
	$this->flag_target = 1;
}

//---------------------------------------------------------
// set_flag_date
//---------------------------------------------------------
function set_flag_date()
{
	$this->flag_date = 1;
}

//---------------------------------------------------------
// set_flag_convert
//---------------------------------------------------------
function set_flag_convert()
{
	$this->flag_convert = 1;
}

//---------------------------------------------------------
// set user encode
//---------------------------------------------------------
function set_encode($value)
{
	$this->user_encode = $value;
}

//---------------------------------------------------------
// convert_array_array_from_utf8
//---------------------------------------------------------
function convert_array_array_from_utf8($in_arr)
{
	$out_arr = array();

	foreach ($in_arr as $key => $value)
	{
		$out_arr[$key] = $this->convert_array_from_utf8($value);
	}

	return $out_arr;
}

//---------------------------------------------------------
// convert_array_from_utf8
//---------------------------------------------------------
function convert_array_from_utf8($in_arr)
{
	$out_arr = array();

	foreach ($in_arr as $key => $value)
	{
		$out_arr[$key] = $this->convert_from_utf8($value);
	}

	return $out_arr;
}

//---------------------------------------------------------
// convert_from_utf8
//---------------------------------------------------------
function convert_from_utf8($text)
{
	if ( function_exists('mb_convert_encoding') )
	{
		$text = mb_convert_encoding($text, $this->user_encode, "UTF-8");
	}
	else
	{
		$text = utf8_decode($text);
	}

	return $text;
}

// --------------------------------------------------------
// shorten text
// --------------------------------------------------------
function shorten_text($text,$max=100)
{
	if (function_exists('mb_strimwidth'))
	{
		$text = mb_strimwidth( $text, 0, $max, " ..." );
	}
	else
	{
		$text = substr( $text, 0, $max )." ...";
	}

	return $text;
}

// -------------------------------------------------------------------------
// http://www.arielworks.net/articles/2004/0224c/
// array parse_w3cdtf(string datetime)
// -------------------------------------------------------------------------
// http://www.w3.org/TR/NOTE-datetime
//  Year:
//      YYYY (eg 1997)
//   Year and month:
//      YYYY-MM (eg 1997-07)
//   Complete date:
//      YYYY-MM-DD (eg 1997-07-16)
//   Complete date plus hours and minutes:
//      YYYY-MM-DDThh:mmTZD (eg 1997-07-16T19:20+01:00)
//   Complete date plus hours, minutes and seconds:
//      YYYY-MM-DDThh:mm:ssTZD (eg 1997-07-16T19:20:30+01:00)
//   Complete date plus hours, minutes, seconds and a decimal fraction of a second
//      YYYY-MM-DDThh:mm:ss.sTZD (eg 1997-07-16T19:20:30.45+01:00)
// -------------------------------------------------------------------------
function parse_w3cdtf($datetime)
{
    // Year
    if(preg_match("/^(\d{4})$/", $datetime, $val)) {
        $year = $val[1];

    // Year and month
    } elseif(preg_match("/^([0-9]{4})-(0[1-9]|1[0-2])$/", $datetime, $val)) {
        $year = $val[1];
        $month = $val[2];

    // Complete date
    } elseif(preg_match("/^([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $datetime, $val)) {
        $year = $val[1];
        $month = $val[2];
        $day = $val[3];

    // Complete date plus hours and minutes
    } elseif(preg_match("/^([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-5][0-9]):([0-5][0-9])(Z|(\+|-)[0-5][0-9]:[0-5][0-9])$/", $datetime, $val)) {
        $year = $val[1];
        $month = $val[2];
        $day = $val[3];
        $hour = $val[4];
        $minute = $val[5];
        $timezone = $val[6];

    // Complete date plus hours, minutes and seconds
    } elseif(preg_match("/^([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-5][0-9]):([0-5][0-9]):([0-5][0-9])(Z|(\+|-)[0-5][0-9]:[0-5][0-9])$/", $datetime, $val)) {
        $year = $val[1];
        $month = $val[2];
        $day = $val[3];
        $hour = $val[4];
        $minute = $val[5];
        $second = $val[6];
        $timezone = $val[7];

    // Complete date plus hours, minutes, seconds and a decimal fraction of a second
    } elseif(preg_match("/^([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-5][0-9]):([0-5][0-9]):([0-5][0-9]).([0-9]+)(Z|(\+|-)[0-5][0-9]:[0-5][0-9])$/", $datetime, $val)) {
        $year = $val[1];
        $month = $val[2];
        $day = $val[3];
        $hour = $val[4];
        $minute = $val[5];
        $second = $val[6];
        $fraction = $val[7];
        $timezone = $val[8];

    // Not W3C-DTF
    } else {
        return false;
    }

    // Offset of Timezone for gmmktime()
    if($timezone != "Z") {
        $offset_sign = substr($timezone, 0, 1);
        $offset_hour = substr($timezone, 1, 2);
        $offset_minute = substr($timezone, 4, 2);
    }

    $timestamp = gmmktime($hour - ($offset_sign . $offset_hour), $minute - ($offset_sign . $offset_minute), $second, $month, $day, $year);

    $result = array("year" => $year, "month" => $month, "day" => $day,
                    "hour" => $hour, "minute" => $minute, "second" => $second,
                    "fraction" => $fraction, "timezone" => $timezone, "timestamp" => $timestamp);

    return $result;
}

// class end
}

?>
