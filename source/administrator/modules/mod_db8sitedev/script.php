<?php
/**
 * @version    CVS: 0.9.4
 * @package    Mod_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

/**
 * Class Mod_Db8sitedevInstallerScript
 * 
 * @since  1.0
 */
class Mod_Db8sitedevInstallerScript
{
	/**
	 * Method to remove old language files from /administrator/language/
	 *
	 * @param  $parent
	 *
	 * @return void
	 *
	 * @since
	 */
	public function update ($parent)
	{
		$languageFiles = Array(
			"da-DK/da-DK.mod_db8sitedev.ini",
			"da-DK/da-DK.mod_db8sitedev.sys.ini",

			"de-DE/de-DE.mod_db8sitedev.ini",
			"de-DE/de-DE.mod_db8sitedev.sys.ini",

			"en-GB/en-GB.mod_db8sitedev.ini",
			"en-GB/en-GB.mod_db8sitedev.sys.ini",

			"fr-FR/fr-FR.mod_db8sitedev.ini",
			"fr-FR/fr-FR.mod_db8sitedev.sys.ini",

			"nl-NL/nl-NL.mod_db8sitedev.ini",
			"nl-NL/nl-NL.mod_db8sitedev.sys.ini"
		);

		foreach ($languageFiles AS $languageFile)
		{
			if (JFile::exists(JPATH_ROOT . '/administrator/language/' . $languageFile))
			{
				JFile::delete(JPATH_ROOT . '/administrator/language/' . $languageFile);
			}
		}
	}

	/**
	 * Method to check if Component has been installed
	 *
	 * @param   string  $parent  Parent is the class calling this method
	 *
	 * @return   bool
	 *
	 * @throws Exception
	 * @since
	 */
	public function preflight ($parent)
	{
		// Check if the component has been installed
		if (!JComponentHelper::isEnabled('com_db8sitedev'))
		{
			JFactory::getApplication()->enqueueMessage(
				'Please install the db8 Site Dev Component first. This Module needs that component!', 'error');
			JFactory::getApplication()->redirect('index.php?option=com_installer&view=install');

			return false;
		}

		return true;
	}

	/**
	 * Method to enable + assign Module after installation
	 * 
	 * @param   string  $parent  Parent is the class calling this method
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @since
	 */
	public function postflight ($parent)
	{
		// Check if Module has not been published yet
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id'));
		$query->from($db->quoteName('#__modules'));
		$query->where($db->quoteName('module') . ' = ' . $db->quote('mod_db8sitedev'));
		$query->where($db->quoteName('published') . ' = 1');
		$query->where($db->quoteName('position') . ' = ' . $db->quote('cpanel'));
		$db->setQuery($query);
		$moduleId = $db->loadResult();

		// If the Module has not been published, publish + assign it

		if (empty($moduleId))
		{
			// Change Module settings to auto publish it on position cpanel
			$query = $db->getQuery(true);
			$fields = array(
				$db->quoteName('published') . ' = 1',
				$db->quoteName('position') . ' = ' . $db->quote('cpanel'),
				$db->quoteName('access') . ' = 3',
				$db->quoteName('params') . ' = ' .
				$db->quote('{"layout":"_:default","moduleclass_sfx":"","cache":"0","module_tag":"div",' .
					'"bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}'),
			);
			$conditions = array($db->quoteName('module') . ' = ' . $db->quote('mod_db8sitedev'));
			$query->update($db->quoteName('#__modules'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$db->execute();

			// Get ID for module
			$query = $db->getQuery(true);
			$query->select($db->quoteName('id'));
			$query->from($db->quoteName('#__modules'));
			$query->where($db->quoteName('module') . ' = ' . $db->quote('mod_db8sitedev'));
			$db->setQuery($query);
			$moduleId = $db->loadResult();

			// Add to modules_menu
			$query = $db->getQuery(true);
			$fields = array(
				$db->quoteName('moduleid') . ' = ' . $db->quote($moduleId),
				$db->quoteName('menuid') . ' = 0',
			);

			$query->insert($db->quoteName('#__modules_menu'))->set($fields);
			$db->setQuery($query);
			$db->execute();
		}
	}
}
