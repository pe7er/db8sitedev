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
<div id="j-sidebar-container" class="span2" xmlns="http://www.w3.org/1999/html">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
		<?php endif; ?>
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
		<br >

		<h3>Module</h3>

		<ol>
			<li>Switch on the <a href="index.php?option=com_modules&client_id=1">Site Checklist Module</a> and
				assign it to position <b>cpanel</b></li>
			<li>The <a href="index.php">Admin Control Panel </a> will display a Module with an overview of the
				checklist.
			</li>
			<li>You can click on any part to navigate to your filtered checklist</li>
		</ol>
	</div>
</div>