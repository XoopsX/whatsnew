<?php
// $Id: whatsnew_http_client.php,v 1.1 2011/12/30 21:45:52 ohwada Exp $

// 2005-09-29 K.OHWADA
// change file name & class name

// 2004/08/20 K.OHWADA
// add socket_set_timeout

//=========================================================
// What's New Module
// class http_client
// 2004/07/24 K.OHWADA
//=========================================================

//=========================================================
// class http_client
//=========================================================
class Whatsnew_Http_Client
{
// send
	var $host;
	var $path;
	var $port;
	var $request_method;
	var $content_type;
	var $user_agent;
	
// recieve
	var $response;
	var $ret_code;
	var $ret_message;

// return code
	var $http_error;
	var $http_errmsg;

// for debug
	var $flag_debug;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Http_Client()
{
	$this->http_error = array();
	$this->http_errmsg = array();
	$this->http_error['connect_error']  = 1;
	$this->http_errmsg['connect_error'] = "HTTP connect error:";
	$this->http_error['send_error']     = 2;
	$this->http_errmsg['send_error']    = "HTTP send error.";
	$this->http_error['code_error']     = 3;
	$this->http_errmsg['code_error']    = "HTTP return code error:";
	$this->http_error['timed_out']      = 4;
	$this->http_errmsg['timed_out']     = 'HTTP response timeout.';
	$this->http_error['not_eof']        = 5;
	$this->http_errmsg['not_eof']       = 'HTTP response failed.';
	$this->http_error['no_data']        = 6;
	$this->http_errmsg['no_data']       = 'No data received from host.';

//	$this->set_url($url);

  	$this->setRequestMethod( 'GET' );
	$this->setContentType( 'text/xml' );
	$this->setUserAgent( 'PHP http client 1.0' );

// for debug
	$this->resetDebug();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Http_Client();
	}

	return $instance;
}

//---------------------------------------------------------
// split url
// $url  : server url
//---------------------------------------------------------
function setUrl($url)
{
	$parse  = parse_url($url);

	if ( isset($parse['host']) )  $host   = $parse['host'];
	if ( isset($parse['path']) )  $path   = $parse['path'];
	if ( isset($parse['port']) )  $port   = $parse['port'];

// default port
	if ( empty($port) )
	{
		$port = 80;
	}

	$this->host = $host;
	$this->path = $path;
	$this->port = $port;

	return array($host, $path, $port);
}

//---------------------------------------------------------
// send message & get payload
//---------------------------------------------------------
function send($payload, $timeout1=0, $timeout2=0)
{

	$this->ret_code    = 1;
	$this->ret_message = 'no message';

// send message
	if ($this->send_msg( $payload, $timeout1, $timeout2 ) != 0)
	{
  		return $this->ret_code;
	}

// strip http header
	if ($this->stripHttp() != 0)
	{
  		return $this->ret_code;
  	}

	$this->ret_code = 0;
  	return 0;
}

//---------------------------------------------------------
// send message
//---------------------------------------------------------
function send_msg($payload, $timeout1=0, $timeout2=0)
{
	if ($timeout1 > 0)
	{
		$fp=fsockopen($this->host, $this->port,$errno, $errstr, $timeout1);
	}
	else
	{
		$fp=fsockopen($this->host, $this->port,$errno, $errstr);
	}

	if (!$fp)
	{
		return $this->set_return_code($this->http_error['connect_error'], $this->http_errmsg['connect_error']. ' (' . $errstr . ')');
	}

	$msg  = $this->request_method." ".$this->path." HTTP/1.0\r\n";
	$msg .= "User-Agent: $this->user_agent\r\n";
	$msg .= "Host: ". $this->host  . "\r\n";
	$msg .= "Content-Type: $this->content_type\r\n";
	$msg .= "Content-Length: " . strlen($payload) . "\r\n";
	$msg .= "\r\n";
	$msg .= $payload;

// for debug 
	if ($this->flag_debug) 
	{
		$msg_print = htmlspecialchars( $msg );
		print "<pre>";
		print "---SEND--- \n";
		print "$this->host \n";
		print "\n";
		print $msg_print;
		print "</pre> \n";
	}

	if (!fputs($fp, $msg, strlen($msg)))
	{
		return $this->set_error_code('send_error');
	}

	if ($timeout2 == 0) $timeout2 = $timeout1;
	if ($timeout2 > 0)
	{
		socket_set_timeout($fp, $timeout2);
	}

	$this->readResponse($fp);

	$status = socket_get_status($fp);

	fclose($fp);

	$timed_out = $status['timed_out'];
	$eof       = $status['eof'];

	if ($eof != 1)
	{
		if ($timed_out == 1)
		{
			return $this->set_error_code('timed_out');
		}

		return $this->set_error_code('not_eof');
	}

	if ($this->flag_debug)
	{
		$msg_print = htmlspecialchars( $this->response );
		print "<PRE>---RESPONSE---\n";
		print $msg_print;
		print "-----</PRE>\n";
	}

	return 0;	// OK
}

