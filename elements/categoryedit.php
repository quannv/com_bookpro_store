<?php


defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\Utilities\ArrayHelper;

/**
 * Form Field class for the Joomla Framework.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_categories
 * @since       1.6
 */
class JFormFieldCategoryEdit extends ListField
{
	/**
	 * A flexible category list that respects access controls
	 *
	 * @var        string
	 * @since   1.6
	 */
	public $type = 'CategoryEdit';

	/**
	 * Method to get a list of categories that respects access controls and can be used for
	 * either category assignment or parent category assignment in edit screens.
	 * Use the parent element to indicate that the field will be used for assigning parent categories.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.6
	 */
	protected function getOptions()
	{
		$options = array();
		$published = $this->element['state'] ? $this->element['state'] : array(0, 1);
		$name = (string) $this->element['name'];

		// Let's get the id for the current item, either category or content item.
		$jinput = Factory::getApplication()->input;
		// Load the category options for a given extension.

		// For categories the old category is the category id or 0 for new category.


		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->select('a.id AS value, a.title AS text, a.level, a.state')
			->from('#__bookpro_dest AS a')
			->join('LEFT', $db->quoteName('#__bookpro_dest') . ' AS b ON a.lft > b.lft AND a.rgt < b.rgt');

		// Filter by the extension type


		// Filter on the published state

		if (is_numeric($published)) {
			$query->where('a.state = ' . (int) $published);
		} elseif (is_array($published)) {
			ArrayHelper::toInteger($published);
			$query->where('a.state IN (' . implode(',', $published) . ')');
		}

		$query->group('a.id, a.title, a.level, a.lft, a.rgt,  a.parent_id, a.state')
			->order('a.lft ASC');

		// Get the options.
		$db->setQuery($query);

		try {
			$options = $db->loadObjectList();
		} catch (RuntimeException $e) {
			throw new Exception($e->getMessage(), 500);
		}

		// Pad the option text with spaces using depth level as a multiplier.
		for ($i = 0, $n = count($options); $i < $n; $i++) {
			// Translate ROOT
			if ($this->element['parent'] == true) {
				if ($options[$i]->level == 0) {
					$options[$i]->text = Text::_('JGLOBAL_ROOT_PARENT');
				}
			}
			if ($options[$i]->state == 1) {
				$options[$i]->text = str_repeat('- ', $options[$i]->level) . $options[$i]->text;
			} else {
				$options[$i]->text = str_repeat('- ', $options[$i]->level) . '[' . $options[$i]->text . ']';
			}
		}

		if (($this->element['parent'] == true || $jinput->get('option') == 'com_bookpro')
			&& (isset($row) && !isset($options[0]))
			&& isset($this->element['show_root'])
		) {
			if ($row->parent_id == '1') {
				$parent = new stdClass;
				$parent->text = Text::_('JGLOBAL_ROOT_PARENT');
				array_unshift($options, $parent);
			}
			array_unshift($options, HTMLHelper::_('select.option', '0', Text::_('JGLOBAL_ROOT')));
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
