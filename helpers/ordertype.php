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
class OrderType {

	static $FLIGHT = null;
	static $TOUR = null;
	static $HOTEL = null;
	static $BUS = null;
	static $TRANSPORT = null;

	public $value = null;

	public static $map;
	private $key=null;
	public $text=null;

	public function __construct($value) {
		$this->value = $value;
		$this->text=$value;
	}

	public static function init () {
		self::$FLIGHT  = new OrderType("FLIGHT");
		self::$TOUR = new OrderType("TOUR");
		self::$HOTEL = new OrderType("HOTEL");
		self::$BUS = new OrderType("BUS");
		self::$TRANSPORT = new OrderType("TRANSPORT");
		//static map to get object by name - example Enum::get("INIT") - returns Enum::$INIT object;
		self::$map = array (self::$FLIGHT,self::$TOUR,self::$HOTEL,self::$BUS,self::$TRANSPORT);
	}

	public static function get($element) {
		if($element == null)
			return null;
		return self::$map[$element];
	}

	public function getValue() {
		return $this->value;
	}
	
	public function __getKey() {
		return $this->value;
	}
	public function __getText() {
		return $this->value;
	}
	public function __setKey($key){
		$this->key=$key;
	}
	
	public function equals(OrderType $element) {
		return $element->getValue() == $this->getValue();
	}

	public function __toString () {
		return $this->value;
	}
}