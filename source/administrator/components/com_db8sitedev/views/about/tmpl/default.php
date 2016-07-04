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
		<b>db8 Site Dev</b> v0.9.4 - A Joomla Site Development Tool to
		<b>improve your workflow</b> with <b>Joomla website development</b><br>
		(C) 2016 by Peter Martin, <a href="https://db8.nl" title="Joomla specialist db8.nl"
									 target="_blank">db8.nl</a>.
		All Rights Reserved. This extension has been licensed under GPL v2 and higher.<br>
		Inspired by the awesome <a href="https://github.com/renekreijveld/livechecklist" title="Live Checklist"
								   target="_blank">Live Checklist</a>
		created by <a href="http://www.renekreijveld.nl" target="_blank">Rene Kreijveld</a>.
		<br>
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