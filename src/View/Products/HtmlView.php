<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

namespace Joombooking\Component\Bookpro\Administrator\View\Products;

defined('_JEXEC') or die('Restricted access');



use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joombooking\Component\Bookpro\Administrator\Model\ProductsModel;

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
        /** @var VehiclesModel $model */
        $model               = $this->getModel();
        $this->items         = $model->getItems();
        $this->pagination    = $model->getPagination();
        $this->state         = $model->getState();
        $this->filterForm    = $model->getFilterForm();
        $this->activeFilters = $model->getActiveFilters();


        // foreach ($this->items as &$item) {
        //     $this->ordering[$item->parent_id][] = $item->id;
        // }
        $this->addToolbar();

        parent::display($tpl);
    }
    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('Products'), 'list');
        ToolBarHelper::addNew('product.add');
        ToolBarHelper::editList('product.edit');
        ToolBarHelper::divider();
        ToolBarHelper::publish('products.publish', 'Publish', true);
        ToolBarHelper::unpublish('products.unpublish', 'UnPublish', true);
        ToolBarHelper::divider();

        ToolBarHelper::deleteList('', 'products.delete');
    }
}
