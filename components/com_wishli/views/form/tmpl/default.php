<?php
/**
 * @version		$Id: edit.php 21437 2011-06-04 05:23:08Z eddieajau $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
if($this->user->id > 0){

	$itemId = JRequest::getVar('id');
	$posted = JRequest::getVar('posted');
	if($posted == 1 && $itemId == 0){
		$this->item->id++;
	}

?>

	<div id="header"><a href="index.php?option=com_wishli&view=list&id=<?php echo $this->item->id; ?>&Itemid=109">go to this WishLi >></a></div>
    <div class="edit item-page">
    
    <form action="<?php echo 'index.php?option=com_wishli&posted=1&view=form&id='.(int) $this->item->id; ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
    
        <fieldset>
            <legend><?php echo JText::_('COM_CONTENT_METADATA'); ?></legend>
            <div class="formelm-area">
            <?php echo $this->form->getLabel('title'); ?>
            <?php echo $this->form->getInput('title'); ?>
            </div>
    
            <div class="formelm-area">
            <?php echo $this->form->getLabel('categories'); ?>
            <?php echo $this->form->getInput('categories'); ?>
            </div>
    
            <div class="formelm-area">
            <?php echo $this->form->getLabel('event_date'); ?>
            <?php echo $this->form->getInput('event_date'); ?>
            </div>
    
            <div class="formelm-area">
            <?php echo $this->form->getLabel('location'); ?>
            <?php echo $this->form->getInput('location'); ?>
            </div>
            <div class="formelm-area">
            <?php echo $this->form->getLabel('desc'); ?>
            <?php echo $this->form->getInput('desc'); ?>
            </div>
    
            <?php echo JHtml::_( 'form.token' ); ?>
            <input type="hidden" value="<?php echo $this->user->id; ?>" id="jform_userid" name="jform[userid]" aria-invalid="false">
            <input type="submit" value="submit" name="submit" id="submit"  />
        </fieldset>
    </form>
    </div>
	<?php } ?>