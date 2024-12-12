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
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die('Restricted access');

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate')


?>
<form action="<?php echo Route::_('index.php?option=com_bookpro&id=' . (int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">


    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset>


                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('firstname'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('firstname'); ?></div>
                </div>

                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('lastname'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('lastname'); ?></div>
                </div>

                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('company'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('company'); ?></div>
                </div>

                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('shortname'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('shortname'); ?></div>
                </div>

                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('image'); ?></div>
                </div>



                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('mobile'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('mobile'); ?></div>
                </div>


                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('website'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('website'); ?></div>
                </div>


            </fieldset>
        </div>
        <?php echo LayoutHelper::render('joomla.edit.details', $this); ?>

    </div>



    <div>
        <input type="hidden" name="task" value="" />

        <?php echo HTMLHelper::_('form.token'); ?>
    </div>
</form>