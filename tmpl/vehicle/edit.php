<?php

/**
 * @version     1.0.0
 * @package     com_bookpro
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ngo <quannv@gmail.com> - http://joombooking.com
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// no direct access
defined('_JEXEC') or die();

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate')
?>


<form action="<?php echo Route::_('index.php?option=com_bookpro&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="bus-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'general', Text::_('COM_BOOKPRO_BUS', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
					</div>


					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('seat'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('seat'); ?></div>
					</div>



					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
					</div>



					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('agent_id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('agent_id'); ?></div>
					</div>




					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('desc'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('desc'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
					</div>




				</fieldset>
			</div>
		</div>
		<?php echo HTMLHelper::_('bootstrap.endTab'); ?>



		<?php echo HTMLHelper::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>

	</div>
</form>