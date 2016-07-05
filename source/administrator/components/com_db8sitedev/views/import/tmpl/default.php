<?php
/**
 * @version    CVS: 0.9.4
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
		<?php endif; ?>


		<h1>Import a Checklist</h1>
		For example: Download a default <a
			href="https://github.com/pe7er/db8sitedev" target="_blank"> Site Checklist</a>.
		<br><br><br>
		<form action="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=checklist'); ?>"
		      name="upload" method="post" enctype="multipart/form-data">
			1. <input type="file" name="file_upload"/><br><br>
			2. <input type="submit" value="<?php echo JText::_('COM_DB8SITEDEV_UPLOAD'); ?>"/>
			<input type="hidden" name="task" value="checklist.upload"/>
			<?php echo JHtml::_('form.token'); ?>

		</form>
	</div>
</div>