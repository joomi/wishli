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



jimport('joomla.application.component.modelform');

/**
 * Wishli model.
 */
class WishliModelForm extends JModelForm
{


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'List', $prefix = 'WishliTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();
		// Get the form.
		$form = $this->loadForm('com_wishli.list', 'list', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$itemId = JRequest::getVar('id');
		$posted = JRequest::getVar('posted');
		
		if ($posted == 1) {
			//get the posted data
			$data1 = JRequest::getVar('jform', array(), 'post', 'array'); 
			//preper the data from the posted array
			//create new object with the posted data
			$db = JFactory::getDBO();
			$data =new JObject();
			
			$data->ordering = 0;
			$data->state = 1;
			$data->checked_out = 0;
			$data->checked_out_time = '0000-00-00 00:00:00';
			$data->title = $data1['title'];
			$data->location = $data1['location'];
			$data->event_date = $data1['event_date'];
			$data->desc = $data1['desc'];
			$data->userid = $data1['userid'];
			$data->categories = $data1['categories'];
			$data->theme = 'none';
		//print_r($data);	
			if($itemId == 0){
				$data->id = NULL;
				$ret = $db->insertObject('#__wishli_list', $data, 'id');
			} elseif($itemId > 0){
				$data->id = $itemId;
				$ret = $db->updateObject('#__wishli_list', $data, 'id');
			}
			if (!$ret) {
				$this->setError($db->getErrorMsg());
			} 
			
		} else {
			$data = $this->getItem();
		}
		
		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		// Initialise variables.
		$itemId = JRequest::getVar('id');
		$posted = JRequest::getVar('posted');
		
		if ($itemId == 0 && $posted == 1) {
			$db = JFactory::getDbo();
			$db->setQuery('SELECT MAX(id) FROM #__wishli_list');
			$max = $db->loadResult();
			$Id = (int) $max ;		
		} else {
			$Id = $itemId;
		}
		// Get a row instance.
		$table = $this->getTable();

		// Attempt to load the row.
		$return = $table->load($Id);

		// Check for a table object error.
		if ($return === false && $table->getError()) {
			$this->setError($table->getError());
			return false;
		}

		$properties = $table->getProperties(1);
		$item = JArrayHelper::toObject($properties, 'JObject');

		// Compute selected asset permissions.
		$user	= JFactory::getUser();
		$userId	= $user->get('id');

		return $item;
	}

//	/**
//	 * Prepare and sanitise the table prior to saving.
//	 *
//	 * @since	1.6
//	 */
//	protected function prepareTable(&$table)
//	{
//		jimport('joomla.filter.output');
//
//		if (empty($table->id)) {
//
//			// Set ordering to the last item if not set
//			if (@$table->ordering === '') {
//				$db = JFactory::getDbo();
//				$db->setQuery('SELECT MAX(ordering) FROM #__wishli_list');
//				$max = $db->loadResult();
//				$table->ordering = $max+1;
//			}
//
//		}
//	}
	
}