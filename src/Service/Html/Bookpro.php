<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joombooking\Component\Bookpro\Administrator\Service\Html;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\Database\DatabaseAwareTrait;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Banner HTML class.
 *
 * @since  2.5
 */
class Bookpro
{
    use DatabaseAwareTrait;

    /**
     * Display a batch widget for the client selector.
     *
     * @return  string  The necessary HTML for the widget.
     *
     * @since   2.5
     */



    /**
     * Returns a pinned state on a grid
     *
     * @param   integer  $value     The state value.
     * @param   integer  $i         The row index
     * @param   boolean  $enabled   An optional setting for access control on the action.
     * @param   string   $checkbox  An optional prefix for checkboxes.
     *
     * @return  string   The Html code
     *
     * @see     HTMLHelperJGrid::state
     * @since   2.5.5
     */
    public function pinned($value, $i, $enabled = true, $checkbox = 'cb')
    {
        $states = [
            1 => [
                'sticky_unpublish',
                'COM_BANNERS_BANNERS_PINNED',
                'COM_BANNERS_BANNERS_HTML_UNPIN_BANNER',
                'COM_BANNERS_BANNERS_PINNED',
                true,
                'publish',
                'publish',
            ],
            0 => [
                'sticky_publish',
                'COM_BANNERS_BANNERS_UNPINNED',
                'COM_BANNERS_BANNERS_HTML_PIN_BANNER',
                'COM_BANNERS_BANNERS_UNPINNED',
                true,
                'unpublish',
                'unpublish',
            ],
        ];

        return HTMLHelper::_('jgrid.state', $states, $value, $i, 'banners.', $enabled, true, $checkbox);
    }
}
