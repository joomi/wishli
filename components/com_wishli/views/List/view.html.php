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

jimport('joomla.application.component.view');

/**
 * HTML View class for the Wishli component
 */
class WishliViewList extends JView
{
	protected $state;
	protected $list;
	protected $gift;

	// Overwriting JView display method
	function display($tpl = null) 
	{
		$app		= JFactory::getApplication();
		$params		= $app->getParams();
		// Assign data to the view
		$this->list    =   $this->get('List');
		$this->gift    =   $this->get('Gift');
		$this->state   =   $this->get('State');
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Display the view
		parent::display($tpl);
	}
}
