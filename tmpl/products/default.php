<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 81 2012-08-11 01:16:36Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');

use Joombooking\Component\Bookpro\Administrator\Helper\CurrencyHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/* @var $this BookingViewSubjects */

$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));

?>

<div id="j-main-container" class="span10">
	<form action="<?php echo Route::_('index.php?option=com_bookpro&view=products'); ?>" method="post" name="adminForm" id="adminForm">
		<?php
		// Search tools bar
		//echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);
		?>

		<table class="table">
			<thead>
				<tr>

					<th width="1%" class="hidden-phone"><?php echo HtmlHelper::_('grid.checkall'); ?>

					</th>
					<th width="1%"><?php echo HtmlHelper::_('grid.sort', Text::_('JSTATUS'), 'state', $listDirn, $listOrder); ?>
					</th>
					<th class="title" width="10%"><?php echo HtmlHelper::_('grid.sort', Text::_('COM_BOOKPRO_TITLE'), 'title', $listDirn, $listOrder); ?>
					</th>
					<th width="5%"><?php echo Text::_('COM_BOOKPRO_SKU'); ?>

					<th width="5%"><?php echo Text::_('COM_BOOKPRO_TITLE'); ?>
					</th>
					<th width="5%"><?php echo Text::_('COM_BOOKPRO_BRAND'); ?>
					</th>

					<th width="5%"><?php echo Text::_('COM_BOOKPRO_BUSTRIP_START_TIME'); ?>
					</th>
					<th width="5%"><?php echo Text::_('COM_BOOKPRO_BUSTRIP_END_TIME'); ?>
					</th>

					<th width="7%"><?php echo Text::_('COM_BOOKPRO_BUSTRIP_PRICE'); ?>
					</th>


				</tr>
			</thead>
			
			<tbody>
				<?php
				for ($i = 0; $i < count($this->items); $i++) {
					$subject = &$this->items[$i];
				?>
					<tr class="<?php if (($subject->price == 0) || !$subject->seattemplate_title) echo "warning";
								else echo "success" ?>">

						<td class="checkboxCell"><?php echo HtmlHelper::_('grid.checkedout', $subject, $i); ?>
						</td>
						<td>
							<?php echo HtmlHelper::_('jgrid.published', $subject->state, $i, 'bustrips.', true, 'cb', null, null); ?>
						</td>
						<td>
							<a href="<?php echo Route::_('index.php?option=com_bookpro&task=product.edit&id=' . $subject->id); ?>">

								<span style="<?php if (!$subject->parent_id) echo "font-weight:bold;" ?>"><?php echo $subject->title; ?></span> </a>
						</td>
						
						<td><?php echo $subject->sku; ?>
						</td>
						<td><?php echo $subject->brand_title; ?>
						</td>

						<td><?php echo Factory::getDate($subject->start_time)->format('H:i'); ?></td>
						<td><?php echo Factory::getDate($subject->end_time)->format('H:i'); ?></td>

						<?php
						$color = '';
						if ($subject->price > 0) {
							$color = 'style="color:blue;"';
						} else {
							$color = 'style="color:red"';
						}
						?>
						<td>

							<?php echo CurrencyHelper::formatprice($subject->price)
							?><br />

						</td>


					<?php
				}

					?>
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