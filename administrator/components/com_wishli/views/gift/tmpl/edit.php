<?php
/**
 * @version     1.0.0
 * @package     com_wishli
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'gift.cancel' || document.formvalidator.isValid(document.id('gift-form'))) {
			Joomla.submitform(task, document.getElementById('gift-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_wishli&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="gift-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_WISHLI_LEGEND_GIFT'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>

            
			<li><?php echo $this->form->getLabel('listid'); ?>
			<?php echo $this->form->getInput('listid'); ?></li>

            
			<li><?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?></li>

            
			<li><?php echo $this->form->getLabel('link'); ?>
			<?php echo $this->form->getInput('link'); ?></li>

            
			<li><?php echo $this->form->getLabel('desc'); ?>
			<?php echo $this->form->getInput('desc'); ?></li>

            
			<li><?php echo $this->form->getLabel('status'); ?>
			<?php echo $this->form->getInput('status'); ?></li>

            
			<li><?php echo $this->form->getLabel('image'); ?>
			<?php echo $this->form->getInput('image'); ?></li>

            
			<li><?php echo $this->form->getLabel('budget'); ?>
			<?php echo $this->form->getInput('budget'); ?></li>

            
			<li><?php echo $this->form->getLabel('price'); ?>
			<?php echo $this->form->getInput('price'); ?></li>

            

            <li><?php echo $this->form->getLabel('state'); ?>
                    <?php echo $this->form->getInput('state'); ?></li><li><?php echo $this->form->getLabel('checked_out'); ?>
                    <?php echo $this->form->getInput('checked_out'); ?></li><li><?php echo $this->form->getLabel('checked_out_time'); ?>
                    <?php echo $this->form->getInput('checked_out_time'); ?></li>

            </ul>
		</fieldset>
	</div>


	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>
</form>