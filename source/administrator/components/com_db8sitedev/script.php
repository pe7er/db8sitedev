<?php
/**
 * @version    CVS: 0.9.3
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
	 * @param   string $parent Parent is the class calling this method
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function install($parent)
	{
		// Create default Category for db8 Site Dev component

		// Initialize a new category
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/tables');
		$category = JTableCategory::getInstance('Category', 'CategoriesTable');

		// If default category does not exist, create it and add some default items.
		if (!$category->load(array('extension' => 'com_db8sitedev', 'title' => 'db8 Site Dev'))) {
			$category->extension = 'com_db8sitedev';
			$category->title = 'db8 Site Dev';
			$category->description = '';
			$category->published = 1;
			$category->access = 1;
			$category->params = '{"category_layout":"","image":""}';
			$category->metadata = '{"author":"","robots":""}';
			$category->metadesc = '';
			$category->metakey = '';
			$category->language = '*';
			$category->checked_out_time = JFactory::getDbo()->getNullDate();
			$category->version = 1;
			$category->hits = 0;
			$category->modified_user_id = 0;
			$category->checked_out = 0;

			// Set the location in the tree
			$category->setLocation(1, 'last-child');

			// Check to make sure our data is valid
			if (!$category->check()) {
				JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_DB8SITEDEV_ERROR_SAVING_DATA_CATEGORY',
					$category->getError()));
				return;
			}
			// Now store the category
			if (!$category->store(true)) {
				JFactory::getApplication()->enqueueMessage(JText::sprintf('COM_DB8SITEDEV_ERROR_SAVING_DATA_CATEGORY',
					$category->getError()));
				return;
			}
			// Build the path for our category
			$category->rebuildPath($category->id);

			$catId = $category->get('id');

			// Create default items for db8 Site Dev component
			JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_db8sitedev/tables');
			$myItems = JTableCategory::getInstance('Check', 'Db8sitedevTable');

			$checkItems[] = Array ('id' => '0', 'ordering' => '1', 'title' => 'Install db8 Site Dev Component',
				'checked' => '1', 'catid' => $catId, 'state' => '1');
			$checkItems[] = Array ('id' => '0', 'ordering' => '2', 'title' => 'Read the Instructions on the About page',
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
}