<?php
/**
 * @version    CVS: 0.9.3
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$list = $this->items;
?>
<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif; ?>
		<h1><?php echo JText::_('COM_DB8SITEDEV_CHECKLIST_STATUS'); ?></h1>
		<?php if (count($list)) : ?>
			<ul class="list-striped list-condensed stats-module<?php //echo $moduleclass_sfx ?>">
				<?php foreach ($list as $item) : ?>
					<li>
			<span class="" title="<?php echo $item->title; ?>">
				<?php if (isset($item) && property_exists($item, 'checked_off')) : ?>
					<span class="center btns">
					<a class="badge <?php if ($item->checked_off > 0) echo "badge-important"; ?> hasTooltip"
					   title="<?php echo JHtml::tooltipText('COM_DB8SITEDEV_UNCHECKED_ITEMS'); ?>"
					   href="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=checklist'
						   . '&filter[catid]=' . (int)$item->catid . '&filter[checked]=0&list[limit]=0'); ?>">
						<?php echo $item->checked_off; ?></a>
				</span>
				<?php endif; ?>
			</span>
			<span class="" title="<?php echo $item->title; ?>">
				<?php if (isset($item) && property_exists($item, 'checked_on')) : ?>
					<span style="width:20px;" class="center btns">
						<a class="badge <?php if ($item->checked_on > 0) echo "badge-success"; ?> hasTooltip"
						   title="<?php echo JHtml::tooltipText('COM_DB8SITEDEV_CHECKED_ITEMS'); ?>"
						   href="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=checklist'
							   . '&filter[catid]=' . (int)$item->catid . '&filter[checked]=1&list[limit]=0'); ?>">
							<?php echo $item->checked_on; ?></a>
					</span>
				<?php endif; ?>
			</span>

			<span class="" title="<?php echo $item->title; ?>">
				<a class="label
				<?php if ($item->checked_off == 0) {
					echo "label-success";
				} else {
					echo "label-warning";
				}

				if ($item->checked_off > 0) echo "label-default";
				?> hasTooltip"
				   title="<?php echo JHtml::tooltipText('COM_DB8SITEDEV_ALL_ITEMS'); ?>"
				   href="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=checklist'
					   . '&filter[catid]=' . (int)$item->catid . '&filter[checked]=&list[limit]=0'); ?>">
					<?php echo $item->title; ?>
				</a>
			</span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert"><?php echo JText::_('COM_DB8SITEDEV_NO_MATCHING_RESULTS'); ?></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if (!empty($this->extra_sidebar)) {
	$this->sidebar .= $this->extra_sidebar;
}
?>
