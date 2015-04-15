<?php
// $Id: whatsnew_config_form.php,v 1.1 2011/12/30 21:45:54 ohwada Exp $

// 20005-11-06 K.OHWADA
// BUG 3169: need to sanitaize $_SERVER['PHP_SELF']

//================================================================
// What's New Module
// class config form
// 2005-10-01 K.OHWADA
//================================================================

class Whatsnew_Config_Form
{
// constant
	var $FORM_TITLE   = 'Config Setting';
	var $FORM_NAME    = 'config';
	var $SUBMIT_VALUE = _GO;

// class
	var $_config_handler;
	var $_class_block;
	var $_myts;

// cache
	var $_config_cache;

// variable
	var $_start_name  = 'whatsnew';
	var $_token_name  = 'whatsnew';
	var $_hidden_name = 'op';
	var $_submit_name = 'submit';
	var $_method      = 'post';


//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function Whatsnew_Config_Form()
{
// class
	$this->_config_handler =& Whatsnew_Config_Handler::getInstance();
	$this->_class_block    =& Whatsnew_Show_Block::getInstance();
	$this->_myts =& MyTextSanitizer::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new Whatsnew_Config_Form();
	}

	return $instance;
}

//---------------------------------------------------------
// main function
//---------------------------------------------------------
function init_form()
{
	$this->_config_cache =& $this->_config_handler->get_all();
}

function show($config_arr)
{
	if ( !is_array($config_arr) || empty($config_arr) )  return;

// form start
	$this->init_form();
	echo $this->make_form_start($this->FORM_NAME);
	echo $this->make_form_token();
	echo $this->make_form_hidden('op', 'save');
	echo $this->make_table_start();
	echo $this->make_table_title( $this->FORM_TITLE );

// list from config array
	foreach ($config_arr as $id => $config) 
	{
		$title = $this->make_conf_title( $id );
		$ele   = $this->make_conf_element( $id );
		$ele  .= $this->make_conf_hidden( $id );
		echo $this->make_table_line($title, $ele);
	}

	$ele = $this->make_form_submit('submit', $this->SUBMIT_VALUE );
	echo $this->make_table_line('', $ele, 'foot', 'foot');
	echo $this->make_table_end();
	echo $this->make_form_end();

// form end

}

function show_by_catid( $catid )
{
	$config_arr = $this->_config_handler->get_by_catid($catid);

	$this->set_form_name( 'config_'.$catid );
	$this->show( $config_arr );
}

//---------------------------------------------------------
// make config element
//---------------------------------------------------------
function make_conf_element( $id )
{
	$formtype = $this->_config_cache[$id]->getVar('conf_formtype');

	switch ( $formtype ) 
	{
		case 'textarea':
			$ele = $this->make_conf_textarea($id);
			break;

		case 'select':
			$ele = $this->make_conf_select($id);
			break;

//		case 'select_multi':
//			$ele = $this->make_conf_select_multi($id);
//			break;

		case 'radio':
		case 'radio_select':
			$ele = $this->make_conf_radio_select($id);
			break;

		case 'yesno':
		case 'radio_yesno':
			$ele = $this->make_conf_radio_yesno($id);
			break;

		case 'yesno_check':
		case 'checkbox_yesno':
			$ele = $this->make_conf_checkbox_yesno($id);
			break;

//		case 'group':
//			$ele = $this->make_conf_group($id);
//			break;

//		case 'group_multi':
//			$ele = $this->make_conf_group_multi($id);
//			break;

//		case 'user':
//			$ele = $this->make_conf_user($id);
//			break;

//		case 'user_multi':
//			$ele = $this->make_conf_user_multi($id);
//			break;

//		case 'password':
//			$ele = $this->make_conf_password($id);
//			break;

		case 'label':
			$ele = $this->make_conf_label($id);
			break;

		case 'text_image':
			$ele = $this->make_conf_text_image($id);
			break;

		case 'label_image':
			$ele = $this->make_conf_label_image($id);
			break;

		case 'textbox':
		default:
			$ele = $this->make_conf_textbox($id);
			break;
	}

	return $ele;
}

//---------------------------------------------------------
// make table form
//---------------------------------------------------------
function make_table_start()
{
	return "<table width='100%' class='outer' cellspacing='1'>\n";
}

function make_table_title($title)
{
	return "<tr><th colspan='2'>".$title."</th></tr>\n";
}

function make_table_end()
{
	return "</table>\n";
}

function make_table_line($title='', $ele='', $title_class='head', $ele_class='odd')
{
	$text  = "<tr valign='top' align='left'><td class='$title_class'>$title</td>";
	$text .= "<td class='$ele_class'>$ele</td></tr>\n";
	return $text;
}

