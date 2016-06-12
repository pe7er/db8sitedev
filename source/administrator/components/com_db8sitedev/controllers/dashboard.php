<?php
/**
 * @version    CVS: 0.9.0
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

use Joomla\Utilities\ArrayHelper;

/**
 * Dashboards list controller class.
 *
 * @since  1.6
 */
class Db8sitedevControllerDashboard extends JControllerAdmin
{
	/**
	 * Method to generate default Site Checklist
	 *
	 * @return void
	 */
	public function generate()
	{
		// Check for request forgeries
		// JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Content for Site Checklist based on https://github.com/renekreijveld/livechecklist

		// Security
		$items[] = Array ("check" => 'Error reporting disabled?', "cat" => 'Security');
		$items[] = Array ("check" => 'ReCaptcha private/public keys?', "cat" => 'Security');
		$items[] = Array ("check" => 'Default Captcha set?', "cat" => 'Security');
		$items[] = Array ("check" => 'Removed all unused Users from User Manager?', "cat" => 'Security');
		$items[] = Array ("check" => 'Removed all unused User Groups?', "cat" => 'Security');
		$items[] = Array ("check" => 'Allow User Registration: No (if necessary)?', "cat" => 'Security');
		$items[] = Array ("check" => 'Password complexity setup?', "cat" => 'Security');
		$items[] = Array ("check" => 'Redirect non-ssl to ssl setup in .htaccess?', "cat" => 'Security');
		$items[] = Array ("check" => 'Prevent blocking own IP-addresses?', "cat" => 'Security');
		$items[] = Array ("check" => 'Block access to administrator folder with admin secret URL parameter?', "cat" => 'Security');
		$items[] = Array ("check" => 'HTTPS:// Certificate setup (if necessary)?', "cat" => 'Security');
		$items[] = Array ("check" => 'Is there a backup scheme?', "cat" => 'Security');
		$items[] = Array ("check" => 'Backup AND restore tested?', "cat" => 'Security');
		$items[] = Array ("check" => '(S)FTP login created for support?', "cat" => 'Security');

		// Configuration
		$items[] = Array ("check" => 'Unpublish or uninstalled all unused extensions?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Joomla up-to-date?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'General email address setup?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Mail Settings setup and SMTP server setup?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Mass Mail disabled?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Server timezone set correctly?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Session settings setup?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Feed Email Address to `No Email`?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Do all webforms have email handling and emailadresses setup correctly?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Activated HTTPS (if necessary)?', "cat" => 'Configuration');
		$items[] = Array ("check" => 'Caching setup?', "cat" => 'Configuration');

		// 3rd Party Extensions
		$items[] = Array ("check" => 'All 3rd party Extensions up-to-date?', "cat" => '3rd Party Extensions');
		$items[] = Array ("check" => 'ACL Manager installed and configured?', "cat" => '3rd Party Extensions');
		$items[] = Array ("check" => 'Cleaned form submissions?', "cat" => '3rd Party Extensions');
		$items[] = Array ("check" => 'Cleaned all test Newsletters?', "cat" => '3rd Party Extensions');
		$items[] = Array ("check" => 'Back-end login form security installed and enabled ?', "cat" => '3rd Party Extensions');
		$items[] = Array ("check" => 'Sitemap extension installed?', "cat" => '3rd Party Extensions');

		// Template
		$items[] = Array ("check" => 'Unpublished or uninstalled all unused templaes?', "cat" => 'Template');
		$items[] = Array ("check" => 'Template `Preview Module Positions` disabled?', "cat" => 'Template');
		$items[] = Array ("check" => 'Favicon installed and tested?', "cat" => 'Template');
		$items[] = Array ("check" => 'Mobile icons installed and tested?', "cat" => 'Template');
		$items[] = Array ("check" => 'Added a custom 404 page?', "cat" => 'Template');
		$items[] = Array ("check" => 'Has the website been tested in all major browsers?', "cat" => 'Template');
		$items[] = Array ("check" => 'Is a Mobile template present and tested?', "cat" => 'Template');

		// Content
		$items[] = Array ("check" => 'Removed all unused content?', "cat" => 'Content');
		$items[] = Array ("check" => 'Removed all unused files and images like default Joomla images?', "cat" => 'Content');
		$items[] = Array ("check" => 'All Lorem Ipsum / dummy content has been removed?', "cat" => 'Content');
		$items[] = Array ("check" => 'Removed all deleted Articles from trash?', "cat" => 'Content');
		$items[] = Array ("check" => 'Removed all deleted Categories from trash?', "cat" => 'Content');
		$items[] = Array ("check" => 'Removed all deleted Menu items from trash?', "cat" => 'Content');
		$items[] = Array ("check" => 'Removed all deleted Modules from trash?', "cat" => 'Content');
		$items[] = Array ("check" => 'Replaced development URLs in the database with production URLs?', "cat" => 'Content');

		// SEO
		$items[] = Array ("check" => 'Robots.txt setup', "cat" => 'SEO');
		$items[] = Array ("check" => 'URL redirects from old site to new site setup?', "cat" => 'SEO');
		$items[] = Array ("check" => 'Redirect www to non-www in .htaccess?', "cat" => 'SEO');
		$items[] = Array ("check" => 'Sitemap created for all menus?', "cat" => 'SEO');
		$items[] = Array ("check" => 'Add line to .htaccess to show OSXMAP sitemap as sitemap.xml?', "cat" => 'SEO');
		$items[] = Array ("check" => 'XML Sitemap added to Google Webmaster Tools?', "cat" => 'SEO');
		$items[] = Array ("check" => 'Search-engine friendly URLs installed and configured?', "cat" => 'SEO');
		$items[] = Array ("check" => 'Social Share installed and configured?', "cat" => 'SEO');

		// Performance
		$items[] = Array ("check" => 'Optimized images?', "cat" => 'Performance');
		$items[] = Array ("check" => 'Mootools enabler/disabler active?', "cat" => 'Performance');
		$items[] = Array ("check" => 'Cleared cache/tmp folders?', "cat" => 'Performance');
		$items[] = Array ("check" => 'Varnish setup?', "cat" => 'Performance');
		$items[] = Array ("check" => 'CSS/Javascript compress/merge installed and configured?', "cat" => 'Performance');
		$items[] = Array ("check" => 'CDN activated?', "cat" => 'Performance');
		$items[] = Array ("check" => 'Website checked outside your own network/DNS?', "cat" => 'Performance');
		$items[] = Array ("check" => 'Website speed checked?', "cat" => 'Performance');

		// Usability
		$items[] = Array ("check" => 'Unpublished unused Search Plugins?', "cat" => 'Usability');
		$items[] = Array ("check" => 'Unpublished unused Smart Search Plugins?', "cat" => 'Usability');
		$items[] = Array ("check" => 'Are search plugins in correct order?', "cat" => 'Usability');
		$items[] = Array ("check" => 'JCE editor - Optimized profile added/configured?', "cat" => 'Usability');
		$items[] = Array ("check" => 'JCE editor - editors-xtd plugins unpublished?', "cat" => 'Usability');

		// Extras
		$items[] = Array ("check" => 'Clear + Rebuild Smart Search indexes (if used)?', "cat" => 'Extras');
		$items[] = Array ("check" => 'Cookie Law / Cookie alert?', "cat" => 'Extras');
		$items[] = Array ("check" => 'Watchful.li setup?', "cat" => 'Extras');
		$items[] = Array ("check" => 'myJoomla.com audit done?', "cat" => 'Extras');
		$items[] = Array ("check" => 'Trainingwebsite archived and removed?', "cat" => 'Extras');

		// Marketing
		$items[] = Array ("check" => 'Google Analytics setup?', "cat" => 'Marketing');

		// Create default Category for db8 Site Dev component
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/tables');
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_db8sitedev/tables');

		foreach ($items AS $item)
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select($db->quoteName('id'));
			$query->from($db->quoteName('#__categories'));
			$query->where($db->quoteName('title') . ' = ' . $db->quote($item["cat"]));
			$db->setQuery($query);

			$catId = $db->loadResult();

			// If category does NOT exist, create it first
			if (!$catId)
			{
				print "create new category: " . $item["cat"];
				$myCategory = JTableCategory::getInstance('Category', 'CategoriesTable');
				$myCategory->save(
					Array(
						'path' => 'db8-site-dev',
						'extension' => 'com_db8sitedev',
						'title' => $item["cat"],
						'access' => '1',
						'published' => '1',
						'language' => '*'
					)
				);
				$catId = $myCategory->get('id');

				// Correct values for parent_id + level for the new category
				$myCategory->save(
					Array(
						'id' => $catId,
						'parent_id' => '1',
						'level' => '1'
					)
				);
			}

			$myCheckItem = JTableCategory::getInstance('Check', 'Db8sitedevTable');
			$myCheckItem->save(Array ('id' => '0', 'title' => $item["check"], 'catid' => $catId, 'state' => '1'));
		}

		// Switch OFF Generate Site Checklist Button
		$params = JComponentHelper::getParams('com_db8sitedev');
		$params->set('generate_site_checklist_button', 0);
		$componentId = JComponentHelper::getComponent('com_db8sitedev')->id;
		$table = JTable::getInstance('extension');
		$table->load($componentId);
		$table->bind(array('params' => $params->toString()));

		// Check for error
		if (!$table->check())
		{
			echo $table->getError();

			return false;
		}

		// Save to database
		if (!$table->store())
		{
			echo $table->getError();

			return false;
		}

		// Return to Dashboard
		JFactory::getApplication()->enqueueMessage(JText::_('COM_DB8SITEDEV_SITE_CHECKLIST_GENERATED', 'type'));
		$this->setRedirect('index.php?option=com_db8sitedev&view=dashboard');
	}
}
