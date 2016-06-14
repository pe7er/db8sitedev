<?php
/**
 * @version    CVS: 0.9.3
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

use Joomla\Utilities\ArrayHelper;

/**
 * Checks list controller class.
 *
 * @since  1.6
 */
class Db8sitedevControllerAbout extends JControllerAdmin
{
	/**
	 * Method to upload checklist
	 *
	 * @return void
	 */
	public function upload()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$app = JFactory::getApplication(); //->input;
		//$file = $jinput->get('file_upload', '', 'string');
		$file = JRequest::getVar('file_upload', null, 'files', 'array');
		//$file = $jInput->getVar('file_upload', null, 'files', 'array');
		$filename = $file['tmp_name'];

		//$file = $jinput->files('file_upload');

		//jimport('joomla.filesystem.file');

		$json = file_get_contents($filename);
		$items = json_decode($json);

		// Create default Category for db8 Site Dev component
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/tables');
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_db8sitedev/tables');

		$db = JFactory::getDbo();
		$catNo = 0;
		$checkNo = 0;
		foreach ($items AS $item)
		{
			$query = $db->getQuery(true);
			$query->select($db->quoteName('id'));
			$query->from($db->quoteName('#__categories'));
			$query->where($db->quoteName('title') . ' = ' . $db->quote($item->category));
			$db->setQuery($query);
			$catId = $db->loadResult();

			// If category does NOT exist, create it first
			if (!$catId)
			{
				$myCategory = JTableCategory::getInstance('Category', 'CategoriesTable');
				$myCategory->save(
					Array(
						'path' => 'db8-site-dev',
						'extension' => 'com_db8sitedev',
						'title' => $item->category,
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
				$catNo++;
			}

			// Create Check Items if the import has a title
			if(!empty($item->title))
			{
				$myCheckItem = JTableCategory::getInstance('Check', 'Db8sitedevTable');
				$myCheckItem->save(Array ('id' => '0', 'title' => $item->title, 'catid' => $catId, 'checked' => $item->checked,
					'description' => $item->description,'ordering' => $item->ordering, 'state' => $item->state));
				$checkNo++;
			}
		}

		// Something has been imported so Switch OFF the Import function on the About page
		if ($catNo > 0 || $checkNo > 0)
		{
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
		}

		// Return to Dashboard and display a message
		if($catNo == 0 && $checkNo == 0)
		{
			//No items generated
			$app->enqueueMessage(JText::_("COM_DB8SITEDEV_NO_SITE_CHECKLIST_GENERATED"), 'error');
		}
		if($catNo > 0)
		{
			$app->enqueueMessage($catNo . " " . JText::_("COM_DB8SITEDEV_SITE_CHECKLIST_CATS_GENERATED"));
		}
		if($checkNo > 0)
		{
			$app->enqueueMessage($checkNo . " " . JText::_("COM_DB8SITEDEV_SITE_CHECKLIST_CHECKS_GENERATED"));
		}

		$this->setRedirect('index.php?option=com_db8sitedev&view=dashboard');
	}

	/**
	 * Method to download checklist
	 *
	 * @return void
	 */
	public function download()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDbo();
	
		$query = $db->getQuery(true);
		$query->select('cat.title AS category, a.title, a.checked, a.description, a.ordering, a.state')
			->from('#__categories AS cat')
			->where('cat.extension = "com_db8sitedev"')
			->leftJoin('#__db8sitedev_checks AS a ON cat.id = a.catid')
			->order('cat.lft ASC, a.ordering ASC');

		$db->setQuery($query);
		$items = $db->loadObjectList();

		$fileName = "db8-site-dev-export" . '-' . date('Ymd') . '-' . date('His');

		header('Content-disposition: attachment; filename=' . $fileName);
		header('Content-type: application/json');
		echo json_encode($items);

		$app->close();
	}

}