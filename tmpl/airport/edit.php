<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 81 2012-08-11 01:16:36Z quannv $
 **/

use Joombooking\Component\Bookpro\Administrator\Helper\JHtmlHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

?>
<form action="<?php echo Route::_('index.php?option=com_bookpro&id=' . (int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">


    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset>

                <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>
                <?php
                echo $this->form->renderField('subtitle');
                echo $this->form->renderField('code');
                echo $this->form->renderField('image');
                echo $this->form->renderField('country_id');
                echo $this->form->renderField('desc');
                echo $this->form->renderField('state');
                ?>

            </fieldset>
        </div>
        <?php echo LayoutHelper::render('joomla.edit.details', $this); ?>

    </div>



    <div>
        <input type="hidden" name="task" value="" />

        <?php echo HTMLHelper::_('form.token'); ?>
    </div>
</form>