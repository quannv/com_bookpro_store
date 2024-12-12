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

		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

				
					<?php
					echo $this->form->renderField('title');
					echo $this->form->renderField('unit');
					echo $this->form->renderField('state');

					?>




				</fieldset>
			</div>
		</div>


		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>

	</div>
</form>