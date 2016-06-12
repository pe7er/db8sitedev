<?php
/**
 * @package     mod_db8sitedev
 * @author      Peter Martin, www.db8.nl
 * @copyright   Copyright (C) 2016 Peter Martin. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_db8sitedev
 */
abstract class ModDb8sitedevHelper
{

	/**
	 * Method to get items for Checklist
	 *
	 * @param   $params
	 *
	 * @return   mixed
	 */
	public static function getItems(&$params)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('cat.title, cat.id as catid, COUNT(IF(c.checked = 1, 1, NULL)) AS checked_on, COUNT(IF(c.checked = 0, 1, NULL)) AS checked_off ')
			->from('#__db8sitedev_checks AS c')
			->leftJoin('#__categories AS cat ON cat.id = c.catid')
			->where('c.state = 1')
			->order('cat.lft DESC')
			->group('c.catid');

		$db->setQuery($query);
		$items = $db->loadObjectList();

		return $items;
	}


	/**
	 * Method to get count items in categories
	 *
	 * @param   $categories
	 * 
	 * @return mixed
	 */
	public static function countItems(&$categories)
	{
		$db = JFactory::getDbo();

		foreach ($categories as $item)
		{
			$item->count_trashed = 0;
			$item->count_archived = 0;
			$query = $db->getQuery(true);
			$query->select('state, count(*) AS count')
				->from($db->qn('#__db8sitedev_checks'))
				->where('catid = ' . (int) $item->catid)
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
			}
		}

		return $categories;
	}
}
