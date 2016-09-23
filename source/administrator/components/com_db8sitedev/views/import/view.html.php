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
class Db8sitedevViewImport extends JViewLegacy
{
	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @since
	 */
	public function display($tpl = null)
	{
		$this->addToolbar();

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
		JToolbarHelper::title(JText::_('COM_DB8SITEDEV') . ": " . JText::_('COM_DB8SITEDEV_IMPORT'), 'upload.png');
	}
}
