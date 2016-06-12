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
class Db8sitedevViewAbout extends JViewLegacy
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

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		Db8sitedevHelpersDb8sitedev::addSubmenu('about');

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
		$canDo = Db8sitedevHelpersDb8sitedev::getActions();

		JToolbarHelper::title(JText::_('COM_DB8SITEDEV') . ": " . JText::_('COM_DB8SITEDEV_TITLE_ABOUT'), 'info.png');

		if ($canDo->get('core.admin'))
		{
		/*	JToolbarHelper::divider();
			JToolbarHelper::custom('checklist.toggle_on', 'upload.png', 'upload_f2.png', 'COM_DB8SITEDEV_UPLOAD', true);
			JToolbarHelper::custom('checklist.toggle_off', 'download.png', 'download_f2.png', 'COM_DB8SITEDEV_DOWNLOAD', true);
			JToolbarHelper::divider();
		*/
			JToolbarHelper::preferences('com_db8sitedev');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_db8sitedev&view=dashboard');

		$this->extra_sidebar = '';
	}
}
