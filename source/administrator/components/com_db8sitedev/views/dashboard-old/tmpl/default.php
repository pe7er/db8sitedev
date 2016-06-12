<?php
/**
 * @version    CVS: 0.9.0
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die; ?>
<form action="<?php echo JRoute::_('index.php?option=com_db8sitedev&view=dashboard'); ?>" method="post"
      name="adminForm" id="adminForm">
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
<b>db8 Site Dev</b> v0.9.0 - A Joomla Site Development Tool<br>
(C) 2016 by Peter Martin, <a href="https://db8.nl" title="Joomla specialist db8.nl" target="_blank">db8.nl</a>.
All Rights Reserved. This extension has been licensed under GPL v2 and higher.<br>
Inspired by the awesome <a href="https://github.com/renekreijveld/livechecklist" title="Live Checklist" target="_blank">Live Checklist</a>
created by <a href="http://www.renekreijveld.nl" target="_blank">Rene Kreijveld</a>.
<br>
<br>
<h1>Instructions</h1>
<h2>Component</h2>
<ol>
    <li>Create some <a href="index.php?option=com_categories&extension=com_db8sitedev">Checklist Categories</a></li>
    <li>Create a list of <a href="index.php?option=com_db8sitedev&view=checks">Check Items</a> that you want on your checklist</li>
    <li>Manage your <a href="index.php?option=com_db8sitedev&view=checklist">Checklist</a> by toggling items on or off<br><br>
<?php
if (JComponentHelper::getParams('com_db8sitedev')->get('generate_site_checklist_button') == 1)
{
	echo '-> or <a href="index.php?option=com_db8sitedev&task=dashboard.generate">[Generate Live Checklist]</a>';
}
else
{
	echo '(The Generate Live Checklist Option has been disabled. To generate Live Checklist, enable it under [Options])';
}
?>
    </li>
</ol>
<h2>Module</h2>
<ol>
    <li>Switch on the <a href="index.php?option=com_modules&client_id=1">Site Checklist Module</a> and assign it to position <b>cpanel</b></li>
    <li>The <a href="index.php">Admin Control Panel </a> will display a Module with an overview of the checklist.</li>
    <li>You can click on any part to navigate to your filtered checklist</li>
</ol>
<br>
</form>
