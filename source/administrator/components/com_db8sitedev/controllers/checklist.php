<?php
/**
 * @version    CVS: 0.9.1
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
	 * Method to clone existing Checks
	 *
	 * @return void
	 */
	public function duplicate()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Get id(s)
		$pks = $this->input->post->get('cid', array(), 'array');

		try {
			if (empty($pks)) {
				throw new Exception(JText::_('COM_DB8SITEDEV_NO_ELEMENT_SELECTED'));
			}

			ArrayHelper::toInteger($pks);
			$model = $this->getModel();
			$model->duplicate($pks);
			$this->setMessage(JText::_('COM_DB8SITEDEV_ITEMS_SUCCESS_DUPLICATED'));
		} catch (Exception $e) {
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
		}

		$this->setRedirect('index.php?option=com_db8sitedev&view=checklist');
	}

	/**
	 * Proxy for getModel.
	 *
	 * @param   string $name Optional. Model name
	 * @param   string $prefix Optional. Class prefix
	 * @param   array $config Optional. Configuration array for model
	 *
	 * @return  object    The Model
	 *
	 * @since    1.6
	 */
	public function getModel($name = 'check', $prefix = 'Db8sitedevModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		// Sanitize the input
		ArrayHelper::toInteger($pks);
		ArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return) {
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}


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

