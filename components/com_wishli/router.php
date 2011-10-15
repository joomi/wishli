<?php
/**
 * @version     1.0.0
 * @package     com_wishli
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

/**
 * @param	array	A named array
 * @return	array
 */
//function WishliBuildRoute(&$query)
//{
//	$segments = array();
//
//	if (isset($query['task'])) {
//		$segments[] = $query['task'];
//		unset($query['task']);
//	}
//	if (isset($query['view'])) {
//		$segments[] = $query['view'];
//		unset($query['view']);
//	}
//	if (isset($query['id'])) {
//		$segments[] = $query['id'];
//		unset($query['id']);
//	}
//
//	return $segments;
//}
//
///**
// * @param	array	A named array
// * @param	array
// *
// * Formats:
// *
// * index.php?/banners/task/id/Itemid
// *
// * index.php?/banners/id/Itemid
// */
//function WishliParseRoute($segments)
//{
//	$vars = array();
//
//	// view is always the first element of the array
//	$count = count($segments);
//
//	if ($count)
//	{
//		if($segments[0] === 'list'){
//			$vars['view']	= $segments[0];
//		} else {
//			$vars['task']	= $segments[0];
//		}
//		$vars['id']	= $segments[1];
//	}
//
////	if ($count)
////	{
////		$count--;
////		$segment = array_shift($segments) ;
////		if (is_numeric($segment)) {
////			$vars['id'] = $segment;
////		}
////	}
//
//	return $vars;
//}
