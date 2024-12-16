<?php

/**
 * Popup element to select size.
 * @package     Bookpro
 * @subpackage  Field
 * @author      Ngo Van Quan
 * @link        http://joombooking.com
 * @copyright   Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

namespace Joombooking\Component\Bookpro\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die('Restricted access');

class SizeField extends ListField
{

    protected $type = 'Size';

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
        ->from('#__bookpro_sizes')->order('title ASC');

        $db->setQuery($query);
        try {
            $options = $db->loadObjectList();
            array_unshift($options, HTMLHelper::_('select.option', '0', Text::_('COM_BOOKPRO_SELECT_SIZE')));
            return $options;
        } catch (\RuntimeException $e) {
            Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
        }
    }
}
