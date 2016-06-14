<?php
/**
 * @version    CVS: 0.9.3
 * @package    Com_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  2016 by Peter Martin
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Supports a value from an external table
 *
 * @since  1.6
 */
class JFormFieldForeignKey extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var      string
	 * @since    1.6
	 */
	protected $type = 'foreignkey';

	private $input_type;

	private $table;

	private $key_field;

	private $value_field;

	/**
	 * Method to get the field input markup.
	 *
	 * @return   string  The field input markup.
	 *
	 * @since    1.6
	 */
	protected function getInput()
	{
		// Assign field properties.
		// Type of input the field shows
		$this->input_type = $this->getAttribute('input_type');

		// Database Table
		$this->table = $this->getAttribute('table');

		// The field that the field will save on the database
		$this->key_field = (string) $this->getAttribute('key_field');

		// The column that the field shows in the input
		$this->value_field = (string) $this->getAttribute('value_field');

		// Flag to identify if the fk_value is multiple
		$this->value_multiple = (int) $this->getAttribute('value_multiple', 0);

		// Initialize variables.
		$html     = '';
		$fk_value = '';

		// Load all the field options
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Support for multiple fields on fk_values
		if ($this->value_multiple == 1)
		{
			// Get the fields for multiple value
			$this->value_fields = (string) $this->getAttribute('value_field_multiple');
			$this->value_fields = explode(',', $this->value_fields);

			$fk_value = ' CONCAT (';

			foreach ($this->value_fields as $field)
			{
				$fk_value .= $db->quoteName($field) . ', \' \', ';
			}

			$fk_value = substr($fk_value, 0, -7);
			$fk_value .= ') AS ' . $db->quoteName($this->value_field);
		}
		else
		{
			$fk_value = $db->quoteName($this->value_field);
		}

		$query->select(array($db->quoteName($this->key_field), $fk_value))
			->from($this->table);

		$db->setQuery($query);
		$results = $db->loadObjectList();

		$input_options = 'class="' . $this->getAttribute('class') . '"';

		// Depends of the type of input, the field will show a type or another
		switch ($this->input_type)
		{
			case 'list':
			default:
				$options = array();

				// Iterate through all the results
				foreach ($results as $result)
				{
					$options[] = JHtml::_('select.option', $result->{$this->key_field}, $result->{$this->value_field});
				}

				$value = $this->value;

				// If the value is a string -> Only one result
				if (is_string($value))
				{
					$value = array($value);
				}
				elseif (is_object($value))
				{
					// If the value is an object, let's get its properties.
					$value = get_object_vars($value);
				}

				// If the select is multiple
				if ($this->multiple)
				{
					$input_options .= 'multiple="multiple"';
				}
				else
				{
					array_unshift($options, JHtml::_('select.option', '', ''));
				}

				$html = JHtml::_('select.genericlist', $options, $this->name, $input_options, 'value', 'text', $value, $this->id);
				break;
		}

		return $html;
	}

	/**
	 * Wrapper method for getting attributes from the form element
	 *
	 * @param   string  $attr_name  Attribute name
	 * @param   mixed   $default    Optional value to return if attribute not found
	 *
	 * @return mixed The value of the attribute if it exists, null otherwise
	 */
	public function getAttribute($attr_name, $default = null)
	{
		if (!empty($this->element[$attr_name]))
		{
			return $this->element[$attr_name];
		}
		else
		{
			return $default;
		}
	}
}
