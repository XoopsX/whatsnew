<?php
// $Id: data.inc.php,v 1.1 2011/12/30 21:45:49 ohwada Exp $

// 2007-06-15 photosite
// future timestamped

// 2007-05-25 photosite
// pico_whatsnew_filter_body

// 2007-05-19 photosite
// category option

// 2007-05-14 photosite
// modified, created

// 2007-05-13 photosite
// for textwiki

// 2007-05-08 photosite
// for pico 1.31 alpha

// 2007-05-06 photosite
// check by category_permissions

// 2007-05-05 photosite
// check by visible

//================================================================
// What's New Module
// get aritciles from module
// for pico <http://www.peak.ne.jp/xoops/>
// by  photosite <http://www.photositelinks.com/>
//================================================================

// === option begin ===
$category_option = '';
//表示するカテゴリー番号をカンマ(,)で区切って記入。空欄なら全カテゴリー表示。
// --- option end ---

$mydirname = basename( dirname( __FILE__ ) ) ;

// === eval begin ===
eval( '

function '.$mydirname.'_new( $limit=0, $offset=0 )
{
	return pico_whatsnew_base( "'.$mydirname.'", "'.$category_option.'", $limit, $offset ) ;
}

' ) ;
// --- eval end ---

// === pico_whatsnew_base begin ===
if (! function_exists('pico_whatsnew_base')) {
	function pico_whatsnew_base( $mydirname, $category_option, $limit=0, $offset=0 )
	{
		global $xoopsUser ;

		$db =& Database::getInstance() ;
		$myts =& MyTextSanitizer::getInstance();
		$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

		$module_handler =& xoops_gethandler('module');
		$config_handler =& xoops_gethandler('config');
		$module =& $module_handler->getByDirname($mydirname);
		$mod_config =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

		// categories can be read by current viewer (check by category_permissions)
		$whr_readcontent = 'o.`cat_id` IN (' . implode( "," , pico_whatsnew_categories_can_read( $mydirname ) ) . ')' ;

		$categories = trim( @$category_option ) === '' ? array() : array_map( 'intval' , explode( ',' , $category_option ) ) ;
		// categories
		if( $categories === array() ) {
			$whr_categories = '1' ;
		} else {
			$whr_categories = 'o.cat_id IN ('.implode(',',$categories).')' ;
		}

		$sql = "SELECT  o.content_id, o.vpath, o.cat_id, o.created_time, o.modified_time, o.poster_uid, o.subject, o.visible, o.use_cache, o.viewed, o.body, o.body_cached, o.filters, c.cat_id, c.cat_title FROM ".$db->prefix($mydirname."_contents")." o LEFT JOIN ".$db->prefix($mydirname."_categories")." c ON o.cat_id=c.cat_id WHERE ($whr_readcontent) AND ($whr_categories) AND o.visible AND o.created_time <= UNIX_TIMESTAMP() ORDER BY o.modified_time DESC" ;

		$result = $db->query($sql, $limit, $offset);

		$URL_MOD = XOOPS_URL.'/modules/'.$mydirname;

		$i = 0;
		$ret = array();

		while( $row = $db->fetchArray($result))
		{
			$id     = $row['content_id'];
			$ret[$i]['link']  =  $URL_MOD.'/'.pico_whatsnew_content_link4html( $mod_config , $row );
			$ret[$i]['cat_link'] = $URL_MOD.'/'.pico_whatsnew_category_link4html( $mod_config , $row );
			$ret[$i]['title'] = $myts->makeTboxData4Show($row['subject']);
			$ret[$i]['cat_name'] = $myts->makeTboxData4Show($row['cat_title']);
			$ret[$i]['time']  = $row['modified_time'];
			$ret[$i]['modified'] = $row['modified_time'];
			$ret[$i]['created']  = $row['created_time'];
			$ret[$i]['uid']  = $row['poster_uid'];
			$ret[$i]['hits'] = $row['viewed'];

// description
			if ( strstr( $row['filters'] , 'eval' ) || strstr( $row['filters'] , 'xoopstpl' )){
				$ret[$i]['description'] = htmlspecialchars( xoops_substr( strip_tags( $row['body'] ) , 0 , 255 ) , ENT_QUOTES ) ;
			} else {
				$ret[$i]['description'] = pico_whatsnew_filter_body( $mydirname , $row , $row['use_cache'] );
			}

			$i++;
		}

		return $ret;
	}
}
// --- pico_whatsnew_base end ---

// === pico_whatsnew_categories_can_read begin ===
if (! function_exists('pico_whatsnew_categories_can_read')) {
	function pico_whatsnew_categories_can_read( $mydirname )
	{
		global $xoopsUser ;

		$db =& Database::getInstance() ;

		if( is_object( $xoopsUser ) ) {
			$uid = intval( $xoopsUser->getVar('uid') ) ;
			$groups = $xoopsUser->getGroups() ;
			if( ! empty( $groups ) ) {
				$whr4cat = "`uid`=$uid || `groupid` IN (".implode(",",$groups).")" ;
			} else {
				$whr4cat = "`uid`=$uid" ;
			}
		} else {
			$whr4cat = "`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
		}

		// get categories
		$sql = "SELECT distinct cat_id FROM ".$db->prefix($mydirname."_category_permissions")." WHERE ($whr4cat)" ;
		$result = $db->query( $sql ) ;
		if( $result ) while( list( $cat_id ) = $db->fetchRow( $result ) ) {
			$cat_ids[] = intval( $cat_id ) ;
		}
		
		if( empty( $cat_ids ) ) return array(0) ;
		else return $cat_ids ;
	}
}
// --- pico_whatsnew_categories_can_read end ---

// === pico_whatsnew_content_link4html begin ===
if (! function_exists('pico_whatsnew_content_link4html')) {
	function pico_whatsnew_content_link4html( $mod_config , $content_row , $mydirname = null )
	{
		if( ! empty( $mod_config['use_wraps_mode'] ) ) {
			// wraps mode 
			if( ! is_array( $content_row ) && ! empty( $mydirname ) ) {
				// specify content by content_id instead of content_row
				$db =& Database::getInstance() ;
				$content_row = $db->fetchArray( $db->query( "SELECT content_id,vpath FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=".intval($content_row) ) ) ;
			}

			if( ! empty( $content_row['vpath'] ) ) {
				$ret = 'index.php'.htmlspecialchars($content_row['vpath'],ENT_QUOTES) ;
			} else {
				$ret = 'index.php' . sprintf( '/content%04d.html' , intval( $content_row['content_id'] ) ) ;
			}
			return empty( $mod_config['use_rewrite'] ) ? $ret : substr( $ret , 10 ) ;
		} else {
			// normal mode
			$content_id = is_array( $content_row ) ? intval( $content_row['content_id'] ) : intval( $content_row ) ;
			return empty( $mod_config['use_rewrite'] ) ? 'index.php?content_id='.$content_id : substr( sprintf( '/content%04d.html' , $content_id ) , 1 ) ;
		}
	}
}
// --- pico_whatsnew_content_link4html end ---

// === pico_whatsnew_category_link4html begin ===
if (! function_exists('pico_whatsnew_category_link4html')) {
	function pico_whatsnew_category_link4html( $mod_config , $cat_row , $mydirname = null )
	{
		if( ! empty( $mod_config['use_wraps_mode'] ) ) {
			if( empty( $cat_row ) || is_array( $cat_row ) && $cat_row['cat_id'] == 0 ) return '' ;
			if( ! is_array( $cat_row ) && ! empty( $mydirname ) ) {
				// specify category by cat_id instead of cat_row
				$db =& Database::getInstance() ;
				$cat_row = $db->fetchArray( $db->query( "SELECT cat_id,cat_vpath FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=".intval($cat_row) ) ) ;
			}
			if( ! empty( $cat_row['cat_vpath'] ) ) {
				$ret = 'index.php'.htmlspecialchars($cat_row['cat_vpath'],ENT_QUOTES) ;
				if( substr( $ret , -1 ) != '/' ) $ret .= '/' ;
			} else {
				$ret = 'index.php' . sprintf( '/category%04d.html' , intval( $cat_row['cat_id'] ) ) ;
			}
			return empty( $mod_config['use_rewrite'] ) ? $ret : substr( $ret , 10 ) ;
		} else {
			// normal mode
			$cat_id = is_array( $cat_row ) ? intval( $cat_row['cat_id'] ) : intval( $cat_row ) ;
			if( $cat_id ) return empty( $mod_config['use_rewrite'] ) ? 'index.php?cat_id='.$cat_id : substr( sprintf( '/category%04d.html' , $cat_id ) , 1 ) ;
			else return '' ;
		}
	}
}
// --- pico_whatsnew_category_link4html end ---

// === pico_whatsnew_filter_body begin ===
if (! function_exists('pico_whatsnew_filter_body')) {
	function pico_whatsnew_filter_body( $mydirname , $content_row , $use_cache = false )
	{
		include_once XOOPS_TRUST_PATH.'/modules/pico/include/common_functions.php' ;

		$can_use_cache = $content_row['use_cache'] && $content_row['body_cached'] ;

		if( $can_use_cache ) {
			return $content_row['body_cached'] ;
		}

		// process each filters
		$text = $content_row['body'] ;
		foreach( explode( '|' , $content_row['filters'] ) as $filter ) {
			$filter = trim( $filter ) ;
			$func_name = 'pico_'.$filter ;
			$file_path = XOOPS_TRUST_PATH.'/modules/pico/filters/pico_'.$filter.'.php' ;
			if( function_exists( $func_name ) ) {
				$text = $func_name( $mydirname , $text , $content_row ) ;
			} else if( file_exists( $file_path ) ) {
				include_once $file_path ;
				$text = $func_name( $mydirname , $text , $content_row ) ;
			}
		}
		return $text ;
	}
// --- pico_whatsnew_filter_body end ---
}

?>