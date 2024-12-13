<?php

/**
 * Popup element to select destination.
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: destination.php 44 2012-07-12 08:05:38Z quannv $
 **/

namespace Joombooking\Component\Bookpro\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die('Restricted access');


class BrandField extends ListField
{

	protected $type = 'Brand';

	public function getOptions()
	{

		$options = [];
		$db = Factory::getDBO();
		$query = $db->getQuery(true);

		$query->select(
			[
				$db->quoteName('id', 'value'),
				$db->quoteName('title', 'text'),
			]
		)

			->from('#__bookpro_brands')->order('title ASC');
		$db->setQuery($query);
		try {
			$options = $db->loadObjectList();
			array_unshift($options, HTMLHelper::_('select.option', '0', Text::_('COM_BOOKPRO_SELECT_VEHICLE')));
			return $options;
		} catch (\RuntimeException $e) {
			Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}
	}
}
