<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 27 2012-07-08 17:15:11Z quannv $
 **/

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die('Restricted access');



$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= ($listOrder == 'a.lft');
$saveOrder 	= ($listOrder == 'a.lft' && $listDirn == 'asc');

$itemsCount = count($this->items);
$pagination = &$this->pagination;

$saveOrderingUrl = 'index.php?option=com_bookpro&controller=airports&task=saveOrderAjax&tmpl=component';
HTMLHelper::_('sortablelist.sortable', 'airportList', 'adminForm', strtolower($listDirn), $saveOrderingUrl, false, true);
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
	<form action="index.php?option=com_bookpro&view=airports" method="post" name="adminForm" id="adminForm">


		<?php
		// Search tools bar
		echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);
		?>


		<!-- <div id="filter-bar" class="btn-toolbar">
			<div class="filter-search fltlft form-inline">
				<input class="text_area" type="text" name="title" id="title" size="20" maxlength="255" value="<?php echo $this->lists['title']; ?>" placeholder="<?php echo Text::_('Destination') ?>" />
				<button type="submit" class="btn hasTooltip" title="<?php echo HTMLHelper::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
			</div>

			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo Text::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>

		</div> -->

		<table class="table-striped table" id="airportList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo HTMLHelper::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.lft', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>

					<th width="2%" class="hidden-phone">
						<?php echo HTMLHelper::_('grid.checkall'); ?>
					</th>

					<th width="2%">
						<?php echo HTMLHelper::_('grid.sort', Text::_('JSTATUS'), 'state', $listDirn, $listOrder); ?>
					</th>


					<th class="title" width="10%">
						<?php echo HTMLHelper::_('grid.sort', Text::_('COM_BOOKPRO_TITLE'), 'title', $listDirn, $listOrder); ?>
					</th>

					<th width="5%">
						<?php echo Text::_('COM_BOOKPRO_CODE'); ?>
					</th>



					<th width="5%">
						<?php echo Text::_('COM_BOOKPRO_COUNTRY'); ?>
					</th>

					<th width="1%" align="right">
						<?php echo HTMLHelper::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<?php echo $pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php if (!is_array($this->items) || !$itemsCount && $this->tableTotal) { ?>
					<tr>
						<td colspan="<?php echo $colspan; ?>" class="emptyListInfo"><?php echo Text::_('No items found.'); ?></td>
					</tr>
					<?php

				} else {

					for ($i = 0; $i < $itemsCount; $i++) {
						$subject = &$this->items[$i];



					?>
						<tr>
							<td class="order nowrap center hidden-phone">
								<?php
								$iconClass = '';
								if (!$saveOrder) {
									$iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::tooltipText('JORDERINGDISABLED');
								}
								?>
								<span class="sortable-handler<?php echo $iconClass ?>">
									<i class="icon-menu"></i>
								</span>
								<?php if ($saveOrder) : ?>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $orderkey + 1; ?>" />
								<?php endif; ?>
							</td>

							<td class="hidden-phone">
								<?php echo HTMLHelper::_('grid.id', $i, $subject->id); ?>
							</td>
							<td>
								<?php echo HTMLHelper::_('jgrid.published', $subject->state, $i, 'airports.', true, 'cb', null, null); ?>
							</td>
							<td>


								<a href="<?php echo Route::_('index.php?option=com_bookpro&task=airport.edit&id=' . $subject->id); ?>"><?php echo $subject->title; ?></a>

							</td>

							<td>
								<?php echo $subject->code; ?>
							</td>

							<td>
								<?php echo $subject->country_name; ?>
							</td>
							<td><?php echo number_format($subject->id, 0, '', ' '); ?></td>
						</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="airports" />
		<input type="hidden" name="reset" value="0" />

		<input type="hidden" name="boxchecked" value="0" />

		<input type="hidden" name="filter_order" value="<?php echo $order; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $orderDir; ?>" />

		<?php echo HTMLHelper::_('form.token'); ?>
	</form>
</div>