//---------------------------------------------------------
// make config form
//---------------------------------------------------------
function make_conf_title($id)
{
	$title = $this->_config_cache[$id]->getVar('conf_title');
	$desc  = $this->_config_cache[$id]->getVar('conf_desc');

	if ( $desc )
	{
		if ( $title)
		{
			$title .= "<br /><br />\n";
		}

		$title .= "<span style='font-weight:normal;'>" .$desc. "</span>";
	}

	return $title;
}

function make_conf_textbox($id, $size=50, $maxlength=255)
{
	$name  = $this->get_conf_name($id);
	$value = $this->get_conf_html_value($id);
	$text  = $this->make_form_text($name, $value, $size);
	return $text;
}

function make_conf_label($id)
{
	return $this->get_conf_html_value($id);
}

function make_conf_select($id, $none=0, $none_name='---', $none_value='')
{
	$name    = $this->get_conf_name($id);
	$value   = $this->get_conf_value($id);
	$options = $this->get_conf_options($id);
	$text    = $this->make_form_select($name, $value, $options, $none, $none_name, $none_value);
	return $text;
}

function make_conf_select_options($id, $options, $none=0, $none_name='---', $none_value='')
{
	$name    = $this->get_conf_name($id);
	$value   = $this->get_conf_value($id);
	$text    = $this->make_form_select($name, $value, $options, $none, $none_name, $none_value);
	return $text;
}

function make_conf_radio_select($id)
{
	$name    = $this->get_conf_name($id);
	$value   = $this->get_conf_value($id);
	$options = $this->get_conf_options($id);
	$text    = $this->make_form_radio_select($name, $value, $options);
	return $text;
}

function make_conf_radio_yesno($id)
{
	$name    = $this->get_conf_name($id);
	$value   = $this->get_conf_value($id);
	$options = array( _YES => 1, _NO => 0 );
	$text    = $this->make_form_radio_select($name, $value, $options);
	return $text;
}

function make_conf_checkbox_yesno($id)
{
	$name    = $this->get_conf_name($id);
	$value   = $this->get_conf_html_value($id);
	$checked = $this->make_checked($value, 1);
	$text    = $this->make_form_checkbox($name, 1, $checked);
	return $text;
}

function make_conf_textarea($id)
{
	$name      = $this->get_conf_name($id);
	$valuetype = $this->get_conf_valuetype($id);

	if ($valuetype == 'array') 
	{
		$value = $this->_config_cache[$id]->getVar('conf_value');

		if ($value != '')
		{
			$value_conf = $this->get_conf_value($id);
			$value_show = $this->_myts->htmlSpecialChars( implode('|', $value_conf) );
			$text = $this->make_form_textarea($name, $value_show, 5, 50);
		}
		else
		{
			$text = $this->make_form_textarea($name, '', 5, 50);
		}
	}
	else 
	{
		$value_show = $this->get_conf_html_value($id);
		$text = $this->make_form_textarea($name, $value_show, 5, 50);
	}

	return $text;
}

function make_conf_text_image($id, $size=50, $maxlength=255, $width=0, $height=0, $border=0, $alt='image')
{
	$name   = $this->get_conf_name($id);
	$value  = $this->get_conf_value($id);
	$text   = $this->make_form_text($name, $value, $size);
	$text  .= "<br /><br />\n";
	$text  .= $this->make_html_img($value, $width, $height, $border, $alt);
	return $text;
}

function make_conf_label_image($id, $width=0, $height=0, $border=0, $alt='image')
{
	$name   = $this->get_conf_name($id);
	$value  = $this->get_conf_value($id);
	$text   = $value;
	$text  .= "<br /><br />\n";
	$text  .= $this->make_html_img($value, $width, $height, $border, $alt);
	return $text;
}

function make_conf_hidden($id)
{
	return $this->make_form_hidden('conf_ids[]', $id);
}

//---------------------------------------------------------
// make form box
//---------------------------------------------------------
function make_form_box($action='', $hidden_value='save', $submit_value='save')
{
	$text  = '';
	$text .= $this->make_form_start($this->_start_name, $action, $this->_method);
	$text .= $this->make_form_token($this->_token_name);
	$text .= $this->make_form_hidden($this->_hidden_name, $hidden_value);
	$text .= $this->make_form_submit($this->_submit_name, $submit_value);
	$text .= $this->make_form_end();
	return $text;
}

//---------------------------------------------------------
// make form
//---------------------------------------------------------
function make_form_start($name='', $action='', $method='post')
{
	if ( empty($name) )
	{
		$name = $this->_start_name;
	}

	if ( empty($action) )
	{
		$action = $this->_class_block->_html_special_chars_url( $_SERVER['PHP_SELF'] );
	}

	return "<form name='$name' id='$name' action='$action' method='$method' >\n";
}

function make_form_end()
{
	return "</form>\n";
}

