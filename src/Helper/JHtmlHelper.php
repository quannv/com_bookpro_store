<?php

namespace Joombooking\Component\Bookpro\Administrator\Helper;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use stdClass;

class JHtmlHelper
{
    static function  getFilterSelect($field, $noSelectText, $items, $selected, $autoSubmit = false, $customParams = '', $valueLabel = 'value', $textLabel = 'text')
    {
        $first = new stdClass();
        $first->$valueLabel = 0;
        $first->$textLabel = '- ' . Text::_($noSelectText) . ' -';
        array_unshift($items, $first);
        $customParams = array(trim($customParams));
        if ($autoSubmit) {
            $customParams[] = 'onchange="this.form.submit()"';
        }
        $customParams = implode(' ', $customParams);

        return HTMLHelper::_('select.genericlist', $items, $field, $customParams, $valueLabel, $textLabel, $selected);
    }
}
