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

        $db = $this->getDatabase();
        $query = $db->getQuery(true);
        $query->select(array(
            'a.*,brands.title AS brand_title',
            'colors.title AS color_title',
            'sizes.title AS size_title',
            'types.title AS type_title',
            'surfaces.title AS surface_title',
            'designs.title AS design_title',
            "(SELECT GROUP_CONCAT(title SEPARATOR ', ')
            FROM #__bookpro_areas
            WHERE FIND_IN_SET(id, a.areas_id)) AS area_titles",
            "(SELECT GROUP_CONCAT(title SEPARATOR ', ')
            FROM #__bookpro_effects
            WHERE FIND_IN_SET(id, a.effects_id)) AS effect_titles",
        ));

        $query->from('#__bookpro_products AS a');

        $query->join('left', '#__bookpro_colors AS colors ON colors.id = a.color_id ');
        $query->join('left', '#__bookpro_sizes AS sizes ON sizes.id = a.size_id ');
        $query->join('left', '#__bookpro_surfaces AS surfaces ON surfaces.id = a.surface_id ');
        $query->join('left', '#__bookpro_types AS types ON types.id = a.type_id ');
        $query->join('left', '#__bookpro_brands AS brands ON brands.id = a.brand_id ');
        $query->join('left', '#__bookpro_designs AS designs ON designs.id = a.design_id ');
        $query->join('left', '#__bookpro_thicknesss AS thickness ON thickness.id = a.thickness_id ');

        
        $design_id = $this->getState('filter.design_id');
        if (!empty($design_id)) {
            $query->where('(a.design_id = ' . (int) $design_id . ')');
        }


        $color_id = $this->getState('filter.color_id');
        if (!empty($color_id)) {
            $query->where('(a.color_id = ' . (int) $color_id . ')');
        }

        $type_id = $this->getState('filter.type_id');
        if (!empty($type_id)) {
            $query->where('(a.type_id = ' . (int) $type_id . ')');
        }

        if ($search = $this->getState('filter.search')) {
           
                $search = '%' . str_replace(' ', '%', trim($search)) . '%';
                $query->where('(' . $db->quoteName('a.title') . ' LIKE :search1 OR ' . $db->quoteName('a.sku') . ' LIKE :search2)')
                ->bind([':search1', ':search2'], $search);
        }
        

        $state = $this->getState('filter.state');
        if (!empty($state)) {
            $query->where('(a.state = ' . (int) $state . ')');
        }

        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if (empty($orderCol) || empty($orderDirn)) {
            $orderCol = 'a.id';
            $orderDirn = 'ASC';
        }


        $query->group('a.id');

       // echo $db->replacePrefix((string) $query);
        //die;

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
