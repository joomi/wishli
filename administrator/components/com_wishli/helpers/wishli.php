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

/**
 * Wishli helper.
 */
class WishliHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{

		JSubMenuHelper::addEntry(
			JText::_('COM_WISHLI_TITLE_USERSS'),
			'index.php?option=com_wishli&view=userss',
			$vName == 'userss'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_WISHLI_TITLE_LISTS'),
			'index.php?option=com_wishli&view=lists',
			$vName == 'lists'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_WISHLI_TITLE_CATEGORYS'),
			'index.php?option=com_wishli&view=categorys',
			$vName == 'categorys'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_WISHLI_TITLE_GIFTS'),
			'index.php?option=com_wishli&view=gifts',
			$vName == 'gifts'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_WISHLI_TITLE_BUYERS'),
			'index.php?option=com_wishli&view=buyers',
			$vName == 'buyers'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_wishli';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}
