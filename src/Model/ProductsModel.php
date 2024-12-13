<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: airport.php  23-06-2012 23:33:14
 **/

namespace Joombooking\Component\Bookpro\Administrator\Model;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Table\Table;
use Joomla\Database\ParameterType;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Methods supporting a list of banner records.
 *
 * @since  1.6
 */
class ProductsModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @since   1.6
     */
    public function __construct($config = [])
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = [
                'id', 'a.id',

                'state', 'a.state',
                'ordering', 'a.ordering',
                'created', 'a.created',
                'published',
                'code', 'a.code',
            ];
        }

        parent::__construct($config);
    }


    /**
     * Build an SQL query to load the list data.
     *
     * @return  \Joomla\Database\DatabaseQuery
     *
     * @since   1.6
     */
    protected function getListQuery()
    {
        $query = null;

        $db = $this->getDatabase();


        $query = $db->getQuery(true);

        // get table name
        $airportTable = $db->quoteName('#__bookpro_dest');

        $query->select(array(
            'product.*,operator.shortname,operator.company',
            'vehicle.title AS vehicle_name',
            'dest1.code AS from_code',
            'dest2.code AS to_code',
            'dest1.title AS fromName',
            'dest2.title AS toName',
            'operator.image AS operator_logo',

        ));

        $query->from('#__bookpro_product AS product');
        $query->join('left', $airportTable . ' AS dest1' . ' ON product.from = dest1.id ');
        $query->join('left', $airportTable . ' AS dest2' . ' ON product.to = dest2.id ');
        $query->join('left', '#__bookpro_operator AS operator ON operator.id = product.operator_id ');
        $query->join('left', '#__bookpro_vehicle AS vehicle ON vehicle.id = product.vehicle_id ');

       

        $from = $this->getState('filter.from');
        if (!empty($from)) {
            $query->where('(product.from = ' . (int) $from . ')');
        }
        $to = $this->getState('filter.to');
        if (!empty($to)) {
            $query->where('(product.to = ' . (int) $to . ')');
        }
        $vehicle_id = $this->getState('filter.vehicle_id');
        if (!empty($vehicle_id)) {
            $query->where('(product.vehicle_id = ' . (int) $vehicle_id . ')');
        }

        $operator_id = $this->getState('filter.operator_id');
        if (!empty($operator_id)) {
            $query->where('(product.operator_id = ' . (int) $operator_id . ')');
        }

        $state = $this->getState('filter.state');
        if (!empty($state)) {
            $query->where('(product.state = ' . (int) $state . ')');
        }

        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if (empty($orderCol) || empty($orderDirn)) {
            $orderCol = 'product.start';
            $orderDirn = 'ASC';
        }


        $query->group('product.id');

        return $query;
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string  $id  A prefix for the store id.
     *
     * @return  string  A store id.
     *
     * @since   1.6
     */
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.published');
        $id .= ':' . $this->getState('filter.level');

        return parent::getStoreId($id);
    }

    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param   string  $type    The table type to instantiate
     * @param   string  $prefix  A prefix for the table class name. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  Table  A Table object
     *
     * @since   1.6
     */
    public function getTable($type = 'Route', $prefix = 'Administrator', $config = [])
    {
        return parent::getTable($type, $prefix, $config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function populateState($ordering = 'a.id', $direction = 'asc')
    {
        // Load the parameters.
        $this->setState('params', ComponentHelper::getParams('com_bookpro'));

        // List state information.
        parent::populateState($ordering, $direction);
    }
}
