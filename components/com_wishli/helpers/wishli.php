<?php
/**
 * @version     1.0.0
 * @package     com_wishli
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

abstract class WishliHelper
{
	public static function insertData()
	{
		$posted = JRequest::getVar('postdata');
		
		if($posted == 1){
			$data1 = JRequest::getVar('jform', array(), 'post', 'array'); 
		
			$ordering   = 0;
			$state   = 1;
			$checked_out   = 0;
			$checked_time = '0000-00-00 00:00:00';
			$categories   = $data1['categories'];
			$userid       = $data1['userid'];
			$desc         = $data1['desc'];
			$event_date   = $data1['event_date'];
			$location     = $data1['location'];
			$title        = $data1['title'];
			$theme        = 'none';
			
		//	$db =& JFactory::getDBO();
		//	$query = "INSERT INTO '#__wishli_list' ('ordering', 'state', 'checked_out', 'checked_time', 'title', 'location', 'event_date', 'desc', 'userid', 'categories', 'theme')
		//		VALUES ($ordering, $state, $checked_out, $checked_time, $title, $location, $event_date, $desc, $userid, $categories, $theme);";
		//	$db->setQuery( $query );
		//	$db->query();  
			$db = JFactory::getDBO();
			$data =new JObject();
			$data->id = NULL;
			$data->ordering = 0;
			$data->state = 1;
			$data->checked_out = 0;
			$data->checked_time = '0000-00-00 00:00:00';
			$data->title = $title;
			$data->location = $location;
			$data->event_date = $event_date;
			$data->desc = $desc;
			$data->userid = $userid;
			$data->categories = $categories;
			$data->theme = NULL;
		//print_r($data);	
			$ret = $db->insertObject('#__wishli_list', $data, 'id');
			
			if (!$ret) {
				$this->setError($db->getErrorMsg());
				$result = 'error!';
			} else {
				$result = 'done!';
			}
		
		}

		// Check for errors.
//		if (count($errors = $this->get('Errors'))) {
//			JError::raiseWarning(500, implode("\n", $errors));
//			return false;
//		}
		return result;  

	}

}

