<?php
/**
 * @version    CVS: 1.0.0
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
class Db8sitedevViewChecks extends JViewLegacy
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

		Db8sitedevHelpersDb8sitedev::addSubmenu('checks');

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

		JToolbarHelper::title(JText::_('COM_DB8SITEDEV') . ": " . JText::_('COM_DB8SITEDEV_TITLE_CHECKS'), 'checkbox-partial.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/check';

		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolbarHelper::addNew('check.add', 'JTOOLBAR_NEW');
				JToolbarHelper::custom('checks.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolbarHelper::editList('check.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]->state))
			{
				JToolbarHelper::divider();
				JToolbarHelper::custom('checks.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::custom('checks.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolbarHelper::deleteList('', 'checks.delete', 'JTOOLBAR_DELETE');
			}

			if (isset($this->items[0]->state))
			{
				JToolbarHelper::divider();
				JToolbarHelper::archiveList('checks.archive', 'JTOOLBAR_ARCHIVE');
			}

			if (isset($this->items[0]->checked_out))
			{
				JToolbarHelper::custom('checks.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolbarHelper::deleteList('', 'checks.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolbarHelper::divider();
			}
			elseif ($canDo->get('core.edit.state'))
			{
				JToolbarHelper::trash('checks.trash', 'JTOOLBAR_TRASH');
				JToolbarHelper::divider();
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_db8sitedev');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_db8sitedev&view=checks');

		$this->extra_sidebar = '';
	}

	/**
	 * Method to order fields 
	 *
	 * @return array
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
