<?php

/**
 * Popup element to select destination.
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: destination.php 44 2012-07-12 08:05:38Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.parameter.element');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldAgent extends JFormFieldList
{
	
	protected function getInput() {
		
		$db = JFactory::getDBO();
		
		$query=$db->getQuery(true);
		$query->select('id,company')->from('#__bookpro_agent')->order('company');
		$db->setQuery($query);
		$options 	= array();
		$options[] 	= JHTML::_('select.option',  '', JText::_('COM_BOOKPRO_SELECT_AGENT'), 'id', 'company');
		$options = array_merge($options, $db->loadObjectList()) ;
		return JHTML::_('select.genericlist', $options, $this->name, ' class="input" ', 'id', 'company', $this->value,$this->id) ;
	
	}

	

}

?>