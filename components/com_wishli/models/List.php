<?php
/**
 * @version     1.0.0
 * @package     com_wishli
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');

class WishliModelList extends JModelItem
{
	protected $list;
	protected $gift;

	function &getList()
	{
		if (!isset($this->list))
		{
			$cache = JFactory::getCache('com_wishli', '');
			$user		= JFactory::getUser();
			$userId      = $user->id;
			$listid      = JRequest::getVar('id');
			$listVal     = '';
			$this->list =  $cache->get($userId);

			if ($this->list === false) {
				
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);
				$query->select('a.*');
				$query->from('#__wishli_list as a');
				if($listid){
					$query->where('a.id = ' . (int) $listid);
				} else {
					$query->where('a.userid = ' . (int) $userId);
				}
				

				$db->setQuery($query);
				if (!$db->query()) {
					JError::raiseError(500, $db->getErrorMsg());
				}

				$this->list = $db->loadObjectList();
				$cache->store($this->list, $userId);
			}
		}
		return $this->list;
	}

	function &getGift()
	{
		if (!isset($this->gift))
		{
			$app =& JFactory::getApplication(); 
			$data1 = JRequest::getVar('jform', array(), 'post', 'array');
			$this->setFormData($data1);
			$user		= JFactory::getUser();
			$userId      = $user->id;
			$cache = JFactory::getCache('com_wishli', '');
			$listid      = JRequest::getVar('id');


			$this->gift =  $cache->get($userId);

			if ($this->gift === false) {
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);
				if(isset($listid)){
					$query->select('gift.*')
					->from('#__wishli_gift as gift')
				//	->leftJoin('#__wishli_gift AS gift ON gift.listid = '.$listid)
					->where('gift.listid = '.$listid);
				} else {
					$query->select('aList.* AS list')
					->from('#__wishli_list as aList')
					->leftJoin('#__wishli_gift AS gift ON gift.listid = aList.id')
					->where('aList.userid = ' . $userId)
					->where('gift.listid = aList.id');
				}
			//	->order('ordering');

				$db->setQuery((string)$query);
				if (!$db->query()) {
				//	JError::raiseError(500, $db->getErrorMsg());
					$app->enqueueMessage( $db->getErrorMsg(), 'error' );
				}

				$this->gift = $db->loadObjectList();
				$cache->store($this->gift, $userId);
			}
		}
		return $this->gift;
	}

	function setFormData($data1)
	{
		$app =& JFactory::getApplication(); 

		$listId = JRequest::getVar('id');
		$data = NULL;
	//	$posted = JRequest::getVar('posted');
		 
		
		if ($data1) {
			//preper the data from the posted array
			//create new object with the posted data
			$db = JFactory::getDBO();
			$data =new JObject();
			
			$data->ordering = 0;
			$data->state = 1;
			$data->checked_out = 0;
			$data->checked_out_time = '0000-00-00 00:00:00';
			$data->listid = $listId;
			$data->title = $data1['title'];
			$data->link = $data1['link'];
			$data->desc = $data1['desc'];
			$data->status = 0;
			$data->image = $data1['image'];
			$data->budget = $data1['budget'];
			$data->price = $data1['price'];
		//print_r($data);	
			if(!isset($data1['gift_id'])){
				$data->id = NULL;
				$ret = $db->insertObject('#__wishli_gift', $data, 'id');
			} else {
				$data->id = $data1['gift_id'];
				$ret = $db->updateObject('#__wishli_gift', $data, 'id');
			}
			if (!$ret) {
				//add a message to the message queue
				$app->enqueueMessage( JText::_( 'Some error occurred' ), 'error' );
			} //else {
//				$data->id = $db->insertid();
//			}
		}
		
		return $data;
	}

}

