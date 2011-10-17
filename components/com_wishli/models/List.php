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
			$data2 = JRequest::getVar('jbuyer', array(), 'post', 'array');
			$this->addBuyer($data2);
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
					->where('gift.listid = '.$listid);
				} //else {
//					$query->select('gifts.* AS gift')
//					->from('#__wishli_gift as gifts')
//					->leftJoin('#__wishli_list AS lists ON gifts.listid = lists.id')
//					->where('gifts.listid = lists.id');
//				}
			//	->order('ordering');

				$db->setQuery((string)$query);
				if (!$db->query()) {
					$app->enqueueMessage( $db->getErrorMsg(), 'error' );
				}

				$this->gift = $db->loadObjectList();
				$cache->store($this->gift, $userId);
			}
		}
		return $this->gift;
	}

	function &getBuyer()
	{
		if (!isset($this->buyer))
		{
			$app =& JFactory::getApplication(); 
			$user		= JFactory::getUser();
			$userId      = $user->id;
			$cache = JFactory::getCache('com_wishli', '');
			$listid      = JRequest::getVar('id');

			$this->buyer =  $cache->get($listid);

			if ($this->buyer === false) {
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);
				if(isset($listid)){
					$query->select('buyer.*')
					->from('#__wishli_buyer as buyer')
					->where('buyer.list_id = '.$listid);
				} 

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

	function &getAccess()
	{
	//	if (!isset($this->access))
	//	{
			$user		= JFactory::getUser();
			$userId      = $user->id;
			$cache = JFactory::getCache('com_wishli', '');

	//		$this->access =  $cache->get($userId);

	//		if ($this->access === false) {
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);
				$query->select('list.id')
				->from('#__wishli_list as list')
				->where('list.userid = '.$userId);

				$db->setQuery((string)$query);
				if (!$db->query()) {
					$app->enqueueMessage( $db->getErrorMsg(), 'error' );
				}

				$this->access = $db->loadResultArray();
	//			$cache->store($this->access, $userId);
	//		}
	//	}
		return $this->access;
	}

	function setFormData($data1)
	{
		$app =& JFactory::getApplication(); 
		$listId = JRequest::getVar('id');
		if(!isset($listId) && $data1){
			$listId = $data1['listid'];
		}
		$data = NULL;
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
			} 
		}
		return $data;
	}

	function addBuyer($data2)
	{
		$app =& JFactory::getApplication(); 
		$data = NULL;
		$user		= JFactory::getUser();
		$userId      = $user->id;
		
		if ($data2) {
			//preper the data from the posted array
			//create new object with the posted data
			$db = JFactory::getDBO();
			$data =new JObject();
			
			$query	= $db->getQuery(true);
			$query->select('status')
			->from('#__wishli_gift')
			->where('id = '.$data2['gift_id']);
			$db->setQuery($query);
			$getPersent = $db->loadResult();
						
			$data->ordering            = 0;
			$data->state               = 1;
			$data->checked_out         = 0;
			$data->checked_out_time    = '0000-00-00 00:00:00';
			$data->user_id             = $userId;
			$data->gift_id             = $data2['gift_id'];
			$data->list_id             = $data2['list_id'];
			$data->buyer_name          = $data2['name'];
			$data->email               = $data2['email'];
			$data->attending           = $data2['attending'];
			$data->message             = $data2['message'];
			$data->percentage          = $data2['percentage'];
			$data->id = NULL;
			$ret  = $db->insertObject('#__wishli_buyer', $data, 'id');
			if (!$ret) {
				//add a message to the message queue
				$app->enqueueMessage( JText::_( 'Some error occurred' ), 'error' );
			} 
			
			$data3 =new JObject();
			$data3->id                 = $data2['gift_id'];
			$data3->status             = (int)$data2['percentage'] + (int)$getPersent;
			$ret2 = $db->updateObject('#__wishli_gift', $data3, 'id');
			if (!$ret2) {
				//add a message to the message queue
				$app->enqueueMessage( JText::_( 'Some error occurred' ), 'error' );
			} 
		}
		return $data;
	}

}