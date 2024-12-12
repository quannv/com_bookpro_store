<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bustrip.php  23-06-2012 23:33:14
 **/

namespace Joombooking\Component\Bookpro\Administrator\Table;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die('Restricted access');
class RouteTable extends Table
{

	/**
	 * Construct object.
	 *
	 * @param JDatabaseMySQL $db
	 *        	database connector
	 */
	public function __construct(DatabaseDriver $db)
	{

		parent::__construct('#__bookpro_route', 'id', $db);
	}

	function check()
	{
		if (!$this->id) {
		}
		if ($this->id) {
		}
		return true;
	}

	public function rebuild($parent_id = 0, $left = 0, $level = 0, $path = "")
	{
		// Get the database object
		$db = $this->_db;

		// Get all children of this node
		$db->setQuery('SELECT id FROM ' . $this->_tbl . ' WHERE parent_id=' . (int) $parent_id . ' ORDER BY parent_id, id');
		$children = $db->loadColumn();

		// The right value of this node is the left value + 1
		$right = $left + 1;

		// Execute this function recursively over all children
		for ($i = 0, $n = count($children); $i < $n; $i++) {
			// $right is the current right value, which is incremented on recursion return
			$right = $this->rebuild($children[$i], $right, $level + 1);

			// If there is an update failure, return false to break out of the recursion
			if ($right === false) {
				return false;
			}
		}

		// We've got the left value, and now that we've processed
		// the children of this node we also know the right value
		$db->setQuery('UPDATE ' . $this->_tbl . ' SET lft=' . (int) $left . ', rgt=' . (int) $right . ', level=' . (int) $level . ' WHERE id=' . (int) $parent_id);

		// If there is an update failure, return false to break out of the recursion
		if (!$db->execute()) {
			return false;
		}

		// Return the right value of this node + 1
		return $right + 1;
	}


	public function publish($pks = null, $state = 1, $userId = 0)
	{
		$k = $this->_tbl_key;

		// Sanitize input.
		ArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks)) {
			if ($this->$k) {
				$pks = array(
					$this->$k
				);
			} 			// Nothing to set publishing state on, return false.
			else {
				$this->setError(Text::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k . '=' . implode(' OR ' . $k . '=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time')) {
			$checkin = '';
		} else {
			$checkin = ' AND (checked_out = 0 OR checked_out = ' . (int) $userId . ')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery('UPDATE ' . $this->_db->quoteName($this->_tbl) . ' SET ' . $this->_db->quoteName('state') . ' = ' . (int) $state . ' WHERE (' . $where . ')' . $checkin);

		try {
			$this->_db->execute();
		} catch (Exception $e) {
			$this->setError($e->getMessage());
			return false;
		}


		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows())) {
			// Checkin the rows.
			foreach ($pks as $pk) {
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks)) {
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}
}
