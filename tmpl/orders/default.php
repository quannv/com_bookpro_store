 <?php
	/**
	 * @package 	Bookpro
	 * @author 		Ngo Van Quan
	 * @link 		http://joombooking.com
	 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
	 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
	 * @version 	$Id: bookpro.php 27 2012-07-08 17:15:11Z quannv $
	 **/

	use Joombooking\Component\Bookpro\Administrator\Helper\CurrencyHelper;
	use Joomla\CMS\HTML\Helpers\Select;
	use Joomla\CMS\HTML\HTMLHelper;
	use Joomla\CMS\Language\Text;
	use Joomla\CMS\Layout\LayoutHelper;
	use Joomla\CMS\Router\Route;
	use Joomla\CMS\Toolbar\Toolbar;
	use Joomla\CMS\Uri\Uri;

	defined('_JEXEC') or die('Restricted access');


	$toolbar = Toolbar::getInstance('toolbar');
	//$toolbar->appendButton( 'Link', 'print', Text::_('COM_BOOKPRO_PRINT'), JUri::base().'index.php?option=com_bookpro&view=pmibustrips&tmpl=component&layout=report' );
	$toolbar->appendButton('Link', 'download', Text::_('COM_BOOKPRO_PRINT_CSV'), Uri::base() . 'index.php?option=com_bookpro&view=orders&tmpl=component&layout=csv');

	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));

	$itemsCount = count($this->items);
	$pagination = &$this->pagination;



	?>


 <div id="j-main-container" class="span10">
 	<form action="<?php echo Route::_('index.php?option=com_bookpro&view=orders'); ?>" method="post" name="adminForm" id="adminForm">
 		<div class="j-main-container" style="border: 1px solid #ccc;">

 			<?php
				// Search tools bar
				echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);
				?>

 			<table class="table-striped table">
 				<thead>
 					<tr>


 						<th><?php echo Text::_("COM_BOOKPRO_ORDER_NUMBER"); ?></th>
 						<th><?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_BUSTRIP"), 'total', $listDirn, $listOrder); ?></th>
 						<th><?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_DEPART_DATE"), 'depart', $listDirn, $listOrder); ?></th>
 						<th><?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_CUSTOMER"), 'firstname', $listDirn, $listOrder); ?></th>
 						<th><?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_ORDER_TOTAL"), 'total', $listDirn, $listOrder); ?></th>
 						<th><?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_ORDER_PAY_STATUS"), 'pay_status', $listDirn, $listOrder); ?></th>
 						<th>
 							<?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_ORDER_ORDER_STATUS"), 'order_status', $listDirn, $listOrder); ?>
 						</th>
 						<th><?php echo HtmlHelper::_('grid.sort', Text::_("COM_BOOKPRO_ORDER_CREATED"), 'created', $listDirn, $listOrder); ?>
 						</th>
 					</tr>
 				</thead>
 				<tfoot>
 					<tr>
 						<td colspan="13"><?php echo $pagination->getListFooter(); ?></td>
 					</tr>
 				</tfoot>
 				<tbody>
 					<?php if ($itemsCount == 0) { ?>
 						<tr>
 							<td colspan="13" class="emptyListInfo"><?php echo Text::_('No reservations.'); ?></td>
 						</tr>
 					<?php } ?>
 					<?php for ($i = 0; $i < $itemsCount; $i++) {
							$subject = &$this->items[$i];
							$orderlink = "index.php?option=com_bookpro&view=order&layout=print&tmpl=component&id=" . $subject->id;
							//echo "<pre>";print_r(json_decode($subject->params,true));die;
						?>

 						<tr class="row<?php echo $i % 2; ?>">


 							<td>
 								<a href="<?php echo Uri::base() . 'index.php?option=com_bookpro&view=order&layout=edit&id=' . $subject->id; ?>"><?php echo $subject->order_number; ?></a>
 								<span>
 									<a href="<?php echo $orderlink ?>" target="_blank">
 										<icon class="icon-print"></icon>
 									</a>
 								</span>



 							</td>
 							<td>

 								<?php

									$this->routes = json_decode($subject->params);
									echo $this->loadTemplate('route');

									?>
 							</td>

 							<td>
 								<?php echo $subject->depart ?>
 							</td>
 							<td><a href="<?php echo Uri::base() . 'index.php?option=com_bookpro&view=customer&layout=edit&id=' . $subject->cid ?>"><?php echo $subject->customer_firstname; ?></a>

 								<?php

									echo "<br/>";
									echo $subject->customer_email;

									echo "<br/>";
									echo $subject->customer_mobile;

									?>

 							</td>

 							<td><?php echo CurrencyHelper::formatprice($subject->total) ?>
 								<br />
 								<?php echo $subject->pay_method; ?>
 							</td>

 							<td>
 								<?php echo $subject->pay_status ?>
 							</td>
 							<td>
 								<?php echo $subject->order_status ?>
 							</td>

 							<td><?php echo  $subject->created ?></td>


 						</tr>
 					<?php } ?>
 				</tbody>
 			</table>

 			<input type="hidden" name="task" value="" />

 			<input type="hidden" name="boxchecked" value="0" />
 			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
 			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
 			<?php echo HtmlHelper::_('form.token'); ?>
 		</div>
 	</form>

 </div>