<?php
/**
 * @version    CVS: 0.9.4
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Db8sitedev.
 *
 * @since  1.6
 */
class Db8sitedevViewChecklist extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @since
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		Db8sitedevHelpersDb8sitedev::addSubmenu('checklist');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = Db8sitedevHelpersDb8sitedev::getActions();

		JToolbarHelper::title(JText::_('COM_DB8SITEDEV') . ": " . JText::_('COM_DB8SITEDEV_TITLE_CHECKLIST'), 'checkbox.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/check';

		if (isset($this->items[0]->checked))
		{
			JToolbarHelper::divider();
			JToolbarHelper::custom('checklist.toggle_on', 'publish.png', 'publish_f2.png', 'COM_DB8SITEDEV_TOGGLE_ON', true);
			JToolbarHelper::custom('checklist.toggle_off', 'unpublish.png', 'unpublish_f2.png', 'COM_DB8SITEDEV_TOGGLE_OFF', true);
		}

		$layout = JFactory::getApplication()->input->get('layout');

		if ($layout <> "import")
		{
			JToolbarHelper::divider();
			JToolbarHelper::custom('checklist.import', 'upload.png', 'upload_f2.png', 'COM_DB8SITEDEV_IMPORT', false);
			JToolbarHelper::custom('checklist.export', 'download.png', 'download_f2.png', 'COM_DB8SITEDEV_EXPORT', false);
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_db8sitedev');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_db8sitedev&view=checklist');

		$this->extra_sidebar = '';

	}

	/**
	 * Method to order fields 
	 *
	 * @return array
	 * @since
	 */
	protected function getSortFields()
	{
		return array(
			'a.`title`' => JText::_('COM_DB8SITEDEV_CHECKS_TITLE'),
			'a.`checked`' => JText::_('COM_DB8SITEDEV_CHECKS_CHECKED'),
			'a.`catid`' => JText::_('COM_DB8SITEDEV_CHECKS_CATID'),
			'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
			'a.`state`' => JText::_('JSTATUS'),
			'a.`id`' => JText::_('JGRID_HEADING_ID'),
		);
	}
}
