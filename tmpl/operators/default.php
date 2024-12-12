<?php

/**

 * @package 	Bookpro

 * @author 		Ngo Van Quan

 * @link 		http://joombooking.com

 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan

 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html

 * @version 	$Id: default.php 63 2012-07-29 10:43:08Z quannv $

 * */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die('Restricted access');


$itemsCount = count($this->items);
$pagination = &$this->pagination;
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<div id="j-main-container" class="span10">
	<form action="<?php echo Route::_('index.php?option=com_bookpro&view=agents'); ?>" method="post" name="adminForm" id="adminForm">

		<table class="table table-stripped">

			<thead>

				<tr>
					<th width="1%" class="hidden-phone"><?php echo HtmlHelper::_('grid.checkall'); ?>
					</th>
					<th width="5%"><?php echo Text::_('JSTATUS'); ?></th>

					<th class="title" width="10%"><?php echo HTMLHelper::_('grid.sort', Text::_('COM_BOOKPRO_AGENT_NAME'), 'name', $listDirn, $listOrder); ?>

					</th>

					<th width="4%"><?php echo Text::_('COM_BOOKPRO_AGENT_EMAIL'); ?></th>
					<th width="8%"><?php echo Text::_('COM_BOOKPRO_AGENT_PHONE'); ?></th>
					</th>

					<th width="10%"><?php echo HtmlHelper::_('grid.sort', Text::_('COM_BOOKPRO_AGENT_CREATED_DATE'), 'created', $listDirn, $listOrder); ?>

					</th>

				</tr>

			</thead>

			<tfoot>

				<tr>

					<td colspan="10"><?php echo $pagination->getListFooter(); ?>

					</td>

				</tr>

			</tfoot>

			<tbody>

				<?php if (!is_array($this->items) || !$itemsCount) { ?>

					<tr>
						<td colspan="8"><?php echo Text::_('COM_BOOKPRO_AGENT_NO_ITEMS_FOUND.'); ?>
						</td>
					</tr>

				<?php } else { ?>

					<?php for ($i = 0; $i < $itemsCount; $i++) { ?>

						<?php $subject = &$this->items[$i]; ?>

						<tr class="row<?php echo ($i % 2); ?>">



							<td class="checkboxCell"><?php echo HtmlHelper::_('grid.checkedout', $subject, $i); ?>
							</td>


							<td class="center"><?php echo HtmlHelper::_('jgrid.published', $subject->state, $i, 'agents.', true, 'cb', null, null); ?>

							</td>
							<td><a href="<?php echo Route::_('index.php?option=com_bookpro&amp;task=operator.edit&amp;id=' . $subject->id) ?>">
									<?php echo $subject->company; ?>
								</a></td>


							<td><?php echo $subject->email; ?>&nbsp;</td>

							<td><?php echo $subject->mobile; ?>&nbsp;</td>


							<td><?php echo $subject->created; ?>&nbsp;</td>

						</tr>

					<?php } ?>

				<?php } ?>

			</tbody>

		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" /> <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" /> <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />

		<?php echo HtmlHelper::_('form.token'); ?>

	</form>
</div>