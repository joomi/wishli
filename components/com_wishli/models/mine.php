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

class WishliModelMine extends JModelItem
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
}

