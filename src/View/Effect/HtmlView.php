<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 27 2012-07-08 17:15:11Z quannv $
 **/

namespace Joombooking\Component\Bookpro\Administrator\View\Effect;

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


		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Prepare to display page.
	 *
	 * @param string $tpl name of used template
	 * @param TableCustomer $customer
	 * @param JUser $user
	 */
	protected function addToolbar()
	{

		$isNew      = ($this->item->id == 0);
		ToolbarHelper::title(
			$isNew ? Text::_('New') : Text::_('Edit Effect'),
			'bookmark'
		);

		ToolBarHelper::apply('effect.apply');
		ToolBarHelper::save('effect.save');
		ToolBarHelper::cancel('effect.cancel');
	}
}
