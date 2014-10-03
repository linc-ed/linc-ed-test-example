<?php

/**
 * This is an example class for providing data to the validators.
 * It's more testable because it provides an addSchool method - we
 * can add our own invented schools for testing.
 * That way changes to which school numbers are valid, and which are
 * open or closed won't cause the test to break. We want to test
 * the validation logic itself - not if the data is up to date.
 */

require_once(dirname(__FILE__).'/MOESchool.php');


class MOECodeSets {

	public static $schools = null;

	public static function addSchool($schoolArray) {
		self::$schools[$schoolArray[0]] = new MOESchool($schoolArray);
	}

}
//This is a hack for initializing static variables. Used here just
//to keep our class tiny in this example. Avoid having logic outside
//of the class like this.
MOECodeSets::$schools = array();