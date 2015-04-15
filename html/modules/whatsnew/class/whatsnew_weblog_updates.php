<?php
// $Id: whatsnew_weblog_updates.php,v 1.1 2011/12/30 21:45:53 ohwada Exp $

// 2005-09-29 K.OHWADA
// change file name & class name

// 2005-06-06 K.OHWADA
// check to exist mb_xx function

//=========================================================
// What's New Module
// class for weblogUpdates.ping
// require class.http_client.php
// 2004/08/20 K.OHWADA
//=========================================================

class Whatsnew_Weblog_Updates
{
// class
	var $class_client;

// variable
	var $blog_name;
	var $blog_url;
	var $result;
	var $encode;

// for debug
	var $flag_debug;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Weblog_Updates()
{
// class
	$this->class_client = & Whatsnew_Http_Client::getInstance();

// for debug
	$this->reset_debug(); 

// for English
	$this->set_encode("ISO-8859-1");
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Weblog_Updates();
	}

	return $instance;
}

//---------------------------------------------------------
// set blog data
// $name : my web site ( EUC-JP avalable )
// $url  : my url
//---------------------------------------------------------
function set_blog_data($name, $url)
{
	$this->blog_name = $name;
	$this->blog_url  = $url;
}

//---------------------------------------------------------
// send ping to server
// $url  : server url
// $code : return code
//---------------------------------------------------------
function send_ping($url, $timeout1=0, $timeout2=0)
{
	$METHOD = 'POST';
	$TYPE   = 'text/xml';

	$code = 1;	// NG
 
	if (empty($url))
	{
    	$reason = 'no server url';
		$this->result = array($url,$code,$reason);
		return $code;
	}

  	if (empty($this->blog_name))
  	{
    	$reason = 'no blog name';
		$this->result = array($url,$code,$reason);
		return $code;
  	}

  	if (empty($this->blog_url))
  	{
    	$reason = 'no blog url';
		$this->result = array($url,$code,$reason);
		return $code;
  	}

// set parameter
// 	$client = new http_client( $url );
  	$this->class_client->setUrl( $url );
  	$this->class_client->setRequestMethod( $METHOD );
  	$this->class_client->setContentType( $TYPE  );
  	if ($this->flag_debug) { $this->class_client->setDebug(); }

// make message
  $payload = $this->createPayload();

// print message
	if ($this->flag_debug) 
	{
		$msg_print = $this->convert_to_user_encode( $payload );
		$msg_print = htmlspecialchars($msg_print);
		print "<pre>";
		print "---SEND--- \n";
		print "$url \n";
		print "\n";
		print $msg_print;
		print "</pre> \n";
	}

// send ping
	$ret = $this->class_client->send( $payload, $timeout1, $timeout2 );
	if ($ret != 0)
	{
    	$code   = $this->class_client->getCode();
		$reason = $this->class_client->getMessage();
	}
	else
	{
		$response = $this->class_client->getResponse();
		list($code, $reason) = $this->parseResponse($response);
	}

	$this->result = array($url, $code, $reason);

	return $code;
}

//---------------------------------------------------------
//  createPayload
//---------------------------------------------------------
function createPayload()
{
  	$blog_name = $this->convert_to_utf8( $this->blog_name );
  
	$payload = <<<END_OF_TEXT
<?xml version="1.0"?>
<methodCall>
  <methodName>weblogUpdates.ping</methodName>
   <params>
   <param>
     <value>$blog_name</value>
   </param>
   <param>
     <value>$this->blog_url</value>
   </param>
   </params>
</methodCall>
END_OF_TEXT;

	return $payload;
}

