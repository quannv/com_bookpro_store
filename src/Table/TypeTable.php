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

class TypeTable extends Table
{

	public function __construct(DatabaseDriver $db)
	{

		//$this->setColumnAlias('published', 'state');
		parent::__construct('#__bookpro_types', 'id', $db);
		$this->setColumnAlias('published', 'state');
	}

	

	public function bind($array, $ignore = '')
	{


		return parent::bind($array, $ignore);
	}
}
