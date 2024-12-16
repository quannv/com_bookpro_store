<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 81 2012-08-11 01:16:36Z quannv $
 **/

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die('Restricted access');
HtmlHelper::_('jquery.framework');

//$document = $this->document;
//$document->addScript(Uri::base() . 'components/com_bookpro/assets/js/bootstrap-timepicker.min.js');
//$document->addStyleSheet(Uri::base() . 'components/com_bookpro/assets/css/bootstrap-timepicker.min.css');

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');


?>


<form action="<?php echo Route::_('index.php?option=com_bookpro&layout=edit&id=' . (int) $this->item->id);  ?>" method="post" name="adminForm" id="adminForm" class="form-validate">

	<div class="form-horizontal">
		<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
		<?php echo HtmlHelper::_('bootstrap.addTab', 'myTab', 'general', Text::_('Basic', true)); ?>

		<?php echo $this->form->renderField('sku'); ?>
		<?php echo $this->form->renderField('title'); ?>
		<?php echo $this->form->renderField('design_id');  ?>
		<?php echo $this->form->renderField('color_id');  ?>
		<?php echo $this->form->renderField('brand_id');  ?>

		<?php echo $this->form->renderField('areas_id');  ?>
		<?php echo $this->form->renderField('thickness_id');  ?>
		<?php echo $this->form->renderField('effects_id');  ?>

		<?php echo $this->form->renderField('contrast_id');  ?>
		<?php echo $this->form->renderField('surface_id');  ?>
		<?php echo $this->form->renderField('type_id');  ?>
		<?php echo $this->form->renderField('facetile_id');  ?>
		<?php echo $this->form->renderField('size_id');  ?>



		<?php echo $this->form->renderField('state');  ?>
		<?php echo HtmlHelper::_('bootstrap.endTab');

		?>

		<?php echo HtmlHelper::_('bootstrap.addTab', 'myTab', 'busstoptab', Text::_('Detail')); ?>


		<?php echo $this->form->renderField('description'); ?>
		<?php echo HtmlHelper::_('bootstrap.endTab'); ?>

		<?php echo HtmlHelper::_('bootstrap.addTab', 'myTab', 'image', Text::_('Images')); ?>


		<?php echo $this->form->renderField('image'); ?>
		<?php echo $this->form->renderField('images'); ?>

		<?php echo HtmlHelper::_('bootstrap.endTab'); ?>

		<?php echo HtmlHelper::_('bootstrap.endTabSet'); ?>
	</div>

	<input type="hidden" name="task" value="" />
	<?php echo HtmlHelper::_('form.token'); ?>

</form>