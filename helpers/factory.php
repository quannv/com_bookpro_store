<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 27 2012-07-08 17:15:11Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

use Joomla\Registry\Registry;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\User\UserFactoryInterface;
use Joomla\CMS\Component\ComponentHelper;

class JBFactory
{
	/**
	 * Get Joombooking config
	 * @return JRegistry
	 */
	static function getConfig()
	{
		return  ComponentHelper::getParams('com_bookpro');
	}

	/**
	 * Get Joombooking account logined
	 * @return Customer
	 */
	public static function getAccount()
	{
		$app = Factory::getApplication();
		$userFactory = Factory::getContainer()->get(UserFactoryInterface::class);
		$user = $userFactory->getUser();
		static $instance;
		if (empty($instance)) {
			$user = $userFactory->getUser();
			$instance = $app->bootComponent('com_bookpro')->getMVCFactory()->createTable('Customer', 'Administrator');

			$instance->load(array('user' => $user->id));

			$instance->juser = $user;
			$config = self::getConfig();
			$instance->isNormal = true;
			$instance->isAgent = false;
			$instance->isSupplier = false;
			$instance->isDriver = false;

			if (in_array($config->get('customer_usergroup'), $user->groups)) {
				$instance->isNormal = true;
			}
			if (in_array($config->get('agent_usergroup'), $user->groups)) {
				$instance->isAgent = true;
			}
			if (in_array($config->get('supplier_usergroup'), $user->groups)) {

				$instance = Table::getInstance('Agent', 'Table');
				$instance->load(array('user' => $user->id));
				$instance->isSupplier = true;
			}

			if (in_array($config->get('driver_usergroup'), $user->groups)) {
				$instance->isDriver = true;
			}

			$registry = new Registry;
			$registry->loadString($instance->params);
			$instance->params = $registry->toArray();

			if (isset($instance->params['commission'])) {
				$instance->commission = $instance->params['commission'];
			}
			if (isset($instance->params['credit'])) {
				$instance->credit = $instance->params['credit'];
			}
		}
		return $instance;
	}
}
