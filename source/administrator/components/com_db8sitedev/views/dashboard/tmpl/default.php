<?php
/**
 * @version    CVS: 0.9.4
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

			<table class="table table-striped" id="categoryList">
				<thead>
				<tr>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::link(JRoute::_('index.php?option=com_db8sitedev&view=checklist'
							. '&filter[catid]=&filter[checked]=0&list[limit]=0'), '',
							array(
								'class' => 'btn btn-micro inactive btn-danger icon-remove',
								'title' => JHtml::tooltipText('COM_DB8SITEDEV_FILTER_CHECKED_NO')
							)
						); ?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::link(JRoute::_('index.php?option=com_db8sitedev&view=checklist'
							. '&filter[catid]=&filter[checked]=1&list[limit]=0'), '',
							array(
								'class' => "btn btn-micro inactive btn-success icon-checkmark",
								'title' => JHtml::tooltipText('COM_DB8SITEDEV_FILTER_CHECKED_YES')
							)
						); ?>
					</th>
					<th width="18%" class="nowrap left">
						<b><big></big>
							<?php echo JText::_('COM_DB8SITEDEV_CHECKS_CATID'); ?>
						</b>
					</th>
					<th width="80%" class="nowrap left">
						<b>
							<?php echo JText::_('COM_DB8SITEDEV_CHECKS_NOTE'); ?>
						</b>
					</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($list as $i => $item) : ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td class="center">
					<span class="" title="<?php echo $item->title; ?>">
						<?php if (isset($item) && property_exists($item, 'checked_off')) : ?>
							<span class="center btns">
								<?php
								$class = "badge hasTooltip";
								if ($item->checked_off > 0)
								{
									$class .= " badge-important";
								}
								echo JHtml::link(JRoute::_('index.php?option=com_db8sitedev&view=checklist'
									. '&filter[catid]=' . (int) $item->catid . '&filter[checked]=0&list[limit]=0'),
									$item->checked_off,
									array(
										'class' => $class,
										'title' => JHtml::tooltipText('COM_DB8SITEDEV_UNCHECKED_ITEMS')
									)
								); ?>
						</span>
						<?php endif; ?>
					</span>
						</td>
						<td class="center">
					<span class="" title="<?php echo $item->title; ?>">
						<?php if (isset($item) && property_exists($item, 'checked_on')) : ?>
							<span style="width:20px;" class="center btns">
								<?php
								$class = "badge hasTooltip";
								if ($item->checked_on > 0)
								{
									$class .= " badge-success";
								}
								echo JHtml::link(JRoute::_('index.php?option=com_db8sitedev&view=checklist'
									. '&filter[catid]=' . (int) $item->catid . '&filter[checked]=1&list[limit]=0'),
									$item->checked_on,
									array(
										'class' => $class,
										'title' => JHtml::tooltipText('COM_DB8SITEDEV_CHECKED_ITEMS')
									)
								); ?>
							</span>
						<?php endif; ?>
					</span>
						</td>
						<td class="left">
					<span class="" title="<?php echo $item->title; ?>">
						<?php
						$class = "label hasTooltip label-";
						if ($item->checked_off == 0)
						{
							$class .= "success";
						}
						else
						{
							$class .= "default";
						}
						echo JHtml::link(JRoute::_('index.php?option=com_db8sitedev&view=checklist'
							. '&filter[catid]=' . (int) $item->catid . '&filter[checked]=&list[limit]=0'),
							$item->title,
							array(
								'class' => $class,
								'title' => JHtml::tooltipText('COM_DB8SITEDEV_ALL_ITEMS')
							)
						); ?>
					</span>
						</td>
						<td class="left">
					<span class="" title="<?php echo $item->title; ?>">
						<?php echo $item->note; ?>
					</span>

						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert"><?php echo JText::_('COM_DB8SITEDEV_NO_MATCHING_RESULTS'); ?></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