//---------------------------------------------------------
// read Response
// http://www.php.net/manual/ja/function.fread.php
//---------------------------------------------------------
function readResponse($fp)
{
	$response = '';
	do 
	{
		$data = fread($fp, 8192);
		if ( strlen($data) == 0 )	break;
		$response .= $data;
	} while(true);

	$this->response = $response;
}

//---------------------------------------------------------
// strip HTTP header
//---------------------------------------------------------
function stripHttp($data='')
{
	if (empty($data)) $data = $this->response;

	$headers = array();

	if (empty($data))
	{
		return $this->set_error_code('no_data');
	}

	// see if we got an HTTP 200 OK, else bomb
	// but only do this if we're using the HTTP protocol.
	if(ereg("^HTTP",$data) && !ereg("^HTTP/[0-9\.]+ 200 ", $data))
	{
		$errstr = substr($data, 0, strpos($data, "\n")-1);
		return $this->set_return_code($this->http_error['code_error'], $this->http_errmsg['code_error']. ' (' . $errstr . ')');
	}

	// separate HTTP headers from data
	if (ereg("^HTTP", $data))
	{
		$ar = split("\r\n", $data);
		while (($line = array_shift($ar)))
		{
			if (strlen($line) < 1)
			{
				break;
			}
			$headers[] = $line;
		}
		$data = join("\r\n", $ar);
	}

	$this->response = $data;
	return 0;	// OK
}

//---------------------------------------------------------
// set_request_method
//---------------------------------------------------------
function setRequestMethod($value)
{
	$this->request_method = $value;
}

//---------------------------------------------------------
// set_content_type
//---------------------------------------------------------
function setContentType($value)
{
	$this->content_type = $value;
}

//---------------------------------------------------------
// set_user_agent
//---------------------------------------------------------
function setUserAgent($value)
{
	$this->user_agent = $value;
}

//---------------------------------------------------------
// set_error code
//---------------------------------------------------------
function set_error_code($error)
{
	return $this->set_return_code($this->http_error[$error],$this->http_errmsg[$error] );
}

//---------------------------------------------------------
// set_return_code
//---------------------------------------------------------
function set_return_code($fcode, $fstr='')
{
	if ($fcode == 0)
	{
		// success
		$this->ret_code  = 0;
	}
	else
	{
		// error
		$this->ret_code    = $fcode;
		$this->ret_message = $fstr;
	}

	return $this->ret_code;
}

//---------------------------------------------------------
// get return code
//---------------------------------------------------------
function getCode()
{
	return $this->ret_code;
}

//---------------------------------------------------------
// get return massage
//---------------------------------------------------------
function getMessage()
{
	return $this->ret_message;
}

//---------------------------------------------------------
// get response
//---------------------------------------------------------
function getResponse()
{
	return $this->response;
}

//---------------------------------------------------------
// set flag debug to 1
//---------------------------------------------------------
function setDebug()
{
  $this->flag_debug = 1;
}

//---------------------------------------------------------
// reset flag debug to 0
//---------------------------------------------------------
function resetDebug()
{
  $this->flag_debug = 0;
}

// class end
}

?>
