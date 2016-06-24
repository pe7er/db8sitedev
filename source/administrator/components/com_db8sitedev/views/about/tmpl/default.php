<?php
/**
 * @version    CVS: 0.9.3
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
		<pre>
     888 888       .d8888b.        .d8888b.  d8b 888                 8888888b.
     888 888      d88P  Y88b      d88P  Y88b Y8P 888                 888  "Y88b
     888 888      Y88b. d88P      Y88b.          888                 888    888
 .d88888 88888b.   "Y88888"        "Y888b.   888 888888 .d88b.       888    888  .d88b.  888  888
d88" 888 888 "88b .d8P""Y8b.          "Y88b. 888 888   d8P  Y8b      888    888 d8P  Y8b 888  888
888  888 888  888 888    888            "888 888 888   88888888      888    888 88888888 Y88  88P
Y88b 888 888 d88P Y88b  d88P      Y88b  d88P 888 Y88b. Y8b.          888  .d88P Y8b.      Y8bd8P
 "Y88888 88888P"   "Y8888P"        "Y8888P"  888  "Y888 "Y8888       8888888P"   "Y8888    Y88P

</pre>
		<b>db8 Site Dev</b> v0.9.3 - A Joomla Site Development Tool (Component + Module) to
		<b>improve your workflow</b> with <b>Joomla website development</b><br>
		(C) 2016 by Peter Martin, <a href="https://db8.nl" title="Joomla specialist db8.nl"
									 target="_blank">db8.nl</a>.
		All Rights Reserved. This extension has been licensed under GPL v2 and higher.<br>
		Inspired by the awesome <a href="https://github.com/renekreijveld/livechecklist" title="Live Checklist"
								   target="_blank">Live Checklist</a>
		created by <a href="http://www.renekreijveld.nl" target="_blank">Rene Kreijveld</a>.
		<br>
		<h2>Instructions</h2>
		<h3>Component</h3>
		<ol>
			<li>
				Create some <a href="index.php?option=com_categories&extension=com_db8sitedev">Checklist Categories</a>
			</li>
			<li>
				Create a list of <a href="index.php?option=com_db8sitedev&view=checks">Check Items</a> that you want on
				your checklist
			</li>
			<li>
				Manage your <a href="index.php?option=com_db8sitedev&view=checklist">Checklist</a> by toggling items on
				or off
			</li>
			<li>
				Have an overview of the status of all your Checklist Items on the <a
					href="index.php?option=com_db8sitedev&view=dashboard">Dashboard</a>
			</li>
		</ol>
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

		<h3>Module</h3>

		<ol>
			<li>Switch on the <a href="index.php?option=com_modules&client_id=1">Site Checklist Module</a> and
				assign it to position <b>cpanel</b></li>
			<li>The <a href="index.php">Admin Control Panel </a> will display a Module with an overview of the
				checklist.
			</li>
			<li>You can click on any part to navigate to your filtered checklist</li>
		</ol>

		<h2>Background</h2>
		<p>With my company <a href="https://db8.nl" title="Joomla specialist db8.nl" target="_blank">db8.nl</a> I
			support companies with Joomla websites. When developing websites for customers I always have to do<br>
			the same things to configure and optimize the website before putting it live.<br>
			The awesome <a href="https://github.com/renekreijveld/livechecklist" title="Live Checklist" target="_blank">Live
				Checklist</a>
			created by <a href="http://www.renekreijveld.nl" target="_blank">Rene Kreijveld</a> has proven to be a great
			tool
			to keep track of everything that you have to do.<br>
			It's a list of things you have to do to configure and optimize your Joomla website.<br>
			<br>
			However, it's a list that you can use offline next to your computer. But what if such a list would be inside
			the website you were developing?<br>
			I decided to develop this extension to have such a checklist tool within the website that is under
			development.<br>
			Webdevelopers can create their own checklist and export it for use on other websites,
			and import their own, or a default Live Checklist.</p>

		<h2>Credits & Contributions</h2>
		I would like to thank the following fellow Joomla community members who helped me with the development of this
		extension:
		Roland Dalmulder, Rene Kreijveld, Jisse Reitsma.

	</div>
</div>