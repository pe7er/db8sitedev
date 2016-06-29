<?php
/**
 * @version    CVS: 0.9.4
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
class Db8sitedevControllerChecklist extends JControllerAdmin
{
	/**
	 * Method to toggle fields on a list
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function toggle()
	{
		// Initialise variables
		$app = JFactory::getApplication();
		$ids = $app->input->get('cid', array(), '', 'array');
		$field = 'checked';

		if (empty($ids))
		{
			$app->enqueueMessage('warning', JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			// Get the model
			$model = JModelLegacy::getInstance('check', 'Db8sitedevModel');

			foreach ($ids as $pk) {

				// Toggle the items
				if (!$model->toggle($pk, $field))
				{
					throw new Exception(500, $model->getError());
				}
			}
		}

		$this->setRedirect('index.php?option=' . $app->input->get('option') . '&view=checklist');
	}

	/**
	 * Method to toggle fields on a list OFF
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function toggle_off()
	{
		// Initialise variables
		$app = JFactory::getApplication();
		$ids = $app->input->get('cid', array(), '', 'array');

		if (empty($ids))
		{
			$app->enqueueMessage('warning', JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_db8sitedev/tables');
			$myItems = JTableCategory::getInstance('Check', 'Db8sitedevTable');

			foreach ($ids as $pk) {

				if (!$myItems->save( Array('id' => $pk, 'checked' => '0')))
				{
					throw new Exception(JText::_('COM_DB8SITEDEV_ERROR_SAVING_DATA_ITEM'));
				}
			}
		}

		$this->setRedirect('index.php?option=' . $app->input->get('option') . '&view=checklist');
	}

	/**
	 * Method to toggle fields on a list ON
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function toggle_on()
	{
		// Initialise variables
		$app = JFactory::getApplication();
		$ids = $app->input->get('cid', array(), '', 'array');

		if (empty($ids))
		{
			$app->enqueueMessage('warning', JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_db8sitedev/tables');
			$myItems = JTableCategory::getInstance('Check', 'Db8sitedevTable');

			foreach ($ids as $pk) {

				if (!$myItems->save( Array('id' => $pk, 'checked' => '1')))
				{
					throw new Exception(JText::_('COM_DB8SITEDEV_ERROR_SAVING_DATA_ITEM'));
				}
			}
		}

		$this->setRedirect('index.php?option=' . $app->input->get('option') . '&view=checklist');
	}
}

