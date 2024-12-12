<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

namespace Joombooking\Component\Bookpro\Administrator\View\Orders;

defined('_JEXEC') or die('Restricted access');

use Joombooking\Component\Bookpro\Administrator\Helper\JHtmlHelper;
use Joombooking\Component\Bookpro\Administrator\Model\AirportsModel;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joombooking\Component\Bookpro\Administrator\Model\RoutesModel;

class HtmlView extends BaseHtmlView
{
    /**
     * Array containing browse table filters properties.
     * 
     * @var array
     */
    var $lists;

    /**
     * Array containig browse table subjects items to display.
     *  
     * @var array
     */
    var $items;

    /**
     * Standard Joomla! browse tables pagination object.
     * 
     * @var JPagination
     */
    var $pagination;


    /**
     * Sign if table is used to popup selecting customers.
     * 
     * @var boolean
     */
    var $selectable;

    /**
     * Standard Joomla! object to working with component parameters.
     * 
     * @var $params JParameter
     */
    var $params;

    /**
     * Prepare to display page.
     * 
     * @param string $tpl name of used template
     */
    function display($tpl = null)

    {
        /** @var RoutesModel $model */
        $model               = $this->getModel();
        $this->items         = $model->getItems();
        $this->pagination    = $model->getPagination();
        $this->state         = $model->getState();
        $this->filterForm    = $model->getFilterForm();
        $this->activeFilters = $model->getActiveFilters();


        $this->addToolbar();

        parent::display($tpl);
    }
    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('COM_BOOKPRO_ORDERS_MANAGER'), 'location');
        ToolBarHelper::editList('order.edit');
        ToolBarHelper::divider();

        ToolBarHelper::deleteList('', 'orders.delete');
    }
}
