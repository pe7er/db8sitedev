<?php
/**
 * @version    CVS: 0.9.2
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Db8sitedev helper.
 *
 * @since  1.6
 */
class Db8sitedevHelpersDb8sitedev
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_DB8SITEDEV_TITLE_DASHBOARD'),
			'index.php?option=com_db8sitedev&view=dashboard',
			$vName == 'dashboard'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_DB8SITEDEV_TITLE_CHECKLIST'),
			'index.php?option=com_db8sitedev&view=checklist',
			$vName == 'checklist'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_DB8SITEDEV_TITLE_CHECKS'),
			'index.php?option=com_db8sitedev&view=checks',
			$vName == 'checks'
		);

		JHtmlSidebar::addEntry(
			JText::_('JCATEGORIES'),
			"index.php?option=com_categories&extension=com_db8sitedev",
			$vName == 'categories'
		);

		if ($vName == 'categories')
		{
			JToolbarHelper::title('COM_DB8SITEDEV: JCATEGORIES (COM_DB8SITEDEV_TITLE_CHECKS)');
		}

		JHtmlSidebar::addEntry(
			JText::_('COM_DB8SITEDEV_TITLE_ABOUT'),
			'index.php?option=com_db8sitedev&view=about',
			$vName == 'about'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 *
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_db8sitedev';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}

	/**
	 * Adds Count Items for Category Manager.
	 *
	 * @param   stdClass[]  &$items  The banner category objects
	 *
	 * @return  stdClass[]
	 *
	 * @since   3.5
	 */
	public static function countItems(&$items)
	{
		$db = JFactory::getDbo();

		foreach ($items as $item)
		{
			$item->count_trashed = 0;
			$item->count_archived = 0;
			$item->count_unpublished = 0;
			$item->count_published = 0;
			$query = $db->getQuery(true);
			$query->select('state, count(*) AS count')
				->from($db->qn('#__db8sitedev_checks'))
				->where('catid = ' . (int) $item->id)
				->group('state');
			$db->setQuery($query);
			$articles = $db->loadObjectList();

			foreach ($articles as $article)
			{
				if ($article->state == 1)
				{
					$item->count_published = $article->count;
				}

				if ($article->state == 0)
				{
					$item->count_unpublished = $article->count;
				}

				if ($article->state == 2)
				{
					$item->count_archived = $article->count;
				}

				if ($article->state == -2)
				{
					$item->count_trashed = $article->count;
				}
			}
		}

		return $items;
	}
}


class Db8sitedevHelper extends Db8sitedevHelpersDb8sitedev
{

}
