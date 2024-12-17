<?php

/**
 * @version     1.0.0
 * @package     com_bookpro
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ngo <quannv@gmail.com>
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

// no direct access
defined('_JEXEC') or die();

$document = $this->getDocument();
$user = Factory::getUser();
$userId = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$canOrder  = $user->authorise('core.edit.state', 'com_bookpro');
$saveOrder = $listOrder == 'a.ordering';
if ($saveOrder) {
    $saveOrderingUrl = 'index.php?option=com_bookpro&task=contrasts.saveOrderAjax&tmpl=component';
    HTMLHelper::_('sortablelist.sortable', 'contrastsList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>
<script type="text/javascript">
    Joomla.orderTable = function() {
        table = document.getElementById("sortTable");
        direction = document.getElementById("directionTable");
        order = table.options[table.selectedIndex].value;
        if (order != '<?php echo $listOrder; ?>') {
            dirn = 'asc';
        } else {
            dirn = direction.options[direction.selectedIndex].value;
        }
        Joomla.tableOrdering(order, dirn, '');
    }
</script>

<div id="j-main-container" class="span10">
    <form action="<?php echo Route::_('index.php?option=com_bookpro&view=contrasts'); ?>" method="post" name="adminForm" id="adminForm">

        <div class="clearfix"></div>
        <table class="table table-striped" id="contrastsList">
            <thead>
                <tr>
                    <th width="1%" class="hidden-phone">
                        <input type="checkbox" name="checkall-toggle" value="" title="<?php echo Text::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                    </th>
                    <?php if (isset($this->items[0]->state)) : ?>
                        <th width="1%" class="nowrap center">
                            <?php echo HtmlHelper::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                        </th>
                    <?php endif; ?>
                    <th class='left'>
                        <?php echo HtmlHelper::_('grid.sort',  'COM_BOOKPRO_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <?php if (isset($this->items[0]->id)) : ?>
                        <th width="1%" class="nowrap center hidden-phone">
                            <?php echo HtmlHelper::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                        </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $item) :
                    $ordering   = ($listOrder == 'a.ordering');
                ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="hidden-phone">
                            <?php echo HtmlHelper::_('grid.id', $i, $item->id); ?>
                        </td>
                        <?php if (isset($this->items[0]->state)) : ?>
                            <td class="center">
                                <?php echo HtmlHelper::_('jgrid.published', $item->state, $i, 'contrasts.', true, 'cb'); ?>
                            </td>
                        <?php endif; ?>
                        <td>
                            <a href="<?php echo Route::_('index.php?option=com_bookpro&task=contrast.edit&id=' . (int) $item->id); ?>">
                                <?php echo $this->escape($item->title); ?></a>
                        </td>
                        <?php if (isset($this->items[0]->id)) : ?>
                            <td class="center hidden-phone">
                                <?php echo (int) $item->id; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->pagination->getListFooter(); ?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo HtmlHelper::_('form.token'); ?>
    </form>
</div>