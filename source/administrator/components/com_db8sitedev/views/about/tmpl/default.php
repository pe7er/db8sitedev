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
	<p><b>db8 Site Dev</b> v0.9.4 - A Joomla Site Development Tool to <strong>improve your workflow</strong> with <strong>Joomla website
		development</strong>.<br>
		(C) 2016 by Peter Martin, <a href="https://db8.nl" title="Joomla specialist db8.nl"
		                                target="_blank">db8.nl</a>.
			All Rights Reserved. This extension has been licensed under GPL v2 and higher.<br>
	</p>
		<ul>
			<li>Create a Checklist for your own workflow</li>
			<li>Export your Checklist and import it in all the websites that you develop</li>
			<li>Keep a full overview of everything that you have done and anything that still needs to be done</li>
			<li>The default English Checklist <a href="https://raw.githubusercontent.com/pe7er/db8sitedev/master/db8-site-dev-default-checklist-en.json"
			                                     target="_blank">db8-site-dev-default-checklist-en.json</a>
				has shortcuts to configuration options in the Joomla admin panel</li>
		</ul>

		<h2>Features</h2>
		<ul>
			<li>Easily manage your own Checklist of everything you have to do before a website can be put online</li>
			<li>Manage your own Checklist of Categories and Checklist items</li>
			<li>Import and export your own Checklist Categories and Checklist Items</li>
			<li>Download and import a default Site Checklist with items related to Joomla website development</li>
			<li>Have a full overview of everything that has been done and have to be done</li>
			<li>Easily check or uncheck items to update the status of an item</li>
			<li>Add notes with details to each Checklist item</li>
			<li>Add hyperlinks to your notes to create short cuts to specific pages in your Joomla admin or external
				websites
			</li>
		</ul>

		<h2>Getting started</h2>
		<ul>
			<li>The Component has been installed with one default Checklist</li>
			<li>Create some <a href="index.php?option=com_categories&extension=com_db8sitedev">Checklist Categories</a>
			</li>
			<li>Create a list of <a href="index.php?option=com_db8sitedev&view=checks">Check Items</a> that you want on
				your checklist
			</li>
			<li>Manage your <a href="index.php?option=com_db8sitedev&view=checklist">Checklist</a> by toggling items on
				or off
			</li>
			<li>Have an overview of the status of all your Checklist Items on the <a
					href="index.php?option=com_db8sitedev&view=dashboard">Dashboard</a></li>
			<li>The Admin Module displays the same overview on your <a href="index.php">Administrator Controlpanel</a>
			</li>
			<li>Import or Export a Checklist on the <a
					href="index.php?option=com_db8sitedev&view=checklist">Checklist</a> page<br><br></li>

			<li>Download default Live Site Checklists at <a href="https://github.com/pe7er/db8sitedev/" target="_blank">Github.com</a>
			</li>
			<li>In case you find a bugs in this software, please create an issue at <a
					href="https://github.com/pe7er/db8sitedev/issues" target="_blank">Github.com</a></li>
			<li>If you find this extension useful, <strong>please leave a positive review at the
				<a href="http://extensions.joomla.org/extensions/extension/db8-site-dev" target="_blank">Joomla
					Extension Directory (JED)</a></strong></li>
		</ul>

		<h2>Background</h2>
		<p>Since 2005 I support with my company <a href="http://www.db8.nl" target="_blank">db8.nl</a> other companies
			with Joomla websites. When developing websites for
			<br>customers I always have to do the same things to configure and optimize the website before putting it
			live.
			<br> The <strong>awesome <a href="https://github.com/renekreijveld/livechecklist" target="_blank">Live
					Checklist</a></strong>
			created by <strong> <a href="http://www.renekreijveld.nl/" target="_blank">Rene Kreijveld</a></strong> has
			proven to be a great tool to keep track of everything
			<br>that you have to do. It's a list of things you have to do to configure and optimize your Joomla website.<br>
			<br>
			However, the list is an offline one that you can use next to your computer. What if such a list would be
			inside the
			<br>website you were developing? I decided to develop this extension to have such a checklist tool within
			the website
			<br>that is under development. Website developers can add their own checklist or Generate a default Live
			Checklist.</p>


		<h2>Credits and Contributions</h2>
		<p>I would like to thank the following fellow Joomla community members that inspired or helped me with the
			development of this extension:<br>
			Roland Dalmulder, Rene Kreijveld, Jisse Reitsma.</p>

		<h3>Language packs</h3>
		<p>This extension is available with the following translations, thanks to my fellow international Joomla
			community members!</p>
		<ul>
			<li>English (en-GB)</li>
			<li>Danish (da-DK) by Ole Bang Ottosen</li>
			<li>Dutch (nl-NL)</li>
			<li>French (fr-FR) by Marc-Antoine Thevenet</li>
			<li>German (de-DE)</li>
		</ul>
		<h3>Default Live Site Checklists</h3>
		<ul>
			<li><a href="https://raw.githubusercontent.com/pe7er/db8sitedev/master/db8-site-dev-default-checklist-en.json" target="_blank">
					db8-site-dev-default-checklist-en.json</a></li>
			<li><a href="https://raw.githubusercontent.com/pe7er/db8sitedev/master/db8-site-dev-default-checklist-fr.json" target="_blank">
					db8-site-dev-default-checklist-fr.json</a> by Yann Gomiero and Marc-Antoine Thevenet</li>
			<li><a href="https://raw.githubusercontent.com/pe7er/db8sitedev/master/db8-site-dev-default-checklist-nl.json" target="_blank">
					db8-site-dev-default-checklist-nl.json</a></li>
		</ul>
		<h3>Suggestions and Improvements</h3>
		<p>
			Wilco Alsemgeest, Ludo Arts, Anja Hage, Markus Hermann, Joris Lange, Nico van Leeuwen, Matthew Philogene,
			Ric Raftis, Brian Teeman, Marc-Antoine Thevenet, John Wood.
		</p>
		</div>
</div>