<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: airport.php  23-06-2012 23:33:14
 **/

namespace Joombooking\Component\Bookpro\Administrator\Table;

use Exception;
use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die('Restricted access');

class ProductTable extends Table
{

	public function __construct(DatabaseDriver $db)
	{

		//$this->setColumnAlias('published', 'state');
		parent::__construct('#__bookpro_products', 'id', $db);
		$this->setColumnAlias('published', 'state');
	}


	public function store($updateNulls = false)
	{

		return parent::store($updateNulls);
	}
	
	public function bind($data, $ignore = array())
	{
		if (isset($data['areas_id']) && is_array($data['areas_id'])) {
			// Convert array to comma-separated string
			$data['areas_id'] = implode(',', $data['areas_id']);
		}

		if (isset($data['effects_id']) && is_array($data['effects_id'])) {
			// Convert array to comma-separated string
			$data['effects_id'] = implode(',', $data['effects_id']);
		}

		return parent::bind($data, $ignore);
	}

	public function load($keys = null, $reset = true)
	{
		$result = parent::load($keys, $reset);

		if ($result) {
			if (!empty($this->areas_id)) {
				// Convert comma-separated string to array for areas_id
				$this->areas_id = explode(',', $this->areas_id);
			}

			if (!empty($this->effects_id)) {
				// Convert comma-separated string to array for effects_id
				$this->effects_id = explode(',', $this->effects_id);
			}
		}

		return $result;
	}


}
