<?php
/**
 * @version    CVS: 0.9.0
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Db8sitedev Listhelper.
 *
 * @since  1.6
 */
abstract class JHtmlListhelper
{
	/**
	 * @param   int  $value
	 * @param   $view
	 * @param   $field
	 * @param   $i
	 * @return  string
	 */
	static function toggle($value = 0, $view, $field, $i)
	{
		$states = array(
			0 => array('icon-remove', JText::_('Toggle'), 'inactive btn-danger'),
			1 => array('icon-checkmark', JText::_('Toggle'), 'active btn-success')
		);

		$state  = \Joomla\Utilities\ArrayHelper::getValue($states, (int) $value, $states[0]);
		$text   = '<span aria-hidden="true" class="' . $state[0] . '"></span>';
		$html   = '<a href="#" class="btn btn-micro ' . $state[2] . '"';
		$html  .= 'onclick="return toggleField(\'cb' . $i . '\',\'' . $view . '.toggle\',\'' . $field . '\')" 
		title="' . JText::_($state[1]) . '">' . $text . '</a>';

		return $html;
	}
}