function make_form_token($name='')
{
	if ( !class_exists('XoopsMultiTokenHandler') )  return '';

	if ( empty($name) )
	{
		$name = $this->_token_name;
	}

	$token =& XoopsMultiTokenHandler::quickCreate($name);
	return $this->make_form_hidden($token->getTokenName(), $token->getTokenValue());
}

function make_form_radio_select($name, $value, $options)
{
	$text = '';

	foreach ($options as $opt_name => $opt_val)
	{
		$checked       = $this->make_checked($value, $opt_val);
		$opt_val_show  = $this->_myts->htmlSpecialChars($opt_val);
		$opt_name_show = $this->_myts->htmlSpecialChars($opt_name);
		$text .= $this->make_form_radio($name, $opt_val_show, $checked);
		$text .= " $opt_name_show ";
	}

	return $text;
}

function make_form_checkbox_select($name, $value, $options)
{
	$text = '';

	foreach ($options as $opt_name => $opt_val)
	{
		$checked      = $this->make_checked($value, $opt_val);
		$opt_val_show = $this->_myts->htmlSpecialChars($opt_val);
		$name_show    = $this->_myts->htmlSpecialChars($name);
		$text .= $this->make_form_checkbox($name, $opt_val_show, $checked);
		$text .= " $name_show ";
	}

	return $text;
}

function make_form_select($name, $value, $options, $none=0, $none_name='---', $none_value='')
{
	$text = "<select name='$name'>\n";

	if ($none)
	{
		$text .= "<option value='$none_value' >$none_name</option>\n";
	}

	foreach ($options as $opt_name => $opt_val)
	{
		$selected = '';
		if ($value == $opt_val)
		{
			$selected = "selected='selected'";
		}

		$text .= "<option value='$opt_val' $selected >$opt_name</option>\n";
	}

	$text .= "</select>\n";
	return $text;
}

function make_form_text($name, $value, $size=50, $maxlength=255)
{
	return "<input type='text' name='$name' value='$value' size='$size' maxlength='$maxlength' />\n";
}

function make_form_textarea($name, $value, $rows=5, $cols=50)
{
	$text  = "<textarea name='$name' rows='$rows' cols='$cols' >\n";
	$text .= $value;
	$text .= "</textarea>\n";
	return $text;
}

function make_form_radio($name, $value, $checked='')
{
	return "<input type='radio' name='$name' value='$value' $checked />\n";
}

function make_form_checkbox($name, $value, $checked='')
{
	return "<input type='checkbox' name='$name' value='$value' $checked />\n";
}

function make_form_hidden($name, $value)
{
	return "<input type='hidden' name='$name' value='$value' />\n";
}

function make_form_submit($name, $value)
{
	return "<input type='submit' name='$name' value='$value' />\n";
}


function make_checked($val1, $val2)
{
	if ( isset($val1) && ( $val1 == $val2 ) )
	{
		return 'checked';
	}

	return '';
}

//---------------------------------------------------------
// make html
//---------------------------------------------------------
function make_html_img($image_url, $width=0, $height=0, $border=0, $alt='image')
{
	$text  = "<img ";
	$text .= "src='$image_url' ";

	if ($width)
	{
		$text .= "width='$width' ";
	}

	if ($height)
	{
		$text .= "height='$height' ";
	}

	$text .= "border='$border' ";
	$text .= "alt='$alt' ";
	$text .= "/>";

	return $text;
}

//---------------------------------------------------------
// get config value
//---------------------------------------------------------
function get_id_by_name($name)
{
	return $this->_config_handler->get_id_by_name($name);
}

function get_conf_name($id)
{
	return $this->_config_cache[$id]->getVar('conf_name');
}

function get_conf_valuetype($id)
{
	return $this->_config_cache[$id]->getVar('conf_valuetype');
}

function get_conf_options($id)
{
	return $this->_config_cache[$id]->getVar('conf_options');
}

function get_conf_html_value($id)
{
	return $this->_myts->htmlSpecialChars( $this->get_conf_value($id) );
}

function get_conf_value($id)
{
	return $this->_config_cache[$id]->getConfValueForOutput();
}

//---------------------------------------------------------
// set config value
//---------------------------------------------------------
function set_conf_options($id, $optins)
{
	return $this->_config_cache[$id]->setVar('conf_options', $options);
}

//---------------------------------------------------------
// get POST variable
//---------------------------------------------------------
function get_post($key, $default='')
{
	if ( isset($_POST[$key]) )
	{
		return $_POST[$key];
	}

	return $default;
}


//---------------------------------------------------------
// set parameter
//---------------------------------------------------------
function set_form_title($value)
{
	$this->FORM_TITLE = $value;
}

function set_form_name($value)
{
	$this->FORM_NAME = $value;
}

function set_submit_value($value)
{
	$this->SUBMIT_VALUE = $value;
}

// --- class end ---
}

?>