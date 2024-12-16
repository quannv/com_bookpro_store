<?php

/**
 * @package     Bookpro
 * @author       Ngo Van Quan
 * @link         http://joombooking.com
 * @copyright    Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license      GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version      $Id$
 **/

namespace Joombooking\Component\Bookpro\Administrator\View\Contrast;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->state = $this->get('State');
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        $isNew = ($this->item->id == 0);
        ToolbarHelper::title(
            $isNew ? Text::_('New contrast') : Text::_('Edit contrast'),
            'bookmark'
        );

        ToolBarHelper::apply('contrast.apply');
        ToolBarHelper::save('contrast.save');
        ToolBarHelper::cancel('contrast.cancel');
    }
}
