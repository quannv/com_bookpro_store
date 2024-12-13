<?php

/**
 * @version     1.0.0
 * @package     com_bookpro
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ngo <quannv@gmail.com> - http://joombooking.com
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

// no direct access
defined('_JEXEC') or die;


// Import CSS
$document = $this->getDocument();
$user	= Factory::getUser();
$userId	= $user->get('id');
		$listOrder = $this->escape($this->state->get('list.ordering'));
		$listDirn  = $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_bookpro');
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder) {
	$saveOrderingUrl = 'index.php?option=com_bookpro&task=effects.saveOrderAjax&tmpl=component';
	HTMLHelper::_('sortablelist.sortable', 'busList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
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
	<form action="<?php echo Route::_('index.php?option=com_bookpro&view=effects'); ?>" method="post" name="adminForm" id="adminForm">

		<?php
		// Search tools bar
		//echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);
		?>

		<div class="clearfix"> </div>
		<table class="table table-striped" id="busList">
			<thead>
				<tr>
					<?php if (isset($this->items[0]->ordering)) : ?>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo HtmlHelper::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
						</th>
					<?php endif; ?>
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


					<th class='left'>
						<?php echo Text::_('COM_BOOKPRO_IMAGE'); ?>
					</th>



					<?php if (isset($this->items[0]->id)) : ?>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo HtmlHelper::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th>
					<?php endif; ?>
				</tr>
			</thead>
			<tfoot>
				<?php
				if (isset($this->items[0])) {
					$colspan = count(get_object_vars($this->items[0]));
				} else {
					$colspan = 10;
				}
				?>
				<tr>
					<td colspan="<?php echo $colspan ?>">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($this->items as $i => $item) :
					$ordering   = ($listOrder == 'a.ordering');

				?>
					<tr class="row<?php echo $i % 2; ?>">

						<?php if (isset($this->items[0]->ordering)) : ?>
							<td class="order nowrap center hidden-phone">
								<?php if ($canChange) :
									$disableClassName = '';
									$disabledLabel	  = '';
									if (!$saveOrder) :
										$disabledLabel    = Text::_('JORDERINGDISABLED');
										$disableClassName = 'inactive tip-top';
									endif; ?>
									<span class="sortable-handler hasTooltip <?php echo $disableClassName ?>" title="<?php echo $disabledLabel ?>">
										<i class="icon-menu"></i>
									</span>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
								<?php else : ?>
									<span class="sortable-handler inactive">
										<i class="icon-menu"></i>
									</span>
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<td class="hidden-phone">
							<?php echo HtmlHelper::_('grid.id', $i, $item->id); ?>
						</td>
						<?php if (isset($this->items[0]->state)) : ?>
							<td class="center">
								<?php echo HtmlHelper::_('jgrid.published', $item->state, $i, 'effects.', true, 'cb'); ?>
							</td>
						<?php endif; ?>



						<td>

							<a href="<?php echo Route::_('index.php?option=com_bookpro&task=effect.edit&id=' . (int) $item->id); ?>">
								<?php echo $this->escape($item->title); ?></a>

						</td>

						<td>

							<img src=" <?php echo Uri::root().$item->image; ?>" style="width: 100px; height: 100px;">

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

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo HtmlHelper::_('form.token'); ?>

	</form>
</div>