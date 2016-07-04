<?php
/**
 * @version    CVS: 0.9.4
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$canDo = Db8sitedevHelpersDb8sitedev::getActions();
?>

<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
		<?php endif; ?>

		<?php if ($canDo->get('core.admin')) : ?>

			<?php if (JComponentHelper::getParams('com_db8sitedev')->get('generate_site_checklist_button') == 1) { ?>

				<h4>Import a Checklist</h4>
				<form action="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=about'); ?>"
					  name="upload" method="post" enctype="multipart/form-data">
					<input type="file" name="file_upload"/>
					<input type="submit" value="<?php echo JText::_('COM_DB8SITEDEV_UPLOAD'); ?>"/>
					<input type="hidden" name="task" value="about.upload"/>
					<?php echo JHtml::_('form.token'); ?>
					<br>
					For example: Download a default <a
						href="https://github.com/pe7er/db8sitedev" target="_blank"> Site Checklist</a>.
				</form>
				<?php
			} else { ?>
				<h4>Import a Checklist</h4>
				<p>
					Import has been disabled because you've imported one already. You can enable Import again under [Options]
				</p>
			<?php } ?>

		<?php endif; ?>

		<?php if ($canDo->get('core.admin')) : ?>
			<h4>Export your Checklist</h4>
			<form action="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=about'); ?>" method="post"
				  name="adminForm" id="adminForm">
				<input type="submit" value="<?php echo JText::_('COM_DB8SITEDEV_DOWNLOAD'); ?>"/>
				<input type="hidden" name="task" value="about.download"/>
				<input type="hidden" name="boxchecked" value="0"/>
				<?php echo JHtml::_('form.token'); ?>
			</form>
		<?php endif; ?>

	</div>
</div>