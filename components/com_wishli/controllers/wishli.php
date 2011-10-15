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

jimport('joomla.application.component.controllerform');

/**
 * List controller class.
 */
class WishliControllerForm extends JControllerForm
{

//    function __construct() {
//        $this->view_list = 'Form';
//        parent::__construct();
//    }
	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}

    public function submit(){
		$this->setRedirect(JRoute::_('index.php?option=com_wishli&view=list&id=4', false));
		
		return true;
    }

}