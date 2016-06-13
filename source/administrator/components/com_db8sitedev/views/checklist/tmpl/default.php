<?php
/**
 * @version    CVS: 0.9.2
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/'); 
?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#clear-search-button').on('click', function () {
			jQuery('#filter_search').val('');
			jQuery('#adminForm').submit();
		});
	});

	window.toggleField = function (id, task, field) {

		var f = document.adminForm,
			i = 0, cbx,
			cb = f[id];

		if (!cb) return false;

		while (true) {
			cbx = f['cb' + i];

			if (!cbx) break;

			cbx.checked = false;
			i++;
		}

		var inputField = document.createElement('input');
		inputField.type = 'hidden';
		inputField.name = 'field';
		inputField.value = field;
		f.appendChild(inputField);

		cb.checked = true;
		f.boxchecked.value = 1;
		window.submitform(task);

		return false;
	};
</script>

<?php if (!empty($this->extra_sidebar))
{
	$this->sidebar .= $this->extra_sidebar;
} ?>

<form action="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=checklist'); ?>" method="post"
	  name="adminForm" id="adminForm">
	<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif; ?>

			<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

			<table class="table table-striped" id="checkList">
				<tfoot>
				<tr>
					<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
				<tbody>
				<?php $last_catid = ""; ?>
				<?php foreach ($this->items as $i => $item) : ?>
					<?php if ($item->catid != $last_catid) : //check if new category ?>
						<tr>
							<td colspan="6">
								<h1> <input type="checkbox" name="checkall-toggle" value=""
									   title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
										<?php echo $item->catid; ?>
								</h1>
							</td>
						</tr>
					<?php endif; ?>
					
					<tr class="row<?php echo $i % 2; ?>">

						<td width="1%" class="hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td width="1%">
							<?php echo JHtml::_('listhelper.toggle', $item->checked, 'checklist', 'checked', $i); ?>
						</td>

						<td>
							<?php echo $this->escape($item->title); ?>
						</td>
						<td>
							<?php echo $item->id; ?>
						</td>
					</tr>

					<?php $last_catid = $item->catid; ?>
				<?php endforeach; ?>
				</tbody>
			</table>

			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
			<?php echo JHtml::_('form.token'); ?>
		</div>
</form>        
