<?php

/**
 * Here's how I want the validators to work. A function that takes
 * an input string and returns true or false. This makes testing
 * much saner.
 */

require_once(dirname(__FILE__).'/MOECodeSets.php');

class MOEValidator {

	/**
	 * Validates that the SCHOOL ID is not null and is an open school
	 * @param  string $school_id
	 * @return boolean
	 */
	public static function validate_1_SCHOOL_ID($school_id) {
		return (
			isset(MOECodeSets::$schools[$school_id]) && 
			MOECodeSets::$schools[$school_id]->closed === false
		);
	}
}