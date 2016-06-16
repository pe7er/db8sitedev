<?php
/**
 * @version    CVS: 0.9.3
 * @package    Mod_Db8SiteDev
 * @author      Peter Martin, www.db8.nl
 * @copyright   Copyright (C) 2016 Peter Martin. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
?>
<?php if (count($list)) : ?>
<ul class="list-striped list-condensed stats-module<?php //echo $moduleclass_sfx ?>">
	<?php foreach ($list as $item) : ?>
		<li>
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
							. '&filter[catid]=' . (int)$item->catid . '&filter[checked]=0&list[limit]=0'),
							$item->checked_off,
							array(
							'class' => $class,
							'title' => JHtml::tooltipText('MOD_DB8SITEDEV_UNCHECKED_ITEMS')
							)
						); ?>
				</span>
				<?php endif; ?>
			</span>
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
							. '&filter[catid]=' . (int)$item->catid . '&filter[checked]=1&list[limit]=0'),
							$item->checked_on,
							array(
								'class' => $class,
								'title' => JHtml::tooltipText('MOD_DB8SITEDEV_CHECKED_ITEMS')
							)
						); ?>
					</span>
				<?php endif; ?>
			</span>

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
					. '&filter[catid]=' . (int)$item->catid . '&filter[checked]=&list[limit]=0'),
					$item->title,
					array(
						'class' => $class,
						'title' => JHtml::tooltipText('MOD_DB8SITEDEV_ALL_ITEMS')
					)
				); ?>
			</span>
		</li>
	<?php endforeach; ?>
</ul>
<?php else : ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert"><?php echo JText::_('MOD_DB8SITEDEV_NO_MATCHING_RESULTS'); ?></div>
		</div>
	</div>
<?php endif; ?>
