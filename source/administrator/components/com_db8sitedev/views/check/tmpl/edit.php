<?php
/**
 * @version    CVS: 0.9.1
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_db8sitedev/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {

	});

	Joomla.submitbutton = function (task) {
		if (task == 'check.cancel') {
			Joomla.submitform(task, document.getElementById('check-form'));
		}
		else {

			if (task != 'check.cancel' && document.formvalidator.isValid(document.id('check-form'))) {

				Joomla.submitform(task, document.getElementById('check-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_db8sitedev&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="check-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_DB8SITEDEV_TITLE_CHECK', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<?php echo $this->form->renderField('title'); ?>
					<?php echo $this->form->renderField('state'); ?>
					<?php echo $this->form->renderField('catid'); ?>
					<?php // echo $this->form->renderField('description'); ?>
					<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>"/>
					<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>"/>
					<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>"/>
					<input type="hidden" name="jform[checked_out_time]"
						   value="<?php echo $this->item->checked_out_time; ?>"/>

					<?php
					if (empty($this->item->created_by))
					{
						?>
						<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>"/>
						<?php
					} else {
						?>
						<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>"/>

						<?php
					}
					?>
					<?php

					if (empty($this->item->modified_by))
					{
						?>
						<input type="hidden" name="jform[modified_by]" value="<?php echo JFactory::getUser()->id; ?>"/>

						<?php
					} else {
						?>
						<input type="hidden" name="jform[modified_by]" value="<?php echo $this->item->modified_by; ?>"/>
						<?php
					}
					?>
					<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>

				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
