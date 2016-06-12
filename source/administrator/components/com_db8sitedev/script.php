<?php
/**
 * @version    CVS: 0.9.0
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

/**
 * Class Com_Db8sitedevInstallerScript
 * 
 * @since  1.0
 */
class Com_Db8sitedevInstallerScript
{
	/**
	 * Method to create a sample category + some sample check items.
	 *
	 * @param   string  $parent  Parent is the class calling this method
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function postflight ($parent)
	{
		// Create default Category for db8 Site Dev component
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/tables');
		$myCategory = JTableCategory::getInstance('Category', 'CategoriesTable');
		$myData = Array (
			'path' => 'db8-site-dev',
			'extension' => 'com_db8sitedev',
			'title' => 'db8 Site Dev',
			'alias' => 'db8-site-dev',
			'note' => 'This category is a sample category for db8 Site Dev',
			'access' => '1',
			'published' => '1',
			'language' => '*'
		);

		if (!$myCategory->save($myData))
		{
			throw new Exception(JText::_('COM_DB8SITEDEV_ERROR_SAVING_DATA_CATEGORY'));
		}

		$catId = $myCategory->get('id');

		// Correct values for parent_id + level
		$myData = Array (
			'id' => $catId,
			'parent_id' => '1',
			'level' => '1'
		);

		if (!$myCategory->save($myData))
		{
			throw new Exception("Could not save data. Error: " . $myCategory->getError());
		}

		// Create default items for db8 Site Dev component
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_db8sitedev/tables');
		$myItems = JTableCategory::getInstance('Check', 'Db8sitedevTable');
		$checkItems[] = Array ('id' => '0', 'ordering' => '1', 'title' => 'Install db8 Site Dev Component',
			'checked' => '1', 'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '2', 'title' => 'Read the Instructions on the Dashboard',
			'checked' => '0', 'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '3', 'title' => 'Install db8 Site Dev Module',
			'checked' => '0', 'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '4', 'title' => 'Enable db8 Site Dev Module',
			'checked' => '0', 'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '5', 'title' => 'Create some Categories for your checklist',
			'checked' => '0', 'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '6', 'title' => 'Create some Check Items for your checklist', 'checked' => '0',
			'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '7', 'title' => 'Please rate db8 Site Dev at http://extensions.joomla.org',
			'checked' => '0', 'catid' => $catId, 'state' => '1');
		$checkItems[] = Array ('id' => '0', 'ordering' => '8', 'title' => 'Some Unpublished item',
			'checked' => '0', 'catid' => $catId, 'state' => '0');
		$checkItems[] = Array ('id' => '0', 'ordering' => '9', 'title' => 'Some Archived item',
			'checked' => '0', 'catid' => $catId, 'state' => '2');
		$checkItems[] = Array ('id' => '0', 'ordering' => '10', 'title' => 'Some Trashed item',
			'checked' => '0', 'catid' => $catId, 'state' => '-2');

		foreach ($checkItems AS $checkItem)
		{
			if (!$myItems->save($checkItem))
			{
				throw new Exception(JText::_('COM_DB8SITEDEV_ERROR_SAVING_DATA_ITEM'));
			}
		}
	}
}
