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
		if (task == 'list.cancel' || document.formvalidator.isValid(document.id('list-form'))) {
			Joomla.submitform(task, document.getElementById('list-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_wishli&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="list-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_WISHLI_LEGEND_LIST'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>

            
			<li><?php echo $this->form->getLabel('categories'); ?>
			<?php echo $this->form->getInput('categories'); ?></li>

            
			<li><?php echo $this->form->getLabel('userid'); ?>
			<?php echo $this->form->getInput('userid'); ?></li>

            
			<li><?php echo $this->form->getLabel('desc'); ?>
			<?php echo $this->form->getInput('desc'); ?></li>

            
			<li><?php echo $this->form->getLabel('event_date'); ?>
			<?php echo $this->form->getInput('event_date'); ?></li>

            
			<li><?php echo $this->form->getLabel('location'); ?>
			<?php echo $this->form->getInput('location'); ?></li>

            
			<li><?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?></li>

            
			<li><?php echo $this->form->getLabel('theme'); ?>
			<?php echo $this->form->getInput('theme'); ?></li>

            

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