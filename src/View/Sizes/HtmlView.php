<?php

/**
 * @package     Bookpro
 * @author       Ngo Van Quan
 * @link         http://joombooking.com
 * @copyright    Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license      GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version      $Id$
 **/

namespace Joombooking\Component\Bookpro\Administrator\View\Sizes;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    var $lists;
    var $items;
    var $pagination;
    var $selectable;
    var $params;

    function display($tpl = null)
    {
        $model = $this->getModel();
        $this->items = $model->getItems();
        $this->pagination = $model->getPagination();
        $this->state = $model->getState();
        $this->filterForm = $model->getFilterForm();
        $this->activeFilters = $model->getActiveFilters();

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('Manage sizes'), 'location');
        ToolBarHelper::addNew('sizes.add');
        ToolBarHelper::editList('sizes.edit');
        ToolBarHelper::divider();
        ToolBarHelper::publish('sizess.publish', 'Publish', true);
        ToolBarHelper::unpublish('sizess.unpublish', 'UnPublish', true);
        ToolBarHelper::divider();
        ToolBarHelper::deleteList('', 'sizess.delete');
    }
}