//---------------------------------------------------------
//   parse response
//---------------------------------------------------------
// --- success ---
// <methodResponse>
//   <params>
//   <param>
//   <value>
//   <struct>
//     <member>
//       <name>flerror</name>
//       <value>
//       <boolean>0</boolean>
//       </value>
//     </member>
//     <member>
//       <name>message</name>
//       <value>Thanks for the ping.</value>
//     </member>
//   </struct>
//   </value>
//   </param>
//   </params>
// </methodResponse>
//
// --- fault ---
// <methodResponse>
//    <fault>
//    <value>
//    <struct>
//      <member>
//        <name>faultCode</name>
//        <value><int>***</int></value>
//      </member>
//      <member>
//        <name>faultString</name>
//        <value><string>***</string></value>
//      </member>
//   </struct>
//   </value>
//   </fault>
// </methodResponse>
//---------------------------------------------------------
function parseResponse($response)
{
	$error   = 1;
	$message = 'no message';

	$member_arr = $this->parse_xml($response);

// print message
	if ($this->flag_debug) 
	{
		print "<pre>";
		print "--- PARSE --- \n";

		foreach ( $member_arr as $name => $value )
		{
			print "$name: $value \n";
		}
		print "</pre> \n";
	}

	if ( isset($member_arr['flerror']) )
	{
		$error   = $member_arr['flerror'];
		$message = $member_arr['message'];
	}
	elseif ( isset($member_arr['faultCode']) )
	{
		$error   = $member_arr['faultCode'];
		$message = $member_arr['faultString'];
	}

	return array($error, $message);
}

//---------------------------------------------------------
//   parse xml
//---------------------------------------------------------
function parse_xml($xml)
{
	preg_match_all('/<member>(.*?)<\/member>/is', $xml, $match1);
	$arr = $match1[1];

	$member_arr = array();

	foreach ($arr as $member)
	{
		if (preg_match('/<name>(.*)<\/name>/is', $member, $match2))
		{
			$name = trim( $match2[1] );
		}

		if (preg_match('/<value>(.*)<\/value>/is', $member, $match2))
		{
			$value1 = $match2[1];
			$value2 = $value1;

			if (preg_match('/<boolean>(.*)<\/boolean>/is', $value1, $match3))
			{
				$value2 = trim( $match3[1] );
			}

			if (preg_match('/<int>(.*)<\/int>/is', $value1, $match3))
			{
				$value2 = trim( $match3[1] );
			}

			if (preg_match('/<string>(.*)<\/string>/is', $value1, $match3))
			{
				$value2 = trim( $match3[1] );
			}
		}

		$member_arr[$name] = $value2;
	}

	return $member_arr;
}

//---------------------------------------------------------
// make result message
// $list : result list
// $msg  : result message
//---------------------------------------------------------
function make_result($result)
{
	list($url,$code,$reason) = $result;
  
	if ( $code == 0 )
  	{
    	$msg  = "ping send - $url - OK <br />\n";
  	}
  	else
  	{
    	$msg  = "<font color='red'>ping send - $url - NG </font><br />\n";
     	$msg .= "$reason <br />\n";
  	} 

  	return $msg;
}

//---------------------------------------------------------
// get result
//---------------------------------------------------------
function get_result()
{
	return $this->result;
}

//---------------------------------------------------------
// set flag debug to 1
//---------------------------------------------------------
function set_debug()
{
	$this->flag_debug = 1;
}

//---------------------------------------------------------
// reset flag debug to 0
//---------------------------------------------------------
function reset_debug()
{
	$this->flag_debug = 0;
}

//---------------------------------------------------------
// convert to utf8
//---------------------------------------------------------
// check to exist mb_xx function
function convert_to_utf8($text)
{
	if ( function_exists('mb_convert_encoding') )
	{
		$text = mb_convert_encoding( $text, "UTF-8", $this->encode );
	}
	else
	{
		$text = utf8_encode($text);
	}

	return $text;
}

//---------------------------------------------------------
// convert to user encode
//---------------------------------------------------------
// check to exist mb_xx function
function convert_to_user_encode($text)
{
	if ( function_exists('mb_convert_encoding') )
	{
		$text = mb_convert_encoding( $text, $this->encode, "UTF-8" );
	}
	else
	{
		$text = utf8_decode($text);
	}

	return $text;
}

//---------------------------------------------------------
// set user encode
//---------------------------------------------------------
function set_encode($value)
{
	$this->encode = $value;
}

// --- class end ---
}

?>
